<?php

namespace Modules\Core\SmallShop\User\Provider\Grid\Column\Model;

use App\Providers\Grid\Columns;
use App\Providers\Grid\Column\Type;
use Modules\Core\SmallShop\User\Model\User as UserModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of User
 *
 * @author windigo
 */
class User extends Columns
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
            app(Type\Text::class, ['name' => 'name', 'label' => __('Name')]),
            app(Type\Text::class, ['name' => 'email', 'label' => __('Email')]),
            app(Type\Date::class, ['name' => 'email_verified_at', 'label' => __('Verified')]),
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
                            return route('admin.users.edit', ['user' => $item]);
                        },
                    ],
                    'delete' => [
                        'color' => 'danger',
                        'icon' => 'trash',
                        'route' => function (Model $item) {
                            return route('admin.users.destroy', ['user' => $item]);
                        }
                    ]
                ]
            ]),
        ];

    }
}
