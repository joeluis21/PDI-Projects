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
        foreach ($lastPopularMovies->results as $movie) {
            $moviesArray = [
                'nome' => $movie->original_title,
                'generos' => $movie->genre_ids,
                'adulto' => $movie->adult,
                'pontuacao' => $movie->vote_average,
                'poster' => $movie->poster_path,
                'idioma_original' => $movie->original_language,
                'sinopse' => $movie->overview
            ];
            
            $movies[] = $moviesArray;
        }

        $collection = collect($movies);
        $moviesByCount = $collection->take($number);
        return response()->json($moviesByCount, 200);
    }
}
