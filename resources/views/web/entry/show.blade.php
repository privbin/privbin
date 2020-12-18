@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session()->has('alert'))
            <div class="alert alert-warning">
                {!! session()->get('alert') !!}
            </div>
        @endif
        <div class="clearfix mt-4 mb-1">
            <a target="_blank" href="{{ route('web.entry.raw', $entry) }}" class="float-end btn btn-sm btn-dark px-3">
                {{ __('privbin.raw') }}
            </a>
        </div>
        <div class="border p-2">
            @if ($entry->type == \App\Enums\EntryType::Markdown())
                {!! (new \League\CommonMark\CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false, 'max_nesting_level' => 25]))->convertToHtml($entry->content) !!}
            @else
                <pre style="min-height: 240px" class="m-0">{{ $entry->content }}</pre>
            @endif
        </div>
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
