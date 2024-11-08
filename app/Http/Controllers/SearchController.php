<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use App\Models\Preference;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Retrieve user-selected preferences and search term
        $selectedPreferences = $request->input('preferences', []); // Array of selected preference IDs
        $searchQuery = $request->input('search'); // Search input for boarding house name

        // Fetch all preference IDs for consistent vector creation
        $allPreferences = Preference::all()->pluck('id')->toArray();

        // Build the user's binary vector based on selected preferences
        $userVector = array_map(fn($preferenceId) => in_array($preferenceId, $selectedPreferences) ? 1 : 0, $allPreferences);

        // Query boarding houses, applying name filter if search query is present
        $boardingHouses = BoardingHouse::with('preferences')
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where('name', 'LIKE', '%' . $searchQuery . '%');
            })
            ->get();

        // Calculate similarity scores for each boarding house
        $boardingHouseScores = $boardingHouses->map(function ($boardingHouse) use ($userVector, $allPreferences) {
            // Create the binary vector for the boarding house based on its preferences
            $boardingHouseVector = array_map(fn($preferenceId) => in_array($preferenceId, $boardingHouse->preferences->pluck('id')->toArray()) ? 1 : 0, $allPreferences);

            // Compute cosine similarity score
            $similarityScore = $this->cosineSimilarity($userVector, $boardingHouseVector);

            return [
                'boarding_house' => $boardingHouse,
                'similarity_score' => $similarityScore,
            ];
        })->sortByDesc('similarity_score')->values()->all();

        // Fetch all preferences to display in the view
        $preferences = Preference::all();

        return view('homeResult', compact('boardingHouseScores', 'preferences'));
    }

    // Compute cosine similarity between two binary vectors
    private function cosineSimilarity(array $vecA, array $vecB)
    {
        $dotProduct = 0;
        $magnitudeA = 0;
        $magnitudeB = 0;

        foreach ($vecA as $i => $val) {
            $dotProduct += $val * $vecB[$i];
            $magnitudeA += pow($val, 2);
            $magnitudeB += pow($vecB[$i], 2);
        }

        $magnitudeA = sqrt($magnitudeA);
        $magnitudeB = sqrt($magnitudeB);

        return ($magnitudeA * $magnitudeB == 0) ? 0 : $dotProduct / ($magnitudeA * $magnitudeB);
    }
}
