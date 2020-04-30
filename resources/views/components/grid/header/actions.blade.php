<!--<div class="btn-group" role="group">-->
    @foreach ($actions as $action_name => $action)
    <a
        class="link text-{{ $action['color'] }}"
        title="{{ __(ucfirst($action_name)) }}"
        @if (isset($action['confirm']))
            @click="{!! $action['confirm']($row) !!}"
            @if ($action['route'] instanceof Closure)
            route="{{ $action['route']($row) }}"
            @else
            route="{{ $column->route($action['route']['route_name'], $action['route']['attrs'], $row) }}"
            @endif
            href="#"
        @elseif ($action['route'] instanceof Closure)
            href="{{ $action['route']($row) }}"
        @else
            href="{{ $column->route($action['route']['route_name'], $action['route']['attrs'], $row) }}"
        @endif
    >
        <i class="fas fa-{{ $action['icon'] }}"></i>
    </a>
    @endforeach
<!--</div>-->