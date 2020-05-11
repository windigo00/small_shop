<?php

namespace Modules\Core\SmallShop\Customer\Providers\Grid\Column\Model;

use App\Providers\Grid\Columns;
use App\Providers\Grid\Column\Type;
use Modules\Core\SmallShop\User\Model\User;
use Modules\Core\SmallShop\Customer\Model\Customer as CustomerModel;
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
            app(Type\BulkAction::class, [
                'name' => 'bulk_action',
                'label' => '',
                'orderable' => false,
                'filterable' => false,
                'enabled_actions' => ['edit', 'delete']
            ]),
            app(Type\ID::class, [
                'name' => 'id',
                'label' => '#'
            ]),
            app(Type\Text::class, ['name' => 'first_name', 'label' => __('First Name')]),
            app(Type\Text::class, ['name' => 'last_name', 'label' => __('Last Name')]),
            app(Type\Text::class, [
                'name' => 'name',
                'label' => __('Name'),
                'orderColumn'  => 'CONCAT(customers.first_name,\' \',customers.last_name)',
                'selectColumn' => 'CONCAT(customers.first_name,\' \',customers.last_name)',
                'render' => function ($value, CustomerModel $row) {
                    return __('link', ['route' => route('admin.customers.show', ['customer' => $row]), 'label' => $value]);
                }
            ]),
            app(Type\Date::class, ['name' => 'registered_at', 'label' => __('Registration')]),
            app(Type\Text::class, ['name' => 'phone', 'label' => __('Telephone')]),
            app(Type\Text::class, [
                'name' => 'user',
                'label' => __('Email'),
                'orderColumn' => 'user.email',
//                'selectColumn' => 'users.email',
                'render' => function (User $value) { return $value->email; }
            ]),
            app(Type\Text::class, [
                'name' => 'orders',
                'label' => __('Orders'),
                'orderColumn'  => '(SELECT COUNT(*) FROM orders WHERE customers.id = orders.customer_id)',
                'selectColumn' => '(SELECT COUNT(*) FROM orders WHERE customers.id = orders.customer_id)',
            ]),
            app(Type\Price::class, [
                'name' => 'order_sum',
                'label' => __('Ordered'),
                'orderColumn'  => '(SELECT SUM((SELECT SUM(order_items.price) FROM order_items WHERE orders.id = order_items.order_id)) FROM orders WHERE customers.id = orders.customer_id)',
                'selectColumn' => '(SELECT SUM((SELECT SUM(order_items.price) FROM order_items WHERE orders.id = order_items.order_id)) FROM orders WHERE customers.id = orders.customer_id)',
//                'render' => function(\Illuminate\Database\Eloquent\Collection $items) {
//                    return $items->count();
//                }
            ]),
            app(Type\Text::class, [
                'name' => 'cards',
                'label' => __('Gift Cards'),
                'orderColumn'  => '(SELECT COUNT(*) FROM customer_cards WHERE customers.id = customer_cards.customer_id)',
                'selectColumn' => '(SELECT COUNT(*) FROM customer_cards WHERE customers.id = customer_cards.customer_id)',
            ]),
            app(Type\Date::class, ['name' => 'created_at', 'label' => __('Created')]),
            app(Type\Date::class, ['name' => 'updated_at', 'label' => __('Last Update')]),
            app(Type\Action::class, [
                'name' => 'action',
                'label' => __('Action'),
                'actions' => [
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
                ]
            ]),
        ];

    }
}
