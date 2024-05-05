<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Response{
    public function success(array $data, string $msg = null): JsonResponse
    {
        return response()->json(['success'=>true,
                                 'message'=>$msg ,
                                 'data'=> $data]);
    }

    public function error(string $msg = null): JsonResponse
    {
        return response()->json(['success'=>false,
                                 'message'=>$msg]);
    }
}