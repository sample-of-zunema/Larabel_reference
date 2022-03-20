<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistPost;
// use Illuminate\Http\Request;
// use Illuminate\Http\Response;

class UserController extends Controller
{
    public function register(UserRegistPost $request)
    {
        $name = $request->get('name');
    }

    public function detail(string $id): View
    {
        return view('user.detail');
    }

    public function userDetail(string $id): Response
    {
        return new Response(view('user.detail'), Response::HTTP_OK);
    }
}
