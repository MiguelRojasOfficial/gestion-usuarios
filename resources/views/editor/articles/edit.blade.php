@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Editar Artículo</h1>
        <form action="{{ route('editor.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group my-1">
                <label for="title">Título</label>
                <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
            </div>
            <div class="form-group my-1">
                <label for="content">Contenido</label>
                <textarea name="content" class="form-control" required>{{ $article->content }}</textarea>
            </div>
            <div class="form-group my-1">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
                @if ($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" width="200">
                @endif
            </div>
            <button type="submit" class="btn btn-success btn-animated my-3">Actualizar</button>
        </form>
    </div>
@endsection