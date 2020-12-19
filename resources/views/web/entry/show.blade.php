@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session()->has('alert'))
            <div class="alert alert-warning">
                {!! session()->get('alert') !!}
            </div>
        @endif
        <iframe class="my-3" src="{{ route('web.entry.embed', $entry) }}" frameborder="0" style="width: 100%"></iframe>
        <div class="clearfix mt-4">
            <form action="{{ route('web.entry.destroy', $entry) }}" method="post">
                @csrf
                @method('delete')
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
                <div class="form-floating">
                    <input name="token" type="text" class="form-control" id="token" placeholder="{{ __('privbin.token') }}">
                    <label for="token">{{ __('privbin.token') }}</label>
                </div>
                <button type="submit" class="btn btn-sm btn-danger float-end mt-2">
                    {{ __('privbin.delete') }}
                </button>
            </form>
        </div>
    </div>
@endsection
