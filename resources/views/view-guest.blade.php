<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color:rgb(81, 81, 221)">
            {{ __('Dashboard / Guest / View') }}
        </h2>
    </x-slot>
        <div class="max-w-7xl mx-auto">
            <div class="">
                <div>
                    <x-info-card>
                        <x-slot name="title">Visitor</x-slot>
                        <div>
                            Name: <strong>{{ $visitor->name ?? ''}}</strong>
                        </div>
                        <div class="mt-4">
                            Title: <strong>{{ $visitor->Role ?? '' }}</strong>
                        </div>

                        <div class="mt-4">
                            Organization: <strong>{{ $visitor->Company ?? '' }}</strong>
                        </div>

                        <div class="mt-4">
                            Registered On: {{ $visitor->created_at->format('D d M Y') }}
                        </div>

                        <div class="mt-4 flex justify-between">
                            <a href="{{route('guest-pdf', $visitor->id)}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                View Ticket
                            </a>
                            <a href="{{ route('edit-guest', ['visitor' => $visitor]) }}">
                                <x-button class="text-green-600" style="background: darkcyan">Edit</x-button>
                            </a>
                        </div>
                    </x-info-card>
                </div>
                <div class="mt-2">
                    <x-info-card>
                        <x-slot name="title">QR CODE</x-slot>
                        <div class="flex justify-center">
                            <div>
                                <a href="{{ route('visitor.download', $visitor->id) }}" download>
                                    {!! DNS2D::getBarcodeHTML((string) $visitor->id." ".$visitor->name, 'QRCODE', 7.8, 7.8) !!}
                                </a>
                            </div>
                        </div>
                    </x-info-card>
                </div>
            </div>
            <br>
            <h3 class="text-center text-lg">Sessions Attended</h3>
            <div class="mx-auto max-w-6xl">
                <table class="border-collapse table-auto w-full text-sm card-datatable table-responsive bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                    <thead>
                    <tr>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Topic') }}
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-gray-500 dark:bg-slate-800">
                    @foreach($visitor->sessions as $session)
                        <tr>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-2 pl-3 text-slate-500 dark:text-slate-400">
                                <div class="text-sm text-white">
                                    {{ Str::limit($session->topic, 50) }}
                                </div>
                            </td>
                            <td>
                                <div class="flex">
                                    <a href="{{ route('view-session', $session->id) }}">
                                        <x-button class="bg-zinc-50 text-cyan-50">View</x-button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>
