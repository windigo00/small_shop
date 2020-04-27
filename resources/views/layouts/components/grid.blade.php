<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        @include('layouts.components.grid.header', ['columns' => $container->getColumns()])
    </thead>
    <tbody>
        @forelse ($container->getItems() as $item)
            @include('layouts.components.grid.row', ['columns' => $container->getColumns(), 'row' => $item, 'actions' => $container->getActions()])
        @empty
        <tr>
            <th scope="row" colspan="{{ count($container->getColumns()) }}">No Items</th>
        </tr>
        @endforelse
    </tbody>
</table>
<modal-form name="confirmForm" title="{{ __('Are You Sure?!?') }}">
    <h1>{{ __('Are You Sure?!?') }}</h1>
</modal-form>
{{ $container->getItems()->onEachSide(1)->links('layouts.components.paging') }}