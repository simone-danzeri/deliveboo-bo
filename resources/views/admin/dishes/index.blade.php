@extends('layouts.admin')

@section('content')

    <h1>{{$restaurant->restaurant_name}}'s Menu</h1>
    {{-- Success Message Section --}}
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    {{-- Success Message Section --}}


    <div class="overflow-auto">
        <div class="d-flex mb-3 justify-content-end">
            <a class="btn ms-bg-primary" href="{{route('admin.dishes.create', [ 'restaurant' => $restaurant->slug] )}}">Create a new dish</a>
        </div>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Dish</th>
            <th scope="col">Category</th>
            <th scope="col">Img</th>
            <th scope="col">Visibility</th>
            <th scope="col">Price</th>
            <th scope="col">For Vegetarians</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dishes as $dish)
          <tr>
            <td>{{ $dish->id}}</td>
            <td>{{$dish->dish_name}}</td>
            @if($dish->category)
                <td>{{$dish->category->name}}</td>
            @else
                <td>Altro</td>
            @endif
            @if ($dish->dish_photo)
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
            @if ($dish->is_vegetarian)
                <td>YES</td>
            @else
                <td>NO</td>
            @endif
            <td>
                <div class="mb-1">
                    <a class="btn btn-success" href="{{route('admin.dishes.show', [ 'restaurant' => $restaurant->slug, 'dish' => $dish->dish_slug ] )}}">View</a>
                </div>
                <div class="mb-1">
                    <a class="btn btn-warning" href="{{route('admin.dishes.edit', [ 'restaurant' => $restaurant->slug, 'dish' => $dish->dish_slug ] )}}">Edit</a>
                </div>
                <div class="mb-1">
                    <form action="{{ route('admin.dishes.destroy', ['restaurant' => $restaurant->slug, 'dish' => $dish->dish_slug ] ) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger js-delete-btn" data-dish-title="{{ $dish->dish_name }}" type="submit">Delete</button>
                    </form>
                </div>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
        @if (count($dishes) > 5)
            <div class="mb-1">
                <a class="btn ms-bg-primary" href="{{route('admin.dishes.create', [ 'restaurant' => $restaurant->slug] )}}">Create a new dish</a>
            </div>
        @endif

    </div>


        <!-- Modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm elimination</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-confirm-deletion" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
{{-- CDN Bootstrap Js - I NEED THIS FOR THE DELETE MODAL --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
{{-- /CDN Bootstrap Js - I NEED THIS FOR THE DELETE MODAL --}}
        <script>
            // Modal for confirm elimination of a single dish
            const allDeleteButtons = document.querySelectorAll('.js-delete-btn');
            allDeleteButtons.forEach((deleteButton) => {
                deleteButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    console.log("you clicked me!");
                    const deleteModal = document.getElementById('confirmDeleteModal');
                    // Populate modal text with "Are you sure you want to eliminate: [x]?"
                    const dishTitle = this.dataset.dishTitle;
                    deleteModal.querySelector('.modal-body').innerHTML = `Are you sure you want to eliminate: ${dishTitle}?`;
                    // Show the modal
                    const bsDeleteModal = new bootstrap.Modal(deleteModal);
                    bsDeleteModal.show();
                    // On click of Delete btn in modal, actually delete the element
                    const modalConfirmDeletionBtn = document.getElementById('modal-confirm-deletion');
                    modalConfirmDeletionBtn.addEventListener('click', function() {
                        // Send the delete
                        deleteButton.parentElement.submit();
                    });
                });
            });
        </script>
@endsection

