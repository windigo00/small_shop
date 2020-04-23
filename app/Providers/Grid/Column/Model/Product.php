<?php
namespace App\Providers\Grid\Column\Model;

use App\Providers\Grid\Column;
use App\Providers\Grid\Columns;
use App\Providers\Grid\Column\Type;

/**
 * Description of ProductGridColumns
 *
 * @author windigo
 */
class Product extends Columns {

    public function initColumns(): void {

        $this->items = [
            ['name' => 'id',          'label' => '#',              'type' => Type\Number::class],
            ['name' => 'title',       'label' => trans('Title'),   'type' => Type\Text::class  ],
            ['name' => 'seo_name',    'label' => trans('SEO'),     'type' => Type\Text::class  ],
            ['name' => 'price',       'label' => trans('Price'),   'type' => Type\Price::class ],
            ['name' => 'created_at',  'label' => trans('Created'), 'type' => Type\Date::class  ],
            ['name' => 'updated_at',  'label' => trans('Updated'), 'type' => Type\Date::class  ],
            ['name' => 'action',      'label' => trans('Action'),  'type' => Type\Text::class  , 'orderable' => false, 'filterable' => false],
        ];
    }
}
