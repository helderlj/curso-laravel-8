<h1>Index de Posts</h1>
<a href="{{ route('posts.create') }}">Criar novo post</a>
<hr>
@if(session('message'))
    {{ session('message') }}
    <hr>
@endif
@foreach($posts as $post)
    <p>{{ $post->title }}
        [ <a href="{{ route('posts.show', $post->id) }}">Ver</a> | <a href="{{ route('posts.edit', $post->id) }}">Editar</a> ]</p>
@endforeach
