<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API ルート
|--------------------------------------------------------------------------
|
| ここでアプリケーションの API ルートを登録できます。これらのルートは RouteServiceProvider によって読み込まれ、
| すべてが "api" ミドルウェアグループに割り当てられます。素晴らしいものを作りましょう！
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
