<?php

namespace App\Providers\Grid\Column\Type;

use App\Providers\Grid\Column\Type;
use Illuminate\Support\Carbon;

/**
 * Description of Number
 *
 * @author windigo
 */
class Date extends Type
{
    protected $type_name = 'number';

    /**
     *
     * @param \DateTime $value
     * @return string|null
     */
    public function render($value): ?string
    {
        $value = parent::render($value);

        if (!$value) {
            return '-';
        }
        if (!($value instanceof Carbon)) {
            $value = Carbon::parse($value);
        }

        return $value->toDayDateTimeString();
    }
}
