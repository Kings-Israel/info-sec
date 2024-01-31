<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div style="font-size: 100">
            <i class="fa fa-check" aria-hidden="true"></i> Successfully registered.
        </div>
        <br>
        <hr>
        <br>
        <div>
            A QR Code has been sent to your email. It will be used to verify your attendance.
        </div>
        <br>
        <div class="flex justify-between">
            <div>
                Not Received? <a href="{{ route('user.resend', $user->id) }}"><x-button>Resend</x-button></a>
            </div>
            <div>
                <a href="{{ url('/') }}">
                    <x-button>Go Home</x-button>
                </a>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
