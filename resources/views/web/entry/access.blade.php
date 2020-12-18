@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="my-5">
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
            <form action="{{ route('web.entry.access', $entry) }}" method="post">
                @csrf
                <div class="form-floating">
                    <input name="password" type="password" class="form-control" id="password" placeholder="{{ __('privbin.password') }}">
                    <label for="password">{{ __('privbin.password') }}</label>
                </div>
                <button type="submit" class="d-block w-100 mt-3 btn btn-dark text-gray-600">
                    {{ __('privbin.view') }}
                </button>
            </form>
        </div>
    </div>
@endsection
