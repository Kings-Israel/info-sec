<div class="flex flex-col sm:justify-center items-center sm:pt-0 bg-gray-100">
    <h2 class="text-200 font-bold">
        {{ $title }}
    </h2>

    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
