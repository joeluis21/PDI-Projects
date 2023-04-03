<?php

namespace App\Business\API;

use Illuminate\Http\Request;
use App\Facades\MoviesFacade;
use Exception;

class Movies
{
    private $key = "b4bce14b774116c09c4f3805ad0f3dc0";

    public function getLastPopularMovies($number)
    {
        $response = MoviesFacade::get('/movie/popular?api_key=' . $this->key . '&language=pt-BR&page=1');
        $lastPopularMovies = $response->object();
        if (!$response->ok()) {
            throw new Exception();
        }
        foreach ($lastPopularMovies->results as $movie) {
            $moviesArray = [
                'nome' => $movie->original_title,
                'generos' =>  $this->getGenresById($movie->genre_ids),
                'adulto' => $movie->adult,
                'pontuacao' => $movie->vote_average,
                'poster' => $movie->poster_path,
                'idioma_original' => $movie->original_language,
                'sinopse' => $movie->overview
            ];
            $movies[] = $moviesArray;
        }
        return $movies;
    }

    private function getGenresById($genres)
    {
        try {
            $response = MoviesFacade::get('/genre/movie/list?api_key=' . $this->key . '&language=pt-BR');
            if (!$response->ok()) {
                throw new Exception();
            }
            $responseObj = $response->object();

            $generos = [];
            foreach ($genres as $genre) {
                foreach ($responseObj->genres as $genresapi) {
                    if ($genre == $genresapi->id) {
                        $genre = $genresapi->name;
                    }
                }
                $generos[] = $genre;
            }
            $genero =  implode(',', $generos);
            return $genero;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
