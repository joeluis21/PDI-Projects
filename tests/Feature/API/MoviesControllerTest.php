<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MoviesControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_popular_movies(): void
    {
        $response = $this->get('/api/movies/getPopular/5');
        $response->assertStatus(200);
        dd($response);
    }
}
