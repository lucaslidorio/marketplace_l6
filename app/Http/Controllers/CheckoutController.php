<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use Illuminate\Http\Request;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class CheckoutController extends Controller
{
    public function index()
    {
       
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if(!session()->has('cart')) return redirect()->route('home');

        $this->makePagSeguroSession();

       

        $cartItems = array_map(function($line){
            return $line['amount']* $line['prince'];

        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);
       

        // session()->forget('pagseguro_session_code');

        return view('checkout', compact('cartItems'));
    }

    public function proccess(Request $request)
    {
        try{
            
        $dataPost = $request->all();
        $user=auth()->user();
        $cartItems = session()->get('cart');
       
        $reference = 'XPTO';
        $creditCarPayment = new CreditCard($cartItems, $user, $dataPost, $reference);

        $result = $creditCarPayment->doPayment();

        $userOrder = [
            'reference' =>$reference,
            'pagseguro_code' => $result->getCode(),
            'paseguro_status' => $result->getStatus(),    
            'items' =>serialize($cartItems),
            'store_id' => 42,
        ];

        $user->orders()->create($userOrder);

        session()->forget('cart');
        session()->forget('pagseguro_session_code');

        return response()->json([
            'data'=>[
                'status'=> true,
                'message'=> 'Pedido Criado com sucesso',
                'order' =>$reference
            ]
        ]);

        }catch (\Exception $e){
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar o pedido'; 
            return response()->json([
                'data'=>[
                    'status'=> false,
                    'message'=> $message
                ]
                ], 401);
    
        }
    }

public function thanks()
{
    return view ('thanks');
}

    private function makePagSeguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {

            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            return session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
