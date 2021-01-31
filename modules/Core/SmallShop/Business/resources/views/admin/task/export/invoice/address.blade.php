<b>{{ $address->getName() }}</b><br>
{!! nl2br($address->getAddress()) !!}<br>
IČ: {{ $address->getIco() }}<br>
@if($address->getDic() === null)
Nejsme plátci DPH
@else
DIČ: {{ $address->getDic() }}
@endif
