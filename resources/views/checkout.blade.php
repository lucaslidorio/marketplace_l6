@extends('layouts.front')
@section('stytesheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')

<div class="container">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h2>Dados para Pagamento</h2>
                <hr>
            </div>
        </div>
        <form action="">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Número no Cartão></label>
                    <input type="text" class="form-control" name="card_name" id="">
                    
                </div>

            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Número do Cartão <div class="span brand"></div></label>
                    <input type="text" class="form-control" name="card_number" id="">
                    <input type="hidden" name="card_brand">
                </div>

            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="">Mês de Expiração</label>
                    <input type="text" class="form-control" name="card_month" id="">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Ano de Expiração</label>
                    <input type="text" class="form-control" name="card_year" id="">
                </div>
            </div>
            <div class="row">

                <div class="col-md-5 form-group">
                    <label for="">Código de Segurança</label>
                    <input type="text" class="form-control" name="card_cvv" id="">
                </div>

                <div class="col-md-12 installments form-group"></div>
            </div>
            <button class="btn btn-success btn-lg processCheckout">Efetuar Pagamento</button>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="<script
src="https://code.jquery.com/jquery-2.2.4.min.js"
integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
crossorigin="anonymous"></script>

The integrity and crossorigin attributes a"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    
    const sessionId = '{{session()->get('pagseguro_session_code')}}';

        pagSeguroDirectPayment.setSessionId(sessionId);

</script>

<script>
    let amountTransaction = '{{$cartItems}}';
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

        function processPayment(token){

            let data={
                card_token : token,
                hash: pagSeguroDirectPayment.getSenderHash(),
                installment : document.querySelector('select.select_installments').value,
                card_name: document.querySelector('input[name=card_name]').value,
                _token: '{{csrf_token()}}'

            };

            $.ajax({
                type: 'POST',   
                url:'{{route("checkou.process")}}',
                data: data,
                dataType:  'json',
                sucess: function(res){
                    toastr.success(res.data.message, 'Sucesso');
                    window.location.href='{{route('checkout.thanks')}}?order='+res.data.order;
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
</script>
@endsection