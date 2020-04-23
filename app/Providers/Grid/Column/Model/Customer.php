<?php
namespace App\Providers\Grid\Column\Model;

use App\Providers\Grid\Column;
use App\Providers\Grid\Columns;
use App\Providers\Grid\Column\Type;
use App\Model\User;
/**
 * Description of Customer
 *
 * @author windigo
 */
class Customer  extends Columns {

    public function initColumns(): void {
        $this->items = [
            ['name' => 'id',            'label' => '#',                   'type' => Type\Number::class],
            ['name' => 'first_name',    'label' => trans('First Name'),   'type' => Type\Text::class  ],
            ['name' => 'last_name',     'label' => trans('Last Name'),    'type' => Type\Text::class  ],
            ['name' => 'registered_at', 'label' => trans('Registration'), 'type' => Type\Date::class  ],
            ['name' => 'phone',         'label' => trans('Phone'),        'type' => Type\Text::class  ],
            ['name' => 'user',          'label' => trans('E-mail'),       'type' => Type\Text::class  , 'render' => function(User $value)    { return $value->email; }],
            ['name' => 'created_at',    'label' => trans('Created'),      'type' => Type\Date::class  ],
            ['name' => 'updated_at',    'label' => trans('Last update'),  'type' => Type\Date::class  ],
            ['name' => 'action',        'label' => trans('Action'),       'type' => Type\Text::class  , 'orderable' => false, 'filterable' => false],
        ];
    }

}
