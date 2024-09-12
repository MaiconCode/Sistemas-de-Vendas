@extends('layouts.main')
@section('content')

<main class="container">
<div class="row mt-5">
    @if(session('erro_auteticacao'))
        <div class="alert alert-danger">
            <p>{{ session('erro_auteticacao')}}</p>
        </div>
    @endif
    <div class="col-md-2">
            
            <a href="{{ route('create') }}" onclick="registrarVenda()" class="btn btn-success">Registrar uma Venda</a>
        </div>
        <div class="col-md-10">
            <h2 class="text-center">Lista de Vendas</h2>
        </div>
        
    </div>

    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">Cliente</th>
                <th scope="col">Produto</th>
                <th scope="col">Valor</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Forma de Pagamento</th>
                <th scope="col">Data de vencimento</th>
                <th scope="col">Quantidade da parcelas</th>
                <th scope="col">Parcelas</th>
                <th scope="col">Ações</th>

            </tr>
        </thead>
        <tbody>
        
        @foreach($vendas as $venda)
            <tr>
                <td class="text-center">{{ $venda->cliente }}</td>
                <td class="text-center">{{ $venda->nome_produto }}</td>
                <td class="text-center">{{ $venda->valor }}</td>
                <td class="text-center">{{ $venda->qtda_produto }}</td>
                <td class="text-center">{{ $venda->subtotal }}</td>
                <td class="text-center">{{ $venda->forma_pagamento }}</td>
                <td class="text-center">{{ $venda->data_vencimento }}</td>
                <td class="text-center">{{ $venda->qtda_parcelas }}</td>
                <td class="text-center">{{ $venda->valor_parcelas }}</td>
                <td style="font-size: 18px;" class="d-flex">

                @if(isset(Auth::user()->id) && Auth::user()->id == $venda->id_cliente)
                    <form action="{{ route('edit', ['id' => $venda->id] ) }}" method="GET">
                        <button class="btn btn-primary ms-2" type="submit"><i class="fa-solid fa-pencil" style="color: #fffff; cursor: pointer;"></i></button>
                    </form>
                    <form action="{{ route('destroy', ['id' => $venda->id ]) }}" method="post">

                        @csrf
                        @method('delete')
                        <button class="btn btn-danger ms-2" type="submit"><i class="fa-solid fa-trash" style="color: #ffffff; cursor: pointer;"></i></button>
                    </form>
                    
                    <!-- <i onclick= class="fa-solid fa-pencil" style="color: #74C0FC; cursor: pointer;"></i>
                    <i class="fa-solid fa-trash ms-3" style="color: #ff5252; cursor: pointer;"></i> -->
                @endif
                </td class="text-center">

            </tr>
        @endforeach
        </tbody>
    </table>
</main>
@endsection()
