<?php

namespace Tests\Feature\Auth;

use App\Entities\Movie;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class StarWarMovieTest extends TestCase
{

    public function testSetUp()
    {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        $this->assertTrue(true);
    }

    public function testStarWarMovieIndex(){

        $user = ['email' => 'test@email.com', 'password' => 'testPassword'];
        Auth::attempt($user);
        $token = Auth::user()->createToken('TEST TOKEN')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('GET', route('movie.index'), [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'status',
                'message'
            ]);

    }

    public function testStarWarMovieShow()
    {
        $user = ['email' => 'test@email.com', 'password' => 'testPassword'];
        Auth::attempt($user);
        $token = Auth::user()->createToken('TEST TOKEN')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];


        $movie = Movie::create([
            'title' => 'Jollof Rice',
            "episode_id"  =>  333,
            "opening_crawl"  => "wewe",
            "director"  => "wewew",
            "producer"  => "wewe",
            "release_date"  => "1980-05-17",
            "url"  => "https://swapi.dev/api/films/2/",
            "adult"  => "3",
            "backdrop_path"  => "/aJCtkxLLzkk1pECehVjKHA2lBgw.jpg",
            "language"  => "en",
            "popularity"  => "39.796",
            "poster_path"  => "/2l05cFWJacyIsTpsqSgH0wQXe4V.jpg",
            "video" => "0",
            "vote_average" =>  "8.204",
            "vote_count"  =>"18873"

        ]);
        $response = $this->json('GET', url('api/movie/'.$movie->id), [], $headers);

        $response->assertStatus(200);

        $this->assertEquals('Jollof Rice', $response->json()['data']['title']);

        Movie::where('id',$movie->id)->delete();
    }

    public function testStarWarMovieUpdate(){

        $user = ['email' => 'test@email.com', 'password' => 'testPassword'];
        Auth::attempt($user);
        $token = Auth::user()->createToken('TEST TOKEN')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];

        $movie = Movie::create([
            'title' => 'Jollof Rice',
            "episode_id"  =>  333,
            "opening_crawl"  => "wewe",
            "director"  => "wewew",
            "producer"  => "wewe",
            "release_date"  => "1980-05-17",
            "url"  => "https://swapi.dev/api/films/2/",
            "adult"  => "3",
            "backdrop_path"  => "/aJCtkxLLzkk1pECehVjKHA2lBgw.jpg",
            "language"  => "en",
            "popularity"  => "39.796",
            "poster_path"  => "/2l05cFWJacyIsTpsqSgH0wQXe4V.jpg",
            "video" => "0",
            "vote_average" =>  "8.204",
            "vote_count"  =>"18873"

        ]);
        $response = $this->json('Put', url('api/movie/'.$movie->id), [
            'title' => 'Jollof Rice Updated',
            "episode_id"  =>  333,
            "opening_crawl"  => "wewe",
            "director"  => "wewew",
            "producer"  => "wewe",
            "release_date"  => "1980-05-17",
            "url"  => "https://swapi.dev/api/films/2/",
            "adult"  => "3",
            "backdrop_path"  => "/aJCtkxLLzkk1pECehVjKHA2lBgw.jpg",
            "language"  => "en",
            "popularity"  => "39.796",
            "poster_path"  => "/2l05cFWJacyIsTpsqSgH0wQXe4V.jpg",
            "video" => "0",
            "vote_average" =>  "8.204",
            "vote_count"  =>"18873"
        ], $headers);

        $response->assertStatus(200);
        $this->assertEquals('Jollof Rice Updated', $response->json()['data']['title']);

        Movie::where('id',$movie->id)->delete();
    }

    public function testStarWarMovieDelete(){

        $user = ['email' => 'test@email.com', 'password' => 'testPassword'];
        Auth::attempt($user);
        $token = Auth::user()->createToken('TEST TOKEN')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];


        $movie = Movie::create([
            'title' => 'Jollof Rice',
            "episode_id"  =>  333,
            "opening_crawl"  => "wewe",
            "director"  => "wewew",
            "producer"  => "wewe",
            "release_date"  => "1980-05-17",
            "url"  => "https://swapi.dev/api/films/2/",
            "adult"  => "3",
            "backdrop_path"  => "/aJCtkxLLzkk1pECehVjKHA2lBgw.jpg",
            "language"  => "en",
            "popularity"  => "39.796",
            "poster_path"  => "/2l05cFWJacyIsTpsqSgH0wQXe4V.jpg",
            "video" => "0",
            "vote_average" =>  "8.204",
            "vote_count"  =>"18873"

        ]);
        $response = $this->json('Delete', url('api/movie/'.$movie->id), [], $headers);

        $response->assertStatus(200);

        $this->assertEquals(0,Movie::where('id',$movie->id)->count());
    }

}
