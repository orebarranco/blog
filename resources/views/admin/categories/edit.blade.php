@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Categoría</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method' => 'PUT']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Ingrese el nombre de la categoría',
                ]) !!}

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, [
                    'class' => 'form-control disabled',
                    'placeholder' => 'Ingrese el nombre del slug',
                    'readonly',
                ]) !!}

                @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>


            {!! Form::submit('Actualizar categoría', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
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
