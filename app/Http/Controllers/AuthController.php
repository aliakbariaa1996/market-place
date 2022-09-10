<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\LoginResponseResource;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Login to System
     * /api/auth/login
     * @param LoginUserRequest $request
     * @return LoginResponseResource
     */
    public function login(LoginUserRequest $request)
    {
        return new LoginResponseResource($this->checkLogin($request->email, $request->password));
    }

    /**
     * check if user credentials is valid
     * @param string $username
     * @param string $password
     * @return array
     */
    private function checkLogin(string $username, string $password)
    {
        $credentials = request(['email', 'password']);
        $token = auth()->attempt([
            "email" => $username,
            "password" => $password
        ]);
        if (!$token) {
            throw new UnauthorizedException();
        }

        return ["token" => $token];

    }

    /**
     * Register into system
     * /api/auth/register
     * @param RegisterUserRequest $request
     * @return LoginResponseResource
     */
    public function register(RegisterUserRequest $request)
    {

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);
        $resp = new LoginResponseResource($this->checkLogin($request->email, $request->password));
        return $resp;
    }


    /**
     * User Profile
     * /api/auth/profile
     * @param Request $request
     * @return UserProfileResource
     */
    public function profile(Request $request)
    {
        return new UserProfileResource(auth()->user());
    }

    /**
     * Refresh token
     * /api/auth/refresh
     * @param Request $request
     * @return LoginResponseResource
     */
    public function refresh(Request $request)
    {
        return new LoginResponseResource(["token" => auth()->refresh()]);
    }
}
