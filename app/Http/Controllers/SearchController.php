<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use App\Models\Preference;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
{
    // Get user-selected preferences
    $selectedPreferences = $request->input('preferences', []); // Array of selected preferences IDs

    // Get all preferences (assuming you have a list of all preferences)
    $allPreferences = Preference::all()->pluck('id')->toArray();

    // Create user's binary vector
    $userVector = array_map(function ($preferenceId) use ($selectedPreferences) {
        return in_array($preferenceId, $selectedPreferences) ? 1 : 0;
    }, $allPreferences);

    // Get all boarding houses with their preferences
    $boardingHouses = BoardingHouse::with('preferences')->get();

    // Initialize an array to store the similarity scores
    $boardingHouseScores = [];

    foreach ($boardingHouses as $boardingHouse) {
        // Create the binary vector for the current boarding house
        $boardingHousePreferences = $boardingHouse->preferences->pluck('id')->toArray();

        $boardingHouseVector = array_map(function ($preferenceId) use ($boardingHousePreferences) {
            return in_array($preferenceId, $boardingHousePreferences) ? 1 : 0;
        }, $allPreferences);

        // Compute the cosine similarity between the user and the boarding house
        $similarityScore = $this->cosineSimilarity($userVector, $boardingHouseVector);

        // Store the result with the boarding house id and the score
        $boardingHouseScores[] = [
            'boarding_house' => $boardingHouse,
            'similarity_score' => $similarityScore,
        ];
    }

    // Sort the boarding houses by similarity score in descending order
    usort($boardingHouseScores, function ($a, $b) {
        return $b['similarity_score'] <=> $a['similarity_score'];
    });

    // Return the top results (e.g., top 5 boarding houses)
    $topResults = array_slice($boardingHouseScores, 0, 10);
    $preferences = Preference::all(); 

    return view('homeResult', compact('topResults', 'preferences'));
}

function cosineSimilarity(array $vecA, array $vecB)
{
    $dotProduct = 0;
    $magnitudeA = 0;
    $magnitudeB = 0;

    for ($i = 0; $i < count($vecA); $i++) {
        $dotProduct += $vecA[$i] * $vecB[$i];
        $magnitudeA += pow($vecA[$i], 2);
        $magnitudeB += pow($vecB[$i], 2);
    }

    $magnitudeA = sqrt($magnitudeA);
    $magnitudeB = sqrt($magnitudeB);

    if ($magnitudeA * $magnitudeB == 0) {
        return 0;
    }

    return $dotProduct / ($magnitudeA * $magnitudeB);
}

}
