<?php

namespace Modules\Core\SmallShop\Business\Services\Invoice;

class Item
{
    protected string $title;
    protected float  $amount;
    protected string $unit;
    protected float  $unit_price;

    public function __construct(
        string $title,
        float  $amount,
        string $unit,
        float  $unit_price
    ) {
        $this->title      = $title;
        $this->amount     = $amount;
        $this->unit       = $unit;
        $this->unit_price = $unit_price;
    }

    public function getTitle()    : string { return $this->title;      }
    public function getAmount()   : float  { return $this->amount;     }
    public function getUnit()     : string { return $this->unit;       }
    public function getUnitPrice(): float  { return $this->unit_price; }

    public function setTitle    (string $value): void { $this->title      = $value; }
    public function setAmount   (float  $value): void { $this->amount     = $value; }
    public function setUnit     (string $value): void { $this->unit       = $value; }
    public function setUnitPrice(float  $value): void { $this->unit_price = $value; }

    public function finalPrice(): float
    {
        return $this->amount * $this->unit_price;
    }

    public static function fromArray(array $data) {
        return new Item(
            $data['title'],
            $data['amount'],
            $data['unit'],
            $data['unit_price']
        );
    }
}
