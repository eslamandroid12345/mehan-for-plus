<?php

namespace App\Http\Traits;

trait Responser
{

    public function responseSuccess($status = 200, $message = 'Success', $data = []) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status)
            ->header('Access-Control-Allow-Origin', 'https://api.mhnplus.com');
    }

    public function responseFail($status = 422, $message = 'Error', $data = []) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public function responseCustom($status, $message, $data) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }

}
