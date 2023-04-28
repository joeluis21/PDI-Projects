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
        $numberOfMovies = '10';
        $response = $this->get('/api/movies/getPopular/' . $numberOfMovies);
        $response->assertStatus(200);
        $response->assertJsonCount($numberOfMovies);

        $response->assertJson(function (AssertableJson $json) use ($response) {
            $json->hasAll(['0.nome', '0.generos', '0.adulto', '0.pontuacao', '0.poster', '0.idioma_original', '0.sinopse']);
            $json->whereAllType([
                '0.nome' => 'string',
                '0.generos' => 'string',
                '0.adulto' => 'boolean',
                '0.pontuacao' => 'double',
                '0.poster' => 'string',
                '0.idioma_original' => 'string',
                '0.sinopse' => 'string'
            ]);
        });
    }
}
