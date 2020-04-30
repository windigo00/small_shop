<tr>
    @foreach ($columns as $column)
    <th scope="col">
        @if ($column->getName() == 'bulk_action')
        <div class="dropdown">
            <a class="btn btn-sm dropdown-toggle" id="dropdownBulkMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-square"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownBulkMenuButton">
                <a class="dropdown-item" href="#" @click="allSelection">{{ __('Select All') }}</a>
                <a class="dropdown-item" href="#" @click="noSelection">{{ __('Deselect All') }}</a>
                <a class="dropdown-item" href="#" @click="invertSelection">{{ __('Invert Selection') }}</a>
            </div>
        </div>
        @elseif (!$column->isOrderable())
        {{ $column->getLabel() }}
        @else
        <a href="{{ request()->fullUrlWithQuery(
                [
                    'sort' => [ $column->getName() => !$column->getOrder()?'asc':'desc' ],
                    'page' => 1
                ]
            ) }}"
           class="link"
           @click=""
           >
            {{ $column->getLabel() }}
            @if ($column->isOrdered())
            <i class="ordering fas fa-caret{{ $column->getOrder() ? '-up' : '-down' }}"></i>
            @endif
        </a>
        @endif
    </th>
    @endforeach
</tr>