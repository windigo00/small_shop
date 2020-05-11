<?php

namespace App\Providers\Grid\Column\Type;

use App\Providers\Grid\Column\Type;

/**
 * Description of Obj
 *
 * @author windigo
 */
class Action extends Text
{
    protected $type_name = 'action';

    protected bool $orderable  = false;
    protected bool $filterable = false;
    protected ?string $columnClass = 'slim actions text-right';
    protected ?array $actions = null;

    public function __construct(string $name, ?string $label = null, ?string $columnClass = null, ?callable $render = null, ?array $actions = null)
    {
        $this->actions = !$actions ? $this->actions : ($this->actions ? array_merge($this->actions, $actions) : $actions);
//        dump([$name, $label ?: __('Action')]);
        parent::__construct($name, $label ?: '', $columnClass, null, null, $render);
    }
    /**
     *
     * @return array
     */
    public function getActions(): array {
        return $this->actions ?: [];
    }
}
