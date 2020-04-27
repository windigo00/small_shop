<?php
namespace App\Providers\Translation;

use Illuminate\Filesystem\Filesystem;

/**
 * Description of Loader
 *
 * @author windigo
 */
class Loader
{

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The default path for the loader.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new file loader instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  string  $path
     * @return void
     */
    public function __construct(Filesystem $files, $path)
    {
        $this->path = $path;
        $this->files = $files;
    }

    public function load($locale, $fallback_locale): array
    {
        $files = $this->files->glob($this->getPath($locale));
        if (empty($files)) {
            $files = $this->files->glob($this->getPath($fallback_locale));
        }

        if (!empty($files)) {
            $ret = [];
            foreach ($files as $file) {
                if ($f = fopen($file, 'r')) {
                    while ($line = fgetcsv($f)) {
                        if (count($line) == 2) {
                            $ret[$line[0]] = $line[1];
                        } else {
//                            dump($line);
                        }
                    }
                    fclose($f);
                }
            }
            return $ret;
        }

        return [];
    }

    protected function getPath(string $locale): string
    {
        return "{$this->path}/{$locale}_*/*.csv";
    }
}
