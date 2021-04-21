<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BayRequest;
use App\jobs\BayProduct;
use Illuminate\Http\Request;
use App\Assist\Shop;


class shopController extends Controller
{
   public function info(){
       $data = new Shop();
       $dataUser = $data->dataUser();
       return response()->json($dataUser);
   }

    public function bay(BayRequest $request ){
        $data = new Shop();
        $dataBay = $data->dataBay($request);
        return response()->json($dataBay);
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->somethingElseIsInvalid()) {
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
        });
    }
}
