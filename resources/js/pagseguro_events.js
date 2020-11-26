let cardNumber = document.querySelector('input[card_number]');
let spanBrand = document.querySelector('span.brand');


cartNumber.addEventListener('keyup', function(){
    if(cardNumber.value.legth >= 6){
        pagSeguroDirectPayment.getBrand({
            cardBim: cardNumber.value.substr(0,6),
            sucess: function(res){
                console.log(res);
                let imgFlag =  `<img src = "https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png"/>`
                spanBrand.innerHTML.= imgFlag;
                document.querySelector('input[name=card_brand]').value= res.brand.name;

                getInstallments(amountTransaction, res.brand.name)
            },
            error: function(err){
                console.log(err);
            },
            complete: function(res){
                console.log('Complete: ' +res);
            }
        });
    }
});

let subnutButton =document.querySelector('button.processCheckout');

subnutButton.addEventListener('click', function(event){

    event.preventDefault();

    pagSeguroDirectPayment.createCardToken({
        carNumber: document.querySelector('input[name:card_number]').value,
        brand: document.querySelector('input[name:card_brand]').value, 
        cvv: document.querySelector('input[name:card_cvv]').value,
        expirationMonth: document.querySelector('input[name:card_month]').value,
        expirationYear:document.querySelector('input[name:card_year]').value ,

        sucess: function(res){
            
            processPayment(res.card.token);
        }
    })
})