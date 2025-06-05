@extends(layout())

@section('content')

<div class="container">
    <div class="row">
        <h1>Cadastrar Veículo</h1>
    </div>
    <form method="POST" action="{{ route('veiculos.store') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <label for="placa" class="form-label mt-3">Placa</label>
            <input type="text" name="placa" class="form-control">

            <label for="renavam" class="form-label  mt-3">Renavam</label>
            <input type="text" name="renavam" class="form-control">

            <label for="modelo" class="form-label  mt-3">Modelo</label>
            <input type="text" name="modelo" class="form-control">

            <label for="marca" class="form-label  mt-3">Marca</label>
            <input type="text" name="marca" class="form-control">

            <label for="ano" class="form-label  mt-3">Ano</label>
            <input type="numeric" name="ano" class="form-control">
        </div>
        <div class="row">
            <div class="text-center">
                <a class="btn btn-primary mt-3" href="{{ route('veiculos.index') }}">VOLTAR</a>
                <button class="btn btn-success mt-3">SALVAR</button>
            </div>
        </div>
    </form>
    
</div>

@endsection