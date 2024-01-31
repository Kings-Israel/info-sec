<table>
    <thead>
    <tr>
        <th>
            {{ __('Guest Name') }}
        </th>

        <th>
            {{ __('Title') }}
        </th>
        <th>
            {{ __('Category') }}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($guests as $guest)
        <tr>
            <td>
                <div>
                    {{ $guest->salutation ?? '' }} {{ $guest->name }}
                </div>
            </td>
            <td>
                <div>
                    {{ $guest->Role ?? 'NA' }}
                </div>
            </td>
            <td>
                <div>
                    {{ Str::limit($guest->category, 50) ?? '' }}
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
