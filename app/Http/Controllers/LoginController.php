<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  // auth.loginテンプレートを読み込む
  public function index()
  {
    return view('auth.login');
  }

  // 引数でログイン処理、ホームへリダイレクトする（ログイン不可の場合、メッセージとともにログイン画面へ）
  public function authenticate(Request $request)
  {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    return back()->withErrors([
      'message' => 'メールアドレスまたはパスワードが正しくありません。',
      ]);
  }

  // ログアウト機能
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect(RouteServiceProvider::HOME);
  }
}

// ※練習用（TrainingControllerの関数をサービスコンテナの解決で呼び出してる）
$tricls = app()->make(TrainingController::class);
echo ($tricls->training());