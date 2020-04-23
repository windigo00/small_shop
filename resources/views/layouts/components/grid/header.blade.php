<tr>
    @foreach ($columns as $column)
    <th scope="col">

        @if (!$column->isOrderable())
        {{ $column->getLabel() }}
        @else
        <a href="#" class="link">
            {{ $column->getLabel() }}
            @if ($column->isOrdered())
            <i class="ordering fas fa-caret{{ !$column->getOrder() ? '-up' : '-down' }}"></i>
            @endif
        </a>
        @endif
    </th>
    @endforeach
</tr>