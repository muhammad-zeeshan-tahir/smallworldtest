<?php

namespace App\Services\StarWarMovie;

use Illuminate\Http\JsonResponse;
use App\Helpers\APIResponse;
use App\Interfaces\StarWarMovie\StarWarMovieServiceInterface;
use App\Repositories\StarWarMovieRepository;

class StarWarMovieService implements StarWarMovieServiceInterface
{
    /**
     * @var $starWarMovieRepository ;
     */
    protected $starWarMovieRepository;


    /**
     * StarWarMovieService Constructor
     * @param StarWarMovieRepository $starWarMovieRepository
     */
    public function __construct(StarWarMovieRepository $starWarMovieRepository)
    {
        $this->starWarMovieRepository = $starWarMovieRepository;
    }

    /**
     * Get all Star War Movies
     * @return JsonResponse
     */
    public function getAllStarWarMovies(): JsonResponse
    {
        try {
            $starWarMovies = $this->starWarMovieRepository
                 ->select(['id', 'title', 'release_date', 'url'])
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'Get All Star War Movies Successfully',
                'data' => $starWarMovies
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * Get Specific Star War Movies
     * @return JsonResponse
     */
    public function getStarWarMovies($id): JsonResponse
    {

        try {
            $starWarMovies = $this->starWarMovieRepository
                ->with(['vehicles', 'Planets', 'Characters', 'StarShips', 'Species'])
                ->where('id', $id)
                ->first();
            return response()->json([
                'status' => true,
                'message' => 'Get All Star War Movies Successfully',
                'data' => $starWarMovies
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * Delete Specific Star War Movies
     * @return JsonResponse
     */
    public function deleteStarWarMovies($id): JsonResponse
    {
        try
        {
            $isExist =  $this->starWarMovieRepository->where('id', $id)->exists();

            if($isExist) {
                $this->starWarMovieRepository->where('id', $id)->delete();
                return response()->json([
                    'status' => true,
                    'message' => $id . ' successfully deleted ',
                ], 200);
            }
            else{
                return response()->json([
                    'status' => false,
                    'message' => $id.' does not exit',
                ], 200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * Update Specific Star War Movies
     * @return JsonResponse
     */
    public function updateStarWarMovies($request, $id) : JsonResponse
    {
        try {
            $updatedStarWarMovies = $this->starWarMovieRepository->update([
                'title' => $request->title,
                'episode_id' => $request->episode_id,
                'opening_crawl' => $request->opening_crawl,
                'director' => $request->director,
                'producer' => $request->producer,
                'release_date' => $request->release_date,
                'url' => $request->url,
                'adult'=> $request->adult,
                'backdrop_path'=> $request->backdrop_path,
                'language'=> $request->language,
                'popularity'=> $request->popularity,
                'poster_path'=> $request->poster_path,
                'video'=> $request->video,
                'vote_average'=> $request->vote_average,
                'vote_count'=> $request->vote_count
            ], $id);

            return response()->json([
                'status' => true,
                'message' => $id . ' successfully updated ',
                'data' => $updatedStarWarMovies
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}



