<?php

namespace App\Providers\Grid\Column\Type;

use App\Providers\Grid\Column\Type;
/**
 * Description of Text
 *
 * @author windigo
 */
class Text extends Type {

    protected $type_name = 'text';

    public function render($value): ?string {
        return parent::render($value);
    }

}
