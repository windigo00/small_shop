<form id="tbl">
    <div class="table-responsive-sm">
    <table class="table table-striped table-bordered table-hover table-sm">
        <thead>
            @include('components.grid.header', ['columns' => $container->getColumns()])
        </thead>
        <tbody>
            @forelse ($container->getItems() as $item)
                @include('components.grid.row', ['columns' => $container->getColumns(), 'row' => $item, 'actions' => $container->getActions()])
            @empty
            <tr>
                <th scope="row" colspan="{{ count($container->getColumns()) }}">No Items</th>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</form>

<nav class="navbar">
@include('components.grid.bulk', ['columns' => $container->getColumns()])
{{ $container->getItems()->onEachSide(1)->links('components.paging') }}
</nav>

<modal-form name="confirmForm" title="{{ __('Are You Sure?!?') }}">
    <h1>{{ __('Are You Sure?!?') }}</h1>
</modal-form>
