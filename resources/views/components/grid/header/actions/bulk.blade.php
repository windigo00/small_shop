<div class="custom-control custom-checkbox" @click="setBulkState">
    <input
        type="checkbox"
        class="custom-control-input"
        name="bulk_id[{{ $row->id }}]"
        @if (old('bulk_id.'.$row->id, false))
        data-old="1"
        @endif
        :checked="items[{{ $row->id }}]"
        data-id="{{ $row->id }}"
    >
    <label class="custom-control-label" />
</div>
