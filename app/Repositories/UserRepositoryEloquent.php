<?php

namespace App\Repositories;

use App\Entities\User;
use App\Validators\UserValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Specify Validators class name
     *
     * @return mixed
     */
    public function validator()
    {

        return UserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function changePassword($request, $user)
    {
        try {
            return $this->update([
                'password' => bcrypt($request->password)
            ], $user['id']);
        } catch (Exception $e) {
            Log::critical('USER_RESET_PASSWORD_ERROR', [
                'errorMessage' => $e->getMessage(),
                'errorStack' => $e->getTraceAsString(),
                'request' => $request,
                'extra' => [
                    'errorMessage' => $e->getMessage(),
                    'password' => $request->password,
                ]
            ]);

            return $e;
        }
    }

    public function updateUser($request, $user_id)
    {
        try {
            $result = $this->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'country' => $request->country,
                'city' => $request->city,
                'phone_no' => $request->phone_no
            ], $user_id);

            if ($request->has('profile_photo')) {
                $images = collect($request->profile_photo)
                    ->filter(function ($item) {
                        return !isset($item['id']);
                    })
                    ->map(function ($item) {
                        return [
                            'filename' => $item['filename'],
                            'mimetype' => $item['mimetype'],
                            'group' => 'images',
                        ];
                    });
                $attachment = $this->attachMedia($images->values()->toArray(), $result);

                if ($attachment instanceof \Exception) {
                    return $attachment->getMessage();
                }
            }

            return $result;

        } catch (Exception $e) {
            Log::critical('USER_UPDATE_ERROR', [
                'errorMessage' => $e->getMessage(),
                'errorStack' => $e->getTraceAsString(),
                'request' => $request,
                'extra' => [
                    'errorMessage' => $e->getMessage(),
                    'user_id' => $user_id,
                ]
            ]);

            return $e;
        }
    }
}
