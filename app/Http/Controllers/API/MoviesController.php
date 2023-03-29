<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function getLastPopularMovies($number)
    {
        $externalAPI = "https://api.themoviedb.org/3/movie/popular?api_key=b4bce14b774116c09c4f3805ad0f3dc0&language=pt-BR&page=1";
        $response = file_get_contents($externalAPI);
        $lastPopularMovies = json_decode($response);

        $collection = collect($lastPopularMovies->results);
        $primeirosCinco = $collection->take($number);

        return response()->json($primeirosCinco);
    }
}
