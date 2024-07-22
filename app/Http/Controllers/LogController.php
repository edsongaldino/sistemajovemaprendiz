<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function gravaLog($tipo, $descricao, $id){

        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->fk_id = $id;
        $log->tipo = $tipo;
        $log->script = $descricao;
        
        if($log->save()){
            return true;
        }else{
            return false;
        }
    }
}
