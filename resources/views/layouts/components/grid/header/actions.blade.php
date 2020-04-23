<div class="btn-group" role="group">
    @foreach ($actions as $action_name => $action)
    <button
        class="btn btn-sm btn-outline-{{ $action['color'] }}"
        title="{{ __(ucfirst($action_name)) }}"
        @click="{{ __($action_name) }}Item('{{ $action['route']($row) }}')"
        >
        <i class="fas fa-{{ $action['icon'] }}"></i>
    </button>
    @endforeach
</div>