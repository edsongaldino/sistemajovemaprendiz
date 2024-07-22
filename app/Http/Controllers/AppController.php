<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;
use App\Aluno;
use App\Empresa;
use App\Endereco;
use App\Helpers\Helper;
use App\Http\Controllers\AlunoController;
use App\Importacao;
use App\PreCadastro;
use App\User;
use Illuminate\Support\Facades\Hash;

class AppController extends Controller
{

    public function GetFeriado(){
        $feriados = Helper::dias_feriados(2024);
        foreach($feriados as $feriado){
            print(date('d/m/Y',$feriado))."<br/>";
        }
    }

    public function login(){
        return view('sistema.login');
    }

    public function index(){
        return view('home');
    }

    public function cadastro(){
        return view('cadastro');
    }

    public function sistema(){
        return view('sistema.home');
    }

    public function cursos(){
        return view('sistema.cursos.index');
    }

    public function configuracoes(){
        return view('sistema.configuracoes.index');
    }

    public function polos(){
        return view('sistema.polos.index');
    }

    public function empresas(){
        return view('sistema.empresas.index');
    }

    public function alunos(){
        return view('sistema.alunos.index');
    }

    public function contratos(){
        return view('sistema.contratos.index');
    }

    public function financeiro(){
        return view('sistema.financeiro.index');
    }

    public function estoque(){
        return view('sistema.estoque.index');
    }

    public function vagas(){
        return view('sistema.vagas.index');
    }

    public function eventos(){
        return view('sistema.eventos.index');
    }

    public function relatorios(){
        return view('sistema.relatorios.index');
    }


    public function importarEmpresas(){
        $empresas = Importacao::all();

        foreach($empresas as $empresa){
            echo $empresa->cnpjEmpresa.'</br>';

            if((New Empresa())->verificaDuplicidade('cnpj', Helper::limpa_campo($empresa->cnpjEmpresa))){
                echo 'Este CNPJ já consta em nosso banco de dados! Verifique.';
            }else{

                $endereco = new Endereco();
                $endereco->cidade_id = $empresa->IDmunicipio;
                $endereco->cep_endereco = Helper::limpa_campo($empresa->cep);
                $endereco->logradouro_endereco = $empresa->enderecoJovem;
                $endereco->numero_endereco = $empresa->numero;
                $endereco->complemento_endereco = $empresa->complemento;
                $endereco->bairro_endereco = $empresa->bairro;
                $endereco->save();

                $Nempresa = new Empresa();
                $Nempresa->endereco_id = $endereco->id;
                $Nempresa->tipo_empresa = 'Matriz';
                $Nempresa->tipo_cadastro = 'CNPJ';

                if($Nempresa->tipo_cadastro == 'CEI'){
                    $Nempresa->cei = Helper::limpa_campo($empresa->cei);
                }else{
                    $Nempresa->cnpj = Helper::limpa_campo($empresa->cnpjEmpresa);
                }

                $Nempresa->atividade_principal = $empresa->atividade_principal;
                $Nempresa->conta_contabil = Helper::limpa_campo($empresa->conta_contabil);

                $Nempresa->razao_social = $empresa->razaoSocial;
                $Nempresa->nome_fantasia = $empresa->razaoSocial;
                $Nempresa->telefone = Helper::limpa_campo($empresa->telefoneEmpresa);
                $Nempresa->nome_responsavel = $empresa->contatoEmpresa;
                $Nempresa->telefone_responsavel = Helper::limpa_campo($empresa->telefoneEmpresa);

                $Nempresa->save();

            }


        }
    }

    public function importarAlunos(){

        set_time_limit(300);

        $alunos = Importacao::all();

        foreach($alunos as $aluno){
            echo $aluno->CPFJovem.'</br>';

            if((New Aluno())->verificaDuplicidade('cpf', Helper::limpa_campo($aluno->CPFJovem))){
                echo 'Este CPF já consta em nosso banco de dados! Verifique.';
            }else{

                $endereco = new Endereco();
                $endereco->cidade_id = $aluno->IDmunicipio;
                $endereco->cep_endereco = Helper::limpa_campo($aluno->cep);
                $endereco->logradouro_endereco = $aluno->enderecoJovem;
                $endereco->numero_endereco = $aluno->numero;
                $endereco->complemento_endereco = $aluno->complemento;
                $endereco->bairro_endereco = $aluno->bairro;
                $endereco->save();

                //Perfil de Aluno
                $perfil_id = 4;

                $User = new User();
                $User->perfil_id = $perfil_id;
                $User->nome = $aluno->nomeJovem;

                if($aluno->email <> '' && $aluno->email <> ';'){

                    if((New UserController())->verificaDuplicidade('email', $aluno->email)){
                        $User->email = $endereco->id."@jovemaprendiz.com.br";
                    }else{
                        $User->email = $aluno->email;
                    }

                }else{
                    $User->email = $endereco->id."@jovemaprendiz.com.br";
                }

                $User->data_nascimento = Helper::data_mysql($aluno->dataNascimento);
                $User->telefone = Helper::limpa_campo($aluno->celular);
                $User->password = Hash::make('259864');
                $User->save();

                switch($aluno->periodo){
                    case 'MATUTINO':
                        $turno = 'Matutino';
                        break;
                    case 'VESPERTINO':
                        $turno = 'Vespertino';
                        break;
                    default:
                        $turno = 'Noturno';
                        break;
                }

                switch($aluno->escolaridade){
                    case 'ENSINO FUNDAMENTAL COMPLETO':
                        $escolaridade = 'Ensino Fundamental (Completo)';
                        break;
                    case 'ENSINO MEDIO INCOMPLETO':
                        $escolaridade = 'Ensino Médio (Cursando)';
                        break;
                    case 'ENSINO MEDIO COMPLETO':
                        $escolaridade = 'Ensino Médio (Completo)';
                        break;
                    default:
                        $escolaridade = 'Ensino Fundamental (Cursando)';
                        break;
                }

                $Naluno = new Aluno();
                $Naluno->endereco_id = $endereco->id;
                $Naluno->polo_id = '3';
                $Naluno->user_id = $User->id;
                $Naluno->nome = $aluno->nomeJovem;
                $Naluno->sexo = 'Masculino';
                $Naluno->cpf = Helper::limpa_campo($aluno->CPFJovem);
                $Naluno->rg = Helper::limpa_campo('1245698725');
                $aluno->orgao_expedidor = 'SSPMT';
                $Naluno->data_nascimento = Helper::data_mysql($aluno->dataNascimento);
                $Naluno->telefone = Helper::limpa_campo($aluno->fone);
                $Naluno->whatsapp = Helper::limpa_campo($aluno->celular);
                $Naluno->estado_civil = 'Solteiro';
                $Naluno->situacao = 'Ativo';
                $Naluno->escolaridade = $escolaridade;
                $Naluno->turno = $turno;
                $Naluno->contra_turno = 'Não';
                $aluno->pcd = 'Não';
                $Naluno->tipo_cadastro = 'Jovem Aprendiz';
                $Naluno->save();

            }


        }
    }

}
