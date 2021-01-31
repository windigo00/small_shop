<?php
namespace Modules\Core\SmallShop\System\Provider\Translation;

/**
 * Description of CountryList
 *
 * @author windigo
 */
class CountryList {

    protected $packagePath;


    public function __construct(string $appVendorPath) {
        $this->packagePath = "{$appVendorPath}/umpirsky/country-list/data";
    }

    public function list(string $locale): array
    {
        return include "{$this->packagePath}/{$locale}/country.php";
    }
}
