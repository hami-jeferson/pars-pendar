<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

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

    public function successResource(JsonResource $data, string $msg = null): JsonResponse
    {
        return response()->json(['success'=>true,
                                 'message'=>$msg ,
                                 'data'=> $data]);
    }

    public function paginateResponse(JsonResource $resource): JsonResponse
    {
        return response()->json(array_merge(['success'=>true], $resource->response()->getData(true)));
    }
}