@extends('admin.layouts.app')

@section('title', 'Criar novo post')

@section('content')
    <h1>Cadastrar novo post</h1>
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @method('POST')
        @include('admin.posts._partials.form')
    </form>
@endsection
