@extends('master.layouts.auth')

@section('auth')
<div class="col-md-8">
    <div class="card-group">
        <div class="card">
            <div class="card-body p-5">
                <div class="text-center d-lg-none">
                    <img src="svg/modulr.svg" class="mb-5" width="150" alt="Modulr Logo">
                </div>
                <h1>{{ __('Login') }}</h1>
                <p class="text-muted">Sign In to your account</p>

                <form method="POST" action="{{ route('master.auth.login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                        </div>
                        <input id="email" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="{{ __('Username') }}" required autofocus>

                        @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>

                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-5 offset-3">
                            <button type="submit" class="btn btn-primary px4">
                                {{ __('Login') }}
                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
        <div class="card text-white bg-primary py-5 d-md-down-none">
            <div class="card-body text-center">
                <div>
                    <img src="{{asset('frontend/images/logo.png')}}" class="mb-5" width="150" alt="Modulr Logo">
                    <h2>Top Kopi</h2>
                    <p>Minuman Orang Pemberani Mantap!!</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

