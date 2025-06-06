@extends(layout())

@section('content')

<div class="container">
    <div class="row mb-3">
        <h1>Veículos</h1>
    </div>
    <div class="row">
        <table class="table text-center">
            <thead>
                <th>ID</th>
                <th>PLACA</th>
                <th>MODELO</th>
                <th>MARCA</th>
                <th>ANO</th>
                <th>PROPRIETÁRIO</th>
                <th>OPÇÕES</th>
            </thead>
            <tbody>
                @foreach($veiculos as $veiculo)
                    <tr>
                        <td>{{ $veiculo->id }}</td>
                        <td>{{ $veiculo->placa }}</td>
                        <td>{{ $veiculo->modelo }}</td>
                        <td>{{ $veiculo->marca }}</td>
                        <td>{{ $veiculo->ano }}</td>
                        <td>{{ $veiculo->proprietario->name }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                @if(Auth::user()->role == 2)
                                    <a href="{{ route('veiculos.edit',$veiculo) }}" class="btn btn-primary">EDITAR</a>
                                    <form method="post" action="{{ route('veiculos.destroy', $veiculo)}}">
                                        @method('delete')
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-danger ml-3">EXCLUIR</button>
                                    </form>

                                    @else
                                    <a href="{{ route('veiculos.show',$veiculo) }}" class="btn btn-primary">MOSTRAR</a>
                                @endif
                            </div>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
    <div class="row mt-3">
        <a href="{{ route('veiculos.create') }}" class="btn btn-primary">NOVO</a>
    </div>
</div>

@endsection