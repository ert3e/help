@if (isset($edit))
<a class="btn btn-success btn-xs" href="{{ $edit }}" role="button">
    <i class="fas fa-edit"></i>
</a>
@endif

@if (isset($delete))
<a class="btn btn-danger btn-xs" href="javascript:confirmRequest('{{ $delete }}')" role="button">
    <i class="fas fa-trash-alt"></i>
</a>
@endif

@if (isset($customs))
    @foreach($customs as $custom)
        <a class="btn btn-primary btn-xs" href="{{ $custom['route'] }}" role="button">
            <i class="{{ $custom['icon'] }}"></i>
        </a>
    @endforeach
@endif
