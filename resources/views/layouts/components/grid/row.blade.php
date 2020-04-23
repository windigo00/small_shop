<tr>
    @foreach ($columns as $column)
        <?php $column_name = $column->getName(); ?>
        @switch($column_name)
            @case('action')
    <td>@include('layouts.components.grid.header.actions', ['actions' => $actions, 'row' => $row])</td>
            @break

            @case('id')
    <th scope="row">{{ $row->$column_name }}</th>
            @break

            @default
    <td>{{ $column->render($row->$column_name) }}</td>
            @break
        @endswitch
    @endforeach
</tr>