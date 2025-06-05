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

            <label class="form-label  mt-3">Consultar Proprietário</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProprietario">
                Procurar Proprietário
                </button>
                </div>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="text-center">
                <a class="btn btn-primary mt-3" href="{{ route('veiculos.index') }}">VOLTAR</a>
                <button class="btn btn-success mt-3">SALVAR</button>
            </div>
        </div>
    </form>
</div>

<!-- MODAL PROPRIETARIO -->
<div class="modal fade" id="modalProprietario" tabindex="-1" aria-labelledby="proprietarioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="proprietarioModalLabel">Buscar Proprietário</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('veiculos.proprietario') }}" method="post" class="d-flex">
            @csrf
            <input name="nomeProprietario" type="text" id="buscaProprietario" class="form-control" placeholder="Digite o nome do proprietário">
            <button class="btn btn-primary ml-3">BUSCAR</button>
        </form>
        <table class="table text-center">
            <thead>
                <th>ID</th>
                <th>NOME</th>
                <th>OPÇÕES</th>
            </thead>
        </table>


        <!-- Formulário ou campo para buscar o proprietário -->
        
        <div id="resultadosBusca" class="mt-3">
          <!-- Aqui você pode mostrar os resultados da busca via AJAX -->
        </div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection