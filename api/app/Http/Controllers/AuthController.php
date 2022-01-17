<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthLoginRequest $request, string $provider = 'email')
    {
        $user = $this->authService->authenticate($request->validated(), $provider);
        // return (new UserResource(auth()->user()))->additional($token);
        return response()->json($user);
    }

    public function register(RegisterRequest $request, string $provider)
    {
        $user = $this->authService->register($request->validated(), $provider);

        return response()->json($user);
    }
}
