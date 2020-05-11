<?php

namespace App\Providers\Grid\Column\Type;

use App\Providers\Grid\Column\Type;

/**
 * Description of Price
 *
 * @author windigo
 */
class ID extends Number
{
    protected $type_name = 'id';

    protected bool $orderable  = true;
    protected bool $filterable = false;

    protected ?string $columnClass = 'slim text-right';

    public function __construct(
        string $name,
        string $label,
        ?string $columnClass = null,
        ?string $orderColumn = null,
        ?string $selectColumn = null,
        ?callable $render = null,
        ?bool $orderable = null,
        ?bool $filterable = null
    ) {
//        dump(parent::getColumnClass());
        parent::__construct($name, $label, $columnClass, $orderColumn, $selectColumn, $render, $orderable, $filterable);
    }
}
