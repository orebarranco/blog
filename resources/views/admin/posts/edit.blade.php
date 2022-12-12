@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar post</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($post, [
                'route' => ['admin.posts.update', $post],
                'autocomplete' => 'off',
                'files' => true,
                'method' => 'PUT',
            ]) !!}

            @include('admin.posts.partials.form')

            {!! Form::submit('Actualizar post', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('vendor/jquery-slim/cdnjs/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('vendor/multilingual-slug-generator/jquery.slugit.js') }}"></script>
    <script>
        $(function() {
            $('#name').slugIt({
                output: '#slug'
            });
        });
    </script>
    <script>
        //Previsualizar imagen del blog
        function showFile(input) {

            let file = input.files[0];
            let reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = function() {
                document.getElementById("picture").setAttribute('src', reader.result);
                console.log(reader.result);
            }
        }
    </script>
@endsection
