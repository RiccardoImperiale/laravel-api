@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                {{-- PROJECTS --}}
                <div class="card bg-dark text-white border-secondary mb-3">
                    <div class="card-header bg-secondary text-dark">{{ __('Projects') }}</div>

                    <div class="card-body">
                        @if (count($projects) > 0)
                            @include('partials.all-projects')
                        @else
                            <p>Sorry, no products to show...</p>
                            <a href="{{ route('admin.projects.create') }}">Add Project</a>
                        @endif
                    </div>
                </div>

                {{-- TYPES --}}
                <div class="card bg-dark text-white border-secondary mb-3">
                    <div class="card-header bg-secondary text-dark">{{ __('Types') }}</div>

                    <div class="card-body">
                        @if (count($types) > 0)
                            @include('partials.all-types')
                        @else
                            <p>Sorry, no types to show...</p>
                            <a href="{{ route('admin.projects.create') }}">Add Type</a>
                        @endif
                    </div>
                </div>

                {{-- TECHNOLOGIES --}}
                <div class="card bg-dark text-white border-secondary mb-3">
                    <div class="card-header bg-secondary text-dark">{{ __('Technologies') }}</div>

                    <div class="card-body">
                        @if (count($technologies) > 0)
                            @include('partials.all-technologies')
                        @else
                            <p>Sorry, no technologies to show...</p>
                            <a href="{{ route('admin.projects.create') }}">Add Technologies</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
