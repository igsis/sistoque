<?php

namespace ccult\Http\Controllers;

use Illuminate\Http\Request;
use ccult\Models\PjEndereco;
use ccult\Models\PjTelefone;
use ccult\Models\PessoaJuridica;
use ccult\Models\RepresentanteLegal;

class PessoaJuridicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaJuridica');
    }

    public function index()
    {
        return view('pessoaJuridica.home');
    }

    public function show()
    {
		$pessoaJuridica = auth()->user();

        return view('pessoaJuridica.cadastro', compact('pessoaJuridica'));
    }

    public function update(Request $request)
    {

		$data = $this->validate($request, [
			'razaoSocial' => 'required|string',
			// 'documento' => 'required',
			'ccm' => 'nullable',
			'email' => 'required|string|email|max:255',
		]);

		$pj = auth()->user();

		$pj->update([
			'razao_social' => $request->razaoSocial,
			// 'documento_tipo_id' => $request->documento_tipo_id,
			'ccm' => $request->ccm,
			'email' => $request->email,
		]);

    	return redirect()->back()->with('flash_message',
            'Os Dados Foram Atualizados Com Sucesso!');

	}
	
	public function endereco()
	{	
		$pj = auth()->user();

		if (!$pj->endereco){
			return view('pessoaJuridica.cadastroEndereco');
		}

		$endereco = PjEndereco::find($pj->id);

		return view('pessoaJuridica.editarEndereco', compact('endereco'));
	}

	public function cadastroEndereco(Request $request)
	{
		$pj = auth()->user();

		$data = $this->validate($request, [
			'cep'=>'required|min:8',
			'logradouro'=>'required',
			'bairro'=>'required',
			'numero'=>'required|numeric',
			'complemento'=>'nullable',
			'cidade'=>'required',
			'uf'=>'required|max:2',
		]);

		$data['pessoa_juridica_id'] = $pj->id;

		$pj->endereco()->create($data);

		return redirect()->route('pessoaJuridica.formEndereco')->with('flash_message',
		'Endereço Foi Cadastrado Com Sucesso!');
	}

	public function atualizarEndereco(Request $request)
	{
		$pj = auth()->user();

		$data = $this->validate($request, [
			'cep'=>'required|min:8',
			'logradouro'=>'required',
			'bairro'=>'required',
			'numero'=>'required|numeric',
			'complemento'=>'nullable',
			'cidade'=>'required',
			'uf'=>'required|max:2',
		]);

		$data['pessoa_juridica_id'] = $pj->id;

		$pj->endereco()->update($data);

		return redirect()->route('pessoaJuridica.formEndereco')->with('flash_message',
		'Seu Endereço Foi Atualizado Com Sucesso!');
	}

	public function formTelefones()
	{
		$pj = auth()->user();

		if($pj->telefone){
			$tel = PjTelefone::find($pj->id);

			return view('pessoaJuridica.editarTelefone', compact('tel'));

		}
		return view('pessoaJuridica.cadastroTelefone');
	}

	public function cadastroTelefone(Request $request)
	{
		$pj = auth()->user();

		$data = $this->validate($request, [
			'telefone' =>'required_without:celular',
			'celular'  =>'required_without:telefone',
		]);
		$data['pessoa_juridica_id'] = $pj->id;

		if ($request->celular && $request->telefone){
			PjTelefone::create($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefones Cadastrados Com Sucesso!');

		}elseif ($request->celular && !$request->telefone) {
			PjTelefone::create($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Celular cadastrado com Sucesso!');
		}
		elseif (!$request->celular && $request->telefone) {
			PjTelefone::create($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefone cadastrado com Sucesso!');
		}
	}
	public function atualizaTelefone(Request $request)
	{
	
		$pj = auth()->user();

		$data = $this->validate($request, [
			'telefone' =>'required_without:celular',
			'celular'  =>'required_without:telefone',
		]);
		$data['pessoa_juridica_id'] = $pj->id;

		$telefone = PjTelefone::find($pj->id);

		if ($request->celular && $request->telefone){
			$telefone->update($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefones Atualizados Com Sucesso!');

		}elseif ($request->celular && !$request->telefone) {
			$telefone->update($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Celular Atualizado com Sucesso!');
		}
		elseif (!$request->celular && $request->telefone) {
			$telefone->update($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefone Atualizado com Sucesso!');
		}
	}
	public function formRepresentante()
	{
		$pj = auth()->user();

		$rep = $pj->representanteLegal1;
		$rep2 = $pj->representanteLegal2;

		if(!$rep && $rep2)
		{
			return view('pessoaJuridica.pesquisarRepresentanteLegal', compact('rep2'));
			
		}elseif ($rep) 
		{
			return view('pessoaJuridica.editarRepresentanteLegal', compact('rep'));
		}

		return view('pessoaJuridica.pesquisarRepresentanteLegal');

	}

	public function cadastroRepresentante(Request $request)
	{
		$pj = auth()->user();

		$data = $this->validate($request, [
			'nome' 		=>	'required|string',
			'rg'  		=>	'required',
			'cpf' 		=>	'required|unique:representante_legais|min:14'
		]);

		$rep = RepresentanteLegal::create($data);	

		$pj->update(['representante_legal1_id' => $rep->id]);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
		'1º Representante Legal Inserido com Sucesso!');
	}

	public function editarRepresentante(Request $request)
	{
		$pj = auth()->user();

		$data = $this->validate($request, [
			'nome' 		=>	'required',
			'rg'  		=>	'required',
		]);

		$pj->representanteLegal1()->update($data);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
		'1º Representante Legal Atualizado com Sucesso!');
	}

	public function removerRepresentante()
	{
		$pj = auth()->user();

		$pj->update(['representante_legal1_id' => null]);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
		'2º Representante Foi Removido com Sucesso!');
	}

	public function formRepresentante2()
	{
		$rep = auth()->user()->representanteLegal2;

		if($rep)
		{
			return view('pessoaJuridica.editarRepresentanteLegal2', compact('rep'));
		}
		
		return view('pessoaJuridica.pesquisarRepresentanteLegal2');
	}

	public function cadastroRepresentante2(Request $request)
	{
		$pj = auth()->user();

		$data = $this->validate($request, [
			'nome' 		=>	'required|string',
			'rg'  		=>	'required',
			'cpf' 		=>	'required|cpf|unique:representante_legais|min:14'
		]);

		$rep = RepresentanteLegal::create($data);	

		$pj->update(['representante_legal2_id' => $rep->id]);

		return redirect()->route('pessoaJuridica.formRepresentante2')->with('flash_message',
		'2º Representante Legal Inserido com Sucesso!');

	}

	public function editarRepresentante2(Request $request)
	{
		$pj = auth()->user();

		$data = $this->validate($request, [
			'nome' 		=>	'required',
			'rg'  		=>	'required',
		]);

		$pj->representanteLegal1()->update($data);

		return redirect()->route('pessoaJuridica.formRepresentante2')->with('flash_message',
		'2º Representante Legal Atualizado com Sucesso!');
	}

	public function removerRepresentante2()
	{
		$pj = auth()->user();

		$pj->update(['representante_legal2_id' => null]);

		return redirect()->route('pessoaJuridica.formRepresentante2')->with('flash_message',
		'2º Representante Foi Removido com Sucesso!');
	}

	public function search(Request $request, RepresentanteLegal $representanteLegal)
    {
		$dataForm = $request->except('_token');

		$this->validate($request, [
			'cpf' 		=>	'required|min:14|cpf',
		],
        [
            'required' => 'O campo :attribute é obrigatório para localizar o Representante Legal',
		],[
            'cpf'      => 'CPF',
        ]);

		$rep = $representanteLegal->search($dataForm)->first();
	
		if ($rep){
			$request->session()->put('rep', $rep);
			return redirect()->route('pessoaJuridica.formVincularRepresentante')
				->with('warning', 'Verifique se esse representante corresponde a pesquisa do CPF informado');
		}

		$request->session()->put('cpf',$request->cpf);
		return redirect()->route('pessoaJuridica.formCadastrarRepresentante')
			->with('flash_message', 'Cadastre o representante Legal');

	}

	public function formVincularRepresentante(Request $request){
		
		$rep = $request->session()->get('rep');


		return view('pessoaJuridica.vincularRepresentanteLegal', compact('rep'));
	}

	public function formCadastrarRepresentante(Request $request){

		$cpf = $request->session()->get('cpf');

		return view('pessoaJuridica.cadastroRepresentanteLegal', compact('cpf'));
	}

	public function formVincularRepresentante2(Request $request){
		
		$rep = $request->session()->get('rep2');


		return view('pessoaJuridica.vincularRepresentanteLegal2', compact('rep'));
	}

	public function formCadastrarRepresentante2(Request $request){

		$cpf = $request->session()->get('cpf2');

		return view('pessoaJuridica.cadastroRepresentanteLegal2', compact('cpf'));
	}
	
	public function search2(Request $request, RepresentanteLegal $representanteLegal)
    {
		$dataForm = $request->except('_token');
		
		$this->validate($request, [
			'cpf' 		=>	'required|min:14',
		],
        [
            'required' => 'O campo :attribute é obrigatório para localizar o Representante Legal',
        ], [
            'cpf'      => 'CPF',
        ]);

		$rep = $representanteLegal->search($dataForm)->first();

		if ($rep){
			$request->session()->put('rep2', $rep);
			return redirect()->route('pessoaJuridica.formVincularRepresentante2')
				->with('warning', 'Verifique se esse representante corresponde a pesquisa do CPF informado');
		}

		$request->session()->put('cpf2',$request->cpf);
		return redirect()->route('pessoaJuridica.formCadastrarRepresentante2')
			->with('flash_message', 'Cadastre o representante Legal');

	}
	
	public function vincularRepresentante(Request $request)
    {
		$pj = auth()->user();

		$data = $this->validate($request,[
			'nome' 	=> 'required',
			'rg' 	=> 'required',
		]);
		
		$rep = RepresentanteLegal::find($request->id);

		$rep->update($data);

		$pj->update(['representante_legal1_id' => $rep->id ]);
		
		// Destroi a sessao
		$request->session()->pull('rep', []);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
		'1º Representante Legal Vinculado com Sucesso!');
	}

	public function vincularRepresentante2(Request $request)
    {
		$data = $this->validate($request,[
			'nome' => 'required',
			'rg' => 'required',
		]);

		$pj = auth()->user();

		$rep = RepresentanteLegal::findOrFail($request->id);

		// Destroi a sessao
		$request->session()->pull('rep2', []);

		if($pj->representanteLegal1)
		{

			if($pj->representanteLegal1->id != $rep->id)
			{
				$pj->update(['representante_legal2_id' => $rep->id ]);

				$rep->update($data);

				return redirect()->route('pessoaJuridica.formRepresentante2')->with('flash_message',
					'2º Representante Legal Vinculado com Sucesso!');
			}
			return redirect()->route('pessoaJuridica.formRepresentante2')
				->with('warning', 'Representate já foi cadastrado como 1º Representante Legal!');
		}

		$pj->update(['representante_legal2_id' => $rep->id ]);

		$rep->update($data);

		return redirect()->route('pessoaJuridica.formRepresentante2')->with('flash_message',
			'2º Representante Legal Vinculado com Sucesso!');

	}


	public function trocarRepLegal(){
		$pj = auth()->user();

		$rep = $pj->representanteLegal2;

		$pj->update(['representante_legal1_id' => $rep->id ]);
		$pj->update(['representante_legal2_id' => null ]);

		return redirect()->route('pessoaJuridica.formRepresentante')
			->with('flash_message','Alteração Realizada com Sucesso!');;

	}

	public function pendencias()
	{
		$pj = auth()->user();
		
		$notificacoes = [];

		if(!$pj->endereco){
			
			$notificacao = (object) 
			[
				'titulo'	=>	'Cadastro de Endereço Pendente',
				'aviso' 	=>	'Necessário Cadastrar Endereço',
				'rota' 		=>	 route('pessoaJuridica.formEndereco'),
			];
			array_push($notificacoes, $notificacao);

		}
		
		if(!$pj->telefone){

			$notificacao = (object) 
			[
				'titulo'	=>	'Cadastro de Telefone Pendente',
				'aviso' 	=>	'Necessário Cadastrar Pelo Menos Um Telefone',
				'rota' 		=>	 route('pessoaJuridica.formTelefones'),
			];
			array_push($notificacoes, $notificacao);
		}

		if(!$pj->representanteLegal1){

			$notificacao = (object) 
			[
				'titulo'	=>	'Cadastro de Representante Legal Pendente',
				'aviso' 	=>	'Necessário Cadastrar Pelo Menos Um Representante Legal',
				'rota' 		=>	 route('pessoaJuridica.formRepresentante'),
			];
			array_push($notificacoes, $notificacao);
		}

		return view('pessoaJuridica.pendencias', compact('notificacoes'));
	}
}
