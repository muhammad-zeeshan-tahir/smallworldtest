<?php

namespace App\Interfaces\StarWarMovie;

use App\Http\Requests\starWarMovieUpdateRequest;
use App\Repositories\StarWarMovieRepository;
use Illuminate\Http\JsonResponse;

interface StarWarMovieServiceInterface
{
    public function __construct(StarWarMovieRepository $star_war_movie_repository);

    public function getStarWarMovies($id): JsonResponse;

    public function getAllStarWarMovies(): JsonResponse;

    public function updateStarWarMovies(starWarMovieUpdateRequest $request, $id): JsonResponse;

}
