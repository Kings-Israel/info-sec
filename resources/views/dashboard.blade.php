<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color:rgb(81, 81, 221)">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <div class="card-body w-full sm:max-w-md mt-1 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <span><i class="fas fa-clock"></i> No. of Sessions available</span>
                    {{ $sessions->count() }}
                </div>
                <div class="card-body w-full ml-1 sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <span><i class="fas fa-users"></i> No. of Guests</span>
                    {{ $guests->count() }}
                </div>
                <div class="card-body w-full ml-1 sm:max-w-md mt-1 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <span><i class="fas fa-user-alt"></i> No. of System Users</span>
                    {{ $users->count() }}
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('report', ['full_report' => 'full_report']) }}" class="flex justify-end mt-2 mr-2">
                    <x-button class="bg-gray-800 text-cyan-50" style="background: #4a5568">All Visitors Report</x-button>
                </a>
                <a href="{{ route('report', ['attendees_report' => 'attendees_report']) }}" class="flex justify-end mt-2 mr-2">
                    <x-button class="bg-gray-800 text-cyan-50" style="background: #4a5568">All Attendees Report</x-button>
                </a>
                <a href="{{ route('report', ['walk_ins' => 'walk_ins']) }}" class="flex justify-end mt-2 mr-2">
                    <x-button class="bg-gray-800 text-cyan-50" style="background: #4a5568">All Walk Ins Report</x-button>
                </a>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($sessions->count() > 0)
                <div class="card w-full mt-1 mr-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <div class="flex">
                        @foreach($session_days as $count => $session)
                            <a href="{{ route('report', ['day_attendance_report' => $count]) }}" class="flex justify-end mt-2 mr-2">
                                <x-button class="bg-gray-800 text-cyan-50" style="background: #4a5568">Day {{ $count }} Attendees Report</x-button>
                            </a>
                            <a href="{{ route('report', ['day_non_attendance_report' => $count]) }}" class="flex justify-end mt-2 mr-2">
                                <x-button class="bg-gray-800 text-cyan-50">Day {{ $count }} Non Attendees Report</x-button>
                            </a>
{{--                        <a href="{{ route('report', ['day_report' => $sessions->last()->session_date]) }}" class="flex justify-end mt-2 mr-2">--}}
{{--                            <x-button class="bg-gray-800 text-cyan-50" style="background: #4a5568">Day Two Attendance Report</x-button>--}}
{{--                        </a>--}}
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($sessions->count() > 0)
                <div class="">
                    @foreach ($sessions as $session)
                        <div class="card w-full mt-1 mr-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                            <div class="card-header flex justify-between">
                                <p class="text-lg text-gray-900 font-bold dark:text-white">{{ $session->description }}</p>
                                <span class="flex">
                                    <h5>Visitors: </h5>
                                    <h6>{{ $session->visitors->count() }}</h6>
                                </span>
                            </div>
                            @if ($session->visitors->count() > 0)
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
                                            @foreach($session->visitors->take(5) as $guest)
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
                                    <div class="flex justify-end">
                                        <a href="{{ route('report', ['session_report' => $session->id]) }}" class="flex justify-end mt-2 mr-2">
                                            <x-button class="bg-gray-800 text-cyan-50" style="background: #4a5568">Get Session Attendance Report</x-button>
                                        </a>
                                        <a href="{{ route('view-session', $session->id) }}" class="flex justify-end mt-2">
                                            <x-button class="bg-gray-800 text-cyan-50">View Session Details</x-button>
                                        </a>&nbsp;
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</x-app-layout>
