<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistPost;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // $name = $request->get('name');
        // var_dump($name);

        $rules = [
            'name' => ['required', 'max:20', 'ascii_alpha'],
            'email' => ['required', 'email', 'max:255'],
        ];

        $inputs = $request->all();

        Validator::extend('ascii_alpha', function($attribute, $value, $parameters) {
            return preg_match('/ˆ[a-zA-Z]+$/', $value);
        });

        $validator = Validator::make($inputs, $rules);

        if ($validator->fils()) {
            // ここにバリデーションエラーの場合の処理
        }

        // ここにバリデーション通過後の処理
        $name = $request->input('name');

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
