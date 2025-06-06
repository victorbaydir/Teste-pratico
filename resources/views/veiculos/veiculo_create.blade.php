@extends(layout())

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Cadastrar Veículo</h1>
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
    <form method="POST" action="{{ route('veiculos.store') }}" class="input-group">
    
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row container-fluid">
            <div class="col">
                <label for="placa" class="form-label mt-3">Placa</label>
                <input type="text" name="placa" class="form-control">
            </div>
            <div class="col">
                <label for="renavam" class="form-label  mt-3">Renavam</label>
                <input type="text" name="renavam" class="form-control">
            </div>
        </div>
        <div class="row container-fluid ml-1">
            <label for="modelo" class="form-label  mt-3">Modelo</label>
            <input type="text" name="modelo" class="form-control">
        </div>
        <div class="row container-fluid">
            
            <div class="col">
                <label for="marca" class="form-label  mt-3">Marca</label>
                <input type="text" name="marca" class="form-control">

                
            </div>
            <div class="col">
                <label for="ano" class="form-label  mt-3">Ano</label>
                <input type="numeric" name="ano" class="form-control">
            </div>
        </div>
        <div class="row container-fluid ml-1">
            <label for="proprietario" class="form-label  mt-3">Proprietário</label>
            <input type="text" name="proprietario" class="form-control">
        </div>
        
        <div class="row container-fluid">
            <div class="text-center">
                <a class="btn btn-primary mt-3" href="{{ route('veiculos.index') }}">VOLTAR</a>
                @if( Auth::user()->role == 2 )
                <button type="submit" class="btn btn-success mt-3">SALVAR</button>
                @endif
            </div>
        </div>

    </form>
</div>



@endsection