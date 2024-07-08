<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function saveData(Request $request) {
        /* $validatedData = $request->validate([
            'client_name'=> 'required|string|max:255',
            'client_surname'=> 'required|string|max:255',
            'phone'=> 'required|string|max:30',
            'email'=> 'required|email|max:100',
            'address'=> 'required|string|max:255',
            'total'=> 'required|numeric|max:999,99',
        ]); */
        $newOrder = Order::create([
            'client_name'=>$request['params']['client_name'],
            'client_surname'=>$request['params']['client_surname'],
            'phone'=>$request['params']['phone'],
            'email'=>$request['params']['email'],
            'address'=>$request['params']['address'],
            'total'=>$request['params']['total'],
        ]); 
        //$newOrder->fill($validatedData);
        //$newOrder->save();
        return response()->json([
            "success" => true,
            "results" => $newOrder
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
