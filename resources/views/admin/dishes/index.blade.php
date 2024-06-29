@extends('layouts.admin')

@section('content')
    <h1>{{$restaurant->restaurant_name}}'s Menu</h1>

    <div class="overflow-auto">
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Dish</th>
            <th scope="col">Slug</th>
            <th scope="col">Category</th>
            <th scope="col">Img</th>
            <th scope="col">Visibility</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">For Vegetarians</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dishes as $dish)
          <tr>
            <td>{{ $dish->id}}</td>
            <td>{{$dish->dish_name}}</td>
            <td>{{$dish->dish_slug}}</td>
            @if($dish->category)
                <td>{{$dish->category->name}}</td>
            @else
                <td>Altro</td>
            @endif
            @if ($dish->img)
                <td>YES</td>
            @else
                <td>NO</td>
            @endif
            @if ($dish->is_visible)
                <td>YES</td>
            @else
                <td>NO</td>
            @endif
            <td>{{$dish->price}}€</td>
            <td>{{$dish->description}}</td>
            @if ($dish->is_vegetarian)
                <td>YES</td>
            @else
                <td>NO</td>
            @endif
            <td>
                <div class="mb-1">
                    {{-- <a class="btn btn-primary" href="{{ admin.restaurants.show, ['restaurant' => $restaurant->slug] }}">View</a>  --}}
                </div>

                <div class="mb-1">
                    <a class="btn btn-warning" href="{{route('admin.dishes.edit', [ 'restaurant' => $restaurant->slug, 'dish' => $dish->dish_slug ] )}}">Edit</a>
                </div>

                <div class="mb-1">
                    {{-- <form action="{{ admin.restaurants.destroy, ['restaurant' => $restaurant->slug] }}" method="POST">  --}}
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
@endsection

