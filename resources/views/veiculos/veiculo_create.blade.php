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
                <button type="submit" class="btn btn-success mt-3">SALVAR 2</button>
            </div>
        </div>

    </form>
</div>


<script>
    async function consultarProprietario() {
    const url = 'http://127.0.0.1:8000/veiculos/proprietario?nomeProprietario=Administrador';

    // 1. Obter o token CSRF da meta tag
    const csrfToken = 'aaslTnpP87GwI9Xv4oZaaYJIrS5nGfSap4aeURg2';

    try {
        console.log(1);
        const response = await fetch(url, {
            method: 'GET', // Usar GET, pois é uma consulta. Se fosse enviar dados, seria POST, PUT, etc.
            headers: {
                // 2. Incluir o token CSRF no cabeçalho X-CSRF-TOKEN
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json', // Informa ao servidor que você está enviando JSON (se aplicável)
                'Accept': 'application/json' // Informa ao servidor que você espera uma resposta JSON
            },
            // Se fosse uma requisição POST/PUT, você incluiria o corpo aqui:
            // body: JSON.stringify({ seuDado: 'valor' })
        });
        console.log(2);
        console.log(response);

        if (!response.ok) {
            console.log(3);
            // Se a resposta não for OK (ex: 403 Forbidden, 419 Page Expired), lance um erro
            throw new Error(`Response status: ${response.status} - ${response.statusText}`);
        }
        console.log(4);

        const text = await response.text();
        console.log('Resposta da API:', text);

        if (text) {
            const json = JSON.parse(text);
            console.log(5, json);
        } else {
            console.log('Resposta vazia, não tem JSON');
        }
    } catch (error) {
        console.log('API ERROR: ' + error);
        // Adicionar tratamento para erros de rede ou de requisição
        if (error instanceof TypeError && error.message === 'Failed to fetch') {
            console.error('Erro de rede: Verifique a URL ou a conexão.');
        }
    }
}

</script>

@endsection