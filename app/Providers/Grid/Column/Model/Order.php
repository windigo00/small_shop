<?php
namespace App\Providers\Grid\Column\Model;
use App\Providers\Grid\Column;
use App\Providers\Grid\Columns;
use App\Model\Customer;
use App\Model\Card;
use App\Model\Order\Status;
use App\Providers\Grid\Column\Type;

/**
 * Description of OrderGridColumns
 *
 * @author windigo
 */
class Order extends Columns {

    public function initColumns(): void {
        $this->items = [
            ['name' => 'id',          'label' => '#',                   'type' => Type\Number::class],
            ['name' => 'order_nr',    'label' => trans('Order number'), 'type' => Type\Number::class],
            ['name' => 'customer',    'label' => trans('Customer'),     'type' => Type\Text::class  , 'render' => function(Customer $value)    { return $value->fullName(); }],
            ['name' => 'status',      'label' => trans('Status'),       'type' => Type\Text::class  , 'render' => function(Status $value)      { return $value->label; }],
            ['name' => 'card',        'label' => trans('Card'),         'type' => Type\Text::class  , 'render' => function(Card $value = null) { return $value ? $value->number : '-'; }],
            ['name' => 'price',       'label' => trans('Price'),        'type' => Type\Price::class ],
            ['name' => 'created_at',  'label' => trans('Created'),      'type' => Type\Date::class  ],
            ['name' => 'updated_at',  'label' => trans('Updated'),      'type' => Type\Date::class  ],
            ['name' => 'action',            'label' => trans('Action'),  'type' => Type\Text::class  , 'orderable' => false, 'filterable' => false],
        ];
    }

}
