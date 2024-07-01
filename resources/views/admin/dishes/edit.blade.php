@extends('admin.dashboard')
@section('content')
    <h1>{{$dish->dish_name}}</h1>
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
    <form class="my-4" method="POST" action="{{route('admin.dishes.update', ['restaurant' => $restaurant->slug, 'dish' => $dish->dish_slug])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="dish_name" class="form-label">Change name of this dish</label>
          <input type="text" class="form-control" id="dish_name" name="dish_name" value="{{old('dish_name', $dish->dish_name)}}">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Choose a type</label>
            <select class="form-select" aria-label="Default select example" id="category_id" name="category_id">
                <option value="">Altro</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($category->id == old('category_id', $dish->category_id))>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="dish_photo" class="form-label">Upload a new image for this dish</label>
            <input class="form-control" type="file" id="dish_photo" name="dish_photo">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible" value="1" {{ old('is_visible') ? 'checked' : '' }} @checked($dish->is_visible)>
            <label class="form-check-label" for="is_visible">Is this dish visible?</label>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_vegetarian" name="is_vegetarian" value="1" {{ old('is_vegetarian') ? 'checked' : '' }} @checked($dish->is_vegetarian)>
            <label class="form-check-label" for="is_vegetarian" >Is this dish vegetarian?</label>
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
