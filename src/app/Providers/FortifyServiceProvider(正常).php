<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Redirect; // 追加
use Laravel\Fortify\Contracts\RegisterResponse;   # Fortifyにでユーザー登録後のレスポンスをカスタマイズするためのインターフェース

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);    // ユーザー登録処理の設定

            Fortify::registerView(function () {
                return view('register');            // 登録画面のビューを指定（GETなら認証はしない）
            });

            Fortify::loginView(function () {
                return view('login');               // ログイン画面のビューを指定
            });

            // ユーザー登録後のリダイレクト先をカスタマイズ
            $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {

                public function toResponse($request)        // 登録後のレスポンスを定義
                {
                    // ユーザーをログアウトさせる(Laravel仕様により登録とともにログインしてしまう。仕様書に従いこの処理を加える）
                    // auth()->logout();
                    return Redirect::to('/login');      // 登録完了後、ログインページにリダイレクト
                }
            });

            RateLimiter::for('login', function (Request $request) {
                $email = (string) $request->email;

                return Limit::perMinute(10)->by($email . $request->ip());
            });
    }
}