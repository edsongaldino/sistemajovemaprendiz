<?php

use App\AtualizacoesContrato;
use App\Contrato;
use App\Faturamento;
use App\FaturamentoBoleto;
use App\FaturamentoContrato;
use App\FaturamentoNF;
use App\Helpers\Helper;
use App\Http\Controllers\FaturamentoController;
use App\Http\Controllers\FaturamentoBoletoController;
use App\Http\Controllers\FaturamentoNFController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AppController@index')->name('site');
Route::post('/gravar-pre-cadastro', 'PreCadastroController@store')->name('gravar-pre-cadastro');

Route::get('/gravar-pre-cadastro', 'PreCadastroController@edit')->name('gravar-pre-cadastro');

Route::get('/cadastro-jovem-aprendiz', 'PreCadastroController@cadastroAluno')->name('cadastro-jovem-aprendiz');
Route::post('/gravar-cadastro-completo', 'PreCadastroController@SalvarDadosAluno')->name('gravar-cadastro-completo');

Route::get('/login', 'AppController@login')->name('login');
Route::get('/sistema', 'AppController@sistema')->name('sistema')->middleware('auth');
Route::get('/sistema/alunos', 'AlunoController@index')->name('alunos')->middleware('auth');
Route::get('/sistema/configuracoes', 'AppController@configuracoes')->name('configuracoes')->middleware('auth');
Route::get('/sistema/polos', 'AppController@polos')->name('polos')->middleware('auth');
Route::get('/sistema/contratos', 'AppController@contratos')->name('contratos')->middleware('auth');
Route::get('/sistema/eventos', 'AppController@eventos')->name('eventos')->middleware('auth');

//LOGIN ROTAS
Route::post('/login/do', 'AuthController@Login')->name('login.do');
Route::get('logout', 'AuthController@Logout')->name('logout')->middleware('auth');

//FERIADO ROTAS
Route::get('sistema/configuracoes/feriados', 'FeriadoController@index')->name('sistema.feriados')->middleware('auth');
Route::get('sistema/feriado/adicionar', 'FeriadoController@create')->name('sistema.feriado.adicionar')->middleware('auth');
Route::post('sistema/feriado/salvar', 'FeriadoController@store')->name('sistema.feriado.salvar')->middleware('auth');
Route::get('sistema/feriado/{id}/editar', 'FeriadoController@edit')->name('sistema.feriado.editar')->middleware('auth');
Route::post('sistema/feriado/update', 'FeriadoController@update')->name('sistema.feriado.update')->middleware('auth');
Route::post('sistema/feriado/excluir', 'FeriadoController@destroy')->name('sistema.feriado.excluir')->middleware('auth');
Route::match(['get', 'post'], 'sistema/feriado/buscar', 'FeriadoController@Busca')->name('sistema.feriado.buscar')->middleware('auth');

//PRE CADASTRO ROTAS
Route::get('sistema/cadastros', 'PreCadastroJovensController@index')->name('sistema.cadastros')->middleware('auth');
Route::match(['get', 'post'], 'sistema/cadastros/buscar', 'PreCadastroJovensController@CadastroBusca')->name('sistema.cadastros.buscar')->middleware('auth');
Route::get('sistema/cadastro/{id}/editar', 'PreCadastroJovensController@edit')->name('sistema.cadastro.editar')->middleware('auth');
Route::post('sistema/cadastro/update', 'PreCadastroJovensController@update')->name('sistema.cadastro.update')->middleware('auth');
Route::post('sistema/cadastro/excluir', 'PreCadastroJovensController@destroy')->name('sistema.cadastro.excluir')->middleware('auth');
Route::post('sistema/cadastro/enviar-link-curriculo', 'PreCadastroJovensController@EnviarLinkCurriculo')->name('sistema.cadastro.enviar-link-curriculo')->middleware('auth');

Route::get('sistema/cadastro/{id}/preencher-curriculo', 'PreCadastroJovensController@PreencherCurriculo')->name('sistema.cadastro.preencher-curriculo');
Route::post('sistema/cadastro/salvar-curriculo', 'PreCadastroJovensController@SalvarCurriculo')->name('sistema.cadastro.salvar-curriculo');


//User Rotas
Route::get('sistema/usuarios', 'UserController@index')->name('sistema.usuarios')->middleware('auth');
Route::get('sistema/usuarios/adicionar', 'UserController@create')->name('sistema.usuarios.adicionar')->middleware('auth');
Route::post('sistema/usuario/salvar', 'UserController@store')->name('sistema.usuario.salvar')->middleware('auth');
Route::get('sistema/usuario/{id}/editar', 'UserController@edit')->name('sistema.usuario.editar')->middleware('auth');
Route::post('sistema/usuario/update', 'UserController@update')->name('sistema.usuario.update')->middleware('auth');
Route::post('sistema/usuario/excluir', 'UserController@destroy')->name('sistema.usuario.excluir')->middleware('auth');
Route::match(['get', 'post'], 'sistema/usuarios/buscar', 'UserController@UserBusca')->name('sistema.usuarios.buscar');

//Perfis rotas
Route::get('sistema/perfis', 'PerfilController@index')->name('sistema.perfis')->middleware('auth');
Route::get('sistema/perfil/adicionar', 'PerfilController@create')->name('sistema.perfil.adicionar')->middleware('auth');
Route::post('sistema/perfil/salvar', 'PerfilController@store')->name('sistema.perfil.salvar')->middleware('auth');
Route::get('sistema/perfil/{id}/editar', 'PerfilController@edit')->name('sistema.perfil.editar')->middleware('auth');
Route::post('sistema/perfil/update', 'PerfilController@update')->name('sistema.perfil.update')->middleware('auth');
Route::post('sistema/perfil/excluir', 'PerfilController@destroy')->name('sistema.perfil.excluir')->middleware('auth');


//User Rotas
Route::get('sistema/parceiros', 'ParceiroController@index')->name('sistema.parceiros')->middleware('auth');
Route::get('sistema/parceiros/adicionar', 'ParceiroController@create')->name('sistema.parceiros.adicionar')->middleware('auth');
Route::post('sistema/parceiro/salvar', 'ParceiroController@store')->name('sistema.parceiro.salvar')->middleware('auth');
Route::get('sistema/parceiro/{id}/editar', 'ParceiroController@edit')->name('sistema.parceiro.editar')->middleware('auth');
Route::post('sistema/parceiro/update', 'ParceiroController@update')->name('sistema.parceiro.update')->middleware('auth');
Route::post('sistema/parceiro/excluir', 'ParceiroController@destroy')->name('sistema.parceiro.excluir')->middleware('auth');
Route::match(['get', 'post'], 'sistema/parceiros/buscar', 'ParceiroController@ParceiroBusca')->name('sistema.parceiros.buscar')->middleware('auth');

//Pólos rotas
Route::get('sistema/polos', 'PoloController@index')->name('sistema.polos')->middleware('auth');
Route::get('sistema/polo/adicionar', 'PoloController@create')->name('sistema.polo.adicionar')->middleware('auth');
Route::post('sistema/polo/salvar', 'PoloController@store')->name('sistema.polo.salvar')->middleware('auth');
Route::get('sistema/polo/{id}/editar', 'PoloController@edit')->name('sistema.polo.editar')->middleware('auth');
Route::post('sistema/polo/update', 'PoloController@update')->name('sistema.polo.update')->middleware('auth');
Route::post('sistema/polo/excluir', 'PoloController@destroy')->name('sistema.polo.excluir')->middleware('auth');

Route::match(['get', 'post'], 'sistema/polo/buscar', 'PoloController@PoloBusca')->name('sistema.polo.buscar')->middleware('auth');

Route::get('sistema/polo/{id}/equipe', 'PoloController@equipe')->name('sistema.polo.equipe')->middleware('auth');
Route::post('sistema/polo/equipe/adicionar', 'PoloController@EquipeAdd')->name('sistema.polo.equipe.adicionar')->middleware('auth');
Route::post('sistema/polo/equipe/excluir', 'PoloController@EquipeExcluir')->name('sistema.polo.equipe.excluir')->middleware('auth');

//Regiões rotas
Route::get('sistema/regioes', 'RegiaoController@index')->name('sistema.regioes')->middleware('auth');
Route::get('sistema/regiao/adicionar', 'RegiaoController@create')->name('sistema.regiao.adicionar')->middleware('auth');
Route::post('sistema/regiao/salvar', 'RegiaoController@store')->name('sistema.regiao.salvar')->middleware('auth');
Route::get('sistema/regiao/{id}/editar', 'RegiaoController@edit')->name('sistema.regiao.editar')->middleware('auth');
Route::post('sistema/regiao/update', 'RegiaoController@update')->name('sistema.regiao.update')->middleware('auth');
Route::post('sistema/regiao/excluir', 'RegiaoController@destroy')->name('sistema.regiao.excluir')->middleware('auth');
Route::post('sistema/regiao/responsavel/adicionar', 'RegiaoController@AdicionarResponsavel')->name('sistema.regiao.responsavel.adicionar')->middleware('auth');
Route::match(['get', 'post'], 'sistema/regiao/buscar', 'RegiaoController@RegiaoBusca')->name('sistema.regiao.buscar')->middleware('auth');

//Pólos rotas
Route::get('sistema/empresas', 'EmpresaController@index')->name('sistema.empresas')->middleware('auth');
Route::get('sistema/empresa/adicionar', 'EmpresaController@create')->name('sistema.empresa.adicionar')->middleware('auth');
Route::post('sistema/empresa/salvar', 'EmpresaController@store')->name('sistema.empresa.salvar')->middleware('auth');
Route::get('sistema/empresa/{id}/editar', 'EmpresaController@edit')->name('sistema.empresa.editar')->middleware('auth');
Route::post('sistema/empresa/update', 'EmpresaController@update')->name('sistema.empresa.update')->middleware('auth');
Route::post('sistema/empresa/excluir', 'EmpresaController@destroy')->name('sistema.empresa.excluir')->middleware('auth');
Route::match(['get', 'post'], 'sistema/empresas/buscar', 'EmpresaController@EmpresasBusca')->name('sistema.empresas.buscar')->middleware('auth');

Route::get('sistema/empresa/consulta-cnpj/{cnpj}', 'EmpresaController@consultaCNPJ')->name('sistema.empresa.consultaCNPJ')->middleware('auth');
Route::get('sistema/empresa/consulta-empresa/{tipo}/{valor}', 'EmpresaController@consultaEmpresa')->name('sistema.empresa.consultaEmpresa')->middleware('auth');

Route::get('sistema/empresa/{id}/equipe', 'EmpresaController@equipe')->name('sistema.empresa.equipe')->middleware('auth');
Route::post('sistema/empresa/equipe/adicionar', 'EmpresaController@EquipeAdd')->name('sistema.empresa.equipe.adicionar')->middleware('auth');
Route::post('sistema/empresa/equipe/excluir', 'EmpresaController@EquipeExcluir')->name('sistema.empresa.equipe.excluir')->middleware('auth');
Route::post('sistema/empresa/contato/excluir', 'EmpresaController@ExcluirContato')->name('sistema.empresa.contato.excluir')->middleware('auth');

Route::get('sistema/minha-empresa', 'EmpresaController@show')->name('sistema.minha-empresa')->middleware('auth');

//Rotas Estoque
Route::get('sistema/estoque', 'EstoqueProdutoController@index')->name('sistema.estoque')->middleware('auth');
Route::get('sistema/produto/adicionar', 'EstoqueProdutoController@create')->name('sistema.produto.adicionar')->middleware('auth');
Route::post('sistema/produto/salvar', 'EstoqueProdutoController@store')->name('sistema.produto.salvar')->middleware('auth');
Route::get('sistema/produto/{id}/editar', 'EstoqueProdutoController@edit')->name('sistema.produto.editar')->middleware('auth');
Route::post('sistema/produto/update', 'EstoqueProdutoController@update')->name('sistema.produto.update')->middleware('auth');
Route::post('sistema/produto/excluir', 'EstoqueProdutoController@destroy')->name('sistema.produto.excluir')->middleware('auth');

Route::get('sistema/clientes', 'EstoqueProdutoController@clientes')->name('sistema.clientes')->middleware('auth');
Route::get('sistema/novo-cliente', 'EstoqueProdutoController@NovoCliente')->name('sistema.novo-cliente')->middleware('auth');
Route::get('sistema/nova-cobranca', 'EstoqueProdutoController@NovaCobranca')->name('sistema.nova-cobranca')->middleware('auth');
Route::get('sistema/nova-nf', 'FaturamentoNFController@EmitirNF')->name('sistema.nova-nf')->middleware('auth');

Route::get('sistema/novo-boleto', 'FaturamentoBoletoController@GerarBoleto')->name('sistema.novo-boleto')->middleware('auth');

Route::get('sistema/produto/{id}/movimentacao', 'EstoqueMovimentacaoController@index')->name('sistema.produto.movimentacao')->middleware('auth');
Route::post('sistema/estoque/produto/movimentacao', 'EstoqueMovimentacaoController@store')->name('sistema.estoque.produto.movimentacao')->middleware('auth');

//Rotas Alunos
Route::get('sistema/alunos', 'AlunoController@index')->name('sistema.alunos')->middleware('auth');
Route::get('sistema/aluno/adicionar', 'AlunoController@create')->name('sistema.aluno.adicionar')->middleware('auth');
Route::post('sistema/aluno/salvar', 'AlunoController@store')->name('sistema.aluno.salvar')->middleware('auth');
Route::get('sistema/aluno/{id}/editar', 'AlunoController@edit')->name('sistema.aluno.editar')->middleware('auth');
Route::post('sistema/aluno/update', 'AlunoController@update')->name('sistema.aluno.update')->middleware('auth');
Route::post('sistema/aluno/excluir', 'AlunoController@destroy')->name('sistema.aluno.excluir')->middleware('auth');
Route::get('sistema/aluno/consulta-cpf/{cpf}', 'AlunoController@consultaCPF')->name('sistema.aluno.consultaCPF')->middleware('auth');
Route::match(['get', 'post'], 'sistema/alunos/buscar', 'AlunoController@AlunoBusca')->name('sistema.alunos.buscar')->middleware('auth');


Route::match(['get', 'post'], '/sistema/financeiro/buscar', 'FaturamentoController@FaturadosBusca')->name('sistema.financeiro.buscar')->middleware('auth');
Route::match(['get', 'post'], '/sistema/faturamento/convenio/buscar', 'FaturamentoController@FaturamentoConvenioBusca')->name('sistema.faturamento.convenio.buscar')->middleware('auth');
Route::match(['get', 'post'], '/sistema/faturamentos/buscar', 'FaturamentoContratoController@FaturamentoContratoBusca')->name('sistema.faturamentos.buscar')->middleware('auth');

//Rotas Alunos
Route::get('sistema/financeiro', 'FaturamentoController@index')->name('sistema.financeiro')->middleware('auth');
Route::get('sistema/faturamento/adicionar', 'FaturamentoController@create')->name('sistema.faturamento.adicionar')->middleware('auth');
Route::get('sistema/faturamento/{tipo}', 'FaturamentoController@show')->name('sistema.faturamento.tipo')->middleware('auth');
Route::post('sistema/faturamento/excluir', 'FaturamentoController@destroy')->name('sistema.faturamento.excluir')->middleware('auth');
Route::post('sistema/faturamento/contrato/excluir', 'FaturamentoContratoController@destroy')->name('sistema.faturamento.contrato.excluir')->middleware('auth');
Route::get('sistema/faturamento/convenio/{id}/contratos', 'FaturamentoController@VisualizarContratos')->name('sistema.faturamento.visualizar-contratos')->middleware('auth');
Route::get('sistema/faturamento/{id}/visualizar-relatorio', 'FaturamentoController@VisualizarRelatorio')->name('sistema.faturamento.visualizar-relatorio')->middleware('auth');


//Route::get('/sistema/faturamento/api-clientes', 'FaturamentoController@getClientes');
//Route::get('/sistema/faturamento/api-cliente-novo', 'FaturamentoController@NovoCliente');

Route::get('/sistema/cron/atualizar-notas', 'FaturamentoController@CronAtualizarNF');
Route::get('/sistema/cron/atualizar-boletos-retorno/{data}', 'FaturamentoBoletoController@CronAtualizarBoletos');
Route::get('/sistema/cron/atualizar-boletos', 'FaturamentoBoletoController@AtualizarBoletos');
Route::get('/sistema/cron/atualizar-boletos-geral', 'FaturamentoBoletoController@AtualizarBoletosGeral');
Route::get('/sistema/cron/executa-atualizacoes', 'AtualizacoesController@CronAtualizacoesAgendadas');


//Notas Fiscais
Route::post('sistema/faturamento/emitir-nf', 'FaturamentoNFController@EmitirNotaFiscal')->name('sistema.faturamento.emitirNF')->middleware('auth');
Route::get('sistema/faturamento/nota-fiscal/{id}/visualizar', 'FaturamentoNFController@VisualizarNotaFiscal')->name('sistema.faturamento.visualizar-nf');
Route::post('sistema/faturamento/cancelar-nf', 'FaturamentoNFController@CancelarNotaFiscal')->name('sistema.faturamento.cancelar-nf')->middleware('auth');
Route::get('sistema/faturamento/nota-fiscal/{id}/consultar', 'FaturamentoNFController@ConsultarNotaFiscal')->name('sistema.faturamento.consultar-nf');
Route::get('/sistema/faturamento/atualizar-nf', 'FaturamentoNFController@AtualizarNotaFiscal');

//Rotas Cobranças
Route::post('sistema/faturamento/boleto/excluir', 'FaturamentoBoletoController@destroy')->name('sistema.faturamento.boleto.excluir')->middleware('auth');
Route::post('sistema/contrato/gerar-cobranca', 'FaturamentoBoletoController@GerarBoleto')->name('sistema.contrato.gerar-cobranca')->middleware('auth');
//Route::get('sistema/faturamento/gerarBoleto', 'FaturamentoController@Boleto')->name('sistema.faturamento.gerar-boleto')->middleware('auth');
Route::get('sistema/faturamento/boleto/{id}/visualizar', 'FaturamentoBoletoController@VisualizarBoleto')->name('sistema.faturamento.visualizar-boleto');
Route::post('sistema/faturamento/boleto/baixar', 'FaturamentoBoletoController@CancelarBoleto')->name('sistema.boleto.cancelar-boleto')->middleware('auth');
Route::get('sistema/financeiro/gerar-remessa', 'FaturamentoBoletoController@GerarRemessa')->name('sistema.faturamento.gerar-remessa')->middleware('auth');
Route::post('sistema/faturamento/importar-retorno', 'FaturamentoBoletoController@ImportarRetorno')->name('sistema.faturamento.importar-retorno')->middleware('auth');
Route::post('sistema/faturamento/informar-numero-pedido', 'FaturamentoController@InformarNumeroPedido')->name('sistema.faturamento.informar-numero-pedido')->middleware('auth');
Route::post('sistema/faturamento/informar-credito', 'FaturamentoController@InformarCredito')->name('sistema.faturamento.informar-credito')->middleware('auth');
Route::post('sistema/faturamento/alterar-vencimento-boleto', 'FaturamentoBoletoController@AlterarVencimentoBoleto')->name('sistema.faturamento.alterar-vencimento-boleto')->middleware('auth');
Route::get('/sistema/financeiro/faturamento/boleto/{id}/visualizar', 'FaturamentoBoletoController@VisualizarBoleto')->name('sistema.faturamento.visualizar-boleto');
Route::post('sistema/faturamento/informar-pagamento', 'FaturamentoController@InformarPagamento')->name('sistema.faturamento.informar-pagamento')->middleware('auth');

//Rotas para geração de arquivos
Route::get('sistema/arquivo/arquivos-importacao', 'ArquivoController@index')->name('sistema.arquivo.arquivos-importacao')->middleware('auth');
Route::post('sistema/arquivo/gerar-arquivo', 'ArquivoController@GerarTXTFaturamento')->name('sistema.arquivo.gerar-arquivo')->middleware('auth');
Route::post('sistema/arquivo/excluir', 'ArquivoController@destroy')->name('sistema.arquivo.excluir')->middleware('auth');

Route::post('sistema/faturamento/enviar-email', 'FaturamentoController@EnviarEmailFaturamento')->name('sistema.faturamento.enviar-email')->middleware('auth');
Route::post('sistema/faturamento/validar', 'FaturamentoController@ValidarFaturamento')->name('sistema.faturamento.validar-faturamento')->middleware('auth');


//Rotas Vagas
Route::get('sistema/vagas', 'VagaController@index')->name('sistema.vagas')->middleware('auth');
Route::get('sistema/vaga/adicionar', 'VagaController@create')->name('sistema.vaga.adicionar')->middleware('auth');
Route::post('sistema/vaga/salvar', 'VagaController@store')->name('sistema.vaga.salvar')->middleware('auth');
Route::get('sistema/vaga/{id}/editar', 'VagaController@edit')->name('sistema.vaga.editar')->middleware('auth');
Route::post('sistema/vaga/update', 'VagaController@update')->name('sistema.vaga.update')->middleware('auth');
Route::post('sistema/vaga/excluir', 'VagaController@destroy')->name('sistema.vaga.excluir')->middleware('auth');
Route::get('sistema/candidatos', 'VagaController@candidatos')->name('sistema.candidatos')->middleware('auth');
Route::get('sistema/candidato/{id}/editar', 'VagaController@editCandidato')->name('sistema.candidato.editar')->middleware('auth');
Route::post('sistema/candidato/update', 'VagaController@updateCandidato')->name('sistema.candidato.update')->middleware('auth');
Route::match(['get', 'post'], 'sistema/candidatos/buscar', 'VagaController@CandidatoBusca')->name('sistema.candidatos.buscar');

Route::get('sistema/vaga/{id}/processo-seletivo', 'VagaController@ProcessoSeletivo')->name('sistema.vaga.processo-seletivo')->middleware('auth');
Route::post('sistema/candidato/adicionar', 'VagaController@AddCandidato')->name('sistema.candidato.adicionar')->middleware('auth');
Route::get('sistema/candidato/{id}/curriculo', 'VagaController@CurriculoCandidato')->name('sistema.candidato.curriculo');
Route::get('sistema/candidato/{id}/processo-seletivo', 'VagaController@ProcessoSeletivoCandidato')->name('sistema.candidato.processo-seletivo')->middleware('auth');
Route::post('sistema/processo/enviar', 'VagaController@EnviarProcesso')->name('sistema.processo.enviar')->middleware('auth');
Route::get('sistema/vaga/{id}/selecionar-candidatos', 'VagaController@SelecionarCandidatos')->name('sistema.vaga.selecionar-candidatos')->middleware('auth');
Route::post('sistema/vaga/processo-seletivo/incluir-candidato', 'VagaController@IncluirCandidato')->name('sistema.vaga.incluir-candidato')->middleware('auth');
Route::post('sistema/vaga/processo-seletivo/excluir-candidato', 'VagaController@ExcluirCandidato')->name('sistema.vaga.excluir-candidato')->middleware('auth');
Route::get('sistema/vaga/processo-seletivo/{id}/gerar-contrato', 'VagaController@GerarContrato')->name('sistema.vaga.gerar-contrato')->middleware('auth');
Route::post('sistema/vaga/processo-seletivo/desfazer-aceite', 'VagaController@DesfazerAceite')->name('sistema.vaga.desfazer-aceite')->middleware('auth');
//Rpta Processo Seletivo Empresa
Route::get('sistema/vaga/{id}/consulta-processo', 'ProcessoSeletivoController@ConsultaProcessoExterno')->name('sistema.vaga.consulta-processo');
Route::post('sistema/processo-seletivo/gravar-atualizacao', 'ProcessoSeletivoController@AtualizarProcessoSeletivoExterno')->name('sistema.processo-seletivo.gravar-atualizacao');
Route::post('sistema/vaga/processo-seletivo/concluir', 'ProcessoSeletivoController@FinalizarProcessoSeletivoExterno')->name('sistema.processo-seletivo.finalizar');

//Rota Calendário
Route::get('sistema/calendario/aluno/{aluno}/contrato/{contrato}/{acao}', 'CalendarioAlunoController@create')->name('sistema.calendario')->middleware('auth');

//Rotas Alunos
Route::get('sistema/cursos', 'CursoController@index')->name('sistema.cursos')->middleware('auth');
Route::get('sistema/curso/adicionar', 'CursoController@create')->name('sistema.curso.adicionar')->middleware('auth');
Route::post('sistema/curso/salvar', 'CursoController@store')->name('sistema.curso.salvar')->middleware('auth');
Route::get('sistema/curso/{id}/editar', 'CursoController@edit')->name('sistema.curso.editar')->middleware('auth');
Route::post('sistema/curso/update', 'CursoController@update')->name('sistema.curso.update')->middleware('auth');
Route::post('sistema/curso/excluir', 'CursoController@destroy')->name('sistema.curso.excluir')->middleware('auth');

//Rotas Alunos
Route::get('sistema/contratos', 'ContratoController@index')->name('sistema.contratos')->middleware('auth');
Route::get('sistema/contrato/adicionar', 'ContratoController@create')->name('sistema.contrato.adicionar')->middleware('auth');
Route::post('sistema/contrato/salvar', 'ContratoController@store')->name('sistema.contrato.salvar')->middleware('auth');
Route::get('sistema/contrato/{id}/editar', 'ContratoController@edit')->name('sistema.contrato.editar')->middleware('auth');
Route::post('sistema/contrato/update', 'ContratoController@update')->name('sistema.contrato.update')->middleware('auth');
Route::post('sistema/contrato/excluir', 'ContratoController@destroy')->name('sistema.contrato.excluir')->middleware('auth');
Route::get('sistema/contrato/{id}/imprimir', 'ContratoController@Print')->name('sistema.contrato.imprimir')->middleware('auth');
Route::get('sistema/contrato/{id}/atualizacoes', 'ContratoController@show')->name('sistema.contrato.atualizacoes')->middleware('auth');
Route::match(['get', 'post'], 'sistema/contratos/buscar', 'ContratoController@ContratoBusca')->name('sistema.contratos.buscar');
//Route::get('sistema/reposicao/get-alunos/{polo}', 'ContratoController@getAlunosReposicao')->middleware('auth');
Route::get('sistema/reposicao/get-alunos-empresa/{empresa}', 'ContratoController@getAlunosReposicao')->middleware('auth');
Route::get('/sistema/cron/atualizar-contratos', 'ContratoController@atualizaSituacao');

Route::get('/sistema/empresa/get-responsaveis/{id}', 'ContratoController@getResponsaveis')->middleware('auth');

Route::post('sistema/convenio/faturar', 'FaturamentoController@faturarConvenio')->name('sistema.convenio.faturar')->middleware('auth');
Route::post('sistema/contrato/faturar', 'FaturamentoController@faturarContrato')->name('sistema.contrato.faturar')->middleware('auth');

Route::get('sistema/contrato/{id}/calendario-pdf', 'ContratoController@CalendarioPDF')->name('sistema.contrato.calendario-pdf')->middleware('auth');

Route::post('sistema/contrato/gravarAtualizacao', 'AtualizacoesContratoController@store')->name('sistema.contrato.gravarAtualizacao')->middleware('auth');
Route::post('sistema/contrato/excluirAtualizacao', 'AtualizacoesContratoController@destroy')->name('sistema.atualizacao.excluir')->middleware('auth');

//Rotas Convênios
Route::get('sistema/convenios', 'ConvenioController@index')->name('sistema.convenios')->middleware('auth');
Route::get('sistema/convenio/adicionar', 'ConvenioController@create')->name('sistema.convenio.adicionar')->middleware('auth');
Route::post('sistema/convenio/salvar', 'ConvenioController@store')->name('sistema.convenio.salvar')->middleware('auth');
Route::get('sistema/convenio/{id}/editar', 'ConvenioController@edit')->name('sistema.convenio.editar')->middleware('auth');
Route::post('sistema/convenio/update', 'ConvenioController@update')->name('sistema.convenio.update')->middleware('auth');
Route::post('sistema/convenio/excluir', 'ConvenioController@destroy')->name('sistema.convenio.excluir')->middleware('auth');
Route::get('sistema/convenio/{id}/imprimir', 'ConvenioController@Print')->name('sistema.convenio.imprimir')->middleware('auth');
Route::get('sistema/convenio/{id}/contratos', 'ConvenioController@listarContratos')->name('sistema.convenio.contratos')->middleware('auth');
Route::match(['get', 'post'], 'sistema/convenios/buscar', 'ConvenioController@ConvenioBusca')->name('sistema.convenios.buscar');

//Rotas Alunos
Route::get('sistema/tabelas', 'TabelaController@index')->name('sistema.tabelas')->middleware('auth');
Route::get('sistema/tabela/adicionar', 'TabelaController@create')->name('sistema.tabela.adicionar')->middleware('auth');
Route::post('sistema/tabela/salvar', 'TabelaController@store')->name('sistema.tabela.salvar')->middleware('auth');
Route::get('sistema/tabela/{id}/editar', 'TabelaController@edit')->name('sistema.tabela.editar')->middleware('auth');
Route::post('sistema/tabela/update', 'TabelaController@update')->name('sistema.tabela.update')->middleware('auth');
Route::post('sistema/tabela/excluir', 'TabelaController@destroy')->name('sistema.tabela.excluir')->middleware('auth');

//Rotas Atualizações
Route::get('sistema/atualizacoes', 'AtualizacoesController@index')->name('sistema.atualizacoes')->middleware('auth');
Route::get('sistema/atualizacao/adicionar', 'AtualizacoesController@create')->name('sistema.atualizacao.adicionar')->middleware('auth');
Route::post('sistema/atualizacao/salvar', 'AtualizacoesController@store')->name('sistema.atualizacao.salvar')->middleware('auth');
Route::post('sistema/atualizacao/excluir', 'AtualizacoesController@destroy')->name('sistema.atualizacao.excluir')->middleware('auth');

//Enderecos
Route::get('/sistema/endereco/get-cidades/{id}', 'EnderecoController@getCidades');
Route::get('/sistema/endereco/get-bairros/{id}', 'EnderecoController@getBairros');

Route::get('/sistema/alunos/update-polo', 'AlunoController@updatePoloAluno');

Route::get('envio-email-boleto', function(){
    return view('emails.email_faturamento');
});

//Relatórios
Route::get('/sistema/relatorios', 'RelatoriosController@RelatorioBusca')->name('relatorios')->middleware('auth');
Route::match(['get', 'post'], 'sistema/relatorios/buscar', 'RelatoriosController@RelatorioBusca')->name('sistema.relatorios.buscar')->middleware('auth');
Route::post('sistema/relatorio/imprimir', 'RelatoriosController@ImprimirRelatorio')->name('sistema.relatorio.imprimir')->middleware('auth');

// Clear application cache:
Route::get('clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

//Clear route cache:
Route::get('route-cache', function() {
	Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});

//Clear config cache:
Route::get('config-cache', function() {
 	Artisan::call('config:cache');
 	return 'Config cache has been cleared';
});

// Clear view cache:
Route::get('view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});

Route::get('clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'App has been cleared';
});


Route::get('/importar-empresas', 'AppController@importarEmpresas');
Route::get('/importar-alunos', 'AppController@importarAlunos');
Route::get('/testes-feriados', 'AppController@GetFeriado');

Route::get('/testes', function() {
    //$valor = FaturamentoController::GetFaturamentoMesAnterior('484', '2024-07-01');
    //return $valor;
});

Route::get('/atualiza-boletos', function() {
    $data = date('Y-m-d', strtotime(Carbon::yesterday()));
    $valor = FaturamentoBoletoController::CronAtualizarBoletos($data);
    return $valor;
});

Route::get('/atualiza-boletos-hoje', function() {
    $data = date('Y-m-d');
    $valor = FaturamentoBoletoController::CronAtualizarBoletos($data);
    return $valor;
});

Route::get('/atualiza-pagamentos', function() {
    $boletosPagos = FaturamentoBoleto::where('status', 'LIQUIDACAO')->get();
    $i = 0;
    foreach($boletosPagos as $boleto){
        Faturamento::informarPagamento($boleto->faturamento_id, 'Boleto', $boleto->data_pagamento);
        $i++;
    }
    echo "Foram atualizados " . $i . " Pagamentos";
});

Route::get('/atualiza-atualizacoes-faturamentos', function() {
    $faturamentos = FaturamentoContrato::all();
    foreach($faturamentos as $faturamento){
        Helper::getAtualizacaoContrato($faturamento->data_inicial, $faturamento->data_final, $faturamento->contrato_id, 'Benefícios');
        Helper::getAtualizacaoContrato($faturamento->data_inicial, $faturamento->data_final, $faturamento->contrato_id, 'Falta Trabalho');
        Helper::getAtualizacaoContrato($faturamento->data_inicial, $faturamento->data_final, $faturamento->contrato_id, 'Exame Admissional');
        Helper::getAtualizacaoContrato($faturamento->data_inicial, $faturamento->data_final, $faturamento->contrato_id, 'Exame Demissional');
        Helper::getAtualizacaoContrato($faturamento->data_inicial, $faturamento->data_final, $faturamento->contrato_id, 'Entrega de Uniforme');
    }
    return $faturamentos->count()." atualizados";
});

Route::get('/atualiza-vencimento-faturamentos', function() {
    $boletos = FaturamentoBoleto::all();
    foreach($boletos as $boleto){
        $faturamento = Faturamento::find($boleto->faturamento_id);
        $faturamento->data_vencimento = $boleto->data_vencimento;
        $faturamento->update();
    }
    return $boletos->count()." atualizados";
});

Route::get('/atualiza-emissao-notas', function() {
    $notas = FaturamentoNF::all();
    foreach($notas as $nota){
        $nota->data_emissao = Helper::data_mysql(Helper::datetime_br($nota->created_at));
        $nota->update();
    }
    return $notas->count()." atualizados";
});

Route::get('/atualiza-vencimento-depositos', function() {
    $faturamentos = Faturamento::all();
    $total = 0;
    foreach($faturamentos as $faturamento){
        if($faturamento->forma_pagamento == "Depósito"){
            $data_vencimento = Helper::GetDataVencimentoFaturamento($faturamento); 
            $faturamento->data_vencimento = $data_vencimento;
            $faturamento->save();
            $total++;
        }
    }
    return $total." atualizados";
});

Route::get('/remove-atualizacoes-salario', function() {

    $contratos = Contrato::where('empresa_id', 1070)->get();
    $total = 0;
    foreach($contratos as $contrato){

            $alteracoes = AtualizacoesContrato::where('contrato_id', $contrato->id)->where('tipo', 'Alteração Salarial')->get();

            foreach($alteracoes as $alteracao){
                $alteracao->delete();
                $total++;
            }
        
    }
    return $total." removidos";
    
});



Route::get('/teste-api-post', function() {

    $url  = 'https://sistema.larjovemaprendiz.ong.br/api/gravar-pre-cadastro';
    $data = [
        'nomeCompleto' => 'Edson Galdino',
        'dataNascimento' => '2024-10-25',
        'email' => 'edsongaldino@outlook.com',
        'periodoEstudo' => 'manhã',
        'whatsapp' => '65996030422',
        'sexo' => 'Masculino',
        'cep' => '78144901',
        'estado' => 'MT',
        'cidade' => 'Várzea Grande',
        'bairro' => 'Jd Petrópolis'
    ];
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $result = curl_exec($ch);

    dd($result);

    curl_close($ch);
});

Route::get('/automatizacao-faturamentos', function() {
    $faturamentos = Faturamento::where('etapa_faturamento','<>','Validação')->where('etapa_faturamento','<>','Finalizado')->limit(2)->get();
    $total = 0;
    foreach($faturamentos as $faturamento){

        switch ($faturamento->etapa_faturamento) {
            case "Nota Fiscal":
                (New FaturamentoNFController())->EmitirNFAutomatico($faturamento->id);
                break;
            case "Boleto":
                (New FaturamentoBoletoController())->GerarBoletoAutomatico($faturamento->id);
                break;
            case "Envio Relatório":
                echo "Envio Relatório";
                break;
            case "Envio Faturamento":
                echo "Envio Faturamento";
                break;
            default:
                break;
        }
        $total++;
    }
    return $total." atualizados";
});


