<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class EmpresaContato extends Model
{
    protected $table = 'empresa_contato';

    public function salvarContatos($request, $empresa)
    {
		$contatos = $empresa->contatos;

		foreach ($contatos as $contato) {
		    $contato->delete();
		}

	    for($i=0;$i<count($request->contato_setor);$i++){

            $insc = new EmpresaContato();
            $insc->empresa_id = $empresa->id;
            $insc->setor = $request->contato_setor[$i];
            $insc->nome = $request->contato_nome[$i];
            $insc->email = $request->contato_email[$i];

            if(isset($request->contato_cpf[$i])){
                $insc->cpf = Helper::limpa_campo($request->contato_cpf[$i]);
            }

            if(isset($request->contato_departamento[$i])){
                $insc->departamento = $request->contato_departamento[$i];
            }

            $insc->whatsapp = Helper::limpa_campo($request->contato_whatsapp[$i]);

            if(isset($request->contato_data_nascimento[$i])){
                $insc->data_nascimento = Helper::data_mysql($request->contato_data_nascimento[$i]);
            }
            $insc->save();

        }
    }
}
