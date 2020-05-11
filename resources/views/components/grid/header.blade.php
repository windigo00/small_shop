<tr>
    @foreach ($columns as $column)
    <th scope="col @if ($column->getName() == 'bulk_action')slim bulk @endif">
        @if ($column->getName() == 'bulk_action')
        <div class="dropdown custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" ref="bulkcheck" :checked="allSelected">
            <label class="custom-control-label" data-toggle="dropdown" id="dropdownBulkMenuButton" aria-haspopup="true" aria-expanded="false"></label>
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
            @if (strpos($column->getLabel(), '<') !== false)
            {!! $column->getLabel() !!}
            @else
            {{ $column->getLabel() }}
            @endif

            @if ($column->isOrdered())
            <i class="ordering fas fa-caret{{ $column->getOrder() ? '-up' : '-down' }}"></i>
            @endif
        </a>
        @endif
        @if(false && $column->isFilterable())
        <span
            class="filter badge badge-primary"
            title="{{ __('catalog.Filter') }}"
            @click.prevent="addFilter('{{ $column->getName() }}')"
            :style="filteredCollumns.includes('{{ $column->getName() }}')?'visibility: visible;':''"
        >
            <i class="fas fa-filter"></i>
        </span>
        @endif
    </th>
    @endforeach
</tr>