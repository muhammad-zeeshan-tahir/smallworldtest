<?php

namespace App\Services\Authorization;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Helpers\APIResponse;
use App\Interfaces\Authorization\UserAuthorizationServiceInterface;
use App\Models\User;
use App\Repositories\UserRepository;

use Auth;
class UserAuthorizationService implements UserAuthorizationServiceInterface
{
    /**
     * @var $userRepository ;
     */
    protected $userRepository;


    /**
     * UserAuthorizationService Constructor
     * @param UserRepository $user_repository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Authenticate user
     * @param $request
     * @return JsonResponse
     */
    public function logIn($request): JsonResponse
    {
        try {


            if(!\Illuminate\Support\Facades\Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            $user->tokens()->where('name', "TOKEN")->delete();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * LogOut the user
     * @param Request $request
     */
    public function logOut($request): JsonResponse
    {

        $user = User::where('email', auth()->user()->email)->first();
        $user->tokens()->where('name', "TOKEN")->delete();

        return response()->json([
            "status" =>true,
            "message" => "Successfully Logged out."
        ]);
    }

}



