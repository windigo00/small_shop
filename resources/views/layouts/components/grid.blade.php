<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        @include('layouts.components.grid.header', ['columns' => $columns])
    </thead>
    <tbody>
        @forelse ($items as $item)
            @include('layouts.components.grid.row', ['columns' => $columns, 'row' => $item])
        @empty
        <tr>
            <th scope="row" colspan="{{ count($columns) }}">No Items</th>
        </tr>
        @endforelse
    </tbody>
</table>
{{ $items->onEachSide(1)->appends(['sort' => 'votes'])->links('layouts.components.paging') }}