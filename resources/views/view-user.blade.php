<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color:rgb(81, 81, 221)">
            {{ __('Dashboard / Guest / View') }}
        </h2>
    </x-slot>
    <div class="mx-auto">
        <div class="flex justify-center">
            <div class="mr-2">
                <x-info-card>
                    <x-slot name="title">Visitor</x-slot>
                    <div>
                        Name: <strong>{{ $visitor->name ?? ''}}</strong>
                    </div>
                    <div class="mt-4">
                        Title: <strong>{{ $visitor->Role ?? '' }}</strong>
                    </div>
                    {{-- <div class="mt-4">
                        Category: <strong>{{ $visitor->category ?? '' }}</strong>
                    </div> --}}
                    
                    <div class="mt-4">
                        Company: <strong>{{ $visitor->Company ?? ' '}}</strong>
                    </div>

                    <div class="mt-4">
                        Country: <strong>{{ $visitor->Country ?? '' }}</strong>
                    </div>

                    <div class="mt-4">
                        Registered On: {{ $visitor->created_at->format('D M Y') }}
                    </div>
                </x-info-card>
                <x-info-card>
                    <x-slot name="title">QR CODE</x-slot>
                    <div class="flex justify-center">
                        <div>
                            {!! DNS2D::getBarcodeHTML((string) $visitor->id. " ".$visitor->name, 'QRCODE') !!}
                        </div>
                    </div>
                </x-info-card>
            </div>
            <div>
                <x-info-card>
                    <x-slot name="title">Sessions Attended</x-slot>
                    @forelse ($visitor->sessions as $count => $session)
                        {{ $count + 1 }}. {{ $session->topic }} - {{ Str::limit($session->description, 20) }} - {{ $session->created_at->format('D M Y') }}<br>
                    @empty
                        <p>No Sessions Attended</p>
                    @endforelse
                </x-info-card>
            </div>
        </div>

    </div>
</x-app-layout>
