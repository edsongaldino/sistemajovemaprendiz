<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacaoSistema extends Model
{
    use HasFactory;
    protected $table = 'notificacoes_sistema';

    public static function gravaNotificacao($tipo_notificacao,$email,$descricao){

        $Notificacao = new NotificacaoSistema();
        $Notificacao->tipo_notificacao = $tipo_notificacao;
        $Notificacao->descricao = $descricao;
        $Notificacao->situacao = 'Criada';
        $Notificacao->email = $email;
        $Notificacao->data_envio = Carbon::now();
        $Notificacao->save();

        return $Notificacao;
    }
}
