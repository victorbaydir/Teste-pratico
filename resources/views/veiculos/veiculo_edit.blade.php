@extends(layout())

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Editar Veículo</h1>
        </div>
        @if(session()->has('error'))
            <div class="col text-center mt-3">
                <p style="color:red">{{ session()->get('error') }}</p>
            </div>
        @elseif(session()->has('success'))
            <div class="col text-center mt-3">
                <p style="color:green">{{ session()->get('success') }}</p>
            </div>
        @endif
        
    </div>
    <form method="POST" action="{{ route('veiculos.update', $veiculo) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <label for="id" class="form-label mt-3">ID</label>
            <input disabled type="text" name="id" class="form-control" value="{{ $veiculo->id }}">

            <label for="placa" class="form-label mt-3">Placa</label>
            <input type="text" name="placa" class="form-control" value="{{ $veiculo->placa }}">

            <label for="renavam" class="form-label  mt-3">Renavam</label>
            <input type="text" name="renavam" class="form-control" value="{{ $veiculo->renavam }}">

            <label for="modelo" class="form-label  mt-3">Modelo</label>
            <input type="text" name="modelo" class="form-control" value="{{ $veiculo->modelo }}">

            <label for="marca" class="form-label  mt-3">Marca</label>
            <input type="text" name="marca" class="form-control" value="{{ $veiculo->marca }}">

            <label for="ano" class="form-label  mt-3">Ano</label>
            <input type="numeric" name="ano" class="form-control" value="{{ $veiculo->ano }}">
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