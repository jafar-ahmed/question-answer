@extends('layouts.default')

@section('title' )
Edit Tag
<a class="btn btn-outline-dark" href="/tags/">HOME</a>
@endsection
@section('content')

@include('tags._form',[
'action' => '/tags/' .$tag->id,
'update' => true
])

<!-- 
<form action="/tags/{{$tag->id}}/edit" method="post">
    @csrf
    @method('put')
    {{--<input type="hidden" name="_method" value="put">--}}
    div.form-group
    <div class="form-group mb-3">
        <label for="name">Tag Name :</label>
        <div class="mt-3">
            < input.form-control
            <input type="text" name='name' value="{{$tag->name}}" class="form-control">
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form> -->
@endsection