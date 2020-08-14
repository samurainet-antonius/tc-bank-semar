<?php
namespace App\Helpers;

use Illuminate\Http\JsonResponse;

trait FuncResponse{

    public function responseData ($data){
        return new JsonResponse([
            'result' => 'true',
            'data'      => $data,
            'status' => 200
        ],200);
    }

    public function responseDataCount ($data, $count = null){
        if($count == null){
            return new JsonResponse([
                'result' => 'true',
                'count'      => count($data),
                'data'      => $data,
                'status' => 200
            ],200);
        }

        return new JsonResponse([
            'result' => 'true',
            'count' => $count,
            'data' => $data,
            'status' => 200
        ], 200);
    }

    public function responseDataLimitOffset($count,$limit,$offset,$data){
        return new JsonResponse([
            'result'    => 'true',
            'count'      => $count,
            'limit'      => $limit,
            'offset'      => $offset,
            'data'      => $data,
            'status' => 200
        ],200);
    }

    public function responseInfo($info){
        return new JsonResponse([
            'result' => 'true',
            'info' => $info,
            'status' => 200
        ], 200);
    }

    public function responseValidation($info="",$detail = ""){
        if ($detail == "" && $info == "") {
            $info = 'Isian yang diberikan tidak valid';
            return new JsonResponse([
                'result' => 'false',
                'info' => $info,
                'status' => 400
            ], 400);
        }else{
            return new JsonResponse([
                'result'    => 'false',
                'info'      => $info,
                'detail'      => $detail,
                'status' => 400
            ],400);
        }
    }
    public function responseBadRequest($info,$message = ""){
        if ($message == "") {
            return new JsonResponse([
                'info' => $info,
                'status' => 400
            ], 400);
        }else{
            return new JsonResponse([
                'message'    => $message,
                'info'      => $info,
                'status' => 400
            ],400);
        }
    }

    public function responseInternalServerError($info,$detail = ""){
        if ($detail == "") {
            return new JsonResponse([
                'result' => 'false',
                'info' => $info,
                'status' => 500
            ], 500);
        }else{
            return new JsonResponse([
                'result'    => 'false',
                'info'      => $info,
                'detail'      => $detail,
                'status' => 500
            ],500);
        }
    }

    public function responseDataNotFound($customMessage = "",$detail = "",$lang =""){
        $statusCode = 400;
        if ($customMessage == "") {
            switch ($lang) {
                case "en" :
                    $info = "Data not found";
                    break;
                default :
                    $info = "Data tidak ditemukan";
            }
        }else{
            $info = $customMessage;
        }
        if ($detail == "") {
            return new JsonResponse([
                'result' => 'false',
                'info' => $info,
                'status' => $statusCode
            ], $statusCode);
        } else {
            return new JsonResponse([
                'info' => $info,
                'detail' => $detail,
                'status' => $statusCode
            ], $statusCode);
        }
    }

    public function limitOffset($count){
        $limit = $count;
        $offset=0;
        if ($count < $limit){
            $limit= $count;
        }
        if(isset($_GET['limit'])){
            $limit =  (int)$_GET['limit'];
        }
        if(isset($_GET['offset'])){
            $offset =  (int)$_GET['offset'];
        }

        return array ($limit,$offset);
    }

    
    public function errorMessage($info, $code){
        return response($info,$code)->header('Content-Type', 'application/json');
    }
}