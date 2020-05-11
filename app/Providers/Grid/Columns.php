<?php
namespace App\Providers\Grid;

use Illuminate\Http\Request;

/**
 * Description of GridColumns
 *
 * @author windigo
 */
abstract class Columns implements \Countable, \IteratorAggregate
{

    /**
     * Columns definitions
     *
     * @var array
     */
    protected array $items = [];
    /**
     * Columns names filtered from definitions (cache)
     *
     * @var array
     */
    protected array $names = [];
    /**
     *
     * @var Request
     */
    protected Request $request;
    /**
     * Row Actions
     *
     * @var array
     */
    protected array $actions = [];

    /**
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->initColumns();
        $this->initNames($request);
    }
    /**
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }
    /**
     *
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }
    /**
     *
     * @param Request $request
     * @return void
     */
    protected function initNames(Request $request): void
    {
        foreach ($this->items as $idx => $column) {
            if (is_array($column)) {
//                debug(get_class($this) .' `initColumns` is in old array format. consider to change it to factory initiation.');
                $this->items[$idx] = $column = self::createColumn($column);
            }
            $column->checkOrder($request->input(config('view.sort_attribute')));

            $this->names[$idx] = $column->getName();
        }
    }
    /**
     *
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     *
     * @return array
     */
    public function getNames(): array
    {
        return $this->names;
    }

    /**
     *
     * @return array
     */
    public function getColumns(): array
    {
        return $this->items;
    }

    public function getColumn(string $name): ?Column\Type
    {
        $key = array_search($name, $this->names);
        if ($key === false) {
            return null;
        }
        return $this->items[$key];
    }

    abstract protected function initColumns(): void;

    /**
     *
     * @param array $columnConfig
     * @return Column\Type
     */
    public static function createColumn(array $columnConfig): Column\Type
    {
        $type = $columnConfig['type'];
        unset($columnConfig['type']);
        return app($type, $columnConfig);
    }
}
