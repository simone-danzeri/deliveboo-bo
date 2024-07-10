@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Order Details</h1>
        <table class="table table-striped">
            
            <thead class="thead-dark">
                <tr>
                    <th>ID Order</th>
                    <th>Dish Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($order->dishes)}}  --}}
                @foreach ($order->dishes as $dish)
                    <tr>
                        <td>{{$dish->pivot->order_id}}</td>
                        <td>{{$dish->dish_name}}</td>
                        <td>{{$dish->pivot->quantity}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection
