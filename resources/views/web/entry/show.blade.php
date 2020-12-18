@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
        @if (session()->has('alert'))
            <div class="alert alert-warning">
                {{ session()->get('alert') }}
            </div>
        @endif
        <div class="border p-2"><pre style="min-height: 240px" class="m-0">{{ $entry->content }}</pre></div>
    </div>
@endsection
