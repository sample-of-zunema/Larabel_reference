<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Response;

use function response;

class TextAction extends Controller
{
    public function __invoke(Request $request): IlluminateResponse
    {
        $response = Response::make('hello world');
        // ヘルパー関数を利用する場合
        $response = response('hello world');
        // content-typeを変更
        $response = response(
            'hello world',
            IlluminateResponse::HTTP_OK,
            [
                'content-type' => 'text/plain'
            ]
        );
        return $response;
    }
}
