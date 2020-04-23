<?php
namespace App\Providers\Grid\Column\Model;
use App\Providers\Grid\Column;
use App\Providers\Grid\Columns;
use App\Model\Auth\Type as AuthType;
use App\Model\Order\Status;
use App\Providers\Grid\Column\Type;

/**
 * Description of UserGridColumns
 *
 * @author windigo
 */
class User extends Columns {

    public function initColumns(): void {
        $this->items = [
            ['name' => 'id',                'label' => '#',              'type' => Type\Number::class],
            ['name' => 'name',              'label' => trans('Name'),    'type' => Type\Text::class  ],
            ['name' => 'email',             'label' => trans('E-mail'),  'type' => Type\Text::class  ],
            ['name' => 'email_verified_at', 'label' => trans('Verified'),'type' => Type\Date::class  ],
            ['name' => 'authRule',          'label' => trans('Rule'),    'type' => Type\Text::class  , 'render' => function(AuthType $value = null) { return $value ? $value->label : AuthType::AUTH_LABEL_CUSTOMER; }],
            ['name' => 'created_at',        'label' => trans('Created'), 'type' => Type\Date::class  ],
            ['name' => 'updated_at',        'label' => trans('Updated'), 'type' => Type\Date::class  ],
            ['name' => 'action',            'label' => trans('Action'),  'type' => Type\Text::class  , 'orderable' => false, 'filterable' => false],
        ];
    }

}
