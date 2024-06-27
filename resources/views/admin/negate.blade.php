@extends('layouts.admin')

@section('content')
    <div class="text-center">
        <h1 class="display-5 fw-bold text-center mt-5 mb-3">
            You don't have the permission to access this page, please click on this button
        </h1>
        <a href="{{ route('admin.dashboard')}}" class="btn ms-bg-primary mx-auto">
            Back to Dashboard
        </a>
    </div>
@endsection
