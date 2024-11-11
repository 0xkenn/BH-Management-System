<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CosineSimilarityHelper extends Controller
{
    public static function calculateSimilarity($query, $text)
    {
        $queryWords = self::textToVector($query);
        $textWords = self::textToVector($text);

        $dotProduct = 0;
        foreach ($queryWords as $word => $queryCount) {
            if (isset($textWords[$word])) {
                $dotProduct += $queryCount * $textWords[$word];
            }
        }

        $queryMagnitude = sqrt(array_sum(array_map(fn($count) => $count ** 2, $queryWords)));
        $textMagnitude = sqrt(array_sum(array_map(fn($count) => $count ** 2, $textWords)));

        return ($queryMagnitude * $textMagnitude) ? $dotProduct / ($queryMagnitude * $textMagnitude) : 0;
    }

    private static function textToVector($text)
    {
        $words = str_word_count(strtolower($text), 1);
        return array_count_values($words);
    }
}
