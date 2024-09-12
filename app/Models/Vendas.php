<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_produto',
        'valor',
        'qtda_produto',
        'subtotal',
        'forma_pagamento',
        'cliente',
        'qtda_parcelas',
        'valor_parcelas',
        'data_vencimento',
        'id_cliente'
    ];
}
