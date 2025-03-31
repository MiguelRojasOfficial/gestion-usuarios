@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Notificaciones</h2>

        <div class="card shadow p-3">
            @if($notifications->isEmpty())
                <p class="text-muted text-center">No tienes nuevas notificaciones.</p>
            @else
                <ul class="list-group">
                    @foreach($notifications as $notification)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $notification->data['title'] ?? 'Notificación' }}</strong>
                                <p class="mb-0 text-muted">{{ $notification->data['message'] ?? 'Mensaje...' }}</p>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-success">Marcar como leída</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
