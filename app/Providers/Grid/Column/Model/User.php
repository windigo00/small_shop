<?php
namespace App\Providers\Grid\Column\Model;

use App\Providers\Grid\Columns;
use App\Model\Auth\Type as AuthType;
use App\Providers\Grid\Column\Type;
use Illuminate\Database\Eloquent;

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
            [
                'name' => 'bulk_action',
                'label' => '',
                'type' => Type\Text::class  ,
                'orderable' => false,
                'filterable' => false,
                'enabled_actions' => ['edit', 'delete']
            ],
            ['name' => 'id',                'label' => '#',              'type' => Type\Number::class],
            ['name' => 'name',              'label' => __('Name'),    'type' => Type\Text::class  , 'render' => function ($value, \App\Model\User $row) {
                return __('link', ['route' => route('admin.users.show', ['user' => $row]), 'label' => $value]);
            }],
            ['name' => 'email',             'label' => __('Email'),  'type' => Type\Text::class   ],
            ['name' => 'email_verified_at', 'label' => __('Verified'),'type' => Type\Date::class  ],
            ['name' => 'authRule',          'label' => __('Rule'),    'type' => Type\Text::class  , 'orderColumn' => 'authRule.label', 'render' => function (AuthType $value = null) {
                return $value ? $value->label : AuthType::AUTH_LABEL_CUSTOMER;
            }],
            ['name' => 'created_at',        'label' => __('Created'), 'type' => Type\Date::class  ],
            ['name' => 'updated_at',        'label' => __('Updated'), 'type' => Type\Date::class  ],
            ['name' => 'action',            'label' => __('Action'),  'type' => Type\Text::class  , 'orderable' => false, 'filterable' => false],
        ];

        $this->actions = [
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
        ];
    }
}
