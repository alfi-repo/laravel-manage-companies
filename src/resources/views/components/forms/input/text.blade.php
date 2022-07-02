<label class="form-label {{ ($required ?? false) ? 'required' : '' }}">
    {{ $label }}
</label>
<div>
    <input class="form-control @error($name) is-invalid @enderror"
           name="{{ $name }}"
           placeholder="{{ $placeholder ?? ''}}"
           type="text"
           {{ ($required ?? false) ? 'required' : '' }}
           value="{{ old($name, $value ?? null) }}">
    @if($hint ?? false)
        <small class="form-hint">{{ $hint }}</small>
    @endif
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
