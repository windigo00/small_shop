@extends('business::admin.task.export.empty_layout')
@section('content')
<div class="container-fluid page">
    <div class="row">
        <div class="col-1 my-side-tabs no-border"></div>
        <div class="col-5"></div>
        <div class="col-6">
            <div class="row">
                <div class="col-6 border border-light text-center text-lg invoice_nr">
                    <span>Faktura</span>
                    <br>
                    <b>{{ $invoice->getInvoiceNr() }}</b></div>
                <img id="barcode" class="col-6" src="{{ $invoice->getBarcodePng() }}"/>
            </div>
        </div>
    </div>

    @include('business::admin.task.export.invoice.ident')
    @include('business::admin.task.export.invoice.payment', ['me' => $invoice->getMyData()])
    @include('business::admin.task.export.invoice.items', ['items' => $invoice->getItems()])
    @include('business::admin.task.export.invoice.summary')
    <div class="row spacer">
        <div class="col-1 my-side-tabs">&nbsp;</div>
        <div class="col col-11"></div>
    </div>
    <div class="row">
        <div class="col-1 my-side-tabs">&nbsp;</div>
        <div class="col col-3"><i class="fas fa-phone"></i> {{ $invoice->getMyData()->getPhone() }}</div>
        <div class="col col-3"><i class="fas fa-envelope"></i> {{ $invoice->getMyData()->getEmail() }}</div>
        <div class="col col-5 text-right">Vystaveno v online fakturační aplikaci Fakturovadlo</div>
    </div>
    <div class="row">
        <div class="col-1 my-side-tabs">&nbsp;</div>
        <div class="col col-8">Vytiskl(a): {{ $invoice->getMyData()->getName() }}, {{ $invoice->getDateCreated()->format('d.m.Y H:i:s') }}</div>
        <div class="col col-3 text-right">Strana <span class="p-2 bg-light font-weight-bold">1/1</span></div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        * {
            -webkit-print-color-adjust: exact;
        }
        html, body {
            padding: 0;
        }
    }

    html, body {
        margin: 0;
        padding: 1.5em;
        font-size: 0.85em;
    }
    .page {
        border: 1px solid;
        width: 85vw !important;
        height: 85vh !important;
        display: block;
    }

    .container-fluid {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .container-fluid > .row {
        flex: 1;
        flex-grow: 0;
    }
    .container-fluid > .row > .col {
        padding-bottom: 2.45em;
    }
    .container-fluid > .sum > .col {
        padding-top: 1.5em;
    }
    .container-fluid > .spacer {
        flex-grow: 1;
    }
    .container-fluid > .row.payment > .col {
        padding-bottom: 0;
    }

    .invoice_nr {
        padding-top: 6px;
    }

    .my-side-tabs {
        writing-mode: tb;
        text-orientation: sideways-right;
        white-space: nowrap;
        border-right: 1px solid #00c0e4;
        color: #00c0e4;
        text-transform: uppercase;
        font-weight: bold;
        text-align: left;
        padding: 1em 1em 1em 2em;
        width: 1cm;
        max-width: 1cm;
    }
    .inverse {
        color: #fff;
        background-color: #00c0e4;
        -webkit-print-color-adjust: exact;
    }
    .payment .inverse {
        max-height: 11.5em;
    }
    .payment .inverse .row > div {
        padding-right: 0;
    }
    .my-side-tabs.inverse {
        color: #fff;
        border-right: 1px solid #fff;
    }
    .no-border {
        border: 0px;
    }

    .qr_code {
        height: 146px;
        background-color: #fff;
        margin-top: -1.2em;
        position: absolute;
        right: -1px;
    }

    .text-lg {
        font-size: large;
    }

    .sum table th {
        border-top: 0px;
    }
    .sum table tbody tr:last-child td {
        border-bottom: 1px solid #dee2e6;
    }

    .address-title {
        font-size: initial;
        color: #717171;
    }

    .arrow {
        width: 0px;
        height: 0px;
        border-top: 0px solid transparent;
        border-bottom: 6em solid transparent;
        border-right: 1em solid white;
        position: absolute;
        top: 0;
        right: 0;
    }
    .arrow.bot {
        bottom: 0;
        top: auto;
        border-top: 6em solid transparent;
        border-bottom: 0px solid transparent;
    }

</style>
@endsection