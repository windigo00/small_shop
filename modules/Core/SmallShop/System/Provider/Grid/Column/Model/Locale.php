<?php
namespace Modules\Core\SmallShop\System\Provider\Grid\Column\Model;

use App\Providers\Grid\Columns;
use App\Providers\Grid\Column\Type;
use Illuminate\Database\Eloquent;

/**
 * Description of ProductGridColumns
 *
 * @author windigo
 */
class Locale extends Columns
{
    public function initColumns(): void
    {
        $this->items = [
            app(Type\BulkAction::class, [
                'name' => 'bulk_action',
                'label' => '',
                'orderable' => false,
                'filterable' => false,
                'enabled_actions' => ['delete']
            ]),
            app(Type\Text::class, ['name' => 'key', 'label' => __('key')]),
//            app(Type\Action::class, [
//                'name' => 'action',
//                'label' => __('Action'),
//                'actions' => [
//                    'edit'   => [
//                        'color' => 'info',
//                        'icon' => 'envelope',
//                        'route' => ['route_name' => 'admin.locales.edit', 'attrs' => ['key']],
//                    ],
//                ]
//            ]),
        ];


    }

    public function setLanguages(array $locales): void
    {
        foreach($locales as $idx => $locale) {
            $this->items[] = app(Type\Text::class, [
                'name' => 'col_' . $idx,
                'label' => '<span class="flag-icon flag-icon-'. strtolower(\Locale::getRegion($locale)) .'"></span>',
                'selectColumn' => "(SELECT GROUP_CONCAT(DISTINCT `value` SEPARATOR '--*--') from `locales_{$idx}` WHERE `locales_{$idx}`.`key_id` = `locales`.`id` GROUP BY `locales_{$idx}`.`key_id`)",
            ]);
        }
    }
}
