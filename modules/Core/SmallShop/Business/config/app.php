<?php

return [
    'providers' => [
        \Modules\Core\SmallShop\Business\Provider\ModuleServiceProvider::class,
        \Modules\Core\SmallShop\Business\Provider\RouteServiceProvider::class,
        \Modules\Core\SmallShop\Business\Provider\NavigationServiceProvider::class,
    ],
    'aliases' => [
        'InvoiceUtils' => \Modules\Core\SmallShop\Business\Services\Invoice\Utils::class
    ],
];