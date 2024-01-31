<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color:rgb(81, 81, 221)">
            {{ __('Dashboard / Users') }}
        </h2>
        <a href="{{ route('add-user') }}">
            <x-button class="bg-zinc-50 text-cyan-50 flex items-center justify-end" style="margin-left: 85%">Add User</x-button>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="border-collapse table-auto w-full text-sm card-datatable table-responsive bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                <thead>
                    <tr>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('First Name') }}
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Last Names') }}
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Email') }}
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                            {{ __('Phone Number') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200 dark:bg-slate-800">
                    @foreach($users as $user)
                    <tr>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                            <div class="text-sm text-gray-200">
                                {{ $user->first_name }} 
                            </div>
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                            <div class="text-sm text-gray-200">
                                {{ $user->last_name }}
                            </div>
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                            <div class="text-sm text-gray-200">
                                {{ $user->email }}
                            </div>
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                            <div class="text-sm text-gray-200">
                                {{ $user->phone_number }}
                            </div>
                        </td>
                        {{-- <td>
                            <a href="{{ route('view-user', $user->id) }}">
                                <x-button class="bg-zinc-50 text-cyan-50">View</x-button>
                            </a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
