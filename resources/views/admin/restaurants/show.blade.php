@extends('layouts.admin')

@section('content')
    <h1>{{ $restaurant->restaurant_name }}</h1>

    {{-- Success Message Section --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- Success Message Section --}}

    <div class="card">
        <div class="card-header">
            <h2>Restaurante Detagli</h2>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p class="form-control">{{ $restaurant->restaurant_name }}</p>
            </div>
            <div class="mb-3">
                @if($restaurant->img)
                    <img src="{{ asset('storage/' . $restaurant->img) }}" alt="{{ $restaurant->restaurant_name }}" class="img-fluid">
                @else
                    <p>No image disponibile</p>
                @endif
            </div>
            <div class="mb-3">
                <p class="form-control">{{ $restaurant->type->type_name ?? 'Not specified' }}</p>
            </div>
            <div class="mb-3">
                <p class="form-control">{{ $restaurant->address }}</p>
            </div>
            <div class="mb-3">
                <p class="form-control">{{ $restaurant->phone }}</p>
            </div>
            <div class="mb-3">
                <p class="form-control">{{ $restaurant->email }}</p>
            </div>
        </div>

    </div>
@endsection
