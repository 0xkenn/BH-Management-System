<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomSearchController extends Controller
{

    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $rooms = Room::where('is_occupied', false)->with('boarding_house')->get();

        if ($searchTerm) {
            // Calculate similarity scores
            $rooms = $rooms->map(function ($room) use ($searchTerm) {
                $room->similarity_score = max(
                    CosineSimilarityHelper::calculateSimilarity($searchTerm, $room->name),
                    CosineSimilarityHelper::calculateSimilarity($searchTerm, $room->boarding_house->name)
                );
                return $room;
            });

            // Sort rooms by similarity score in descending order
            $rooms = $rooms->sortByDesc('similarity_score')->values();
        }

        return view('user.room-list', compact('rooms', 'searchTerm'));
    }
    
}
