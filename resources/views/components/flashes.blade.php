@php
$msg = request()->session()->pull('success');
@endphp
@if($msg)
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ $msg }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@php
$msg = request()->session()->pull('error');
@endphp
@if($msg)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $msg }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
