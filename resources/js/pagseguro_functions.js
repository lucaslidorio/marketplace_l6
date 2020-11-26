function processPayment(token){

    let data={
        card_token : token,
        hash: pagSeguroDirectPayment.getSenderHash(),
        installment : document.querySelector('select.select_installments').value,
        card_name: document.querySelector('input[name=card_name]').value,
        _token: csrf

    };

    $.ajax({
        type: 'POST',   
        url:urlProcess,
        data: data,
        dataType:  'json',
        sucess: function(res){
            toastr.success(res.data.message, 'Sucesso');
            window.location.href=urlThanks? `${urlThanks}?order=${res.data.order}`;
        }
    });
}

function getInstallments(amount, brand){
    pagSeguroDirectPayment.getInstallments({
        amount: amount,
        brand: brand,
        maxInstallmentNoInterest:0,

        sucess: function(res){
            let drawSelectInstallments = drawSelectInstallments(res.installments[brand]);
            document.querySelector('div.installments').innerHTML = drawSelectInstallments;
            


        },
        sucess: function(res){
            console.log(err);

        },
        sucess: function(res){

        },  

    })
}

function drawSelectInstallments(installments) {
let select = '<label>Opções de Parcelamento:</label>';

select += '<select class="form-control select_installments">';

for(let l of installments) {
    select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
}


select += '</select>';

return select;
}