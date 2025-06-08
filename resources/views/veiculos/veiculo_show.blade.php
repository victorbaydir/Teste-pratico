@extends(layout())

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Veículo</h1>
        </div>
        
    </div>
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <label for="id" class="form-label mt-3">ID</label>
                    <input disabled type="text" name="id" class="form-control" value="{{ $veiculo->id }}">
                </div>
            </div>   
            <div class="row">
                <div class="col">
                    <label for="placa" class="form-label mt-3">Placa</label>
                    <input disabled type="text" name="placa" class="form-control" value="{{ $veiculo->placa }}">
                </div>
                <div class="col">
                    <label for="renavam" class="form-label  mt-3">Renavam</label>
                    <input disabled type="text" name="renavam" class="form-control" value="{{ $veiculo->renavam }}">
                </div>
            </div>   
            <div class="row">
                <div class="col">
                    <label for="modelo" class="form-label  mt-3">Modelo</label>
                    <input disabled type="text" name="modelo" class="form-control" value="{{ $veiculo->modelo }}">

                </div>
                <div class="col">
                    <label for="marca" class="form-label  mt-3">Marca</label>
                    <input disabled type="text" name="marca" class="form-control" value="{{ $veiculo->marca }}">
                </div>
                <div class="col">
                    <label for="ano" class="form-label  mt-3">Ano</label>
                    <input disabled type="numeric" name="ano" class="form-control" value="{{ $veiculo->ano }}">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="proprietario" class="form-label  mt-3">Proprietário</label>
                    <input disabled type="text" name="proprietario" class="form-control" value="{{ $proprietario->name }}">
                </div>
            </div>    
            <div class="row">
                <div class="col">
                    <a disabled class="btn btn-primary mt-3" href="{{ route('veiculos.index') }}">VOLTAR</a>
                </div>
            </div>
        </div>

            

            
            

            
            
            
        
        
    
</div>

@endsection