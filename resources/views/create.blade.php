@extends('layouts.main')
@section('content')
<main class="container mt-5">
    

    <h2>Insira um novo produto</h2>

    <form action="{{ route('store')}}" method="post">

        @csrf
        <div class="mb-3 mt-4">
            <label for="NomeProduto" class="form-label">Nome do Produto:</label>
            <input name="nome_produto" type="text" class="form-control" id="NomeProduto" placeholder="Playstation 4">
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="mb-3 mt-4">
                    <label for="nome_produto" class="form-label">Valor do Produto(R$):</label>
                    <input onblur="valorVSquantidade()" name="valor" type="text" class="form-control" id="valor_produto" placeholder="300">
                </div>
            </div>
            <div class="col-md-3">
                <label for="Forma de Pagamento"  class="form-label mt-4">Forma de Pagamento:</label>
                <select name="forma_pagamento" class="form-select" id="formaPagamento" aria-label="Default select example">
                    <option value="0" selected>Forma de Pagamento</option>
                    <option value="Cartao de Credito">Cartão de Credito</option>
                    <option value="Cartao de Debito">Cartão de Debito</option>
                    <option value="Pix">Pix</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="Quantidade" class="form-label mt-4">Quantidade:</label>
               <input type="int" onblur="valorVSquantidade()" id="qtda_produto" placeholder="quantidade" name="qtda_produto" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="Subtotal" class="form-label mt-4">Subtotal:</label>
               <input type="text" id="subtotal" name="subtotal" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="Forma de Pagamento" class="form-label mt-4">Parcelas:</label>
                <select name="qtda_parcelas" class="form-select" id="quantidade_parcelas" aria-label="Default select example">
                    <option value="1">1 x</option>
                </select>
            </div>
        </div>
        @if(session('pagamento_invalido'))
            <div class="alert alert-danger">
                <p>{{ session('pagamento_invalido')}}</p>
            </div>
        @endif

        <div class="mt-3">
            <button type="submit" class="btn btn-success" style="width: 20%">Salvar</button>
        </div>
    </form>

</main>
@endsection()
