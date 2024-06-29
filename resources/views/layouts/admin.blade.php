<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DeliveBoo</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==' crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->

    @vite(['resources/js/app.js'])

</head>

<body>
    <div id="app">

        <header class="navbar navbar-dark sticky-top flex-md-nowrap p-2 shadow ms-bg-primary justify-content-space-between">
            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-white" href="/">
                <div class="logo-deliveboo">
                    <img src="{{ asset('delivebooLogo.svg') }}" alt="" class="w-100">
                </div>
            </a>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap ms-2">
                    <a class="nav-link px-3 text-white" href="{{ route('logout') }}" onclick="event.preventDefault();

                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        <div class="container-fluid vh-100">
            <div class="row h-100">

                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block ms-bg-primary sidebar collapse">
                    <div class="position-sticky pt-3">
                        @if (!Route::is('admin.dashboard'))
                        <a href="{{ route('admin.dashboard')}}" class="d-block btn ml-2 border border-light my-3 text-white">
                            Back to Dashboard
                        </a>
                        @endif
                        <a href="{{route('admin.restaurants.create')}}" class="d-block btn ml-2 border border-light my-3 text-white">
                            Add new Restaurant
                        </a>
                        <a href="{{route('admin.restaurants.bin')}}" class="d-block btn ml-2 border border-light my-3 text-white">
                            <i class="fa-solid fa-trash"></i> Bin
                        </a>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($user->restaurants as $rest)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $rest->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $rest->id }}">
                                            {{ $rest->restaurant_name }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{ $rest->id }}" class="accordion-collapse collapse bg-dark" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul class="nav flex-column">
                                                <li class="text-white">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <a href="{{route('admin.restaurants.show' , ['restaurant' => $rest->slug])}}" class="ms-link">

                                                                Show details
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('admin.restaurants.edit', ['restaurant' => $rest->slug])}}" class="ms-link">

                                                                Edit this restaurant
                                                            </a>
                                                        </li>
                                                        <li>

                                                            <a href="{{route('admin.dishes.index', ['restaurant' => $rest->slug])}}" class="ms-link">Show Menu</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>


</html>



