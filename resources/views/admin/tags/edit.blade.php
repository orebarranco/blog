@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar etiqueta</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($tag, ['route' => ['admin.tags.update', $tag], 'method' => 'PUT']) !!}

                @include('admin.tags.partials.form')
                {!! Form::submit('Actualizar etiqueta', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

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
@endsection
