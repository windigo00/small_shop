<?php

namespace Modules\Core\SmallShop\Business\Services\Export;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Modules\Core\SmallShop\Business\Services\Invoice;

class ExportInvoice implements FromView
{
    protected \DateTime $date;
    protected array $data;
    protected array $parameters;

    public function __construct(\DateTime $date, array $data, array $parameters)
    {
        $this->date = $date;
        $this->data = $data;
        $this->parameters = $parameters;
    }

    public function view(): View
    {
        $date = date_create();

        return view('business::admin.task.export.invoice', [
            'invoice' => Invoice::createFromArray([
                "invoiceNumber" => $this->parameters['vs'],
                "date_created" => $date->getTimestamp(),
                "date_invoiced" => $date->format('d.m.Y'),
                "date_payed" => $date->modify('first day of next month')->modify('+20 days')->format('d.m.Y'),
                "me" => [
                    "name" => "Jakub Kuriš",
                    "address" => "Bezměrov 111, 767 01 Bezměrov \nČeská republika",
                    "ico" => "09130489",
                    "dic" => null,
                    "bank" => [
                        "account_nr" => "670100-2206938677/6210",
                        "iban" => "CZ60 6210 6701 0022 0693 8677",
                        "swift" => "BREXCZPP",
                        "vs" => $this->parameters['vs'],
                        "ks" => "0308"
                    ],
                    "email" => "jakub.kuris@gmail.com",
                    "phone" => "+420 603 701 601"
                ],
                "them" => [
                    "name" => "Valatron s.r.o.",
                    "address" => "Táborská 940/31, 140 00 Praha \nČeská republika",
                    "ico" => "04649311",
                    "dic" => "CZ04649311"
                ],
                "items" => [
                    [
                        "title" => "Poradenské a konzultační služby v oblasti vývoje software",
                        "amount" => $this->data['sum'],
                        "unit" => "h",
                        "unit_price" => $this->parameters['itemValue']
                    ]
                ]
            ])
        ]);
    }
}
