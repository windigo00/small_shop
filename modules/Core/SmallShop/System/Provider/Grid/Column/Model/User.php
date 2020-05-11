<?php
namespace Modules\Core\SmallShop\System\Provider\Grid\Column\Model;

use App\Providers\Grid\Columns;
use App\Model\Auth\Type as AuthType;
use App\Providers\Grid\Column\Type;
use Illuminate\Database\Eloquent;
use Modules\Core\SmallShop\User\Model\User;

/**
 * Description of UserGridColumns
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
            app(Type\ID::class, ['name' => 'id', 'label' => '#']),
            app(Type\Text::class, [
                'name' => 'name',
                'label' => __('Name'),
                'render' => function ($value, User $row) {
                    return __('link', ['route' => route('admin.users.show', ['user' => $row]), 'label' => $value]);
                }
            ]),
            app(Type\Text::class, ['name' => 'email', 'label' => __('Email')],
            app(Type\Date::class, ['name' => 'email_verified_at', 'label' => __('Verified')],
            app(Type\Text::class, [
                'name' => 'authRule',
                'label' => __('Rule'),
                'orderColumn' => 'authRule.label',
                'render' => function (AuthType $value = null) {
                    return $value ? $value->label : AuthType::AUTH_LABEL_CUSTOMER;
                }
            ]),
            app(Type\Date::class, ['name' => 'created_at',        'label' => __('Created')]),
            app(Type\Date::class, ['name' => 'updated_at',        'label' => __('Updated')]),
            app(Type\Action::class, [
                'name' => 'action',
                'label' => __('Action'),
                'actions' => [
                    'edit'   => [
                        'color' => 'info',
                        'icon' => 'pen',
                        'route' => function (Eloquent\Model $item) {
                            return route('admin.users.edit', ['user' => $item]);
                        },
                    ],
                    'delete' => [
                        'color' => 'danger',
                        'icon' => 'trash',
                        'route' => function (Eloquent\Model $item) {
                            return route('admin.users.destroy', ['user' => $item]);
                        },
                    ]
                ]
            ]),
        ];

    }
}
