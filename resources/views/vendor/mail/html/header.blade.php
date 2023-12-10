@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="logo.PNG" class="logo" alt="TCMS Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
