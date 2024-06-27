@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <h1 class="p-3">NUOVO RISTORANTE:</h1>
           
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
                    <label for="resaturant_name" class="form-label">Nuovo Ristorante</label>
                    <input type="text" class="form-control" id="restaurant_name" name="restaurant_name">
                </div>
            
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input class="form-control" id="address" rows="5" name="address"></input>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>

                <div class="mb-3">
                    <label for="vat_number" class="form-label">Vat Number</label>
                    <input type="text" class="form-control" id="vat_number" name="vat_number">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E mail</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
            
                <div class="mb-3">
                    <label for="img" class="form-label">Immagine</label>
                    <input class="form-control" type="file" name="img">
                </div>
            
                <button type="submit" class="btn btn-primary">SALVA</button>
            </form>
            

        
        </div>
    </section>
@endsection
