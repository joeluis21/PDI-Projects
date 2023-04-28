<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;

class Movies extends Controller
{
    public function getPopular(string $number) : object
    {
        try {
            $movies = $this->business->getLastPopularMovies();
            $collection = collect($movies);
            $moviesByCount = $collection->take($number);
            return response()->json($moviesByCount, 200);
        } catch (Exception $e) {
            echo 'Error on response of movies: ',  $e->getMessage(), "\n";
        }
    }
}
