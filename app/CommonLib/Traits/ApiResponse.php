<?php

namespace App\CommonLib\Traits;

use App\CommonLib\CustomUtils\PCollection;
use \Illuminate\Http\Response;

trait ApiResponse
{
    protected function success($data)
    {
        $response = ['Result' => 'success', 'Data' => $data];
        return response()->json($response, Response::HTTP_OK);
    }

    protected function error($error_message, $code)
    {
        return response()->json(['Result' => $error_message], $code);
    }

    protected function CollectionResponse(PCollection $collection)
    {
        $response = ['Result' => 'success', 'Data' => $collection->List, 'TotalDataCount' => $collection->Paging->getTotalCount()];
        return response()->json($response, Response::HTTP_OK);
    }
}