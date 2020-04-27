<?php
namespace App\Providers\Grid\Column\Model;

use App\Providers\Grid\Columns;
use App\Providers\Grid\Column\Type;
use Illuminate\Database\Eloquent;

/**
 * Description of ProductGridColumns
 *
 * @author windigo
 */
class Product extends Columns
{
    public function initColumns(): void
    {
        $this->items = [
            ['name' => 'id',          'label' => '#',              'type' => Type\Number::class],
            ['name' => 'title',       'label' => trans('Title'),   'type' => Type\Text::class  ],
            ['name' => 'seo_name',    'label' => trans('SEO'),     'type' => Type\Text::class  ],
            ['name' => 'price',       'label' => trans('Price'),   'type' => Type\Price::class ],
            ['name' => 'created_at',  'label' => trans('Created'), 'type' => Type\Date::class  ],
            ['name' => 'updated_at',  'label' => trans('Updated'), 'type' => Type\Date::class  ],
            ['name' => 'action',      'label' => trans('Action'),  'type' => Type\Text::class  , 'orderable' => false, 'filterable' => false],
        ];

        $deleteQuestion = trans('Are you sure?');

        $this->actions = [
            'edit'   => [
                'color' => 'info',
                'icon' => 'pen',
                'route' => ['route_name' => 'admin.products.edit', 'attrs' => ['product']],
            ],
            'delete' => [
                'color' => 'danger',
                'icon' => 'times',
                'route' => ['route_name' => 'admin.products.destroy', 'attrs' => ['product']],
                'confirm' => function (Eloquent\Model $item) use ($deleteQuestion) {
                    return "deleteItem('{$deleteQuestion}', {$item->id}, 'confirmForm')";
                }
            ]
        ];
    }
}
