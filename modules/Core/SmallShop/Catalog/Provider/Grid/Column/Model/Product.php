<?php
namespace Modules\Core\SmallShop\Catalog\Provider\Grid\Column\Model;

use App\Providers\Grid\Columns;
use App\Providers\Grid\Column\Type;
use Illuminate\Database\Eloquent;
use Modules\Core\SmallShop\Catalog\Model\Product as ProductModel;

/**
 * Description of ProductGridColumns
 *
 * @author windigo
 */
class Product extends Columns
{
    public function initColumns(): void
    {
        $deleteQuestion = __('Are you sure?');
        $this->items = [
            app(Type\BulkAction::class, ['name' => 'bulk_action', 'enabled_actions' => ['edit', 'delete']]),
            app(Type\ID::class, ['name' => 'id', 'label' => '#', 'columnClass' => 'slim']),
            app(Type\Text::class, [
                'name' => 'title',
                'label' => __('catalog::product.Title'),
                'render' => function ($value, ProductModel $row) {
                    return __('link', ['route' => route('admin.catalog.products.show', ['product' => $row]), 'label' => $value]);
                }
            ]),
            app(Type\Text::class,  ['name' => 'seo_name',   'label' => __('catalog::product.SEO')]),
            app(Type\Price::class, ['name' => 'price',      'label' => __('catalog::product.Price')]),
            app(Type\Date::class,  ['name' => 'created_at', 'label' => __('catalog::product.Created'), 'columnClass' => 'text-right']),
            app(Type\Date::class,  ['name' => 'updated_at', 'label' => __('catalog::product.Updated'), 'columnClass' => 'text-right']),
            app(Type\Action::class, [
                'name' => 'action',
                'actions' => [
                    'edit'   => [
                        'color' => 'info',
                        'icon' => 'pen',
                        'route' => ['route_name' => 'admin.catalog.products.edit', 'attrs' => ['product']],
                    ],
                    'delete' => [
                        'color' => 'danger',
                        'icon' => 'trash',
                        'route' => ['route_name' => 'admin.catalog.products.destroy', 'attrs' => ['product']],
                        'confirm' => function (Eloquent\Model $item) use ($deleteQuestion) {
                            return "deleteItem('{$deleteQuestion}', {$item->id}, 'confirmForm', \$event)";
                        }
                    ]
                ]
            ]),
        ];

    }
}
