@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end align-items-center">
        @if (Auth::check())
            <span class="text-danger mr-2">{{ auth()->user()->name }}</span>
            <span class="mx-2">|</span>
            <a href="{{ route('logout') }}" class="btn btn-link border-start-0 p-0 text-danger text-decoration-none" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Cerrar sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endif
    </div>
    <div class="container">
        <h1>Mis Artículos</h1>
        <br>
        <form method="GET" action="{{ route('editor.articles.index') }}">
            @csrf
            <div class="row justify-content-center align-items-center">
                <div class="col-md-3">
                    <input type="text" name="title" class="form-control" placeholder="Buscar por título" value="{{ request('title') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <select name="user_id" class="form-select">
                        <option value="">Filtrar por usuario</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="border-5 btn btn-animated"><i class="fa fa-filter"></i></button>
                </div>
            </div>   
        </form>
        
        <div class="d-flex justify-content-end my-5">
            <a href="{{ route('editor.articles.create') }}" class="btn btn-secondary btn-animated"><i class="fa fa-plus"></i>Nuevo Artículo</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('export.articles.excel') }}" class="btn btn-success mx-4 btn-animated"><i class="fa fa-file-excel"></i></a>
            <a href="{{ route('export.articles.pdf') }}" class="btn btn-danger btn-animated"><i class="fa fa-file-pdf"></i></a>
        </div>
        
        
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->content }}</td>
                        <td>
                            @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" width="49">
                            @else
                                <p>No Imagen</p>
                            @endif
                        </td>
                        <td class="col-acciones">
                            <a href="{{ route('editor.articles.edit', $article->id) }}" class="btn btn-sm btn-animated"><i class="fa-solid fa-edit"></i></a>
                            <form action="{{ route('editor.articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-animated" onclick="return confirm('¿Eliminar este artículo?')"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection