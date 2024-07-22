<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IeEmpresa extends Model
{
    protected $table = 'ie_empresa';

    public function salvarInscricoes($request, $empresa)
    {
		$inscricoes = $empresa->inscricoes;

		foreach ($inscricoes as $inscricao) {
		    $inscricao->delete();
		}

	    for($i=0;$i<count($request->inscEstadual);$i++){

            $insc = new IeEmpresa();
            $insc->empresa_id = $empresa->id;
            $insc->inscricao_estadual = $request->inscEstadual[$i];
            $insc->save();
    
        }
    }

}
