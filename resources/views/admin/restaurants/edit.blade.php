@extends('layouts.admin')
@section('content')
    <h1>{{$restaurant->restaurant_name}}</h1>
    {{-- Sezione messaggi di errore --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- Sezione messaggi di errore --}}
    <form class="my-4" method="POST" action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->slug]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="restaurant_name" class="form-label">Restaurant Name *</label>
          <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="{{old('restaurant_name', $restaurant->restaurant_name)}}" required maxlength="255">
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Upload a new image for your restaurant</label>
            <input class="form-control" type="file" id="img" name="img" accept=".jpg, .jpeg, .png, .gif, .bmp, image/jpeg, image/png, image/gif, image/bmp">
            <input type="checkbox" class="form-check-input" id="delete-img" name="delete-img" value="1" {{ old('delete-img') ? 'checked' : '' }}>
            <label class="form-check-label" for="delete-img">Check this checkbox if you want to completely delete the image instead</label>
        </div>
        {{-- <div class="mb-3">
            <label for="type_name" class="form-label">Choose a type</label>
            <select class="form-select" aria-label="Default select example" id="type_name" name="type_name">
                <option value="">Open this select menu</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="mb-3">
            <h6>Types</h6>
            @foreach ($types as $type)
                <div class="form-check form-switch">
                    {{--  Se ci sono errori in pagina, popolare le checkbox con l'old --}}
                    @if ($errors->any())
                    {{-- Se non ci sono errori in pagina l'utente sta caricando la pagina da zero, popolo le checkbox con il contain della collection --}}
                    <input class="form-check-input" @checked(in_array($type->id, old('types', []))) name="types[]" type="checkbox"  value="{{ $type->id }}" id="technology-{{ $type->id }}">
                    @else
                    <input class="form-check-input" @checked($restaurant->types->contains($type))  name="types[]" type="checkbox" value="{{ $type->id }}" id="technology-{{ $type->id }}">    
                    @endif
                    
                    <label class="form-check-label" for="technology-{{ $type->id }}">
                    {{$type->type_name}}
                    </label>
                </div> 
            @endforeach
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">New Address *</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $restaurant->address) }}" required maxlength="255">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">New Phone Number *</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $restaurant->phone) }}" required inputmode="numeric" pattern="\d{10}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">New Email Address *</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $restaurant->email) }}">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
