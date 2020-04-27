<?php

namespace App\Providers\Grid\Column\Model;

use App\Providers\Grid\Column;
use App\Providers\Grid\Columns;
use App\Providers\Grid\Column\Type;
use App\Model\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of Customer
 *
 * @author windigo
 */
class Customer extends Columns
{
    public function initColumns(): void
    {
        $this->items = [
            [
                'name' => 'id',
                'label' => '#',
                'type' => Type\Number::class
            ],
            [
                'name' => 'first_name',
                'label' => trans('First Name'),
                'type' => Type\Text::class
            ],
            [
                'name' => 'last_name',
                'label' => trans('Last Name'),
                'type' => Type\Text::class
            ],
            [
                'name' => 'name',
                'label' => trans('Name'),
                'type' => Type\Text::class,
                'orderColumn'  => 'CONCAT(customers.first_name,\' \',customers.last_name)',
                'selectColumn' => 'CONCAT(customers.first_name,\' \',customers.last_name)',
            ],
            [
                'name' => 'registered_at',
                'label' => trans('Registration'),
                'type' => Type\Date::class
            ],
            [
                'name' => 'phone',
                'label' => trans('Phone'),
                'type' => Type\Text::class
            ],
            [
                'name' => 'user',
                'label' => trans('E-mail'),
                'type' => Type\Text::class,
                'orderColumn' => 'user.email',
//                'selectColumn' => 'users.email',
                'render' => function (User $value) {
                    return $value->email;
                }
            ],
            [
                'name' => 'orders',
                'label' => trans('Orders'),
                'type' => Type\Text::class,
                'orderColumn'  => '(SELECT COUNT(*) FROM orders WHERE customers.id = orders.customer_id)',
                'selectColumn' => '(SELECT COUNT(*) FROM orders WHERE customers.id = orders.customer_id)',
            ],
            [
                'name' => 'order_sum',
                'label' => trans('Ordered'),
                'type' => Type\Price::class,
                'orderColumn'  => '(SELECT SUM((SELECT SUM(order_items.price) FROM order_items WHERE orders.id = order_items.order_id)) FROM orders WHERE customers.id = orders.customer_id)',
                'selectColumn' => '(SELECT SUM((SELECT SUM(order_items.price) FROM order_items WHERE orders.id = order_items.order_id)) FROM orders WHERE customers.id = orders.customer_id)',
//                'render' => function(\Illuminate\Database\Eloquent\Collection $items) {
//                    return $items->count();
//                }
            ],
            [
                'name' => 'cards',
                'label' => trans('Cards'),
                'type' => Type\Text::class,
                'orderColumn'  => '(SELECT COUNT(*) FROM customer_cards WHERE customers.id = customer_cards.customer_id)',
                'selectColumn' => '(SELECT COUNT(*) FROM customer_cards WHERE customers.id = customer_cards.customer_id)',
            ],
            [
                'name' => 'created_at',
                'label' => trans('Created'),
                'type' => Type\Date::class
            ],
            [
                'name' => 'updated_at',
                'label' => trans('Last update'),
                'type' => Type\Date::class
            ],
            [
                'name' => 'action',
                'label' => trans('Action'),
                'type' => Type\Text::class,
                'orderable' => false,
                'filterable' => false
            ],
        ];

        $this->actions = [
            'edit' => [
                'color' => 'info',
                'icon' => 'pen',
                'route' => function (Model $item) {
                    return route('admin.customers.edit', ['customer' => $item]);
                },
            ],
            'delete' => [
                'color' => 'danger',
                'icon' => 'times',
                'route' => function (Model $item) {
                    return route('admin.customers.destroy', ['customer' => $item]);
                }
            ]
        ];
    }
}
