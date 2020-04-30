<?php
namespace App\Providers\Grid;

use App\Providers\Grid\Column\Type as ColumnType;
use App\Providers\Grid\Column\Type\Text as ColumnTypeText;
use Illuminate\Http\Request;

/**
 * Description of Column
 *
 * @author windigo
 */
class Column
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
     * @var ColumnType
     */
    protected ColumnType $type;
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
    protected ?string $filter;
    protected ?string $orderColumn;
    protected ?string $selectColumn;
    protected ?string $selectName;

    public function __construct(
        string $name,
        string $label,
        string $type,
        ?string $orderColumn = null,
        ?string $selectColumn = null,
        ?callable $render = null,
        ?bool $orderable = true,
        ?bool $filterable = true
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->orderable = $orderable;
        $this->filterable = $filterable;
        $this->orderColumn = $orderColumn;
        $this->selectColumn = $selectColumn;
        $this->type = app($type, ['renderer' => $render]);
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
     */
    public function render(string $column_name, \Illuminate\Database\Eloquent\Model $row): ?string
    {
        $value = $row->$column_name;
        return $this->type->render($value, $row);
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
