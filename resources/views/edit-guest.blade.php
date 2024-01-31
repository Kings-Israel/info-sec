<x-guest-layout>
    <x-auth-card>

        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-21 fill-current text-gray-500" />
            </a>

        </x-slot>
        <h2><strong>EDIT GUEST DETAILS</strong></h2>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('update-guest', ['visitor' => $guest]) }}">
            @csrf
            {{-- <div class="mt-4">
                <x-label for="category" :value="__('Category')" />

                <x-input id="category"
                         class="block mt-1 w-full"
                         type="text"
                         name="category"
                         required
                         autocomplete="category"
                         value="{{ $guest->category }}"></x-input>
            </div> --}}

            <div>
                <x-label for="name" :value="__('Guest Full Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $guest->name }}" required />
            </div>

            <div class="mt-4">
                <x-label for="company" :value="__('Company')" />

                <x-input id="company"
                         class="block mt-1 w-full"
                         type="text"
                         name="company"
                         autocomplete="company"
                         value="{{ $guest->Company }}"></x-input>
            </div>

            <div class="mt-4">
                <x-label for="role" :value="__('Title')" />

                <x-input id="role" class="block mt-1 w-full"
                         type="text"
                         name="role"
                         required
                         autocomplete="role"
                         value="{{ $guest->Role }}"></x-input>
            </div>

            {{-- <div class="mt-4">
                <x-label for="country" :value="__('Country')" />

                <x-input id="country" class="block mt-1 w-full"
                         type="text"
                         name="country"
                         required
                         autocomplete="country"
                         value="{{ $guest->Country }}"></x-input>
            </div> --}}

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Update') }}
                </x-button>

                <x-button class="ml-4 fill-current text-gray-500" style="background: gray">
                    <a href="{{ route('guest') }}">
                        {{ __('Cancel') }}
                    </a>
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
