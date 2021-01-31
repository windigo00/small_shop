<div class="row sum">
    <div class="col-1 my-side-tabs"><span>Fakturujeme vám</span></div>
    <div class="col col-11">
        <p class="mt-2 pb-2 mt-3">Fakturujeme Vám za dodané služby:</p>
        <table class="table table-sm mb-0" width="100%">
            <thead>
                <tr>
                    <th class="text-left">Označení dodávky</th>
                    <th class="text-right">Počet</th>
                    <th class="text-left">m. j.</th>
                    <th class="text-right">Cena za m.j.</th>
                    <th class="text-right">Celkem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td align="left">{{ $item->getTitle() }}</td>
                    <td align="right">{{ InvoiceUtils::format_price($item->getAmount()) }}</td>
                    <td align="left">{{ $item->getUnit() }}</td>
                    <td align="right">{{ InvoiceUtils::format_price($item->getUnitPrice()) }}</td>
                    <td align="right"><b>{{ InvoiceUtils::format_price($item->finalPrice()) }}</b></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
