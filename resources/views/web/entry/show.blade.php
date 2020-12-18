@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
        <div class="border p-2"><pre style="min-height: 240px" class="m-0">{{ $entry->content }}</pre></div>
    </div>
@endsection
