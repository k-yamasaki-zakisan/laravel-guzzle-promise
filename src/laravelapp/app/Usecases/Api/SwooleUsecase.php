<?php
namespace App\Usecases\Api;

use GuzzleHttp\Client;
use Carbon\Carbon;

class SwooleUsecase 
{
    public function __invoke() 
    {
        $client = new Client();

        $data = [];

        //計測開始
        $start = Carbon::now();

        // \Swoole\Runtime::enableCoroutine();

        go (function() use($client, $data) {
            $problems = $client->request('GET', 'https://yukicoder.me/api/v1/problems/');
            $problems = json_decode($problems->getBody()->getContents(), true);
            $data += $problems;
        });

        go (function() use($client, $data){
            $p_contests = $client->request('GET', 'https://yukicoder.me/api/v1/contest/past');
            $p_contests = json_decode($p_contests->getBody()->getContents(), true);
            $data += $p_contests;
        });

        go (function() use($client, $data){
            $statistics = $client->request('GET', 'https://yukicoder.me/api/v1/statistics/tags');
            $statistics = json_decode($statistics->getBody()->getContents(), true);
            $data += $statistics;
        });

        go (function() use($client, $data){
            $languages = $client->request('GET', 'https://yukicoder.me/api/v1/languages/');
            $languages = json_decode($languages->getBody()->getContents(), true);
            $data += $languages;
        });

        go (function() use($client, $data){
            $f_contests = $client->request('GET', 'https://yukicoder.me/api/v1/contest/future');
            $f_contests = json_decode($f_contests->getBody()->getContents(), true);
            $data += $f_contests;
        });

        go (function() use($client, $data){
            $rankings = $client->request('GET', 'https://yukicoder.me/api/v1/ranking/golfer');
            $rankings = json_decode($rankings->getBody()->getContents(), true);
            $data += $rankings;
        });


        // \Swoole\Event::wait();
dd($data);
        //計測終了
        $end = Carbon::now();

        //結果の出力
        dump($start, $end);

        return $data;
    }
}