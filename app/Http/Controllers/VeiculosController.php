<?php

namespace App\Http\Controllers;

use App\Mail\CreateVeiculoMail;
use App\User;
use App\Veiculo;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
    public function store(Request $request)
    {   
        
        //Valida regex da PLACA e do ANO
        $validator = Veiculo::validate($request);

        if ($validator->fails()) {
            return response(
                redirect()
                ->back()
                ->with('error', $validator->errors()->first())
                ->withInput());
        }
    
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
        return response(view('veiculos.veiculo_edit', compact('veiculo', 'proprietario')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Veiculo::validate($request);

        if ($validator->fails()) {
            return response(
                redirect()
                ->back()
                ->with('error', $validator->errors()->first())
                ->withInput());
        }
        $this->atualizar($request, $id);
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

    private static function buscarProprietarioPorNome(String $nome) {
        return DB::select("select * from users where name ilike :nome", ['nome' => "$nome"]);
    }

    public function cadastrar($request) {
        $proprietario = $this->buscarProprietarioPorNome($request->proprietario)[0];

        $this->veiculo->create([
            'placa' => $request->placa,
            'renavam' => $request->renavam,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'ano' => $request->ano,
            'proprietario' => $proprietario->id
        ]);

        Veiculo::enviarEmailCreate($proprietario);
    }

    public function atualizar($request, $id) {
        $this->veiculo
            ->where('id', $id)
            ->update($request->except('_token', '_method'));

        $proprietario = $this->buscarProprietarioPorNome($request->proprietario)[0];

        Veiculo::enviarEmailUpdate($proprietario);
    }

}
