<h1>Index de Categorias</h1>
<hr>
<a href="{{ route('categories.create') }}">Criar nova categoria</a>
<hr>
@foreach($categories as $category)
    <p>{{ $category->title }}</p>
@endforeach
