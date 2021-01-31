<?php

namespace Modules\Core\SmallShop\System\Model\Locale;

class Language
{
    public string $code;
    public string $key;
    public string $enabled;

    public function __construct(string $code, string $key, string $enabled)
    {
        $this->code = $code;
        $this->key = $key;
        $this->enabled = $enabled;
    }
}
