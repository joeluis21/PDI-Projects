<?php

namespace App\Business\API;

use Illuminate\Http\Request;
use App\Facades\MoviesFacade;
use Exception;

class Movies
{
    public function getLastPopularMovies(): array
    {
        $response = MoviesFacade::get('/movie/popular?api_key=' . env('TMDB_KEY') . '&language=' . env('TMDB_LANGUAGE') . '&page=' . env('TMDB_PAGES') . '');
        $lastPopularMovies = $response->object();
        if (!$response->ok()) {
            throw new Exception('Error in response of TMDB');
        }
        foreach ($lastPopularMovies->results as $movie) {
            $moviesArray = [
                'nome' => $movie->original_title,
                'generos' =>  $this->separateGenresIds($movie->genre_ids),
                'adulto' => $movie->adult,
                'data_lancamento' => $this->dateBr($movie->release_date),
                'pontuacao' => $movie->vote_average,
                'poster' => $movie->poster_path,
                'idioma_original' => $movie->original_language,
                'sinopse' => $movie->overview
            ];
            $movies[] = $moviesArray;
        }
        return $movies;
    }

    private function separateGenresIds(array $genres): string
    {

        $response = $this->getGenresResponse();

        foreach ($genres as $genre) {
            $generos[] =  $this->getGenresById($genre, $response);
        }
        return $this->separateGenresByComma($generos);
    }

    private function getGenresById(string $genre , object $response): string
    {
        try {
            foreach ($response->genres as $genresapi) {

                if ($genre == $genresapi->id) {
                    $genre = $genresapi->name;
                }
            }
            return $genre;
        } catch (Exception $e) {
            echo 'Error on response of genres: ',  $e->getMessage(), "\n";
        }
    }

    private function getGenresResponse() : object
    {
        $response = MoviesFacade::get('/genre/movie/list?api_key=' .  env('TMDB_KEY')  . '&language=' . env('TMDB_LANGUAGE') . '');
        if (!$response->ok()) {
            throw new Exception('Error in response of TMDB');
        }
        return $response->object();
    }

    private function separateGenresByComma(array $generos): string
    {
        return implode(',', $generos);
    }

    private function dateBr(string $date, string $format = 'd/m/Y'): string
    {
        return date($format, (strtotime($date)));
    }
}
