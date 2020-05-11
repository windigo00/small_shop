<?php
namespace App\Providers\Grid\Column;

/**
 * Description of Type
 *
 * @author windigo
 */
abstract class Type
{
    /**
     *
     * @var string
     */
    protected string $name;
    /**
     *
     * @var string
     */
    protected string $label;

    /**
     *
     * @var callable
     */
    protected $renderer;

    protected bool $orderable = true;
    protected bool $ordered = false;
    protected bool $order = true;//true: ascending, false: descending
    protected bool $filterable = true;
    protected bool $filtered = false;
    protected ?string $filter = null;
    protected ?string $orderColumn = null;
    protected ?string $selectColumn = null;
    protected ?string $selectName = null;
    protected ?string $columnClass = null;

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
//        dump(func_get_args());
        $this->name         = $name;
        $this->label        = $label;
        $this->renderer     = $render      !== null ? $render       : $this->renderer;
        $this->orderable    = $orderable   !== null ? $orderable    : $this->orderable;
        $this->filterable   = $filterable  !== null ? $filterable   : $this->filterable;
        $this->orderColumn  = $orderColumn !== null ? $orderColumn  : $this->orderColumn;
        $this->selectColumn = $selectColumn!== null ? $selectColumn : $this->selectColumn;
        if ($columnClass) {
            if ($this->columnClass) {
                $this->columnClass .= ' ' . $columnClass;
            } else {
                $this->columnClass = $columnClass;
            }
        }
    }
    /**
     *
     * @return string[]
     */
    public function getData(): array
    {
        return [
            'name'          => $this->name,
            'label'         => $this->label,
            'orderable'     => $this->orderable,
            'ordered'       => $this->ordered,
            'order'         => $this->order,
            'filterable'    => $this->filterable,
            'filtered'      => $this->filtered,
            'filter'        => $this->filter,
        ];
    }

    public function render($value, \Illuminate\Database\Eloquent\Model $row)
    {
        if (is_callable($this->renderer)) {
            $value = $this->renderer->call($this, $value, $row);
        }
        return $value;
    }

    /**
     * Get names for buider select
     *
     * @return string
     */
    public function getSelectName(): string
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     *
     * @return string|null
     */
    public function getColumnClass(): ?string
    {
        return $this->columnClass;
    }
    /**
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }
    /**
     *
     * @return string|null
     */
    public function getOrderColumn(): ?string
    {
        return $this->orderColumn;
    }
    /**
     *
     * @return string|null
     */
    public function getSelectColumn(): ?string
    {
        return $this->selectColumn;
    }

    public function checkOrder(?array $sort = null): void
    {
        if (!$sort) {
            return;
        }
        if (is_array($sort) && !empty($sort)) {
            if ($this->orderColumn && isset($sort[$this->orderColumn])) {
                $this->ordered = true;
                $this->order = $sort[$this->orderColumn] == 'asc';
            } elseif (isset($sort[$this->name])) {
                $this->ordered = true;
                $this->order = $sort[$this->name] == 'asc';
            }
        }
    }
    /**
     *
     * @return ColumnType
     */
    public function getType(): ColumnType
    {
        return $this->type;
    }
    /**
     *
     * @return bool
     */
    public function isOrderable(): bool
    {
        return $this->orderable;
    }
    /**
     *
     * @return bool
     */
    public function isOrdered(): bool
    {
        return $this->ordered;
    }
    /**
     * true: ascending, false: descending
     *
     * @return bool
     */
    public function getOrder(): bool
    {
        return $this->order;
    }
    /**
     *
     * @return bool
     */
    public function isFilterable(): bool
    {
        return $this->filterable;
    }

    /**
     *
     * @param string $route_name
     * @param string[] $attrs
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return string
     */
    public function route(string $route_name, array $attrs = [], \Illuminate\Database\Eloquent\Model $model = null): string
    {
        if (!empty($attrs)) {
            return route($route_name, array_combine($attrs, [$model]));
        } else {
            return route($route_name);
        }
    }
}
