@extends('admin.dashboard')
@section('content')
    <h1>{{$dish->dish_name}}</h1>
    <form>
        <div class="mb-3">
          <label for="dish_name" class="form-label">Change name of this dish</label>
          <input type="text" class="form-control" id="dish_name" name="dish_name" value="{{old('dish_name', $dish->dish_name)}}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Choose a type</label>
            <select class="form-select" aria-label="Default select example" id="name" name="name">
                <option value="">Open this select menu</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="dish_photo" class="form-label">Upload a new image for this dish</label>
            <input class="form-control" type="file" id="dish_photo" name="dish_photo">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_visible">
            <label class="form-check-label" for="is_visible" name="is_visible" {{-- @checked($dish->is_visible) --}}>Is this dish visible?</label>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_vegetarian">
            <label class="form-check-label" for="is_vegetarian" name="is_vegetarian" {{-- @checked($dish->is_vegetarian) --}}>Is this dish vegetarian?</label>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Change the price of this dish</label>
            <input type="text" class="form-control" id="price" name="price" value="{{old('price', $dish->price)}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Change description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $dish->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
