@extends('admin.layouts.app')

<h1>Detalhes do post {{ $post->id }}</h1>
<hr>
<span><b>Titulo: </b>{{ $post->title }}</span><br>
<span><b>Conteúdo: </b>{{ $post->content }}</span>
<hr>
<form action="{{ route('posts.destroy', $post->id) }}" method="post">
    @csrf
    @method('DELETE')
    <input type="hidden" value="{{ $post->id }}">
    <button type="submit">Deletar</button>
</form>
