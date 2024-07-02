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
                        <p>{{ $dish->price }}€</p>
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
        <div class="mb-1 mt-3">
            <a class="btn btn-warning" href="{{route('admin.dishes.edit', [ 'restaurant' => $restaurant->slug, 'dish' => $dish->dish_slug ] )}}">Edit</a>
            <form action="{{ route('admin.dishes.destroy', ['restaurant' => $restaurant->slug, 'dish' => $dish->dish_slug ] ) }}" class="d-inline-block" method="POST">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger js-delete-btn" data-dish-title="{{ $dish->dish_name }}" type="submit">Delete</button>
            </form>
        </div>
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
