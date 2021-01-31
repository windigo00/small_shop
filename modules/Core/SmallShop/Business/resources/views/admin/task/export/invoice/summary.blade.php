<div class="row">
    <div class="col-1 my-side-tabs"><span>Shrnutí</span></div>
    <div class="col col-3 pt-3">Razítko a podpis:</div>
    <div class="col col-5 pt-3 text-right"><b class="text-lg">Celková částka:</b></div>
    <div class="col col-3 pt-3 text-right"><b class="text-lg">{{ InvoiceUtils::format_price($invoice->getSum()) }} Kč</b></div>
</div>
