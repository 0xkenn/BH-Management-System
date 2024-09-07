<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        // Perform search logic here

        return view('search-results', compact('query')); // Example view
    }
}
