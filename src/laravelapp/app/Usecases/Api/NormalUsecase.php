<?php
namespace App\Usecases\Api;

use GuzzleHttp\Client;
use Carbon\Carbon;

class NormalUsecase 
{
    public function __invoke() 
    {
        $client = new Client();

        $data = [];

        // 計測開始
        $time_start = microtime(true);

        $problems = $client->request('GET', 'https://yukicoder.me/api/v1/problems/');
        $problems = json_decode($problems->getBody()->getContents(), true);

        $p_contests = $client->request('GET', 'https://yukicoder.me/api/v1/contest/past');
        $p_contests = json_decode($p_contests->getBody()->getContents(), true);

        $statistics = $client->request('GET', 'https://yukicoder.me/api/v1/statistics/tags');
        $statistics = json_decode($statistics->getBody()->getContents(), true);

        $languages = $client->request('GET', 'https://yukicoder.me/api/v1/languages/');
        $languages = json_decode($languages->getBody()->getContents(), true);

        $f_contests = $client->request('GET', 'https://yukicoder.me/api/v1/contest/future');
        $f_contests = json_decode($f_contests->getBody()->getContents(), true);

        $rankings = $client->request('GET', 'https://yukicoder.me/api/v1/ranking/golfer');
        $rankings = json_decode($rankings->getBody()->getContents(), true);

        // 計測終了
        $time = microtime(true) - $time_start;

        //結果の出力
        dump($time); 

        $data += $problems;
        $data += $p_contests;
        $data += $statistics;
        $data += $languages;
        $data += $f_contests;
        $data += $rankings;

        return $data;
    }
}