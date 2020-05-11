<?php

namespace App\Providers\Grid\Column\Type;

use App\Providers\Grid\Column\Type;

/**
 * Description of Number
 *
 * @author windigo
 */
class Number extends Type
{
    protected $type_name = 'number';
    protected ?string $columnClass = 'text-right';
}
