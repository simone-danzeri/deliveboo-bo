@extends('layouts.admin')

@section('content')
    <h1>{{ $restaurant->restaurant_name }}'s Menu</h1>
    <p>Hi this is the menu from restaurant {{ $restaurant->restaurant_name }}.</p>

    <div class="row">
        
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $dish->dish_name }}</h5>
                        <p class="card-text">
                            <strong>Category:</strong> {{ $dish->category->name ?? 'Altro' }} <br>
                            <strong>Price:</strong> {{ $dish->price }}€ <br>
                            <strong>Vegetarian:</strong> {{ $dish->is_vegetarian ? 'Yes' : 'No' }} <br>
                            <strong>Visibility:</strong> {{ $dish->is_visible ? 'Yes' : 'No' }}
                        </p>
                    </div>
                </div>
            </div>
    </div>
@endsection