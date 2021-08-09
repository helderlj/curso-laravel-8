<h1>Atualizar post <b>{{ $post->title }}</b></h1>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('posts.update', $post->id) }}" method="post">
    @csrf
    @method('PUT')
    <input type="text" name="title" id="title" placeholder="Titulo" value="{{ $post->title }}"><br>
    <textarea name="content" id="content" cols="30" rows="10" placeholder="Conteudo">{{ $post->content }}</textarea><br>
    <button type="submit">Atualizar</button>
</form>