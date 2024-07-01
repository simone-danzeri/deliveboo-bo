@extends('admin.dashboard')

@section('content')
    <div class="container mt-5 ">
        <div class="card shadow-sm">
            <div class="card-header text-white text-center ms-bg-primary">
                <h1>{{ $dish->dish_name }}</h1>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Type:
                    </div>
                    <div class="col-md-9">
                        @if ($dish->category)
                            <p>{{ $dish->category->name }}</p>
                        @else
                            <span>Altro</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Image
                    </div>
                    <div class="col-md-9">
                        @if ($dish->dish_photo)
                            <img src="{{ asset('storage/' . $dish->dish_photo) }}" alt="{{ $dish->dish_name }}" class="img-fluid rounded shadow-sm" style="width: 100%; max-width: 400px; height: auto; object-fit: cover;">
                        @else
                            <p>No image available</p>
                        @endif
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Visible
                    </div>
                    <div class="col-md-9">
                        <p>{{ $dish->is_visible ? 'Yes' : 'No' }}</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Vegetarian
                    </div>
                    <div class="col-md-9">
                        <p>{{ $dish->is_vegetarian ? 'Yes' : 'No' }}</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Price
                    </div>
                    <div class="col-md-9">
                        <p>${{ $dish->price }}</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Description
                    </div>
                    <div class="col-md-9">
                        <p>{{ $dish->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
