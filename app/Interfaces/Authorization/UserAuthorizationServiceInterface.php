<?php

namespace App\Interfaces\Authorization;

use App\Http\Requests\UserLoginRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Http\JsonResponse;

interface UserAuthorizationServiceInterface
{
    public function __construct(UserRepository $user_repository);

    public function logIn(UserLoginRequest $request): JsonResponse;

    public function logOut(UserLogOutRequest $request): JsonResponse;
}
