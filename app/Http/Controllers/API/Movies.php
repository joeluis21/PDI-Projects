<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\MoviesFacade;
use Exception;

class Movies extends Controller
{
    public function getPopular($number)
    {
        try {
            $movies = $this->business->getLastPopularMovies($number);
            $collection = collect($movies);
            $moviesByCount = $collection->take($number);
            return response()->json($moviesByCount, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
