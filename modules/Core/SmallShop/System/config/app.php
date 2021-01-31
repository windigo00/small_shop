<?php
return [
    'providers' => [
        Modules\Core\SmallShop\System\Provider\TranslationServiceProvider::class,
        Modules\Core\SmallShop\System\Provider\LocalizedCoutryListServiceProvider::class,

        Modules\Core\SmallShop\System\Provider\ModuleServiceProvider::class,
        Modules\Core\SmallShop\System\Provider\NavigationServiceProvider::class,
        Modules\Core\SmallShop\System\Provider\RouteServiceProvider::class,
    ]
];