<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-21 fill-current text-gray-500" />
            </a>
        </x-slot>
        <h2><strong>ADD SESSION DETAILS</strong></h2>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('add-session') }}">
            @csrf
            <div>
                <x-label for="topic" :value="__('Topic')" />

                <x-input id="topic" class="block mt-1 w-full" type="text" name="topic" :value="old('topic')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="description" :value="__('Description')" />

                <textarea
                    id="description"
                    class="block mt-1 w-full"
                    type="textarea"
                    name="description"
                    required
                >
                </textarea>
            </div>
            <div class="mt-4">
                <x-label for="host" :value="__('Moderator')" />

                <x-input id="host" class="block mt-1 w-full"
                    type="text"
                    name="host"
                />
            </div>
            <div class="mt-4">
                <x-label for="description" :value="__('Speakers')" />

                <textarea
                    id="description"
                    class="block mt-1 w-full"
                    type="textarea"
                    name="speakers"
                    required
                >
                </textarea>
            </div>
            <div class="mt-4">
                <x-label for="date" :value="__('Date')" />

                <x-input id="date" class="block mt-1 w-full"
                    type="date"
                    name="date"
                />
            </div>
            <div class="mt-4">
                <x-label for="start_at" :value="__('Start At')" />

                <x-input id="start_at" class="block mt-1 w-full"
                    type="time"
                    name="start_at"
                />
            </div>
            <div class="mt-4">
                <x-label for="end_at" :value="__('End At')" />

                <x-input
                    id="end_at"
                    class="block mt-1 w-full"
                    type="time"
                    name="end_at"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Add') }}
                </x-button>

                <x-button class="ml-4 fill-current text-gray-500" style="background: gray">
                    <a href="{{ route('sessions') }}">
                        {{ __('Cancel') }}
                    </a>
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
