<?php
namespace App\Providers\Grid;

use App\Providers\Grid\Column\Type as ColumnType;
use App\Providers\Grid\Column\Type\Text as ColumnTypeText;

/**
 * Description of Column
 *
 * @author windigo
 */
class Column {
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

    protected $orderable = true;
    protected $order = true;//true: ascending, false: descending
    protected $filterable = true;

    public function __construct(
        string $name,
        string $label,
        string $type,
        callable $render = null,
        bool $orderable = true,
        bool $is_ordered = false,
        bool $filterable = true
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->orderable = $orderable;
        $this->isOrdered = $is_ordered;
        $this->filterable = $filterable;
        $this->type = app($type, ['renderer' => $render]);
    }
    /**
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
    /**
     *
     * @return string
     */
    public function getLabel(): string {
        return $this->label;
    }
    /**
     *
     * @return ColumnType
     */
    public function getType(): ColumnType {
        return $this->type;
    }
    /**
     *
     * @return bool
     */
    public function isOrderable(): bool {
        return $this->orderable;
    }
    /**
     *
     * @return bool
     */
    public function isOrdered(): bool {
        return $this->isOrdered;
    }
    /**
     * true: ascending, false: descending
     *
     * @return bool
     */
    public function getOrder(): bool {
        return $this->order;
    }
    /**
     *
     * @return bool
     */
    public function isFilterable(): bool {
        return $this->filterable;
    }
    /**
     *
     * @param mixed $value
     * @return string|null
     */
    public function render($value): ?string {
        return $this->type->render($value);
    }

}
