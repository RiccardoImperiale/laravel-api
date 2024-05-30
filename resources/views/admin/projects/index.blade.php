@extends('layouts.admin')

@section('content')
    <header class="heading py-3 text-white">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="fw-lighter text-primary">Projects</h2>
            <a class="btn btn-primary h-100" href="{{ route('admin.projects.create') }}">
                Add New Project
            </a>
        </div>
    </header>

    @if (count($projects) > 0)
        @include('partials.all-projects')
    @else
        <div class="container pt-5">
            <h4>Sorry, no products to show...</h4>
        </div>
    @endif
@endsection
