<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Entities\Movie;
use DB;


class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*
        $searchResults = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
            ->json()['results'];
        */

        $searchMovieResults = Http::withToken(config('services.tmdb.token'))
            ->get('https://swapi.dev/api/films')
            ->json()['results'];

        foreach ( $searchMovieResults as $row) {

            $imdbSearchResults = Http::get(
                'https://api.themoviedb.org/3/search/movie?'.
                    'query='.'Star Wars '.$row['title'].
                    '&api_key='.env('MOVIE_DB_API_KEY')
                )->json()['results'][0];

            $movie = Movie::create([
                'title' => $row['title'],
                'episode_id' => $row['episode_id'],
                'opening_crawl' => $row['opening_crawl'],
                'director' => $row['director'],
                'producer' => $row['producer'],
                'release_date' => $row['release_date'],
                'url' => $row['url'],
                'adult'=>$imdbSearchResults['adult'],
                'backdrop_path'=>$imdbSearchResults['backdrop_path'],
                'language'=>$imdbSearchResults['original_language'],
                'popularity'=>$imdbSearchResults['popularity'],
                'poster_path'=>$imdbSearchResults['poster_path'],
                'video'=>$imdbSearchResults['video'],
                'vote_average'=>$imdbSearchResults['vote_average'],
                'vote_count'=>$imdbSearchResults['vote_count']
            ]);


            foreach($row['characters'] as $url) {
                $movie->characters()->create(['movie_id' => $movie->id, 'url' => $url]);
            }

            foreach($row['planets'] as $url) {
                $movie->planets()->create(['movie_id' => $movie->id, 'url' => $url]);
            }

            foreach($row['species'] as $url) {
                $movie->species()->create(['movie_id' => $movie->id, 'url' => $url]);
            }

            foreach($row['vehicles'] as $url) {
                $movie->vehicles()->create(['movie_id' => $movie->id, 'url' => $url]);
            }

            foreach($row['starships'] as $url) {
                $movie->starships()->create(['movie_id' => $movie->id, 'url' => $url]);
            }

        }
    }
}
