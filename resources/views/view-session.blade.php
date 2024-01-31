<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color:rgb(81, 81, 221)">
                    {{ __('Dashboard / Session / View') }}
                </h2>
            </div>
            <div class="flex justify-between">
                <div>
                    <x-button>
                        <a href="{{ route('add-session') }}" class="">Create Session</a>
                    </x-button>
                </div>
                <div>
                    <x-button class="ml-4 fill-current text-gray-200" style="background: rgb(42, 42, 42); margin-left:85%">
                        <a href="{{ route('sessions') }}">
                            {{ __('BACK') }}
                        </a>
                    </x-button>
                </div>
            </div>
        </div>
    </x-slot>
    <div>
        <div class="card max-w-7xl mx-auto mt-1 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg text-center">
            <div>
                <span>Topic: <br><strong>{{$session->topic}}</strong></span><br><hr>
                <span>Moderator(s): <br><strong>{{ $session->host }}</strong></span><br><hr>
                @if ($session->speakers != null)
                    <span>Speaker(s): <br><strong>{{ $session->speakers }}</strong></span><br><hr>
                @endif
                <span>Date: <strong>{{ Carbon\Carbon::parse($session->session_date)->format('d m Y') }}</strong></span><br>
                <span>Starting At:  <strong>{{ Carbon\Carbon::parse($session->start_at)->format('H:i A') ?? 'NA' }}</strong></span><br>
                <span>Ending At:  <strong>{{ Carbon\Carbon::parse($session->end_at)->format('H:i A') ?? 'NA' }}</span>
            </div>
            <div class="flex justify-center">
                <a href="{{ route('edit-session', ['session' => $session]) }}">
                    <x-button class="text-green-600" style="background: darkcyan; margin-right: 10px">Edit</x-button>
                </a>
                <a href="">
                    <form method="POST" action="{{ route('session.delete', $session->id) }}" style="size:small " class="bg-zinc-50 text-cyan-50">
                        @csrf
                        @method('PUT')
                        <x-button style="background-color:rgb(247, 74, 74)">Delete</x-button>
                    </form>
                </a>
            </div>
        </div>
        @if ($session->visitors->count() > 0)
            <div class="card mt-1 sm:px-6 lg:px-8 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg max-w-7xl mx-auto">
                <div class="card-header">
                    <span class="flex">
                        <h5>Visitors: </h5>
                        <h6>{{ $session->visitors->count() }}</h6>
                    </span>
                </div>
                <livewire:session-guest-list :session="$session" />
            </div>
        @else
            <div class="card mt-1 sm:px-6 lg:px-8 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg max-w-7xl mx-auto">
                <h4 class="text-center">No Visitors Attended This Session</h4>
            </div>
        @endif
    </div>
</x-app-layout>
