@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Crear Artículo</h1>
        <form action="{{ route('editor.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group my-1">
                <label for="title">Título</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group my-1">
                <label for="content">Contenido</label>
                <textarea name="content" class="form-control" required></textarea>
            </div>
            <div class="form-group my-1">
                <label for="image">ImageN</label>
                <input type="file" name="image" accept="image/*" class="form-control">
            </div>
            <button type="submit" class="btn btn-success btn-animated my-3">Guardar</button>
        </form>
    </div>
@endsection