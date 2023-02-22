 @extends('layouts.default')

 @section('title')
Tags
 <a class="btn btn-outline-dark" href="/tags/create">Add New</a>
 {{-- <x-dashboard-layout> --}}

 @endsection

<x-alert />

 {{-- @section('content')
 <!-- <h2 class="mb-4"> {{$title}} </h2> -->
 @if(session()->has('success'))
 <div class="alert alert-success">
     {{session()->get('success')}}
     <!-- @php
            session()->forget('success')
            @endphp -->
 </div>
 @endif
 <!--  -->
 @if(session()->has('info'))
 <div class="alert alert-info">
     {{session()->get('info')}}
     <!-- @php
            session()->forget('success')
            @endphp -->
 </div>
 @endif

 @if(Auth::check())
 User: {{$user->name}}
 @endif --}}
 @section('content')
 <table class="table">
     <thead>
         <tr>
             <th>ID</th>
             <th>Name</th>
             <th>Slug</th>
             <th>Created At</th>
             <th>Updated At</th>
             <th>Update</th>
             <th>Delete</th>
         </tr>
     </thead>

     <tbody>
         @foreach ($tags as $tag)
         <tr>
             <td> {{$tag->id }}</td>
             <td>{{$tag->name}}</td>
             <td> {{$tag->slug}} </td>
             <td>{{$tag->created_at}} </td>
             <td> {{$tag->updated_at}} </td>
             <td>
                 <form action="/tags/{{$tag->id }}/edit">
                     <input type="submit" value="update" />
                 </form>
             </td>
             <td>
                 <form class="delete-form" action="/tags/{{$tag->id }}" method="post">
                     @csrf
                     @method('delete')
                     <button type="submit" class="btn btn-danger btn-sm">delete</button>

                 </form>
             </td>
         </tr>
         @endforeach
     </tbody>
 </table>

 <script>
     setTimeout(function() {
         document.querySelector('.alert').style.display = "none"
     }, 3000)

     document.querySelector('.delete-form').addEventListener('submit', function(e) {
         e.preventDefault();
         if (confirm("Are you sure you want to delete this item ?")) {
             e.target.submit();
         }
     })
 </script>

 @endsection

{{-- </x-dashboard-layout> --}}