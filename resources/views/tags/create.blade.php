@extends('layouts.default')

@section('title')
Create New Tag
<a class="btn btn-outline-dark" href="/tags/">HOME</a>
@endsection

@push('styles')
<link rel="stylesheet" href="style.css">
@endpush
@push('scripts')

@endpush
<!-- @section('title')
Create New Tag
@endsections -->
<!-- @section('title' ,'Create New Tag') -->


@section('content')

@include('tags._form',[
'action' => '/tags',
'update' => false
])


<!-- {{--input:h--}}
    {{--<input type="hidden" name="_token" value="{{csrf_token() }}">
    OR
    {{csrf_token() }}--}}
    @csrf -->
@endsection