@php
    $locale = app()->getLocale();
    $enabled = config('app.enabled_locale');
    $codes = config('app.locale_codes');
    $selected_key = array_search($locale, $enabled);
@endphp
<li class="nav-item dropdown">
    <a id="langDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <span class="flag-icon flag-icon-{{ strtolower(\Locale::getRegion($codes[$selected_key])) }}"></span> <span class="caret"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropdown">
        @foreach ($enabled as $key => $loc)
        <a class="dropdown-item @if($locale == $loc) active @endif" href="{{ route('locale.set', ['locale' => $loc]) }}">
            <span class="flag-icon flag-icon-{{ strtolower(\Locale::getRegion($codes[$key])) }}"></span> {{ \Locale::getDisplayName($loc, $locale) }}
        </a>
        @endforeach
    </div>
</li>