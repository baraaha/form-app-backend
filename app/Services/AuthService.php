<?php

namespace App\Services;

use App\Mail\OTPEmail;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    public function generateAndSendOTP(string $email)
    {
        $otp = rand(100000, 999999);
        Cache::put('otp:' . $email, $otp, now()->addMinutes(3));
        // Mail::to($email)->send(new OTPEmail($otp));
        return $otp;
    }

    public function createUser(array $data)
    {
        $user = new  User;
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->save();

        $token = $user->createToken(time() . "_" . $data['email'])->plainTextToken;
        return ['user' => $user, "token" => $token, 'verify' => false];
    }

    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function updateUser(User $user, array $data)
    {
        $user->name = $data['name'] ?? $user->name;
        $user->email = $data['email'] ?? $user->email;
        $user->save();
        return $user;
    }

    public function checkOTP(string $email, int $otp)
    {
        $cacheOtp = Cache::get('otp:' . $email);
        if ($cacheOtp && $cacheOtp == $otp) {
            return true;
        }
        return false;
    }
}
