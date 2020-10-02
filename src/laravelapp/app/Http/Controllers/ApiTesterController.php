<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Usecases
use App\Usecases\Api\NormalUsecase;
use App\Usecases\Api\PromiseUsecase;
use App\Usecases\Api\SwooleUsecase;

class ApiTesterController extends Controller
{
    public function index(Request $request)
    {
        return view('api.index');
    }

    public function normal(Request $equest, NormalUsecase $usecase)
    {
        $data = $usecase();

        return view('api.normal', ['data' => $data]);
    }

    public function promise(Request $equest, PromiseUsecase $usecase)
    {
        $data = $usecase();

        return view('api.normal', ['data' => $data]);
    }

    public function swoole(Request $equest, SwooleUsecase $usecase)
    {
        $data = $usecase();

        return view('api.swoole', ['data' => $data]);
    }
}
