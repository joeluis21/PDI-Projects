<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_a_new_user_with_factory(): void
    {
        $user = User::factory(1)->createOne();
       var_dump($user); die;
    }
}
