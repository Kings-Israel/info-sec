<div class="card-body">
    <table class="border-collapse table-auto w-full text-sm bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
        <thead>
        <tr>
            <th class="py-1 px-1 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                {{ __('User Names') }}
            </th>

            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                {{ __('Country') }}
            </th>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-left">
                {{ __('Role') }}
            </th>
        </tr>
        </thead>
        <tbody class="bg-gray-200 dark:bg-slate-800">
        @foreach($visitors as $guest)
            <tr>
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                    <div class="text-sm text-gray-200">
                        {{ $guest->salutation ?? '' }} {{ $guest->name }}
                    </div>
                </td>
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                    <div class="text-sm text-gray-200">
                        {{ $guest->Country }}
                    </div>
                </td>
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                    <div class="text-sm text-gray-200">
                        {{ $guest->Role ?? 'NA' }}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $visitors->links() }}
</div>
