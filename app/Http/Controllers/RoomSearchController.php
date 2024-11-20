<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Preference;
use App\Models\Room;
use Illuminate\Http\Request;


class RoomSearchController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $selectedPreferences = $request->input('preferences', []);
    
        $query = Room::where('is_occupied', false)
            ->with(['boarding_house.preferences']);
    
        // Apply filtering by preferences if selected
        if (!empty($selectedPreferences)) {
            $query->whereHas('boarding_house.preferences', function ($q) use ($selectedPreferences) {
                $q->whereIn('id', $selectedPreferences);
            });
        }
    
        $rooms = $query->paginate(10);
    
        // Calculate similarity scores if search term is provided
        if ($searchTerm) {
            $rooms->through(function ($room) use ($searchTerm) {
                $room->similarity_score = max(
                    CosineSimilarityHelper::calculateSimilarity($searchTerm, $room->name),
                    CosineSimilarityHelper::calculateSimilarity($searchTerm, $room->boarding_house->name)
                );
                return $room;
            });
        }
    
        // Retrieve all preferences, grouped by category, to display in the view
        $allPreferences = Preference::all()->groupBy('category');
    
        return view('user.room-list', compact('rooms', 'searchTerm', 'selectedPreferences', 'allPreferences'));
    }
    
}
