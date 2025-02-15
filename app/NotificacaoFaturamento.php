<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class NotificacaoFaturamento extends Model
{
    protected $table = 'notificacoes_faturamento';

    public static function gravaNotificacao($faturamento_id, $tipo_notificacao, $email){

        $Notificacao = new NotificacaoFaturamento();
        $Notificacao->faturamento_id = $faturamento_id;
        $Notificacao->tipo_notificacao = $tipo_notificacao;
        $Notificacao->email = $email;
        $Notificacao->data_envio = Carbon::now();
        $Notificacao->save();

        return $Notificacao;
    }
}
