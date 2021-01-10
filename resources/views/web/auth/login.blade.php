@extends('layouts.app')
@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-xxl-6 py-5">
                    <div class="card bg-dark shadow-sm border-0">
                        <div class="card-header h5 py-3 fw-light">
                            {{ __('privbin.login') }}
                        </div>
                        <div class="card-body">
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                            <div class="form-floating mb-3">
                                <input required type="email" class="form-control" id="email" name="email" placeholder="{{ __('privbin.email') }}" value="{{ old('email') }}">
                                <label for="email">{{ __('privbin.email') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input required type="password" class="form-control" id="password" name="password" placeholder="{{ __('privbin.password') }}">
                                <label for="password">{{ __('privbin.password') }}</label>
                            </div>
                            <div class="form-check user-select-none">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" value="remember">
                                <label class="form-check-label" for="remember">
                                    {{ __('privbin.remember') }}
                                </label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="d-block w-100 btn btn-dark">
                                {{ __('privbin.login') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
