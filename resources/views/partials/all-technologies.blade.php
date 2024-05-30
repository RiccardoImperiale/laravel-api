<div class="container">
    @include('partials.session-messages')
    <div class="mt-4">
        <table style="mix-blend-mode:lighten" class="table table-dark align-middle table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">slug</th>
                    {{-- <th class="text-end pe-3" scope="col">color</th> --}}
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($technologies as $tech)
                    <tr>
                        <th scope="row">{{ $tech->id }}</th>
                        <td>{{ $tech->name }}</td>
                        <td>{{ $tech->slug }}</td>
                        {{-- <td>
                            <div class="rounded w-100 text-end"
                                style="height:25px;background-color: {{ $tech->color ?? 'gray' }}; "></div>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $technologies->links('pagination::bootstrap-5') }}
    </div>
</div>
