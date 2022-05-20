<?php
namespace App\Traits;

trait ErrorSeccuss{
    
    public function seccussMessage($msg){
        return response()->json([
            'status'=>true,
            'message'=>$msg
        ]);
    }
    public function errorMessage($msg){
        return response()->json([
            'status'=>false,
            'message'=>$msg
        ]);
    }
    public function returnData($key,$value){
        return response()->json([
            'status'=>true,
        
            $key=>$value
        ]);
    }
}

