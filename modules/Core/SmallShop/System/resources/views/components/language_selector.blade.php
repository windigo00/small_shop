
<a id="langDropdown" class="{{ $containerClass }} dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    <span class="flag-icon flag-icon-{{ strtolower(\Locale::getRegion($codes[$selected_key])) }}"></span> <span class="caret"></span>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropdown">
    @foreach ($enabled as $key => $loc)
    <a class="dropdown-item @if($locale == $loc) active @endif" href="{{ route('locale.set', ['locale' => $loc]) }}">
        <span class="flag-icon flag-icon-{{ strtolower(\Locale::getRegion($codes[$key])) }}"></span> {{ mb_convert_case(\Locale::getDisplayLanguage($loc, $loc), MB_CASE_TITLE) }}
    </a>
    @endforeach
</div>