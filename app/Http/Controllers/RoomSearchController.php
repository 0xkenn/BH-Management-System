<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Preference;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RoomSearchController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $selectedPreferences = $request->input('preferences', []);

        // Fetch rooms with their boarding houses and preferences
        $rooms = Room::where('is_occupied', false)
            ->with(['boarding_house.preferences'])  // Load preferences with boarding house
            ->get();

        // Calculate similarity scores if search term is provided
        if ($searchTerm) {
            $rooms = $rooms->map(function ($room) use ($searchTerm) {
                // Calculate similarity with room name and boarding house name
                $room->similarity_score = max(
                    CosineSimilarityHelper::calculateSimilarity($searchTerm, $room->name),
                    CosineSimilarityHelper::calculateSimilarity($searchTerm, $room->boarding_house->name)
                );
                return $room;
            });

            // Sort rooms by similarity score in descending order, keeping all rooms
            $rooms = $rooms->sortByDesc('similarity_score')->values();
        }

        // Filter rooms by selected preferences if any are provided
        if (!empty($selectedPreferences)) {
            $rooms = $rooms->filter(function ($room) use ($selectedPreferences) {
                $roomPreferenceIds = $room->boarding_house->preferences->pluck('id')->toArray();  // Get array of preference IDs
                return !array_diff($selectedPreferences, $roomPreferenceIds);  // Ensure all selected preferences match
            })->values();
        }

        // Paginate the results (12 items per page)
        $rooms = $this->paginate($rooms, 12, $request->page);

        // Retrieve all preferences, grouped by category, to display in the view
        $allPreferences = Preference::all()->groupBy('category');

        return view('user.room-list', compact('rooms', 'searchTerm', 'selectedPreferences', 'allPreferences'));
    }

    /**
     * Paginate a Laravel collection or array.
     *
     * @param Collection|array $items
     * @param int $perPage
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    private function paginate($items, $perPage = 12, $page = null)
    {
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }
}
