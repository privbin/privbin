@extends('layouts.app')
@section('content')
    <form action="#" method="post">
        @csrf
        <div class="container">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
            <div class="mb-3">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input name="password" type="password" class="form-control" id="password" placeholder="{{ __('privbin.password') }}">
                            <label for="password">{{ __('privbin.password') }}</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select name="format" class="form-select" id="format">
                                @foreach (\App\Enums\EntryType::asArray() as $type)
                                    <option value="{{ $type }}" {{ $loop->first ? 'selected' : '' }}>
                                        {{ __('privbin.'.$type) }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="format">{{ __('privbin.format') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea name="content" class="form-control" placeholder="{{ __('privbin.content') }}" id="content" style="min-height: 400px"></textarea>
                    <label for="content">{{ __('privbin.content') }}</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="clearfix">
                    <button type="submit" class="btn btn-lg btn-dark px-5 py-2 float-end d-block d-md-inline-block" data-waves>
                        {{ __('privbin.save') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
