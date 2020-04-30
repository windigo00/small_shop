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
            [
                'name' => 'bulk_action',
                'label' => '',
                'type' => Type\Text::class  ,
                'orderable' => false,
                'filterable' => false,
                'enabled_actions' => ['edit', 'delete']
            ],
            ['name' => 'id',          'label' => '#',              'type' => Type\Number::class],
            ['name' => 'title',       'label' => __('Title'),   'type' => Type\Text::class  , 'render' => function ($value, \App\Model\Product $row) {
                return __('link', ['route' => route('admin.products.show', ['product' => $row]), 'label' => $value]);
            }],
            ['name' => 'seo_name',    'label' => __('SEO'),     'type' => Type\Text::class  ],
            ['name' => 'price',       'label' => __('Price'),   'type' => Type\Price::class ],
            ['name' => 'created_at',  'label' => __('Created'), 'type' => Type\Date::class  ],
            ['name' => 'updated_at',  'label' => __('Updated'), 'type' => Type\Date::class  ],
            ['name' => 'action',      'label' => __('Action'),  'type' => Type\Text::class  , 'orderable' => false, 'filterable' => false],
        ];

        $deleteQuestion = __('Are you sure?');

        $this->actions = [
            'edit'   => [
                'color' => 'info',
                'icon' => 'pen',
                'route' => ['route_name' => 'admin.products.edit', 'attrs' => ['product']],
            ],
            'delete' => [
                'color' => 'danger',
                'icon' => 'trash',
                'route' => ['route_name' => 'admin.products.destroy', 'attrs' => ['product']],
                'confirm' => function (Eloquent\Model $item) use ($deleteQuestion) {
                    return "deleteItem('{$deleteQuestion}', {$item->id}, 'confirmForm')";
                }
            ]
        ];
    }
}
