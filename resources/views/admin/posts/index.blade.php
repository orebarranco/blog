@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a class="float-right btn btn-secondary btn-sm" href="{{ route('admin.posts.create') }}">Nuevo post</a>

    <h1>Listado de Posts</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    @livewire('admin.posts-index')
@stop
