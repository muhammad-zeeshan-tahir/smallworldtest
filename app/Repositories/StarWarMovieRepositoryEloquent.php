<?php

namespace App\Repositories;

use App\Entities\Movie;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class StarWarMovieRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StarWarMovieRepositoryEloquent extends BaseRepository implements StarWarMovieRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Movie::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
