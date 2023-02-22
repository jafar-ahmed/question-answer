<!-- <label for="title">Title</label>
        <div>
            <input type="text" class="form-control @error('title') is-invalid  @enderror " name="title" value="{{ old('title') }}"></input>
            @error('title')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div> -->
@props(['label','id','name','value' => '', 'type' => 'text'])
<label for="{{ $id }}">{{ $label }}</label>
<div>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value ) }}" {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}></input>
    @error($name)
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>