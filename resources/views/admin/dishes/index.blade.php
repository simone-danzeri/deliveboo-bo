@extends('layouts.admin')

@section('content')
    <div>Ciao! Sono l'index di {{ $restaurant->restaurant_name }}</div>
    @foreach($dishes as $dish)
        <div>{{$dish->dish_name}}

        <a href="{{route('admin.dishes.edit', [ 'restaurant' => $restaurant->slug, 'dish' => $dish->dish_slug ] )}}"> ciaooo</a></div>
    @endforeach
@endsection

