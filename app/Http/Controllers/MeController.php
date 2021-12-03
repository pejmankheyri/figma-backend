<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserShowResource;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function getMe()
    {
        if(auth()->check()) {
            $user = auth()->user();
            return new UserShowResource($user);
        }

        return response()->json(null, 401);
    }
}
