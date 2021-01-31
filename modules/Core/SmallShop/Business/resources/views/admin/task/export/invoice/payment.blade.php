<div class="row payment">
    <div class="col-1 my-side-tabs inverse"><span>Platební údaje</span></div>
    <div class="col col-9 pr-5 inverse">
        <div class="row pt-3 pl-3">
            <div class="col-5 pl-1 text-left border-bottom" >Bankovní účet</div>
            <div class="col-2 pl-0 text-left border-bottom" >Var. symbol</div>
            <div class="col-2 pl-0 text-left border-bottom" >Konst. symbol</div>
            <div class="col-3 pl-0 text-right border-bottom">K úhradě</div>
        </div>
        <div class="row p-1">
            @if($me->getBank() !== null)
            <div class="col-5 text-left" ><b>{{ $me->getBank()->getAccountNr() }}</b></div>
            <div class="col-2 pl-2 text-left" ><b>{{ $me->getBank()->getVs() }}</b></div>
            <div class="col-2 pl-2 text-left" ><b>{{ $me->getBank()->getKs() }}</b></div>
            <div class="col-3 pl-2 text-right"><b>{{ InvoiceUtils::format_price($invoice->getSum()) }} Kč</b></div>
            @endif
        </div>
        <div class="row p-1">
            <div class="col-2">IBAN:</div>
            <div class="col-10"><b>{{ $me->getBank()->getIban() }}</b></div>
        </div>
        <div class="row p-1">
            <div class="col-2">SWIFT:</div>
            <div class="col-7"><b>{{ $me->getBank()->getSwift() }}</b></div>
            <div class="col-3 text-right text-nowrap">Způsob platby: Převodem</div>
        </div>

        <div class="arrow"></div>
        <div class="arrow bot"></div>
    </div>
    <div class="col col-2 inverse p-0">
        <img src="{{ $invoice->getPaymentQrPng()}}" class="qr_code">
    </div>
</div>