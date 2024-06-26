@extends('layouts.admin')

@section('content')
    <h1>All the restaurants</h1>

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Restaurant name</th>
            <th scope="col">Slug</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Vat Number</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($restaurants as $restaurant)
          <tr>
            <td>{{ $restaurant->id}}</td>
            <td>{{$restaurant->restaurant_name}}</td>
            <td>{{$restaurant->slug}}</td>
            <td>{{$restaurant->phone}}</td>
            <td>{{$restaurant->email}}</td>
            <td>{{$restaurant->vat_number}}</td>
            <td>{{$restaurant->created_at}}</td>
            <td>
                <div class="mb-1">
                    {{-- <a class="btn btn-primary" href="{{ admin.restaurants.show, ['restaurant' => $restaurant->slug] }}">View</a>  --}}
                </div>
                
                <div class="mb-1">
                    {{-- <a class="btn btn-warning" href="{{ admin.restaurants.edit, ['restaurant' => $restaurant->slug] }}">Edit</a>   --}}
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
@endsection