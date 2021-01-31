<?php

namespace Modules\Core\SmallShop\Business\Services;

use Modules\Core\SmallShop\Business\Services\Invoice\UserInfo;

class Invoice {

    protected int $invoice_nr;
    protected \DateTime $date_created;
    protected \DateTime $date_invoiced;
    protected \DateTime $date_payed;
    protected UserInfo $my_data;
    protected UserInfo $their_data;
    protected array $items;
    protected float $sum;

    public function __construct(
        int $invoice_nr,
        \DateTime $date_created,
        \DateTime $date_invoiced,
        \DateTime $date_payed,
        UserInfo $my_data,
        UserInfo $their_data,
        array $items = [],
        float $sum = -9999999999999999.0
    ) {
        $this->invoice_nr    = $invoice_nr;
        $this->date_created  = $date_created;
        $this->date_invoiced = $date_invoiced;
        $this->date_payed    = $date_payed;
        $this->my_data       = $my_data;
        $this->their_data    = $their_data;
        $this->items         = $items;
        $this->sum           = $sum;
    }

    public function getInvoiceNr(): int {
        return $this->invoice_nr;
    }

    public function getDateCreated(): \DateTime {
        return $this->date_created;
    }

    public function getDateInvoiced(): \DateTime {
        return $this->date_invoiced;
    }

    public function getDatePayed(): \DateTime {
        return $this->date_payed;
    }

    public function getMyData(): UserInfo {
        return $this->my_data;
    }

    public function getTheirData(): UserInfo {
        return $this->their_data;
    }

    public function getItems(): array {
        return $this->items;
    }

    public function getSum(): float {
        if ($this->sum <= 0) {
            $sum = 0;
            foreach ($this->items as $item) {
                $sum += $item->finalPrice();
            }
            $remainder = $sum - floor($sum);
            if ($remainder > 0) {
                $this->items[] = new Invoice\Item('Zaokrouhlení', -1, '', $remainder);
                $sum = floor($sum);
            }
            $this->sum = $sum;

//            $invoiceAttrs['payment'] = base64_encode(json_encode([
//                'me' => $invoiceAttrs['me'],
//                'sum' => $invoiceAttrs['sum'],
//            ]));
        }

        return $this->sum;
    }

    public function getBarcodePng(): string {
        return Invoice\Utils::bar_code_base64($this->getInvoiceNr());
    }
    
    public function getBarcodePath(): string {
        $image = Invoice\Utils::bar_code($this->getInvoiceNr());
        if (!file_exists(storage_path('temp'))) {
            mkdir(storage_path('temp'));
        }
        $path = storage_path('temp/'.$this->getInvoiceNr().'_bar.png');
        file_put_contents($path, $image);
        return $path;
    }

    protected function getQRData(): string {
        $iban = 'XXXX XXXX XXXX XXXX XXXX';
        $swift = 'CZXXXXXXX';
        $vs = '9999999';
        $ks = '0308';
        if ($this->getMyData()->getBank()) {
            $iban = str_replace(' ', '', $this->getMyData()->getBank()->getIban());
            $swift = $this->getMyData()->getBank()->getSwift();
            $vs = $this->getMyData()->getBank()->getVs();
            $ks = $this->getMyData()->getBank()->getKs();
        } else {
        }
        $msg = $vs . ' ' . $this->getMyData()->getName();
        $amount = $this->getSum();

        // and dump the output
        $data = "SPD*1.0*ACC:{$iban}+{$swift}*AM:{$amount}*CC:CZK*MSG:{$msg}*X-VS:{$vs}*X-KS:{$ks}";
        //*X-INV:SID%2A1.0%2AID:20200002%2ADD:20200630%2AMSG:Poradenské a konzultacní sluzby v oblast%2AINI:09130489%2AVIR:CZ04649311%2AINR:04649311%2ADUZP:20200630%2ADPPD:20200630%2ADT:20200720%2ANTB:57038.00
        return $data;
    }
    public function getPaymentQrPath(): string {
        $image = Invoice\Utils::qr_code($this->getQRData());
        if (!file_exists(storage_path('temp'))) {
            mkdir(storage_path('temp'));
        }
        $path = storage_path('temp/'.$this->getInvoiceNr().'_qr.png');
        file_put_contents($path, $image);
        return $path;
    }
    public function getPaymentQrPng(): string {
        return Invoice\Utils::qr_code_base64($this->getQRData());
    }

    public static function createFromJson(int $invoice_nr, string $data): Invoice {
        $data = json_decode($data, true);
        $data['invoiceNumber'] = $invoice_nr;
        return self::createFromArray($data);
    }
    public static function createFromArray(array $data): Invoice
    {
        $invoice = new Invoice(
            $data['invoiceNumber'],
            date_create()->setTimestamp($data['date_created']),
            date_create($data['date_invoiced']),
            date_create($data['date_payed']),
            UserInfo::fromArray($data['me']),
            UserInfo::fromArray($data['them']),
            self::prepareItems($data['items'])
        );
        return $invoice;
    }

    public static function prepareItems(array $items): array {
        foreach ($items as $k => $item) {
            $items[$k] = Invoice\Item::fromArray($item);
        }
        return $items;
    }
}
