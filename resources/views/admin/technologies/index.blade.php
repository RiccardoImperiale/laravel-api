@extends('layouts.admin')
@section('content')

    <header class="heading py-3 text-white">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="fw-lighter text-primary">Technologies</h2>
            <form action="{{ route('admin.technologies.store') }}" method="post">
                @csrf
                <div class="input-group ">
                    <input
                        class="bg-dark border-primary text-white form-control {{ old('form_name') === 'form1' ? 'is-invalid' : '' }}"
                        type="text" name="name" placeholder="New Tech..."
                        value="{{ old('form_name') === 'form1' ? old('name') : '' }}">
                    {{-- <input style="height: 45px" class="border-primary bg-primary form-control form-control-color"
                        type="color" name="color" value="{{ $tech->color ?? '#bfbfbf' }}"> --}}
                    <button class="btn btn-primary" type="submit">Add new Tech</button>
                </div>
                <input type="hidden" name="form_name" value="form1">
                {{-- @if (old('form_name') === 'form1')
                    @error('name')
                        <div class="text-danger py-2">
                            {{ $message }}
                        </div>
                    @enderror
                @endif --}}
            </form>
        </div>
    </header>

    @if (count($technologies) > 0)
        <div class="container pt-4">
            @include('partials.session-messages')
            @include('partials.validation-messages')

            <table class="table align-middle table-hover table-dark">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3" scope="col">name & color</th>
                        <th scope="col">slug</th>
                        <th class="text-end pe-3" scope="col">actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($technologies as $tech)
                        <tr>
                            <td>
                                <form action="{{ route('admin.technologies.update', $tech) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <input style="background-color: #1A1A1A;"
                                            class="form-control w-50 text-white {{ old('form_name') === "form_$loop->index" ? 'is-invalid border-danger' : 'border-0' }}"
                                            type="text" name="name"
                                            value="{{ old('form_name') === "form_$loop->index" ? old('name') : $tech->name }}">
                                        {{-- <input style="background-color: #1A1A1A;"
                                            class="form-control form-control-color border-0" type="color" name="color"
                                            value="{{ $tech->color ?? '#ffffff' }}">
                                        <button style="background-color: #1A1A1A" class="btn text-white"
                                            type="submit">+</button> --}}
                                    </div>
                                    <input type="hidden" name="form_name" value="form_{{ $loop->index }}">
                                </form>
                            </td>
                            <td>{{ $tech->slug }}</td>
                            <td>
                                <div class="d-flex justify-content-end gap-1">
                                    <!-- Modal trigger button -->
                                    <button tech="button" class="btn btn-danger pb-2" data-bs-toggle="modal"
                                        data-bs-target="#modal-{{ $tech->id }}">
                                        <span style="font-size: 0.7rem" class="text-uppercase">Delete</span>
                                    </button>

                                    <div class="modal fade" id="modal-{{ $tech->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitle-{{ $tech->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitle-{{ $tech->id }}">
                                                        Delete tech
                                                    </h5>
                                                    <button tech="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this tech:
                                                    {{ $tech->name }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button tech="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <form action="{{ route('admin.technologies.destroy', $tech) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button tech="submit" class="btn btn-danger">
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

            {{ $technologies->links('pagination::bootstrap-5') }}
        </div>
        </div>
    @else
        <div class="container pt-5">
            <h4>Sorry, no technologies to show...</h4>
        </div>
    @endif

@endsection
