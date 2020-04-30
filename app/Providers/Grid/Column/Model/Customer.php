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
                'name' => 'bulk_action',
                'label' => '',
                'type' => Type\Text::class  ,
                'orderable' => false,
                'filterable' => false,
                'enabled_actions' => ['edit', 'delete']
            ],
            [
                'name' => 'id',
                'label' => '#',
                'type' => Type\Number::class
            ],
            [
                'name' => 'first_name',
                'label' => __('First Name'),
                'type' => Type\Text::class
            ],
            [
                'name' => 'last_name',
                'label' => __('Last Name'),
                'type' => Type\Text::class
            ],
            [
                'name' => 'name',
                'label' => __('Name'),
                'type' => Type\Text::class,
                'orderColumn'  => 'CONCAT(customers.first_name,\' \',customers.last_name)',
                'selectColumn' => 'CONCAT(customers.first_name,\' \',customers.last_name)',
                'render' => function ($value, \App\Model\Customer $row) {
                    return __('link', ['route' => route('admin.customers.show', ['customer' => $row]), 'label' => $value]);
                }
            ],
            [
                'name' => 'registered_at',
                'label' => __('Registration'),
                'type' => Type\Date::class
            ],
            [
                'name' => 'phone',
                'label' => __('Telephone'),
                'type' => Type\Text::class
            ],
            [
                'name' => 'user',
                'label' => __('Email'),
                'type' => Type\Text::class,
                'orderColumn' => 'user.email',
//                'selectColumn' => 'users.email',
                'render' => function (User $value) {
                    return $value->email;
                }
            ],
            [
                'name' => 'orders',
                'label' => __('Orders'),
                'type' => Type\Text::class,
                'orderColumn'  => '(SELECT COUNT(*) FROM orders WHERE customers.id = orders.customer_id)',
                'selectColumn' => '(SELECT COUNT(*) FROM orders WHERE customers.id = orders.customer_id)',
            ],
            [
                'name' => 'order_sum',
                'label' => __('Ordered'),
                'type' => Type\Price::class,
                'orderColumn'  => '(SELECT SUM((SELECT SUM(order_items.price) FROM order_items WHERE orders.id = order_items.order_id)) FROM orders WHERE customers.id = orders.customer_id)',
                'selectColumn' => '(SELECT SUM((SELECT SUM(order_items.price) FROM order_items WHERE orders.id = order_items.order_id)) FROM orders WHERE customers.id = orders.customer_id)',
//                'render' => function(\Illuminate\Database\Eloquent\Collection $items) {
//                    return $items->count();
//                }
            ],
            [
                'name' => 'cards',
                'label' => __('Gift Cards'),
                'type' => Type\Text::class,
                'orderColumn'  => '(SELECT COUNT(*) FROM customer_cards WHERE customers.id = customer_cards.customer_id)',
                'selectColumn' => '(SELECT COUNT(*) FROM customer_cards WHERE customers.id = customer_cards.customer_id)',
            ],
            [
                'name' => 'created_at',
                'label' => __('Created'),
                'type' => Type\Date::class
            ],
            [
                'name' => 'updated_at',
                'label' => __('Last Update'),
                'type' => Type\Date::class
            ],
            [
                'name' => 'action',
                'label' => __('Action'),
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
                'icon' => 'trash',
                'route' => function (Model $item) {
                    return route('admin.customers.destroy', ['customer' => $item]);
                }
            ]
        ];
    }
}
