@extends(layout())

@section('content')

<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('veiculos.update', $veiculo) }}">
        @method('PUT')

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="emailProprietario" value="{{ $emailProprietario }}">

        <div class="container">
            <div class="row">
                <div class="col-2">

                    <label for="id" class="form-label mt-3">ID</label>
                    <input disabled type="text" name="id" class="form-control" value="{{ $veiculo->id }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="placa" class="form-label mt-3">Placa</label>
                    <input type="text" name="placa" class="form-control" value="{{ $veiculo->placa }}">

                </div>
                <div class="col">
                    <label for="renavam" class="form-label  mt-3">Renavam</label>
                    <input type="text" name="renavam" class="form-control" value="{{ $veiculo->renavam }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="modelo" class="form-label  mt-3">Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="{{ $veiculo->modelo }}">
                </div>
                <div class="col">
                    <label for="marca" class="form-label  mt-3">Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{ $veiculo->marca }}">
                </div>
                <div class="col">
                    <label for="ano" class="form-label  mt-3">Ano</label>
                    <input type="numeric" name="ano" class="form-control" value="{{ $veiculo->ano }}">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="proprietario" class="form-label  mt-3">Proprietário</label>
                <input type="text" name="proprietario" class="form-control" value="{{ $proprietario->name }}">
                </div>
            </div>
            <div class="row">
                <div class="col">
                        @roleadmin()
                            
                        <a href="{{ route('veiculos.create') }}" class="btn btn-secondary mt-3">NOVO</a>
                        <button class="btn btn-success mt-3">SALVAR</button>
                        @endroleadmin
                        <a class="btn btn-primary mt-3" href="{{ route('veiculos.index') }}">VOLTAR</a>

                </div>
                
            </div>
        </div>
   
    </form>
    
</div>

@endsection