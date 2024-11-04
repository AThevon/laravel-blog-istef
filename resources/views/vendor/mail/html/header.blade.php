@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('skyblog-logo.png') }}"
class="logo" 
alt="Skyblog Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
