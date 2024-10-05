<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Redirect;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;     # ログイン時バリデーション用のフォームリクエスト
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;  # Laravel Fortifyで認証セッションを管理するためのコントローラー

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションサービスの登録
     */
    public function register(): void
    {
        // Fortifyが使用するLoginRequestをカスタムのLoginRequestにバインド
        $this->app->bind(
            \Laravel\Fortify\Http\Requests\LoginRequest::class,
            \App\Http\Requests\LoginRequest::class
        );
    }

    /**
     * アプリケーションサービスの初期化
     */
    public function boot(): void
    {
        // ユーザー登録の処理を設定
        Fortify::createUsersUsing(CreateNewUser::class);

        // 登録画面のビューを指定
        Fortify::registerView(function () {
            return view('register');
        });

        // ログイン画面のビューを指定
        Fortify::loginView(function () {
            return view('login');
        });

        // カスタム認証ロジック
        Fortify::authenticateUsing(function (\App\Http\Requests\LoginRequest $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        // ユーザー登録後のリダイレクト先をカスタマイズ
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
            public function toResponse($request)
            {
                return Redirect::to('/login'); // 登録完了後、ログインページにリダイレクト
            }
        });

        // ログインの試行回数制限を設定
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });
    }
}
