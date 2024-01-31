<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color:rgb(81, 81, 221)">
            {{ __('Dashboard / Sessions') }}
        </h2>
        <a href="{{ route('add-session') }}">
            <x-button class="bg-zinc-50 text-cyan-50 flex items-center justify-end" style="margin-left: 85%">Add Session</x-button>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="border-collapse table-auto w-full text-sm card-datatable table-responsive bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                <thead>
                    <tr>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Topic') }}
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Description') }}
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Host') }}
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Date') }}
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Duration') }}
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Visitors') }}
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-500 dark:bg-slate-800">
                    @foreach($sessions as $session)
                    <tr>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-2 pl-3 text-slate-500 dark:text-slate-400">
                            <div class="text-sm text-white">
                                {{ Str::limit($session->topic, 30) }}
                            </div>
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-2 pl-3 text-slate-500 dark:text-slate-400">
                            <div class="text-sm text-white">
                                {{ Str::limit($session->description, 30)  ?? 'N/A'}}
                            </div>
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-2 pl-3 text-slate-500 dark:text-slate-400">
                            <div class="text-sm text-white">
                                {{ $session->host ?? 'N/A'}}
                            </div>
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                            <div class="text-sm text-white">
                                {{ Carbon\Carbon::parse($session->session_date)->format('d m Y') ?? 'N/A'}}
                            </div>
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                            <div class="text-sm text-white">
                                {{ $session->duration.' Mins' ?? 'N/A'}}
                            </div>
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                            <div class="text-sm text-white">
                                {{ $session->visitors->count() }}
                            </div>
                        </td>
                        <td>
                            <div class="flex">
                                <a href="{{ route('view-session', $session->id) }}">
                                    <x-button class="bg-zinc-50 text-cyan-50">View</x-button>
                                </a>&nbsp;
                                <a href="{{ route('edit-session', ['session' => $session]) }}">
                                    <x-button class="text-green-600" style="background: darkcyan">Edit</x-button>
                                </a>&nbsp;
                                <a href="">
                                    <form method="POST" action="{{ route('session.delete', $session->id) }}" style="size:small " class="bg-zinc-50 text-cyan-50">
                                        @csrf
                                        @method('PUT')
                                        <x-button style="background-color:rgb(247, 74, 74)">Delete </x-button>
                                    </form>
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
