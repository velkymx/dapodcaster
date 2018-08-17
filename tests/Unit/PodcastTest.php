<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Podcast;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PodcastTest extends TestCase
{

  use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_access_token()
    {

              $user = factory(\App\User::class)->create();

              $token = $user->createToken('TestToken')->accessToken;

              $this->assertTrue($token !== null);

              $header = [];
              $header['Accept'] = 'application/json';
              $header['Authorization'] = 'Bearer '.$token;

              $response = $this->json('GET', '/api/podcasts', [], $header);

              $response->assertStatus(200);

    }
}
