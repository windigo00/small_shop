<?php

namespace Modules\Core\SmallShop\Business\Services\Invoice;

class Bank {
    protected string $account_nr;
    protected string $iban;
    protected string $swift;
    protected string $vs;
    protected string $ks;

    public function getAccountNr() :string { return  $this->account_nr; }
    public function getIban()      :string { return  $this->iban;       }
    public function getSwift()     :string { return  $this->swift;      }
    public function getVs()        :string { return  $this->vs;         }
    public function getKs()        :string { return  $this->ks;         }

    public function setAccountNr(string $account_nr) { $this->account_nr = $account_nr; }
    public function setIban     (string $iban)       { $this->iban       = $iban;       }
    public function setSwift    (string $swift)      { $this->swift      = $swift;      }
    public function setVs       (string $vs)         { $this->vs         = $vs;         }
    public function setKs       (string $ks)         { $this->ks         = $ks;         }

    public function __construct(
            string $account_nr,
            string $iban,
            string $swift,
            string $vs,
            string $ks
    ) {
        $this->account_nr = $account_nr;
        $this->iban       = $iban;
        $this->swift      = $swift;
        $this->vs         = $vs;
        $this->ks         = $ks;
    }

    public static function fromArray(array $data) {
        return new Bank(
            $data['account_nr'],
            $data['iban'],
            $data['swift'],
            !isset($data['vs']) ? '' : $data['vs'],
            !isset($data['ks']) ? '' : $data['ks']
        );
    }
}
