@extends('layouts.admin')

@section('content')
    <h1 class="mb-3">Orders for {{ $restaurant->restaurant_name }}</h1>
    
    <div class="overflow-auto">
        @if ($orders->isEmpty())
            <p class="fs-3">There is no order yet here!</p>
        @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Client Name</th>
                <th scope="col">Client Surname</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Total</th>
                <th scope="col">Created at</th>
                <th scope="col">Details</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
            <tr>
                <td>{{$order->client_name}}</td>
                <td>{{$order->client_surname}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->total}}€</td>
                <td>{{$order->created_at}}</td>
                <td>
                    <div>
                        <a class="btn btn-success" href="{{route('admin.orders.show', ['restaurant' => $restaurant->slug, 'order' => $order->id])}}">View</a> {{-- AGGIUNGERE ROTTA PER ORDINE --}}
                    </div>
                </td>
            </tr>
            @endforeach        
            </tbody>
        </table>
    </div>
    @endif
@endsection
