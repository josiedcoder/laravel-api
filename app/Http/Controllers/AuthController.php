<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegisterRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function register(UserRegisterRequest $request)
    {
        $token = $this->userService->createUser($request);

        return response()->json([
            'message' => 'User Registration successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], Response::HTTP_CREATED);
    }

    public function login(UserLoginRequest $request)
    {
        if (!$this->userService->validateUser($request['email'], $request['password'])) {
            return response()->json([
                'errors' => ['login' => ['Login credentials are invalid.']],
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = (new UserService())->getUser($request['email']);

        return response()->json([
            'token' => $user->token,
            'user' => $user,
        ], Response::HTTP_OK);
    }

    public function me(Request $request)
    {
        return response()->json($request->user(), Response::HTTP_OK);
    }

    public function saveUserLocation(request $request)
    {
        $user = $request->user();

        $user->location = $request->location;

        $user->save();
    }

    public function logout()
    {
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'Successfully logged out'], Response::HTTP_NO_CONTENT);
    }
}
