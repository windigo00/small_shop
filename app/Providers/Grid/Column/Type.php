<?php
namespace App\Providers\Grid\Column;

/**
 * Description of Type
 *
 * @author windigo
 */
abstract class Type
{
    protected $type_name ;
    protected $renderer ;

    public function __construct(callable $renderer = null)
    {
        $this->renderer = $renderer;
    }

    public static function get($type_name)
    {
        return app('\\'. __NAMESPACE__ .'\\Type\\'. ucfirst($type_name));
    }

    public function render($value)
    {
        if ($this->renderer !== null) {
            $value = $this->renderer->call($this, $value);
        }
        return $value;
    }
}
