<?php
namespace App\Assist;
use App\Jobs\BayProduct;
use App\Models\operation;
use App\Models\product;

class shop
{
    public function dataUser(){
        if(auth()->check()) {
            $dataUser = auth()->user()->with('balance')->with('operation')->get();
            return $dataUser;
        }
        else{
            return abort(403);
        }
    }
    public function dataBay($bay){
            $user = auth()->user();

            $data = new operation();
            $data->user_id = $user->id;
            $data->product_id = $bay->product_id;
            $data->price = product::find($bay->product_id)->price;
            $data->save();
            BayProduct::dispatch($data->price, $bay->product_id, $data->user_id, $data->id);

            $dataUser = $user->with('balance')->get();
            return $dataUser;

    }
}