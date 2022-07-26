<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://arteastratta.es/public/frontend/images/logo.png" class="logo" alt="Astratta Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
