<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{

    public function showServiceproviderTest()
    {
        $encrypt = app()->make('encrypter');
        $password = $encrypt->encrypt('password');

        $sample = app()->make('serviceProviderTest');

        dd($sample, $password, $encrypt->decrypt($password));
    }

    public function showServiceContainerTest()
    {
        // サービスコンテナにコンテナに登録する
        app()->bind('lifeCycleTest', function () {
            return "ライフサイクルテスト";
        });

        // サービスコンテナから取得する
        $test = app()->make('lifeCycleTest');

        //サービスコンテナなしのパターン
        $message = new Message();
        $sample = new Sample($message);
        $sample->run();

        // サービスコンテナありのパターン
        app()->bind('sample', Sample::class);
        $sample = app()->make('sample');
        $sample->run();

        dd($test, app());
    }
}

class Sample
{
    public $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function run()
    {
        $this->message->send();
    }
}


class Message
{
    public function send()
    {
        echo "メッセージ表示";
    }
}
