<table>
    <tbody>
    @foreach($data['days'] as $day)
    @if (count($day['items']) > 0)
        <tr>
            <td colspan="3"><strong>{{ $day['date']->format('d-m-Y') }}</strong></td>
        </tr>
        @foreach($day['items'] as $item)
        <tr>
            <td>{{ $item->amount }}</td>
            <td width="30px">h</td>
            <td>{{ $item->name }}</td>
        </tr>
        @endforeach
    @endif
    @endforeach
    </tbody>
</table>