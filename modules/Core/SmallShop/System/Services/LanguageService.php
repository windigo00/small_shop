<?php

namespace Modules\Core\SmallShop\System\Services;

use Modules\Core\SmallShop\System\Model\Locale\Language;

class LanguageService
{
    /**
     * @var Language[]
     */
    protected array $languageList = [];

    public function __construct(array $localeList, array $enabledCodes)
    {
        foreach ($localeList as $code) {
            $key = explode('_', $code);
            $this->languageList[$key[0]] = new Language($code, $key[0], in_array($key[0], $enabledCodes));
        }
    }

    /**
     * @return Language[]
     */
    public function getList(bool $enabledOnly = true): array
    {
        return array_filter($array, fn (Language $lang) => $lang->enabled);
    }

    /**
     * @return Language
     * @throws \Exception
     */
    public function getLanguageByCode(string $key): Language
    {
        if (!isset($this->languageList[$key])) {
            throw new \Exception('language `'.$key.'` not recognized');
        }
        return $this->languageList[$key];
    }
}
