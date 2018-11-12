<?php

namespace App\Site\Http\Controllers\State\Pay;

use App\Site\Entity\State;
use Illuminate\Http\Request;
use App\Common\Http\Controllers\Controller;


class PayController extends Controller
{

    public function index()
    {
        $liqpay = new \LiqPay(env('LIQPAY_PUBLIC'), env('LIQPAY_PRIVATE'));
        $html = $liqpay->cnb_form([
            'action'         => 'pay',
            'amount'         => session('state_sum'),
            'currency'       => 'UAH',
            'description'    => 'Lawyer',
            'order_id'       => session('state_id'),
            'version'        => '3',
            'sandbox' => 1,
            'result_url' => route('state.end'),
            'server_url' => route('state.paid')
        ]);

        return view('site.state.pay.index', compact('html'));
    }

    public function paid(Request $request)
    {
        /*$data = $request->data;
        $signature = $request->signature;
        $my_sign = base64_encode( sha1( env('LIQPAY_PUBLIC') . $data . env('LIQPAY_PRIVATE'), 1));

        $data_decode = base64_decode(json_decode($data));*/
        //if ($signature === $my_sign) {
            $state = State::findOrFail(14);
            $state->paid();
        //}
    }

    public function end(Request $request)
    {
        $request->session()->forget('state_id');
        $request->session()->forget('state_sum');
        return view('site.state.pay.end');
    }

}
