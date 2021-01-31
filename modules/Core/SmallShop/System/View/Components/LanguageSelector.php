<?php

namespace Modules\Core\SmallShop\System\View\Components;

use Illuminate\View\Component;

class LanguageSelector extends Component
{
    protected string $containerClass;

    public function __construct(string $class = '')
    {
        $this->containerClass = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $locale = app()->getLocale();
        $enabled = config('app.enabled_locale');
        return view('system::components.language_selector', [
            'containerClass' => $this->containerClass,
            'locale' => $locale,
            'enabled' => $enabled,
            'codes' => config('app.locale_codes'),
            'selected_key' => array_search($locale, $enabled),
        ]);
    }
}
