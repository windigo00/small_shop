@extends('layouts.front')
@section('title', ' - ' . __('Profile') . ' - ' . $customer->fullName())
@section('page_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Welcome {{ $customer->fullName() }}.</h3>
                    <p>You are logged in!</p>

                    <div class="row">
                        <div class="col-4">
                            <h4>{{ __('Cards') }}</h4>
                            <ul class="list-group">
                                @forelse ($customer->cards as $card)
                                <li class="list-group-item">{{ $card->number }}</li>
                                @empty
                                <p>{{ __('No cards') }}</p>
                                @endforelse
                            </ul>
                        </div>
                        <div class="col-4">
                            <h4>{{ __('Addresses') }}</h4>
                            <ul class="list-group">
                                @forelse ($customer->addresses as $address)
                                <li class="list-group-item">
                                    <address>
<!--                                        {{ __('Street') }}:&nbsp;-->
                                        {{ $address->street }}&nbsp;{{ $address->street_nr }}<br>
<!--                                        {{ __('Street Number') }}:&nbsp;-->
<!--                                        {{ __('City') }}:&nbsp;-->
                                        {{ $address->city }}<br>
<!--                                        {{ __('Zip/Postal code') }}:&nbsp;-->
                                        {{ $address->zip }}<br>
<!--                                        {{ __('Country') }}:&nbsp;-->
                                        {{ cache('country_list')[app()->getLocale()][$address->country] }}
                                    </address>
                                </li>
                                @empty
                                <p>{{ __('No addresses') }}</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection