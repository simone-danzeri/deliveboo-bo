<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function saveData(Request $request) {
        $validatedData = $request->validate([
            'params.client_name'=> 'required|string|max:255',
            'params.client_surname'=> 'required|string|max:255',
            'params.phone'=> 'required|string|max:30',
            'params.email'=> 'required|email|max:100',
            'params.address'=> 'required|string|max:255',
            'params.total'=> 'required|numeric|max:999,99',
            'params.restaurant_id'=> 'required|numeric',
        ]);
        $newOrder = Order::create([
            'client_name'=>$request['params']['client_name'],
            'client_surname'=>$request['params']['client_surname'],
            'phone'=>$request['params']['phone'],
            'email'=>$request['params']['email'],
            'address'=>$request['params']['address'],
            'total'=>$request['params']['total'],
            'restaurant_id'=>$request['params']['restaurant_id']
        ]);
        //$newOrder->fill($validatedData);
        //$newOrder->save();
        foreach($request['params']['cart'] as $cartElement) {
            $newOrder->dishes()->attach($cartElement['dishInfo']['id'], ['quantity'=>$cartElement['quantity']]);
        }
        Mail::to($request['params']['email'])->send(new SendNewMail());
        return response()->json([
            "success" => true,
            "results" => $newOrder,
        ]);

       /*  if($validatedData){

        }else{
            return response()->json([
                "success" => false,
                "results" => 'No correct data for this order'
            ]);
        }; */

    }

}
