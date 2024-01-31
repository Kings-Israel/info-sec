<x-guest-layout>
    <x-auth-card>
        
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-21 fill-current text-gray-500" />
            </a>
           
        </x-slot>
        <h2><strong>ADD SYSTEM USER DETAILS</strong></h2>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        

        <form method="POST" action="{{ route('add-user') }}">
            
            @csrf


            <div>
                <x-label for="first_name" :value="__('First Name')" />

                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
            </div>            
            <div>
                <x-label for="last_name" :value="__('Last Name')" />

                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
            </div>  
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full"
                                type="email"
                                name="email"
                                required />
            </div>
            <div class="mt-4">
                <x-label for="phone_number" :value="__('Phone Number')" />

                <x-input id="phone_number" class="block mt-1 w-full"
                                type="tel"
                                name="phone_number" :value="old('phone_number')"
                                required />
            </div>
            <div class="flex items-center justify-end mt-4">
            
                <x-button class="ml-4">
                    {{ __('Add') }}
                </x-button>

                <x-button class="ml-4 fill-current text-gray-500" style="background: gray">
                    <a href="{{ route('users') }}">
                        {{ __('Cancel') }}
                    </a>
                </x-button>
            
                
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
