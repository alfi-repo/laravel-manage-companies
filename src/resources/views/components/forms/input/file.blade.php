<label class="form-label {{ ($required ?? false) ? 'required' : '' }}">
    {{ $label }}
</label>
<div>
    <input id="{{ $name }}_xdummy"
           name="{{ $name }}_xdummy"
           type="hidden"
           value="{{ old('{$label}_xdummy') }}">
    <input class="form-control @error($name) is-invalid @enderror"
           name="{{ $name }}"
           onchange="document.getElementById('{{ $name }}_xdummy').value='{{ $name }}_xdummy'"
           type="file">
    @if($hint ?? false)
        <small class="form-hint">{{ $hint }}</small>
    @endif
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
