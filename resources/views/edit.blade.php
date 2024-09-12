@extends('layouts.main')
@section('content')
<main class="container mt-5">
    

    <h2>Editar um Registro</h2>

    <form action="{{ route('update', ['id' => $venda->id ])}}" method="post">

        @csrf
        @method('PUT')
        <div class="mb-3 mt-4">
            <label for="NomeProduto" class="form-label">Nome do Produto:</label>
            <input name="nome_produto" value="{{ $venda->nome_produto }}" type="text" class="form-control" id="NomeProduto" placeholder="Playstation 4">
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="mb-3 mt-4">
                    <label for="nome_produto" class="form-label">Valor do Produto(R$):</label>
                    <input value="{{ $venda->valor }}" onblur="valorVSquantidade()" name="valor" type="text" class="form-control" id="valor_produto" placeholder="300">
                </div>
            </div>
            <div class="col-md-3">
                <label for="Forma de Pagamento"  class="form-label mt-4">Forma de Pagamento:</label>
                <select name="forma_pagamento" class="form-select" id="formaPagamento" aria-label="Default select example">
                    
                @foreach($forma_pagamentos as $pagamento)
                    <option value="{{$pagamento}}" @if($pagamento == $venda->forma_pagamentos) selected @endif >{{$pagamento}}</option>
                @endforeach

                </select>
            </div>
            <div class="col-md-2">
                <label for="Quantidade" class="form-label mt-4">Quantidade:</label>
               <input value="{{ $venda->qtda_produto }}" type="int" onblur="valorVSquantidade()" id="qtda_produto" placeholder="quantidade" name="qtda_produto" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="Subtotal" class="form-label mt-4">Subtotal:</label>
               <input value="{{ $venda->subtotal }}" type="text" id="subtotal" name="subtotal" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="Parcelas" class="form-label mt-4">Parcelas:</label>
                <select name="qtda_parcelas" class="form-select" id="quantidade_parcelas" aria-label="Default select example">
                    
                    @for($i = 1; $i <= 12; $i++)

                        <option value="{{ $i }}" @if($i == $venda->qtda_parcelas) selected @endif >{{ $i }} x</option>
                    @endfor
                </select>
            </div>
        </div>
        @if(session('pagamento_invalido'))
            <div class="alert alert-danger">
                <p>{{ session('pagamento_invalido')}}</p>
            </div>
        @endif

        <div class="mt-3">
            <button type="submit" class="btn btn-success" style="width: 20%">Atualizar</button>
        </div>
    </form>

</main>
@endsection()
