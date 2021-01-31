<?php

namespace Modules\Core\SmallShop\Business\Services\Invoice;

class UserInfo {
    protected string  $name;
    protected string  $address;
    protected string  $ico;
    protected ?string $dic;
    protected ?Bank   $bank;
    protected ?string $email;
    protected ?string $phone;

    public function __construct(
        string  $name,
        string  $address,
        string  $ico,
        ?string $dic        = null,
        ?Bank   $bank       = null,
        ?string $email      = null,
        ?string $phone      = null
    ) {
        $this->name    = $name;
        $this->address = $address;
        $this->ico     = $ico;
        $this->dic     = $dic;
        $this->bank    = $bank;
        $this->email   = $email;
        $this->phone   = $phone;
    }

    public function getName   (): string  { return $this->name;    }
    public function getAddress(): string  { return $this->address; }
    public function getIco    (): string  { return $this->ico;     }
    public function getDic    (): ?string { return $this->dic;     }
    public function getBank   (): ?Bank   { return $this->bank;    }
    public function getEmail  (): ?string { return $this->email;   }
    public function getPhone  (): ?string { return $this->phone;   }

    public static function fromArray(array $data) {
        return new UserInfo(
            $data['name'],
            $data['address'],
            $data['ico'],
            $data['dic'],
            isset($data['bank']) ? Bank::fromArray($data['bank']) : null,
            isset($data['email']) ? $data['email'] : null,
            isset($data['phone']) ? $data['phone'] : null
        );
    }
}
