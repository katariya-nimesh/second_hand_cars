<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseHelper;

class UserController extends Controller
{
    public function getUser()
    {
        return ResponseHelper::success(Auth::user());
    }
}
