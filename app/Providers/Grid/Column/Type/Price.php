<?php

namespace App\Providers\Grid\Column\Type;

use App\Providers\Grid\Column\Type;

/**
 * Description of Price
 *
 * @author windigo
 */
class Price extends Number
{
    protected $type_name = 'price';

    public function render($value, \Illuminate\Database\Eloquent\Model $row)
    {
        /* @var $row \App\Model\Order */
        $val = parent::render($value, $row);
        $frm = new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY);

        return $frm->formatCurrency($val, $row->currency ? $row->currency->code : config('app.default_currency'));
    }
}
