@extends('layouts.app')
@section('content')
    <div class="container d-flex flex-column">
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand">Panel de Administración</a>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Notificaciones ({{ auth()->user()->unreadNotifications->count() }})
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="notificationsDropdown">
                        @foreach(auth()->user()->unreadNotifications as $notification)
                            <li>
                                <a class="dropdown-item" href="{{ $notification->data['url'] }}"
                                onclick="event.preventDefault(); document.getElementById('mark-notification-{{ $notification->id }}').submit();">
                                    {{ $notification->data['message'] }}
                                </a>
                                <form id="mark-notification-{{ $notification->id }}" action="{{ route('notifications.read', $notification->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('POST')
                                </form>
                            </li>
                        @endforeach
                        @if(auth()->user()->unreadNotifications->isEmpty())
                            <li><a class="dropdown-item text-muted">No hay notificaciones</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <div class="flex-grow-1">
        <h1>Lista de Usuarios</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td class="col-acciones">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-animated"><i class="fa-solid fa-edit"></i></a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-animated"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

