<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;    # Authの追加
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/register'); // ログアウト後にリダイレクトする場所
});


Route::get('/admin', function () {
    return view('admin');
})->middleware('auth');

# login画面からの/loginのpost→
Route::get('/admin', [ContactController::class, 'admin'])->middleware('auth');

# adminモーダルからcontactsレコード１件削除
Route::delete('/delete', [ContactController::class, 'destroy']);

# adminでcontactsの検索
Route::get('/search', [ContactController::class, 'search']);

# adminからCSVエクスポート
Route::get('export', [ContactController::class, 'export'])->name('export');

# confirmからindexに戻る
Route::post('/back', [ContactController::class, 'back']);

# デバッグ用！！
Route::get('/thanks', function () {
    return view('thanks');
});