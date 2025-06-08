<?php

namespace App\Http\Controllers;

use App\User;
use App\Veiculo;
use DB;
use Illuminate\Http\Request;
use App\Events\VeiculoSalvoEvent;

class VeiculosController extends Controller
{
    private $veiculo;

    public function __construct()
    {
        $this->veiculo = new Veiculo();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veiculos = $this->veiculo->all()->sortBy('id');
        foreach($veiculos as $veiculo) {
            $user = new User();
            $veiculo->proprietario = $user->find($veiculo->proprietario);
        }
        return response(view('veiculos.veiculo_index', ['veiculos' => $veiculos]));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return response(view('veiculos.veiculo_create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)    {   
        //Valida regex da PLACA e do ANO
        Veiculo::validate($request);

        $this->cadastrar($request);
        
        return response(redirect()->back()->with('success', 'Veículo cadastrado com sucesso!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veiculo = $this->veiculo->find($id);
        $proprietario = User::find($veiculo->proprietario);
        return response(view('veiculos.veiculo_show', compact('veiculo', 'proprietario')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $veiculo = Veiculo::find($id);
        $proprietario = User::find($veiculo->proprietario);
        $emailProprietario = $proprietario->email;
        return response(view('veiculos.veiculo_edit', compact('veiculo', 'proprietario', 'emailProprietario')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        Veiculo::validate($request);
        $this->atualizarEnviarEmail($request, $id);
        return response(redirect()->back()->with('success', 'Veículo atualizado com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $veiculo = $this->veiculo->find($id);
        $veiculo->delete();
        return redirect()->back();
    }

    public function cadastrar($request) {
        $proprietario = Veiculo::buscarProprietarioPorNome($request->proprietario);
        $emailProprietario = $proprietario->email;
        $this->cadastrarEnviarEmail($request, $proprietario, $emailProprietario);
        
    }

    public function cadastrarEnviarEmail($request, $proprietario, $emailProprietario) {
        $this->cadastrarVeiculo($request, $proprietario);
        event(new VeiculoSalvoEvent($proprietario, 'Veículo cadastrado com sucesso!'));
    }

    public function cadastrarVeiculo($request, $proprietario) {
        $this->veiculo->create([
            'placa' => $request->placa,
            'renavam' => $request->renavam,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'ano' => $request->ano,
            'proprietario' => $proprietario->id
        ]);
    }

    public function atualizarEnviarEmail($request, $id) {
        $proprietario = Veiculo::buscarProprietarioPorNome($request->proprietario);
    
        if (!$proprietario) {
            return redirect()->back()->with('error', 'Proprietário não encontrado!');
        }

        $request->merge(['proprietario' => $proprietario->id]);

        $this->atualizar($request, $id);
        event(new VeiculoSalvoEvent( $proprietario, 'Veículo atualizado com sucesso!'));
    }

    public function atualizar($request, $id) {
        $this->veiculo
            ->where('id', $id)
            ->update($request->except('_token', '_method', 'emailProprietario'));
    }

    

}
