@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-dark text-white">
        <div class="container">
            <h2 class="text-center">Edit Project</h2>
        </div>
    </header>

    <div class="container py-5">
        @include('partials.validation-messages')

        <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- TITLE --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    id="title" aria-describedby="titleHelper" placeholder="Title"
                    value="{{ old('title', $project->title) }}" />
                @error('title')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- TYPES --}}
            <div class="mb-3">
                <label for="type_id" class="form-label">Types</label>
                <select class="form-select form-select-lg" name="type_id" id="type_id">
                    <option selected disabled>Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TECHNOLOGIES --}}
            <div class="mb-3">
                <label for="technologies" class="form-label">Technologies</label>
                <select multiple class="form-select form-select-lg" name="technologies[]" id="technologies">
                    @foreach ($technologies as $tech)
                        @if ($errors->any())
                            <option value="{{ $tech->id }}"
                                {{ in_array($tech->id, old('technologies', [])) ? 'selected' : '' }}>
                                {{ $tech->name }}
                            </option>
                        @else
                            <option value="{{ $tech->id }}"
                                {{ $project->technologies->contains($tech->id) ? 'selected' : '' }}>
                                {{ $tech->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('technologies')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- COVER IMAGE --}}
            <div class="mb-3">
                <label for="image" class="form-label">Cover Image:</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image" aria-describedby="imageHelper" placeholder="Image"
                    value="{{ old('image', $project->image) }}" />
                @error('image')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="5">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- LIVE LINK --}}
            <div class="mb-3">
                <label for="live_link" class="form-label">Live Link:</label>
                <input type="text" class="form-control @error('live_link') is-invalid @enderror" name="live_link"
                    id="live_link" value="{{ old('live_link', $project->live_link) }}" />
                @error('live_link')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- CODE LINK --}}
            <div class="mb-3">
                <label for="code_link" class="form-label">Code Link:</label>
                <input type="text" class="form-control @error('code_link') is-invalid @enderror" name="code_link"
                    id="code_link" value="{{ old('code_link', $project->code_link) }}" />
                @error('code_link')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger">
                Confirm Edit
            </button>

        </form>
    </div>
@endsection
