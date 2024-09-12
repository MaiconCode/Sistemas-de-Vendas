<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Vendas;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index() {

        $vendas = Vendas::all();

        return view('dashboard', ['vendas' => $vendas]);
    }

    // Ação para criar uma venda
    public function create() {
        
        // Verificar se o usuário está autenticado
        if(!isset(Auth::user()->id) || Auth::user()->id == "") {

            $msg = "É necessário fazer o cadastro ou login para registrar um produto";
            return redirect('/')->with('erro_auteticacao', $msg);
            return false;
        }

        return view('create');
    }

    // Açaõ para Salvar o banco de dados
    public function store(Request $request) {

        
        $request = $this->calcularParcelas($request);
        $vendas = Vendas::create($request->all());
        return redirect()->route('vendas-index');

    }

    // Ação para Calcular as Parcelas
    public function calcularParcelas($request) {

        // Configurar o fuso horário
        date_default_timezone_set('America/Sao_Paulo');
        $data_vencimento = new \DateTime();

        //Verificar se os campos fora preechidos
        if($request->nome_produto == '' || $request->valor == '' || $request->subtotal == '' || $request->qtda_parcelas == '' || $request->qtda_produto == '') {

            $msg = "Existem campos que não foram preechidos";
            return redirect('/create')->with('pagamento_invalido', $msg);
        }

        // Verificar se usuário adicionou forma de pagamento
        if($request->forma_pagamento == '0' || $request->forma_pagamento == null) {

            $msg = "Por favor, escolhe o seu método de pagamento.";
            return redirect('/create')->with('pagamento_invalido', $msg);
        }

        $request->merge([
            'cliente' => Auth::user()->name,
            'id_cliente' => Auth::user()->id
        ]);

        if($request->forma_pagamento == "Cartao de Credito") {

            // Calcular valor de cada parcela
            $valor_pacelas = $request->subtotal / $request->qtda_parcelas; 

            // Laço de repetição para imprimir o valor de parcelas
            $qtda_parcelas = intval($request->qtda_parcelas);

            $controle = 1;
            $soma_valor_parc = 0;

            while($controle <= $request->qtda_parcelas) {

                // Soma um mês a data
                $data_vencimento->add(new \DateInterval("P1M"));
                
                // Corrigir o valor na comprar 
                if($controle == $request->qtda_parcelas) {

                    // Corrigir as diferenças
                    $parcelas = $request->subtotal - $soma_valor_parc;
                    

                    // Somar valores das parcelas
                    $soma_valor_parc += $parcelas;

                } else {

                    // Somar valores das parcelas
                    $soma_valor_parc += $valor_pacelas; 

                }
                $controle++;
            }

            $parcelas = number_format($parcelas,0,",",".");

            $id_cliente = Auth::user()->id;
            $request->merge([
                'valor_parcelas' => $parcelas,
                'data_vencimento' => $data_vencimento->format('Y/m/d'),
            ]);

        } else {

            $request->merge([
                'valor_parcelas' => 0,
                'data_vencimento' => $data_vencimento->format('Y/m/d')
            ]);
        }
        return $request;

    }

    // Açaõ para deletar
    public function destroy($id) {
        Vendas::where('id', $id)->delete();
        return redirect()->route('vendas-index');

    }

    // Ação para editar
    public function edit($id) {

        $venda = Vendas::where('id', $id)->first();

        if(!empty($venda) && $venda->id_cliente == Auth::user()->id) {
            // dd($venda);

            $forma_pagamentos = ['Cartao de Credito', 'Cartao de Debito', 'Pix'];
            return view('edit', ['venda' => $venda, 'forma_pagamentos' => $forma_pagamentos]);
        } else {
            return redirect()->route('vendas-index');
        }
    }

    // Ação para Update
    public function update(Request $request, $id) {
        
        $request = $this->calcularParcelas($request);
        // dd($request);
        $data = [
            'nome_produto' => $request->nome_produto,
            'valor' => $request->valor,
            'qtda_produto' => $request->qtda_produto,
            'subtotal' => $request->subtotal,
            'forma_pagamento' => $request->forma_pagamento,
            'cliente' => $request->cliente,
            'qtda_parcelas' => $request->qtda_parcelas,
            'valor_parcelas' => $request->valor_parcelas,
            'data_vencimento' => $request->data_vencimento,
            'id_cliente' => $request->id_cliente
        ];
        Vendas::where('id', $id)->update($data);
        return redirect()->route('vendas-index');
    }
}
