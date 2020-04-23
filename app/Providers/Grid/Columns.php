<?php
namespace App\Providers\Grid;

/**
 * Description of GridColumns
 *
 * @author windigo
 */
abstract class Columns implements \Countable, \IteratorAggregate {

    /**
     * Columns definitions
     *
     * @var array
     */
    protected $items = [];
    /**
     * Columns names filtered from definitions (cache)
     *
     * @var array
     */
    protected $names = [];

    /**
     *
     */
    public function __construct() {
        $this->initColumns();
        $this->initNames();
    }

//    public function __get(string $column_name): array {
//        return $this[$column_name];
//    }

    public function count(): int {
        return count($this->items);
    }

    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->items);
    }

    /**
     *
     * @param mixed $offset
     * @return bool
     */
//    public function offsetExists($offset): bool {
//        if (isset($this->items[$offset])) {// numeric index
//            return true;
//        }
//        if (array_search($offset, $this->names) !== false) {// string name index
//            return true;
//        }
//        return false;
//    }
    /**
     *
     * @param mixed $offset
     * @return array|null
     */
//    public function offsetGet($offset): ?array {
//        if (isset($this->items[$offset])) {// numeric index
//            return $this->items[$offset];
//        }
//        $key = array_search($offset, $this->names);// string name index
//        if ($key !== false) {
//            return $this->items[$key];
//        }
//        return null;
//    }
    /**
     *
     * @param mixed $offset
     * @param array $value
     * @return void
     */
//    public function offsetSet($offset, $value): void {
//        if (($offset*1) === $offset) {// numeric index
//            $this->items[$offset] = $value;
//            return;
//        }
//        $key = array_search($offset, $this->names);// string name index
//        if ($key !== false) {
//            $this->items[$key] = $value;
//            return;
//        }
//    }
    /**
     *
     * @param mixed $offset
     * @return void
     */
//    public function offsetUnset($offset): void {
//        if (($offset*1) === $offset) {// numeric index
//            unset($this->items[$offset]);
//            unset($this->names[$offset]);
//            return;
//        }
//        $key = array_search($offset, $this->names);// string name index
//        if ($key !== false) {
//            unset($this->items[$key]);
//            unset($this->names[$key]);
//            return;
//        }
//    }

    protected function initNames(): void {
        /* @var Column $column */
        foreach ($this->items as $idx => $column) {
            $this->items[$idx] = app(Column::class, $column);
            $this->names[$idx] = $this->items[$idx]->getName();
        }
    }

    protected abstract function initColumns(): void;

}
