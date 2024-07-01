@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <h1 class="p-3">NEW DISH:</h1>
           
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
            <form enctype="multipart/form-data" action="{{ route('admin.dishes.store', ['restaurant'=> $restaurant->slug]) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="dish_name" class="form-label">Dish Name *</label>
                    <input type="text" class="form-control" id="dish_name" name="dish_name" required>
                </div>
                   
                <div class="mb-3">
                    <label for="dish_photo" class="form-label">Dish Photo</label>
                    <input class="form-control" type="file" id="dish_photo" name="dish_photo">
                </div>
        
                </div>
            
                <div class="mb-3">
                    <label for="price" class="form-label">Price *</label>
                    <input type="text" class="form-control" id="price" name="price" required>
                </div>
            
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="5" name="description"></textarea>
                </div>
            
                <div class="mb-3">      
                    <div class="form-check form-switch">               
                        <label class="form-check-label" for="is_visible" >Is visible?</label>
                        <input class="form-check-input" type="checkbox"  id="is_visible" name="is_visible"  value="1">
                      </div>

                      <div class="form-check form-switch">
                        <label class="form-check-label" for="is_vegetarian"" >Is vegetarian?</label>
                        <input class="form-check-input" type="checkbox" id="is_vegetarian" name="is_vegetarian" value="1" checked>
                      </div>   
                </div>

                <button type="submit" class="btn btn-primary">SAVE</button>
            </form>
        </div>
            
                
        </div>
    </section>
@endsection

