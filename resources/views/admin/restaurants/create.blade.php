@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <h1 class="p-3">NEW RESTAURANT:</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form enctype="multipart/form-data" action="{{ route('admin.restaurants.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="resaturant_name" class="form-label">New Restaurant *</label>
                    <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" required maxlength="255">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address *</label>
                    <input class="form-control" id="address" rows="5" name="address" required maxlength="255"></input>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Phone *</label>
                    <input type="text" class="form-control" id="phone" name="phone" required inputmode="numeric" pattern="\d{10}">
                </div>

                <div class="mb-3">
                    <label for="vat_number" class="form-label">VAT Number *</label>
                    <input type="text" class="form-control" id="vat_number" name="vat_number" required inputmode="numeric" pattern="\d{11}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="img" class="form-label">Image</label>
                    <input class="form-control" type="file" name="img" accept=".jpg, .jpeg, .png, .gif, .bmp, image/jpeg, image/png, image/gif, image/bmp">
                </div>

                <button type="submit" class="btn btn-primary">SAVE</button>
            </form>



        </div>
    </section>
@endsection
