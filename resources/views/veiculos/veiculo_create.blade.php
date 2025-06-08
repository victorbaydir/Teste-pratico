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
    <form method="POST" action="{{ route('veiculos.store') }}" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="container">
            <div class="row">
                <div class="col">
                    <label for="placa" class="form-label mt-3">Placa</label>
                    <input type="text" name="placa" class="form-control" >

                </div>
                <div class="col">
                    <label for="renavam" class="form-label  mt-3">Renavam</label>
                    <input type="text" name="renavam" class="form-control" >
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="modelo" class="form-label  mt-3">Modelo</label>
                    <input type="text" name="modelo" class="form-control" >
                </div>
                <div class="col">
                    <label for="marca" class="form-label  mt-3">Marca</label>
                    <input type="text" name="marca" class="form-control" >
                </div>
                <div class="col">
                    <label for="ano" class="form-label  mt-3">Ano</label>
                    <input type="numeric" name="ano" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="proprietario" class="form-label  mt-3">Proprietário</label>
                <input type="text" name="proprietario" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('veiculos.create') }}" class="btn btn-secondary mt-3">NOVO</a>
                    <a class="btn btn-primary mt-3" href="{{ route('veiculos.index') }}">VOLTAR</a>
                    @roleadmin
                    <button type="submit" class="btn btn-success mt-3">SALVAR</button>
                    @endroleadmin
                </div>
            </div>
        </div>
    </form>
</div>



@endsection