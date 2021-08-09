<h1>Cadastrar nova categoria</h1>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('categories.store') }}" method="post">
    @csrf
    @method('POST')
    <input type="text" name="title" id="title" placeholder="Titulo" value="{{ old('title') }}"><br>
    <textarea name="details" id="details" cols="30" rows="10" placeholder="Detalhes">{{ old('details') }}</textarea><br>
    <button type="submit">Cadastrar</button>
</form>
