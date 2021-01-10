@extends('layouts.app')
@section('content')
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-xxl-6 py-5">
                    <div class="card bg-dark shadow-sm border-0">
                        <div class="card-header h5 py-3 fw-light">
                            {{ __('privbin.register') }}
                        </div>
                        <div class="card-body">
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                            <div class="form-floating mb-3">
                                <input required type="text" class="form-control" id="name" name="name" placeholder="{{ __('privbin.full_name') }}" value="{{ old('name') }}">
                                <label for="name">{{ __('privbin.full_name') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input required type="email" class="form-control" id="email" name="email" placeholder="{{ __('privbin.email') }}" value="{{ old('email') }}">
                                <label for="email">{{ __('privbin.email') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input required type="password" class="form-control" id="password" name="password" placeholder="{{ __('privbin.password') }}">
                                <label for="password">{{ __('privbin.password') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input required type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('privbin.password_confirmation') }}">
                                <label for="password_confirmation">{{ __('privbin.password_confirmation') }}</label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="d-block w-100 btn btn-dark">
                                {{ __('privbin.register') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
