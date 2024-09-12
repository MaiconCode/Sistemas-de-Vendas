let select = document.getElementById('formaPagamento')

select.addEventListener('change', function() {
    if(select.value == 'Cartao de Credito') {
        let parcelas = document.getElementById('quantidade_parcelas')
        
        for (let index = 2; index <= 12; index++) {
            
            let option = document.createElement('option')
            option.value = index
            option.innerText = index + 'x'
            parcelas.appendChild(option)
            console.log(option)
        }
    }
    else if(select.value == 'Cartao de Debito' || select.value == 'Pix') {

        parcelas.innerHTML = ""
        let option = document.createElement('option')
        option.value = 1
        option.innerText = '1x'
        parcelas.appendChild(option)
    }
})

function valorVSquantidade() {
    
    let valor_produto = document.getElementById('valor_produto').value
    valor_produto = valor_produto.replace(",", ".")
    let qtda_produto = document.getElementById('qtda_produto').value
    let subtotal = document.getElementById('subtotal')
    multiplicacao = valor_produto * qtda_produto;
    subtotal.value = multiplicacao
}