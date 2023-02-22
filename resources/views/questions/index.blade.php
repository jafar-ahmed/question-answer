@extends('layouts.default')

@section('title')
Questions <a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm">New Question</a>
@endsection

@section('content')


<x-alert />

{{-- <x-message type="warning">
    <x-slot name='title'>
        Message Title
    </x-slot>
    <p>Message body content</p>
</x-message> --}}

@foreach($questions as $question)
<div class="card mb-3">
    <div class="card-body">
        <!-- more paramiter
        ['question'=> $question->id] -->
        <!-- one parameter
         $question->id -->
        <h5 class="card-title"><a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</h5></a>
        <div class="text-muted mb-4">
            <!-- Asked: {{ $question->created_at->format(' l d/m/y H:i A ') }} -->
            Asked: {{ $question->created_at->diffForHumans() }},
            {{-- By: <a href="{{ route('profile', $question->user_id) }}">{{ $question->user->name }}</a> | {{ $question->user->email }} --}}
            <!-- @if(Auth::id() == $question->user_id)
            @endif -->

            <br>
            Answers: {{ $question->answers_count }}
        </div>
        <p class="card-text">{{ Str::words($question->description, 30) }}</p>

        <div>
            Tags: {{ implode(', ', $question->tags->pluck('name')->toArray()) }}
        </div>

    </div>
    @if(Auth::id() == $question->user_id)
    <div class="card-footer">
        <div class="d-flex justify-content-between">
            <div>
                <a href="{{ route('questions.edit',$question->id) }}" class="btn btn-outline-dark">Edit</a>
            </div>
            <form action="{{ route('questions.destroy', $question->id) }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-sm btn-danger">Delete</button>
            </form>
        </div>
    </div>
    @endif
</div>
@endforeach

{{ $questions->withQueryString()->links() }}
@endsection