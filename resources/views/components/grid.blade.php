@section('scripts')
    @parent
    <script>
//        window._{{ $name }}_data = @json($container->getColumnData());
    </script>
@endsection
{{--
<filters
    ref="filters"
    :items="filterItems"
    columns-source="_{{ $name }}_data"
    class="container-fluid filter pb-2 bg-light rounded-top border border-bottom-0"
    @remove-filter="removeFilter"
    @move-filter="moveFilter"
>
</filters>
--}}
<form id="tbl">
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered table-hover table-sm" id="{{ $name }}">
            <thead>
                @include('components.grid.header', ['columns' => $container->getColumns()])
            </thead>
            <tbody>
                @forelse ($container->getItems() as $item)
                    @include('components.grid.row', ['columns' => $container->getColumns(), 'row' => $item, 'actions' => $container->getActions()])
                @empty
                <tr>
                    <th scope="row" colspan="{{ count($container->getColumns()) }}">{{ __('No Items') }}</th>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</form>
<form method="POST" id="delete-action-form">
    {{ method_field('DELETE') }}
    @csrf
    <!--<input type="hidden" name="id" />-->
</form>

<nav class="navbar">
@include('components.grid.bulk', ['columns' => $container->getColumns()])
{{ $container->getItems()->onEachSide(2)->links('components.paging') }}
</nav>

<modal-form name="confirmForm" :message="modalMessage" title="{{ __('Are You Sure?!?') }}" @confirm="confirmAction">
    <h1>{{ __('Are You Sure?!?') }}</h1>
</modal-form>
