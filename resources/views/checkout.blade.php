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


The integrity and crossorigin attributes a"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    
    const sessionId = '{{session()->get('pagseguro_session_code')}}';
    const urlThanks = {{route('checkout.thanks')}};
    cont urlProcess = ''{{route("checkou.process")}}''
    const amountTransaction = '{{$cartItems}}';
    const csrf = '{{csrf_token()}}';

        pagSeguroDirectPayment.setSessionId(sessionId);


</script>

<script src="{{asset('js/pagseguro_functions.js')}}"> </script>
<script src="{{asset('js/pagseguro_events.js')}}"> </script>
@endsection