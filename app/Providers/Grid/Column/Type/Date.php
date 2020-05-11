<?php

namespace App\Providers\Grid\Column\Type;

use App\Providers\Grid\Column\Type;
use Illuminate\Support\Carbon;

/**
 * Description of Number
 *
 * @author windigo
 */
class Date extends Text
{
    protected $type_name = 'number';

    protected ?string $columnClass = 'text-right';

    /**
     *
     * @param \DateTime $value
     * @return string|null
     */
    public function render($value, \Illuminate\Database\Eloquent\Model $row): ?string
    {
        $value = parent::render($value, $row);

        if (!$value) {
            return '-';
        }
        if (!($value instanceof Carbon)) {
            $value = Carbon::parse($value);
        }

        return $value->locale(app()->getLocale())->isoFormat('ll');
    }
}
