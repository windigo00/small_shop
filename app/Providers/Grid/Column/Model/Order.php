<?php
namespace App\Providers\Grid\Column\Model;

use App\Providers\Grid\Column;
use App\Providers\Grid\Columns;
use App\Model\Customer;
use App\Model\Card;
use App\Model\Order\Status;
use App\Providers\Grid\Column\Type;
use Illuminate\Database\Eloquent;

/**
 * Description of OrderGridColumns
 *
 * @author windigo
 */
class Order extends Columns
{
    protected $model = \App\Model\Order::class;

    public function initColumns(): void
    {
        $this->items = [
            [
                'name' => 'bulk_action',
                'label' => '',
                'type' => Type\Text::class  ,
                'orderable' => false,
                'filterable' => false,
                'enabled_actions' => ['print']
            ],
            ['name' => 'id',          'label' => '#', 'type' => Type\Number::class],
            ['name' => 'order_nr',    'label' => __('Number'), 'type' => Type\Number::class, 'render' => function ($value, \App\Model\Order $row) {
                return __('link', ['route' => route('admin.sales.orders.show', ['order' => $row]), 'label' => $value]);
            }],
            ['name' => 'customer',    'label' => __('Customer'),     'type' => Type\Text::class  , 'orderColumn' => 'CONCAT(customer.first_name,\' \',customer.last_name)', 'render' => function (Customer $value) {
                return $value->fullName();
            }],
            [
                'name' => 'status',
                'label' => __('Status'),
                'type' => Type\Text::class,
                'orderColumn' => 'status.label',
                'render' => function (Status $value) {
                    return __($value->label);
                }
            ],
            ['name' => 'card',        'label' => __('Gift Card'),         'type' => Type\Text::class  , 'orderColumn' => 'card.number', 'render' => function (Card $value = null) {
                return $value ? $value->number : '-';
            }],
            ['name' => 'price',       'label' => __('Price'),        'type' => Type\Price::class ],
            ['name' => 'created_at',  'label' => __('Created'),      'type' => Type\Date::class  ],
            ['name' => 'updated_at',  'label' => __('Updated'),      'type' => Type\Date::class  ],
            ['name' => 'action',      'label' => __('Action'),       'type' => Type\Text::class  , 'orderable' => false, 'filterable' => false],
        ];

        $this->actions = [
            'print'  => [
                'color' => 'primary',
                'icon' => 'print',
                'route' => function (Eloquent\Model $item) {
                    return route('admin.sales.orders.print', ['order' => $item]);
                },
            ],
        ];
    }
}
