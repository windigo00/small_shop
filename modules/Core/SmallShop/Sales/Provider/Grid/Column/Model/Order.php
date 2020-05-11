<?php
namespace Modules\Core\SmallShop\Sales\Provider\Grid\Column\Model;

use App\Providers\Grid\Columns;
use Modules\Core\SmallShop\Customer\Model\Customer;
use Modules\Core\SmallShop\Customer\Model\Card;
use Modules\Core\SmallShop\Sales\Model\Order as OrderModel;
use Modules\Core\SmallShop\Sales\Model\Order\Status;
use App\Providers\Grid\Column\Type;
use Illuminate\Database\Eloquent;

/**
 * Description of OrderGridColumns
 *
 * @author windigo
 */
class Order extends Columns
{
    protected $model = OrderModel::class;

    public function initColumns(): void
    {
        $this->items = [
            app(Type\BulkAction::class, [
                'name' => 'bulk_action',
                'label' => '',
                'orderable' => false,
                'filterable' => false,
                'enabled_actions' => ['print']
            ]),
            app(Type\ID::class, ['name' => 'id','label' => '#']),
            app(Type\Text::class, [
                'name' => 'order_nr',
                'label' => __('Number'),
                'render' => function ($value, OrderModel $row) {
                    return __('link', ['route' => route('admin.sales.orders.show', ['order' => $row]), 'label' => $value]);
                }
            ]),
            app(Type\Text::class, [
                'name' => 'customer',
                'label' => __('Customer'),
                'orderColumn' => 'CONCAT(customer.first_name,\' \',customer.last_name)',
                'render' => function (Customer $value) {
                    return $value->fullName();
                }
            ]),
            app(Type\Text::class, [
                'name' => 'status',
                'label' => __('Status'),
                'orderColumn' => 'status.label',
                'render' => function (Status $value) {
                    return __($value->label);
                }
            ]),
            app(Type\Text::class, [
                'name' => 'card',
                'label' => __('Gift Card'),
                'orderColumn' => 'card.number',
                'render' => function (Card $value = null) {
                    return $value ? $value->number : '-';
                }
            ]),
            app(Type\Price::class, [
                'name' => 'price',
                'label' => __('Price')
            ]),
            app(Type\Date::class, ['name' => 'created_at',  'label' => __('Created')]),
            app(Type\Date::class, ['name' => 'updated_at',  'label' => __('Updated')]),
            app(Type\Action::class, [
                'name' => 'action',
                'label' => '',
                'actions' => [
                    'print'  => [
                        'color' => 'primary',
                        'icon' => 'print',
                        'route' => function (Eloquent\Model $item) {
                            return route('admin.sales.orders.print', ['order' => $item]);
                        },
                    ],
                ]
            ]),
        ];

    }
}
