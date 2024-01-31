<div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
    <div class="py-2 max-w-7xl mx-auto">
        <form action="{{ route('guest.search') }}" method="GET">
            <div class="flex mt-4">
                <div class="relative text-gray-600">
                    <input type="search" name="search" placeholder="Search" wire:model="search" class="bg-white h-10 pr-10 rounded-md">
                    <button type="submit" class="absolute right-0 top-0 mt-3 pr-2 hidden">
                        <svg class="h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M22 22L15.5 15.5M15.5 15.5C17.9853 12.7314 17.9853 8.26863 15.5 5.5C13.0147 2.73137 8.98528 2.73137 6.5 5.5C4.01472 8.26863 4.01472 12.7314 6.5 15.5C8.98528 18.2686 13.0147 18.2686 15.5 15.5Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <table class="border-collapse table-auto w-full bg-gray-800 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
        <thead>
            <tr>
                <th class="p-4 pl-1 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                    {{ __('Guest Name') }}
                </th>
                <th class=" bg-grey-lightest p-4 pl-1 font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                    {{ __('Title') }}
                </th>
                {{-- <th class="bg-grey-lightest p-4 pl-1 font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                    {{ __('Category') }}
                </th> --}}
                <th class="bg-grey-lightest p-4 pl-1 font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                    {{ __('Actions') }}
                </th>
            </tr>
        </thead>
        <tbody class="bg-gray-200 dark:bg-slate-800">
            @forelse($guests as $guest)
                <tr class="hover:bg-gray-700">
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-1 text-slate-500 dark:text-slate-400">
                        <div class="text-sm text-gray-200">
                            {{ $guest->salutation ?? '' }} {{ $guest->name }}
                        </div>
                    </td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-1 text-slate-500 dark:text-slate-400">
                        <div class="text-sm text-gray-200">
                            {{ $guest->Role ?? 'NA' }}
                        </div>
                    </td>
                    {{-- <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-1 text-slate-500 dark:text-slate-400">
                        <div class="text-sm text-gray-200">
                            {{ Str::limit($guest->category, 50) ?? '' }}
                        </div>
                    </td> --}}
                    <td class="border-b border-slate-100 dark:border-slate-700">
                        <div class="flex justify-between px-2 w-full">
                            <a href="{{ route('visitor.view', $guest->id) }}">
                                <x-button class="bg-sky-600 text-cyan-50">View</x-button>
                            </a>
                            <a href="{{ route('edit-guest', ['visitor' => $guest]) }}">
                                <x-button class="text-green-600" style="background: darkcyan">Edit</x-button>
                            </a>
                            <a href="">
                                <form method="POST" action="{{ route('guest.delete', $guest->id) }}" style="size:small " class="bg-zinc-50 text-cyan-50">
                                    @csrf
                                    @method('PUT')
                                    <x-button style="background-color:rgb(247, 74, 74)">Delete </x-button>
                                </form>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color:rgb(81, 81, 221)">
                    {{ __('No Guests Found') }}
                </h2>
            @endforelse
        </tbody>
    </table>
    <div class="flex justify-end mt-2">
        {{ $guests->links() }}
    </div>
</div>
