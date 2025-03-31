@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h2>Editar Usuario: {{ $user->name }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="role">Rol</label>
                <select name="role_id" class="form-control">
                    @foreach ($roles->unique('id') as $role)
                        <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-success btn-animated">Actualizar Usuario</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-animated">Cancelar</a>
        </form>
    </div>
@endsection
