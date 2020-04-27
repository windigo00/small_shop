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
            ['name' => 'id',          'label' => '#',                   'type' => Type\Number::class],
            ['name' => 'order_nr',    'label' => trans('Order number'), 'type' => Type\Number::class],
            ['name' => 'customer',    'label' => trans('Customer'),     'type' => Type\Text::class  , 'orderColumn' => 'CONCAT(customer.first_name,\' \',customer.last_name)', 'render' => function (Customer $value) {
                return $value->fullName();
            }],
            ['name' => 'status',      'label' => trans('Status'),       'type' => Type\Text::class  , 'orderColumn' => 'status.label', 'render' => function (Status $value) {
                return $value->label;
            }],
            ['name' => 'card',        'label' => trans('Card'),         'type' => Type\Text::class  , 'orderColumn' => 'card.number', 'render' => function (Card $value = null) {
                return $value ? $value->number : '-';
            }],
            ['name' => 'price',       'label' => trans('Price'),        'type' => Type\Price::class ],
            ['name' => 'created_at',  'label' => trans('Created'),      'type' => Type\Date::class  ],
            ['name' => 'updated_at',  'label' => trans('Updated'),      'type' => Type\Date::class  ],
            ['name' => 'action',      'label' => trans('Action'),       'type' => Type\Text::class  , 'orderable' => false, 'filterable' => false],
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
