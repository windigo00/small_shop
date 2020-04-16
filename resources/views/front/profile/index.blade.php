@extends('layouts.front')
@section('title', ' - ' . __('Profile') . ' - ' . $customer->fullName())
@section('page_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Welcome {{ $customer->fullName() }}.</h3>
                    <p>You are logged in!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection