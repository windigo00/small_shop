<?php

namespace App\Providers\Grid\Column\Type;

use App\Providers\Grid\Column\Type;

/**
 * Description of Obj
 *
 * @author windigo
 */
class BulkAction extends Action
{
    protected $type_name = 'bulk_action';

    protected ?string $columnClass = 'slim bulk';
    protected array $enabled_actions = [];

    public function __construct(string $name, ?string $columnClass = null, ?array $enabled_actions = [], ?callable $render = null)
    {
        $this->enabled_actions = $enabled_actions;
        parent::__construct($name, '', $columnClass, $render);
    }
}
