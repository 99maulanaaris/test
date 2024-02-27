<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($status = true, $message, $code = 200)
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function atomic(Closure $callback)
    {
        return DB::transaction($callback);
    }
}
