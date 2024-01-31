<x-guest-layout>
    <x-auth-card>

        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-21 fill-current text-gray-500" />
            </a>

        </x-slot>
        <h2><strong>ADD GUEST DETAILS</strong></h2>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


        <form method="POST" action="{{ route('add-guest') }}">

            @csrf

            <div class="mt-4">
                <x-label for="salutation" :value="__('Salutation')" />
                <select id="salutation" name="salutation" class="block mt-1 w-full">
                    <option value="">-- Select Salutation --</option>
                    <option value="Mr." {{ old('salutation') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                    <option value="Mrs." {{ old('salutation') == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                    <option value="Ms." {{ old('salutation') == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                    <option value="Prof." {{ old('salutation') == 'Prof.' ? 'selected' : '' }}>Prof.</option>
                    <option value="Dr." {{ old('salutation') == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                </select>
            </div>

            {{-- <div class="mt-4">
                <x-label for="category" :value="__('Category')" />

                <x-input id="category"
                         class="block mt-1 w-full"
                         type="text"
                         name="category"
                         required
                         autocomplete="category"
                />
            </div> --}}

            <div>
                <x-label for="name" :value="__('Guest Full Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            </div>

            <div class="mt-4">
                <x-label for="company" :value="__('Company')" />

                <x-input id="company"
                         class="block mt-1 w-full"
                         type="text"
                         name="company"
                         autocomplete="company"
                />
            </div>

            <div class="mt-4">
                <x-label for="role" :value="__('Title')" />

                <x-input id="role" class="block mt-1 w-full"
                                type="text"
                                name="role"
                                required autocomplete="role" />
            </div>

            {{-- <div class="mt-4">
                <x-label for="country" :value="__('Country')" />

                <x-input id="country" class="block mt-1 w-full"
                                type="text"
                                name="country"
                                required autocomplete="country" />
            </div> --}}

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Add') }}
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
