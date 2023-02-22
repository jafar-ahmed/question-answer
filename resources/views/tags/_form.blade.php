<!-- بعرض كل الأخطاء
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div> 
@endif
-->
<form action="{{ $action }}" method="post">
    @csrf
    @if($update)
    @method('put')
    @endif
    <!--div.form-group-->
    <div class="form-group mb-3">
        <label for="name">Tag Name :</label>
        <div class="mt-3">
            <!-- input.form-control-->
            <input type="text" name='name' value="{{ old('name', $tag->name) }}" class="form-control @error('name')is-invalid @enderror">
            <!-- بعرض الخطأ  لكل مدخل -->
            @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
            <!-- @if($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif -->
        </div>

        <div class="mt-3">
            <label for="name">Description :</label>
            <!-- input.form-control-->
            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $tag->description) }}</textarea>
            <!-- بعرض الخطأ  لكل مدخل -->
            @error('description')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
            <!-- @if($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif -->
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>