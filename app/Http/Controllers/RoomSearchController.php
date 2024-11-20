<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Preference;
use Illuminate\Http\Request;

class RoomSearchController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve search term and selected preferences
        $searchTerm = $request->input('search');
        $selectedPreferences = $request->input('preferences', []);

        // Build the query for rooms
        $query = Room::where('is_occupied', false)
            ->with(['boarding_house.preferences']);

        // Apply filtering by preferences if selected
        if (!empty($selectedPreferences)) {
            $query->whereHas('boarding_house.preferences', function ($q) use ($selectedPreferences) {
                $q->whereIn('id', $selectedPreferences);
            });
        }

        // Paginate the results (10 items per page)
        $rooms = $query->paginate(12);

        // Calculate similarity scores if a search term is provided
        if ($searchTerm) {
            $rooms->through(function ($room) use ($searchTerm) {
                $room->similarity_score = max(
                    $this->cosineSimilarity($searchTerm, $room->name),
                    $this->cosineSimilarity($searchTerm, $room->boarding_house->name)
                );
                return $room;
            });
            $rooms = $rooms->setCollection(
                $rooms->getCollection()->sortByDesc('similarity_score')
            );
        }

        // Retrieve all preferences grouped by category to display in the view
        $allPreferences = Preference::all()->groupBy('category');

        return view('user.room-list', compact('rooms', 'searchTerm', 'selectedPreferences', 'allPreferences'));
    }

    // Compute cosine similarity between two strings
    private function cosineSimilarity($stringA, $stringB)
    {
        $vecA = $this->stringToVector($stringA);
        $vecB = $this->stringToVector($stringB);

        $dotProduct = 0;
        $magnitudeA = 0;
        $magnitudeB = 0;

        foreach ($vecA as $i => $val) {
            $dotProduct += $val * ($vecB[$i] ?? 0);
            $magnitudeA += pow($val, 2);
            $magnitudeB += pow($vecB[$i] ?? 0, 2);
        }

        $magnitudeA = sqrt($magnitudeA);
        $magnitudeB = sqrt($magnitudeB);

        return ($magnitudeA * $magnitudeB == 0) ? 0 : $dotProduct / ($magnitudeA * $magnitudeB);
    }

    // Convert a string to a character frequency vector
    private function stringToVector($string)
    {
        $vector = [];
        $string = strtolower(preg_replace('/[^a-z0-9]/', '', $string)); // Clean string

        foreach (count_chars($string, 1) as $char => $count) {
            $vector[chr($char)] = $count;
        }

        return $vector;
    }
}
