<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Modules\Core\SmallShop\System\Repository\LocaleRepository;

class LocaleGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locale:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get CSV locales to db structure';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;
    /**
     *
     * @var LocaleRepository
     */
    protected $repository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files, LocaleRepository $repo)
    {
        parent::__construct();
        $this->files = $files;
        $this->repository = $repo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        //load csv data and store them according to file they came from.
        //if key is duplicate in one file, inform
        $locales = config('app.enabled_locale');
        $locale_codes = config('app.locale_codes');
        DB::beginTransaction();
        try {
            foreach ($locales as $idx => $locale) {
                $this->processLocale($locale, $locale_codes[$idx]);
            }
            DB::commit();
            $this->info("done");
        } catch (\Exception $ex) {
            $this->error($ex);
            DB::rollBack();
            $this->info("fail");
        }
    }

    protected function processLocale($locale, $code) {
        $path = app('path.lang');
        $this->info("doing {$locale}");
        $files = glob("{$path}/{$code}/*.csv");
        $cnt = count($files);
        foreach ($files as $idx => $file) {
            $item = $idx + 1;
//            $this->info("file {$item}/{$cnt}");
            echo '-';
            $this->processLocaleFile($locale, $file);
        }
        echo "\n";
    }
    protected function processLocaleFile($locale, $file) {
        if (($f = fopen($file, 'r'))) {
            $group_name = basename($file, '.csv');
            while(($line = fgetcsv($f)) !== false) {
                if (!empty($line) && isset($line[0]) && isset($line[1]) && !empty($line[0]) && !empty($line[1])) {
                    list($key, $value) = $line;
                    $this->output->write("<info>.</info>");
                    $this->repository->save($key, $value, $locale, $group_name);
                } else {
                    $this->output->write("<error>.</error>");
                }
            }
            fclose($f);
        }
        echo "\n";
    }
}
