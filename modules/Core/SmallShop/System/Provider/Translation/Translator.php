<?php

namespace Modules\Core\SmallShop\System\Providers\Translation;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Translation\MessageSelector;
use Illuminate\Contracts\Translation\Loader;

/**
 * Translator
 *
 * @author windigo
 */
class Translator extends \Illuminate\Translation\Translator
{
    /**
     * Array of all locale codes that are enabled
     *
     * @var string[]
     */
    protected $enabled_locales;
    /**
     * Cache of parsed keys
     *
     * @var string[]
     */
    protected $parsed = [];
    /**
     * list of full locale codes
     *
     * @var string[]
     */
    protected $locale_codes;

    public function __construct(Loader $loader, $locale, string $fallback_locale = null, array $enabled_locales = [], array $locale_codes = []) {
        parent::__construct($loader, $locale);
        $this->enabled_locales = $enabled_locales;
        $this->locale_codes = $locale_codes;
        $this->fallback = $fallback_locale;
    }

    /**
     *
     * @return string[]|null
     */
    public function getTranslations(): ?array
    {
        $this->load('*', '*', $this->locale);
        return $this->loaded[$this->locale] ?? null;
    }
    /**
     *
     * @param string[] $locales
     * @return void
     */
    public function setEnabledLocales(array $locales): void {
        $this->enabled_locales = $locales;
    }

    public function parseKey($key) {
        if (!isset($this->parsed[$key])) {
            $matches = [];
            preg_match('#^((?<namespace>[^\:]+)\:\:)?((?<group>[^\.]+)\.)?(?<key>.+)$#', $key, $matches);
            $this->parsed[$key] = [
                !empty($matches['namespace']) ? $matches['namespace'] : '*',
                !empty($matches['group']) ? $matches['group'] : '*',
                $matches['key'],
            ];
        }
        return $this->parsed[$key];

    }

    public function get($key, array $replace = array(), $locale = null, $fallback = true) {
        $ret = parent::get($key, $replace, $locale, $fallback);
        if ($ret === $key) {
            list($namespace, $group, $expr) = $this->parseKey($key);
            if ($namespace !== '*' || $group !== '*') {
                return $expr;
            }
        }
        return $ret;
    }

    /**
     * Load the specified language group.
     *
     * @param  string  $namespace
     * @param  string  $group
     * @param  string  $locale
     * @return void
     */
    public function load($namespace, $group, $locale): void {
        if ($this->isLoaded($namespace, $group, $locale)) {
            return;
        }
        $this->loaded[$locale] = $this->loader->loadLocale($locale);
    }

    /**
     * Determine if the given group has been loaded.
     *
     * @param  string  $namespace
     * @param  string  $group
     * @param  string  $locale
     * @return bool
     */
    protected function isLoaded($namespace, $group, $locale)
    {
        if (!isset($this->loaded[$locale])) return false;
        if (!isset($this->loaded[$locale][$namespace])) return false;
        return isset($this->loaded[$locale][$namespace][$group]);
    }

    /**
     * Retrieve a language line out the loaded array.
     *
     * @param  string  $namespace
     * @param  string  $group
     * @param  string  $locale
     * @param  string  $item
     * @param  array  $replace
     * @return string|array|null
     */
    protected function getLine($namespace, $group, $locale, $item, array $replace)
    {
        $this->load($namespace, $group, $locale);
        if (!isset($this->loaded[$locale][$namespace])) {
            $namespace = '*';
        }
        if (!isset($this->loaded[$locale][$namespace][$group])) {
            $group = '*';
        }
        $line = Arr::get($this->loaded[$locale][$namespace][$group], $item);

        if (is_string($line)) {
            return $this->makeReplacements($line, $replace);
        } elseif (is_array($line) && count($line) > 0) {
            foreach ($line as $key => $value) {
                $line[$key] = $this->makeReplacements($value, $replace);
            }

            return $line;
        }
    }
}
