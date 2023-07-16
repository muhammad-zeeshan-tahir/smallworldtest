<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserLogOutRequest;
use App\Models\User;
use App\Services\Authorization\UserAuthorizationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * @var userAuthorizationService
     */
    private $userAuthorizationService;


    /**
     * UsersAuthController constructor.
     *
     * @param UserAuthorizationService $userAuthorizationService
     */
    public function __construct(UserAuthorizationService $userAuthorizationService)
    {
        $this->userAuthorizationService = $userAuthorizationService;
    }


    /**
     * @OA\Post(
     * path="/api/login",
     * operationId="authLogin",
     * tags={"Authentication"},
     * summary="User Login",
     * description="Login User Here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email", "password"},
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="password", type="password")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function login(UserLoginRequest $request) : JsonResponse
    {
        return $this->userAuthorizationService->logIn($request);
    }


    /**
     * @OA\POST(
     *     path="/api/logout",
     *     tags={"Authentication"},
     *     summary="User logout",
     *     security={{"sanctum":{}}},
     *     operationId="logout",
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *     @OA\Response(response=500, description="Server error occured", @OA\JsonContent()),
     *     @OA\Response(response=201, description="Successful created", @OA\JsonContent()),
     * )
     */
    public function logout(UserLogOutRequest $request){
        return $this->userAuthorizationService->logOut($request);
    }
}
