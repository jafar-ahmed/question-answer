<!-- <div>
    <textarea type="text" class="form-control @error('description') is-invalid   @enderror " rows="6" name="description">{{ old('description') }}</textarea>
    @error('description')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div> -->

@props(['label','id','name','value' => '', 'type' => 'text'])

<label for="{{ $id }}">{{ $label }}</label>
<div>
    <textarea id="{{ $id }}" name="{{ $name }}" {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>
    {{ old($name, $value) }}
    </textarea>
    @error($name)
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>