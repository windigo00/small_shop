<?php

namespace App\Providers\Grid\Column\Type;

use App\Providers\Grid\Column\Type;
/**
 * Description of Number
 *
 * @author windigo
 */
class Date extends Type {

    protected $type_name = 'number';

    /**
     *
     * @param \DateTime $value
     * @return string|null
     */
    public function render($value): ?string {
        $value = parent::render($value);
        return $value instanceof \Illuminate\Support\Carbon ? $value->toDayDateTimeString() : '';
    }

}
