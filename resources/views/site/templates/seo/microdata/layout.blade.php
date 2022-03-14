@if (isset($microdataArray))
<script type="application/ld+json">
{!! json_encode($microdataArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
