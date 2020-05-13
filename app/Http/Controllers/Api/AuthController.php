<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\AuthenticatesApiUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesApiUsers;
}
