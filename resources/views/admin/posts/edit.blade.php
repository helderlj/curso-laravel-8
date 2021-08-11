@extends('admin.layouts.app')
@section('title', 'Criar novo post')
@section('content')
<h1>Atualizar post <b>{{ $post->title }}</b></h1>
<form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.posts._partials.form')
</form>
@endsection
