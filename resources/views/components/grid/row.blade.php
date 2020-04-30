<tr>
    @foreach ($columns as $idx => $column)
        @php
            $column_name = $column->getName();
        @endphp
        @switch($column_name)
            @case('action')
    <th scope="row" class="slim actions">@include('components.grid.header.actions', ['actions' => $actions, 'row' => $row, 'column' => $column])</th>
            @break

            @case('bulk_action')
    <th scope="row" class="slim bulk">@include('components.grid.header.actions.bulk', ['row' => $row, 'column' => $column])</th>
            @break

            @case('id')
    <th scope="row" class="slim">{{ $row->$column_name }}</th>
            @break

            @default
    <td>{!! $column->render($column_name, $row) !!}</td>
            @break
        @endswitch
    @endforeach
</tr>