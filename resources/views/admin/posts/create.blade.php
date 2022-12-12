@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear nuevo post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off', 'files' => true]) !!}

            @include('admin.posts.partials.form')

            {!! Form::submit('Crear post', ['class' => 'btn btn-primary']) !!}

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
    <script src="{{ asset('vendor/ckeditor5-build-classic-35.3.2/ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/ckeditor5-build-classic-35.3.2/ckeditor5-build-classic/translations/es.js') }}"></script>
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
    <script>
        // Incluir CKEditor en los textArea
        ClassicEditor
            .create(document.querySelector('#extract'), {
                language: 'es'
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#body'), {
                language: 'es'
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
