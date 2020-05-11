<?php
return [
    'providers' => [
        Modules\Core\SmallShop\System\Providers\TranslationServiceProvider::class,
        Modules\Core\SmallShop\System\Providers\LocalizedCoutryListServiceProvider::class,

        Modules\Core\SmallShop\System\Provider\ModuleServiceProvider::class,
        Modules\Core\SmallShop\System\Provider\NavigationServiceProvider::class,
        Modules\Core\SmallShop\System\Provider\RouteServiceProvider::class,
    ]
];