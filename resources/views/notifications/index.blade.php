@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <h1 class="text-lg font-bold mb-4">Notifications</h1>

    @if (session('status'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session('status') }}
        </div>
    @endif

    @if ($notifications->isEmpty())
        <p>No notifications.</p>
    @else
        <ul>
            @foreach ($notifications as $notification)
                <li class="mb-2">
                    <div class="p-4 border rounded">
                        <p>{{ $notification->data['message'] }}</p>
                        <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                </li>
            @endforeach
        </ul>

        <form action="{{ route('notifications.markAsRead') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">
                Mark All as Read
            </button>
        </form>
    @endif
</div>
@endsection
