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

    private function get_token()
    {
        $user = factory(\App\User::class)->create();
        return $user->createToken('TestToken')->accessToken;
    }

    private function set_header()
    {
        $header = [];
        $header['Accept'] = 'application/json';
        $header['Authorization'] = 'Bearer '.$this->get_token();

        return $header;
    }

    public function test_create_access_token()
    {
        $token = $this->get_token();
        $this->assertTrue($token !== null);
    }

    public function test_get_shows()
    {
        $response = $this->json('GET', '/api/show', [], $this->set_header());

        $response
        ->assertStatus(200)
        ->assertJsonStructure([
          'data' => [
              '*' => [
                'id',
                'name',
                'description',
                'status',
                'created_at',
                'updated_at',
                'user_id',
              ]
          ]
      ]);
    }

    public function test_home_route()
    {
      $response = $this->get('/');

      $response
      ->assertStatus(200)
      ->assertSee('Podcasts');
    }

    public function test_get_show()
    {
        $id = factory(\App\Show::class)->create()->id;

        $response = $this->json('GET', '/api/show/'.$id, [], $this->set_header());
        $response->assertStatus(200);
    }

    public function test_get_seasons()
    {
        $response = $this->json('GET', '/api/seasons', [], $this->set_header());
        $response->assertStatus(404);
    }

    public function test_get_episodes()
    {
        $response = $this->json('GET', '/api/episodes', [], $this->set_header());
        $response->assertStatus(404);
    }
}
