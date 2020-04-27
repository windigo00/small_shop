<?php

namespace App\Providers\Translation;

use Illuminate\Contracts\Translation\Translator as TranslatorContract;
use App\Providers\Translation\Loader;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Translator
 *
 * @author windigo
 */
class Translator implements TranslatorContract
{
    use Macroable;

    /**
     *
     * @var Loader
     */
    protected $loader;

    /**
     * The default locale being used by the translator.
     *
     * @var string
     */
    protected $locale;

    /**
     * The fallback locale used by the translator.
     *
     * @var string
     */
    protected $fallback;

    /**
     * The array of loaded translation groups.
     *
     * @var string[]
     */
    protected $loaded = [];

    /**
     * The message selector.
     *
     * @var \Illuminate\Translation\MessageSelector
     */
    protected $selector;

    /**
     * Create a new translator instance.
     *
     * @param  Loader  $loader
     * @param  string  $locale
     * @return void
     */
    public function __construct(Loader $loader, $locale)
    {
        $this->loader = $loader;

        $this->setLocale($locale);
    }
    /**
     *
     * @param string $key
     * @param int $number
     * @param string[] $replace
     * @param string $locale
     * @return string
     */
    public function choice($key, $number, array $replace = [], $locale = null): string
    {
        return 'bbbb';
    }
    /**
     *
     * @param string $key
     * @param string[] $replace
     * @param string $locale
     * @return string
     */
    public function get($key, array $replace = [], $locale = null)
    {
        $locale = $locale ?: $this->locale;

        $this->load($locale);

        $line = $this->loaded[$locale][$key] ?? null;

        return $this->makeReplacements($line ?: $key, $replace);
    }

    /**
     * Get the default locale being used.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set the default locale.
     *
     * @param string $locale
     * @return void
     */
    public function setLocale($locale): void
    {
        $this->locale = $locale;
    }

    /**
     * Get the fallback locale being used.
     *
     * @return string
     */
    public function getFallback()
    {
        return $this->fallback;
    }

    /**
     * Set the fallback locale being used.
     *
     * @param  string  $fallback
     * @return void
     */
    public function setFallback($fallback)
    {
        $this->fallback = $fallback;
    }

    /**
     * Load the specified language group.
     *
     * @param  string  $namespace
     * @param  string  $group
     * @param  string  $locale
     * @return void
     */
    public function load($locale)
    {
        if ($this->isLoaded($locale)) {
            return;
        }

        $lines = $this->loader->load($locale, $this->fallback);
        $this->loaded[$locale] = array_merge(isset($this->loaded[$locale])?$this->loaded[$locale]:[], $lines);
    }

    /**
     * Determine if the given group has been loaded.
     *
     * @param  string  $namespace
     * @param  string  $group
     * @param  string  $locale
     * @return bool
     */
    protected function isLoaded($locale)
    {
        return isset($this->loaded[$locale]);
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
    protected function getLine($locale, $item, array $replace)
    {
        $this->load($locale);

        $line = Arr::get($this->loaded[$locale], $item);

        if (is_string($line)) {
            return $this->makeReplacements($line, $replace);
        } elseif (is_array($line) && count($line) > 0) {
            foreach ($line as $key => $value) {
                $line[$key] = $this->makeReplacements($value, $replace);
            }

            return $line;
        }
    }

    /**
     * Make the place-holder replacements on a line.
     *
     * @param  string  $line
     * @param  array  $replace
     * @return string
     */
    protected function makeReplacements($line, array $replace)
    {
        if (empty($replace)) {
            return $line;
        }

        $replace = $this->sortReplacements($replace);

        foreach ($replace as $key => $value) {
            $line = str_replace(
                [':'.$key, ':'.Str::upper($key), ':'.Str::ucfirst($key)],
                [$value, Str::upper($value), Str::ucfirst($value)],
                $line
            );
        }

        return $line;
    }

    /**
     * Sort the replacements array.
     *
     * @param  array  $replace
     * @return array
     */
    protected function sortReplacements(array $replace)
    {
        return (new Collection($replace))->sortBy(function ($value, $key) {
            return mb_strlen($key) * -1;
        })->all();
    }
}
