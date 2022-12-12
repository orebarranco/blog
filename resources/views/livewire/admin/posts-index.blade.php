<div class="card">
    <div class="card-header">
        {!! Form::text('search', null, [
            'wire:model' => 'search',
            'class' => 'form-control',
            'placeholder' => 'Ingrese el nombre de un post',
        ]) !!}
    </div>

    @if ($posts->count())

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th class="col-span-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->name }}</td>
                            <td with=10px>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.posts.edit', $post) }}">Editar</a>
                            </td>
                            <td with=10px>
                                {!! Form::open(['route' => ['admin.posts.destroy', $post], 'method' => 'DELETE']) !!}
                                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $posts->links() }}
        </div>
    @else
        <div class="alert alert-info ml-4 mr-4 mt-4">
            Lo sentimos, no se ha encontrado ningún post.
        </div>
    @endif
</div>
