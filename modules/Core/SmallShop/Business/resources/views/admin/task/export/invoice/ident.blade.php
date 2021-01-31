<div class="row">
    <div class="col-1 my-side-tabs"><span>Identifikační údaje</span></div>
    <div class="col col-5 pt-3">
        <b class="address-title pb-2">Dodavatel:</b><br>
        @include('business::admin.task.export.invoice.address', ['address' => $invoice->getMyData()])
        <br><br>
        <div class="pb-3">
            Datum vystavení: <b>{{ $invoice->getDateInvoiced()->format('d.m.Y') }}</b>
        </div>
    </div>
    <div class="col col-6 pt-3">
        <b class="address-title pb-2">Fakturační adresa:</b><br>
        @include('business::admin.task.export.invoice.address', ['address' => $invoice->getTheirData()])
        <br><br>
        <div class="pb-3">
            Datum splatnosti: <b>{{ $invoice->getDatePayed()->format('d.m.Y') }}</b>
        </div>
    </div>
</div>