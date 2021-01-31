<?php
namespace Modules\Core\SmallShop\System\Provider\Translation;

use Illuminate\Filesystem\Filesystem;
use Modules\Core\SmallShop\System\Services\LanguageService;

/**
 * Description of Loader
 *
 * @author windigo
 */
class Loader extends \Illuminate\Translation\FileLoader
{

    protected LanguageService $languageService;

    public function __construct(Filesystem $files, $path)
    {
        parent::__construct($files, $path);
        $this->languageService = app('translation.languages');
    }

    protected function loadFile(string $file_path): array
    {
        if ($this->files->exists($file_path)) {
            $ret = [];
            if ($f = fopen($file_path, 'r')) {
                while ($line = fgetcsv($f)) {
                    if (count($line) == 2) {
                        $ret[$line[0]] = $line[1];
                    }
                }
                fclose($f);
            }

            return $ret;
        }

        return [];
    }

    protected function loadPath($path, $locale, $group)
    {
        $full = $this->getPath($path, $locale, $group);
        if (!$this->files->exists($full)) {
            $full = $this->getPath($path, $locale, 'default');
        }
        if ($this->files->exists($full)) {
            return $this->loadFile($full);
        }

        return [];
    }

    public function loadLocale($locale): array
    {
        $locales = ['*' => ['*' => []]];
        $correct_locale = $this->getCorrectLocaleName($locale);

        //add lines to [*,*]
        //load files from path [*, group]
        $files = $this->files->glob("{$this->path}/{$correct_locale}/*.csv");
        foreach ($files as $file) {
            $group = basename($file, '.csv');
            $lines = $this->loadFile($file);
            $locales['*'][$group] = isset($locales['*'][$group]) ? array_merge($locales['*'][$group], $lines) : $lines;
            $locales['*']['*'] = array_merge($locales['*']['*'], $lines);
        }
        //load files from hints [namespace, group]
        foreach ($this->hints as $namespace => $path) {
            $files = $this->files->glob("{$path}/{$correct_locale}/*.csv");
            foreach ($files as $file) {
                $group = basename($file, '.csv');
                $lines = $this->loadFile($file);
                if (!isset($locales[$namespace])) {
                    $locales[$namespace] = ['*' => []];
                }
                $locales[$namespace][$group] = isset($locales[$namespace][$group]) ? array_merge($locales[$namespace][$group], $lines) : $lines;
                $locales['*'][$group] = isset($locales['*'][$group]) ? array_merge($locales['*'][$group], $lines) : $lines;
                $locales[$namespace]['*'] = array_merge($locales[$namespace]['*'], $lines);
                $locales['*']['*'] = array_merge($locales['*']['*'], $lines);
            }
        }

        return $locales;
    }

    /**
     * get path to locale file
     *
     * @param string $path
     * @param string $locale
     * @param string $group
     * @return string
     */
    protected function getPath(string $path, string $locale, string $group): string
    {
        return "{$path}/".$this->getCorrectLocaleName($locale)."/{$group}.csv";
    }

    /**
     * retrieve full code for locale path
     *
     * @param string $locale
     * @return string
     */
    protected function getCorrectLocaleName(string $locale): string
    {
        return $this->languageService->getLanguageByCode($locale)->code;
    }
}
