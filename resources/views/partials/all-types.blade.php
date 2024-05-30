<div class="container">
    @include('partials.session-messages')
    <div class="mt-4">
        <table class="table table-dark align-middle table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">slug</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->slug }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $types->links('pagination::bootstrap-5') }}
    </div>
</div>
