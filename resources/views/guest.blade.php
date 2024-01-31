<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color:rgb(81, 81, 221)">
            {{ __('Dashboard / Guest') }}
        </h2>
        <div class="flex justify-end">
            @if(auth()->user()->is_admin)
                <form action="{{ route('visitors.import') }}" enctype="multipart/form-data" class="bg-black" method="POST">
                    @csrf
                    <div class="flex justify-between">
                        <label for="" class="text-gray-700 text-lg mr-2">Upload Visitors</label>
                        <input type="file" accept=".xls,.xlsx" name="visitors" class="border-2 border-blue-900">
                    </div>
                    <x-button type="submit">Submit</x-button>
                </form>

                <a href="{{ route('add-guest') }}">
                    <x-button class="bg-zinc-50 text-cyan-50 ml-2">Add Guest</x-button>
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-2">
        <livewire:visitors-list />
    </div>

</x-app-layout>
