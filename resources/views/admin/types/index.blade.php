@extends('layouts.admin')

@section('content')
    <header class="heading py-3 text-white">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="fw-lighter text-primary">Types</h2>
            <form action="{{ route('admin.types.store') }}" method="post">
                @csrf
                <div class="input-group ">
                    <input name="name" type="text"
                        class="form-control bg-dark border-primary text-white {{ old('form_name') === 'form1' ? 'is-invalid' : '' }}"
                        placeholder="New Type..." value="{{ old('form_name') === 'form1' ? old('name') : '' }}">
                    <button class="btn btn-primary" type="submit">Add new Type</button>
                </div>
                <input type="hidden" name="form_name" value="form1">
            </form>
        </div>
    </header>

    @if (count($types) > 0)
        <div class="container pt-4">
            @include('partials.session-messages')
            @include('partials.validation-messages')
            <div class="row">
                <table class="table align-middle table-hover table-dark ">
                    <thead>
                        <tr>
                            <th class="ps-3" scope="col">name</th>
                            <th scope="col">slug</th>
                            <th class="text-end pe-3" scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($types as $type)
                            <tr>
                                <td>
                                    <form action="{{ route('admin.types.update', $type) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input style="background-color: #1A1A1A;"
                                            class="form-control text-white m-0 {{ old('form_name') === "form_$loop->index" ? 'is-invalid border-danger' : 'border-0' }}"
                                            type="text" name="name"
                                            value="{{ old('form_name') === "form_$loop->index" ? old('name') : $type->name }}">
                                        <input type="hidden" name="form_name" value="form_{{ $loop->index }}">
                                    </form>
                                </td>
                                <td>{{ $type->slug }}</td>
                                <td>
                                    <div class="d-flex justify-content-end">

                                        <!-- Modal trigger button -->
                                        <button type="button" class="btn btn-danger pb-2" data-bs-toggle="modal"
                                            data-bs-target="#modal-{{ $type->id }}">
                                            <span style="font-size: 0.7rem" class=" text-uppercase">Delete</span>
                                        </button>

                                        <div class="modal fade" id="modal-{{ $type->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitle-{{ $type->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitle-{{ $type->id }}">
                                                            Delete type
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this type:
                                                        {{ $type->name }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <form action="{{ route('admin.types.destroy', $type) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-danger">
                                                                Confirm
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $types->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @else
        <div class="container pt-5">
            <h4>Sorry, no types to show...</h4>
        </div>
    @endif
@endsection
