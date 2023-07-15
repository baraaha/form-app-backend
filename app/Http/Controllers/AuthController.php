<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterStoreRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterStoreRequest $request)
    {

        $this->authService->generateAndSendOTP($request->email);
        $result = $this->authService->createUser($request->all());

        return response()->json($result, 201);
    }

    public function login(LoginRequest $request)
    {

        $this->authService->generateAndSendOTP($request->email);
        $user = $this->authService->getUserByEmail($request->email);
        if ($user) {
            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json(['user' => $user, "token" => $token, 'verify' => false]);
        } else {
            return response()->json(['message' => ' not found user'], 404);
        }
    }



    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'email' => 'required|email'
        ]);
        $check = $this->authService->checkOTP($request->email, $request->otp);
        if ($check) {
            $user = $this->authService->getUserByEmail($request->email);
            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json(['user' => $user, "token" => $token, 'verify' => true]);
        } else {
            return response()->json(['message' => 'OTP not match'], 400);
        }
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $user = $this->authService->updateUser(auth('sanctum')->user(), $request->all());



        return response()->json(['user' => $user, "token" => $user->tokens()->latest()->first()->plainTextToken, 'verify' => true]);
    }

    public function logout()
    {
        Auth::guard('sanctum')->user()->tokens()->delete();
        return response()->json(['message' => 'logout success'], 200);
    }
}
