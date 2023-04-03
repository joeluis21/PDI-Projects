<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class MoviesControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_popular_movies(): void
    {
        $numberOfMovies = '5';
        $response = $this->get('/api/movies/getPopular/' . $numberOfMovies);
        $response->assertStatus(200);
        $response->assertJsonCount( $numberOfMovies);
        dd($response);
    }
}
