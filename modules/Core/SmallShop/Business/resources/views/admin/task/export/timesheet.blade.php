<table>
    <thead>
        <tr>
            <th>Datum</th>
            <th>Odpracováno</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data['days'] as $day)
        <tr>
            <td>{{ $day['date']->format('d-m-Y') }}</td>
            <td>{{ $day['sum'] }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Suma</th>
            <th>{{ $data['sum'] }}</th>
        </tr>
    </tfoot>
</table>