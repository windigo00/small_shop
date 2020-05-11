<?php
namespace App\Bootstrap;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Config\Repository as RepositoryContract;

/**
 * Description of LoadConfiguration
 *
 * @author windigo
 */
class LoadConfiguration extends \Illuminate\Foundation\Bootstrap\LoadConfiguration
{
    /**
     * Get all of the configuration files for the application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return array
     */
    protected function getConfigurationFiles(Application $app)
    {
        $files = parent::getConfigurationFiles($app);
        $module_files = glob($app->basePath().'/modules/*/*/*/config/*.php');
        foreach ($module_files as $file) {
            preg_match('#\/([^\/]+)\/config\/([^\.]+)\.php#', $file, $matches);
            $module = strtolower($matches[1]);
            $name = strtolower($matches[2]);
            $files[$name.'.'.$module] = realpath($file);
        }
        ksort($files, SORT_NATURAL);
        return $files;
    }

    /**
     * Load the configuration items from all of the files.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @param  \Illuminate\Contracts\Config\Repository  $repository
     * @return void
     *
     * @throws \Exception
     */
    protected function loadConfigurationFiles(Application $app, RepositoryContract $repository)
    {
        $files = $this->getConfigurationFiles($app);

        if (! isset($files['app'])) {
            throw new Exception('Unable to load the "app" configuration file.');
        }

        foreach ($files as $key => $path) {
            if (strpos($key, '.') !== false) {
                list($key, $module) = explode('.', $key);
            }
            $value = require $path;
            $this->mergeConfig($repository, $key, $value);
        }
    }
    /**
     *
     * @param RepositoryContract $repository
     * @param string $key
     * @param string[] $value
     */
    protected function mergeConfig(RepositoryContract $repository, string $key, array $value) {
        if ($repository->has($key)) {
            $repository->set($key, array_merge_recursive($repository->get($key), $value));
        } else {
            $repository->set($key, $value);
        }
    }
}
