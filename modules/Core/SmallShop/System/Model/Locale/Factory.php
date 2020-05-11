<?php
namespace Modules\Core\SmallShop\System\Model\Locale;

use Modules\Core\SmallShop\System\Model\Locale\Translation;

/**
 * Description of Factory
 *
 * @author windigo
 */
class Factory {

    public static function get(string $locale): Translation
    {
        /* @var $model Translation */
        $model = app(Translation::class);
        $model->setTable($model->getTable() . $locale);
        return $model;
    }

}
