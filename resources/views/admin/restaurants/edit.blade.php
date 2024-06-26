@extends('layouts.admin')
@section('content')
    <h1>ciao sono edit</h1>
    <form>
        <div class="mb-3">
          <label for="restaurant_name" class="form-label">Restaurant Name</label>
          <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="{{old('restaurant_name', $restaurant->restaurant_name)}}">
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Upload a new image for your restaurant</label>
            <input class="form-control" type="file" id="img" name="img">
        </div>
        <div class="mb-3">
            <label for="type_name" class="form-label">Choose a type</label>
            <select class="form-select" aria-label="Default select example" id="type_name" name="type_name">
                <option value="">Open this select menu</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">New Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $restaurant->address) }}">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">New Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $restaurant->phone) }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">New Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $restaurant->email) }}">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
