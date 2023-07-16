<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\starWarMovieUpdateRequest;
use App\Services\StarWarMovie\StarWarMovieService;
use Illuminate\Http\JsonResponse;

class StarWarMovieController extends Controller
{

    /**
     * @var starWarMovieService
     */
    private $starWarMovieService;


    /**
     * StarWarMovieController constructor.
     *
     * @param starWarMovieService $starWarMovieService
     */
    public function __construct(StarWarMovieService $starWarMovieService)
    {
        $this->starWarMovieService = $starWarMovieService;
    }


    /**
     * @OA\Get(
     *      path="/api/movie",
     *      summary="Get all Star War Movies",
     *      tags={"Star War Movies"},
     *      security={ {"sanctum": {} }},
     *      description="Returns basic information about the movies",
     *      @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *      @OA\Response(response=500, description="Server error occured", @OA\JsonContent()),
     *      @OA\Response(response=201, description="Successful created", @OA\JsonContent())
     * )
     */
    public function index() : JsonResponse
    {
        return $this->starWarMovieService->getAllStarWarMovies();
    }

    /**
     * @OA\Get(
     *     path="/api/movie/{id}",
     *     tags={"Star War Movies"},
     *     summary="Get specific star war movie by id ",
     *     security={{"sanctum":{}}},
     *     description="Returns detailed information about the movie",
     *     @OA\Parameter(
     *          name="id",
     *          description="Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *     @OA\Response(response=500, description="Server error occured", @OA\JsonContent()),
     *     @OA\Response(response=201, description="Successfull created", @OA\JsonContent()),
     * )
     */
    public function show($id=null) : JsonResponse
    {
        return $this->starWarMovieService->getStarWarMovies($id);
    }


    /**
     * @OA\Put(
     *     path="/api/movie/{id}",
     *     tags={"Star War Movies"},
     *     summary="Update specific star war movie by id ",
     *     security={{"sanctum":{}}},
     *     description="Returns information about the specific movie updation",
     *     @OA\Parameter(
     *          name="id",
     *          description="Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\RequestBody(
     *       @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"title", "url", "release_date",
     *                           "director", "opening_crawl", "episode_id", "producer","adult",
     *                           "backdrop_path", "language", "popularity", "poster_path","video",
     *                           "vote_average", "vote_count", "characters"
     *                          },
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="episode_id", type="string"),
     *                 @OA\Property(property="opening_crawl", type="string"),
     *                 @OA\Property(property="director", type="string"),
     *                 @OA\Property(property="producer", type="string"),
     *                 @OA\Property(property="release_date", type="string"),
     *                 @OA\Property(property="url", type="string"),
     *                 @OA\Property(property="adult", type="string"),
     *                 @OA\Property(property="backdrop_path", type="string"),
     *                 @OA\Property(property="language", type="string"),
     *                 @OA\Property(property="popularity", type="string"),
     *                 @OA\Property(property="poster_path", type="string"),
     *                 @OA\Property(property="video", type="string"),
     *                 @OA\Property(property="vote_average", type="string"),
     *                 @OA\Property(property="vote_count", type="string")
     *             )
     *          )
     *     ),
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *     @OA\Response(response=500, description="Server error occured", @OA\JsonContent()),
     *     @OA\Response(response=201, description="Successful created", @OA\JsonContent()),
     * )
     */
    public function update(starWarMovieUpdateRequest $request, $id=null): JsonResponse
    {
        return $this->starWarMovieService->updateStarWarMovies($request, $id);
    }


    /**
     * @OA\Delete(
     *     path="/api/movie/{id}",
     *     tags={"Star War Movies"},
     *     summary="Delete specific star war movie by id ",
     *     security={{"sanctum":{}}},
     *     description="Returns information about the specific movie deletion",
     *     @OA\Parameter(
     *          name="id",
     *          description="Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *     @OA\Response(response=500, description="Server error occured", @OA\JsonContent()),
     *     @OA\Response(response=201, description="Successfull created", @OA\JsonContent()),
     * )
     */
    public function delete($id=null) : JsonResponse
    {
        return $this->starWarMovieService->deleteStarWarMovies($id);
    }


}
