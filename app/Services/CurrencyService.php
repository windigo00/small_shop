<?php
namespace App\Services;

use App\Model\Currency;

/**
 * Description of CurrencyService
 *
 * @author windigo
 */
class CurrencyService {
    /**
     *
     * @var string
     */
    private $default_currency_code;
    /**
     *
     * @var Currency
     */
    private $default_currency;
    /**
     *
     * @param string $default_currency_code
     */
    public function __construct(string $default_currency_code)
    {
        $this->default_currency_code = $default_currency_code;
    }
    /**
     *
     * @return Currency
     */
    public function getDefaultCurrency(): Currency
    {
        if ($this->default_currency === null) {
            $this->default_currency = Currency::query()->where('code', '=', 'CZK')->first();
        }
        return $this->default_currency;
    }
}
