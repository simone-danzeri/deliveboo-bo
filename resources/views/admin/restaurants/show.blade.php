@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ $restaurant->restaurant_name }}</h1>

        {{-- Success Message Section --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{-- End of Success Message Section --}}

        <div class="card mb-4">
            <div class="card-header">
                <h2>Restaurant Details</h2>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="fw-bold">Restaurant Name:</h5>
                    <p>{{ $restaurant->restaurant_name }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="fw-bold">Slug:</h5>
                    <p>{{ $restaurant->slug }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="fw-bold">Type:</h5>
                    @if (count($restaurant->types) > 0)
                        @foreach ($restaurant->types as $type)
                            {{$type->type_name}}
                        @endforeach
                        
                    @else
                        No types assigned    
                    @endif
                </div>
                {{-- Uncomment if image is available --}}
                {{-- 
                <div class="mb-3">
                    @if($restaurant->img)
                        <h5 class="fw-bold">Image</h5>
                        <img src="{{ asset('storage/' . $restaurant->img) }}" alt="{{ $restaurant->restaurant_name }}" class="img-fluid">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
                --}}
                {{-- Uncomment if type is available --}}
                {{-- 
                <div class="mb-3">
                    <h5 class="fw-bold">Type</h5>
                    <p>{{ $restaurant->type->type_name ?? 'Not specified' }}</p>
                </div>
                --}}
                <div class="mb-3">
                    <h5 class="fw-bold">Address:</h5>
                    <p>{{ $restaurant->address }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="fw-bold">Phone:</h5>
                    <p>{{ $restaurant->phone }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="fw-bold">Email:</h5>
                    <p>{{ $restaurant->email }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="fw-bold">VAT Number:</h5>
                    <p>{{ $restaurant->vat_number }}</p>
                </div>

                {{-- Buttons Section --}}
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->slug]) }}" method="POST" onsubmit="return confirm('ARE YOU SURE YOU WANT TO DELETE THIS RESTAURANT?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection
