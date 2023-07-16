<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class Movie.
 *
 * @package namespace App\Entities;
 */
class Movie extends Model
{
    use Uuids, HasFactory;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'overview',
        'url',
        'language',
        'popularity',
        'poster_path',
        'release_date',
        'video',
        'vote_average',
        'vote_count',
        'episode_id',
        'opening_crawl',
        'director',
        'producer',
        'adult',
        'backdrop_path'
    ];

    /**
     * Characters
     *
     * @return hasMany
     */
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class, 'movie_id');
    }

    /**
     * planets
     *
     * @return hasMany
     */
    public function planets(): HasMany
    {
        return $this->hasMany(Planet::class, 'movie_id');
    }

    /**
     * Starships
     *
     * @return hasMany
     */
    public function starships(): HasMany
    {
        return $this->hasMany(Starship::class, 'movie_id');
    }

    /**
     * Vehicles
     *
     * @return hasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'movie_id');
    }

    /**
     * Species
     *
     * @return hasMany
     */
    public function species(): HasMany
    {
        return $this->hasMany(Species::class, 'movie_id');
    }

}
