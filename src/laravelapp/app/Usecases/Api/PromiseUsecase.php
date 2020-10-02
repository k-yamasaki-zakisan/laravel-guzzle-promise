<?php
namespace App\Usecases\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

use Carbon\Carbon;

class PromiseUsecase 
{
    public function __invoke() 
    {
        $client = new Client();

        $data = [];

        // 計測開始
        $time_start = microtime(true);

        $requests = function ($urls) use($client) {
            foreach($urls as $url) {
                yield new Request('GET', $url);
            }
        };

        $urls = [
            'https://yukicoder.me/api/v1/problems/',
            'https://yukicoder.me/api/v1/contest/past',
            'https://yukicoder.me/api/v1/statistics/tags',
            'https://yukicoder.me/api/v1/languages/',
            'https://yukicoder.me/api/v1/contest/future',
            'https://yukicoder.me/api/v1/ranking/golfer',
        ];

        $pool = new Pool($client,$requests($urls), [
            'concurrency' => 6,
            'fulfilled' => function (Response $response, $index) use(&$data) {
                $result = json_decode($response->getBody()->getContents());
                $data[] = $result;
            },
            'rejected' => function (RequestException $reason, $index) {
                throw 'シンダー';
            },
        ]);

        $promise = $pool->promise();
        $result = $promise->wait();

        // 計測終了
        $time = microtime(true) - $time_start;

        //結果の出力
        dump($time);
        dump($data);

        return $data;
    }
}