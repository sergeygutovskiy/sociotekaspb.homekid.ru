<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Knuckles\Scribe\Scribe;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Scribe::beforeResponseCall(function (Request $request) {
            $token = User::first()->createToken('authToken')->plainTextToken;
            $request->headers->add(["Authorization" => "Bearer $token"]);
        });
    }
}
