<ul class="nav pagination justify-content-start">
    <li class="page-item disabled" aria-disabled="true" v-show="isBulkSelected">
        <span class="page-link">@lang('Bulk actions')</span>
    </li>
    <li class="page-item" v-show="isBulkSelected">
        <a class="page-link bg-danger text-white" aria-label="@lang('Delete')" >
            <i class="fas fa-trash"></i>
        </a>
    </li>
    <li class="page-item" v-show="isBulkSelected">
        <a class="page-link bg-primary text-white" aria-label="@lang('Edit')">
            <i class="fas fa-pen"></i>
        </a>
    </li>
    <li class="page-item" v-show="isBulkSelected">
        <a class="page-link bg-info text-white">
            <i class="fas fa-print" aria-label="@lang('Print')"></i>
        </a>
    </li>
</ul>