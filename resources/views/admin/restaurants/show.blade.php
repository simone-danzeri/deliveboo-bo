@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header text-white text-center ms-bg-primary">
                <h1>{{ $restaurant->restaurant_name }}</h1>
            </div>
            <div class="card-body">
                {{-- Success Message Section --}}
                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                {{-- End of Success Message Section --}}
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Restaurant Name:
                    </div>
                    <div class="col-md-9">
                        <p>{{ $restaurant->restaurant_name }}</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Slug:
                    </div>
                    <div class="col-md-9">
                        <p>{{ $restaurant->slug }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Image:
                    </div>
                    <div class="col-md-9">
                        @if ($restaurant->img)
                            <img src="{{ asset('storage/' . $restaurant->img) }}" alt="{{ $restaurant->restaurant_name }}" class="img-fluid rounded shadow-sm" style="width: 100%; max-width: 400px; height: auto; object-fit: cover;">
                        @else
                            <p>No image available</p>
                        @endif
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Type:
                    </div>
                    <div class="col-md-9">
                        @if (count($restaurant->types) > 0)
                        @foreach ($restaurant->types as $type)
                            {{$type->type_name}}
                        @endforeach

                        @else
                            <span>No types assigned</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Address:
                    </div>
                    <div class="col-md-9">
                        <p>{{ $restaurant->address }}</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Phone:
                    </div>
                    <div class="col-md-9">
                        <p>{{ $restaurant->phone }}</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        Email:
                    </div>
                    <div class="col-md-9">
                        <p>{{ $restaurant->email }}</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 fw-bold">
                        VAT Number:
                    </div>
                    <div class="col-md-9">
                        <p>{{ $restaurant->vat_number }}</p>
                    </div>
                </div>



                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}" class="btn btn-primary me-2">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
