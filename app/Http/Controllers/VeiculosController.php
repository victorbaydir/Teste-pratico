<?php

namespace App\Http\Controllers;

use App\User;
use App\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
    public function create()
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
        $this->veiculo->create([
            'placa' => $request->placa,
            'renavam' => $request->renavam,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'ano' => $request->ano,
            'proprietario' => 2
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($veiculo)
    {
        return response(view('veiculos.veiculo_edit', ['veiculo' => $this->veiculo->find($veiculo)]));
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
        $this->veiculo->where('id', $id)->update($request->except('_token', '_method'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($veiculo)
    {
        $veiculo = $this->veiculo->findOrFail($veiculo);
        $veiculo->delete();
        return redirect()->back();
    }
}
