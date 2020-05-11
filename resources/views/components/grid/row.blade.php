<tr>
    @foreach ($columns as $idx => $column)
        @php
            $column_name = $column->getName();
            $value = $row->$column_name;
        @endphp
        @switch($column_name)
            @case('action')
    <th scope="row" @if($column->getColumnClass()) class="{{ $column->getColumnClass() }}" @endif>
                @include('components.grid.header.actions', ['row' => $row, 'column' => $column])
    </th>
            @break

            @case('bulk_action')
    <th scope="row" @if($column->getColumnClass()) class="{{ $column->getColumnClass() }}" @endif>
                @include('components.grid.header.actions.bulk', ['row' => $row, 'column' => $column])
    </th>
            @break

            @case('id')
    <th scope="row" @if($column->getColumnClass()) class="{{ $column->getColumnClass() }}" @endif>{{ $value }}</th>
            @break

            @default
    <td @if($column->getColumnClass()) class="{{ $column->getColumnClass() }}" @endif>{!! $column->render($value, $row) !!}</td>
            @break
        @endswitch
    @endforeach
</tr>