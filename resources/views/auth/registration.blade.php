@extends('layouts.app')
@section('content')

   <div class="row d-flex justify-content-center mt-5">
       <div class="col-md-6">
        <div class="card">
          <div class="card-header">Signup</div>
            <div class="card-body">
                @if(session('message'))
                    <div class="alert-{{ session('key') }}">{{ session('message') }}</div>
                @endif
                <form method="POST" action="{{ route('submit.register') }}" aria-label="{{ __('Register') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label text-md-right">{{ __('Full Name') }}</label>

                        <div class="col-md-8 mt-3">
                            <input id="full_name" type="text" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ old('full_name') }}">

                            @if ($errors->has('full_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('full_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-8 mt-3">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                        <div class="col-md-8 mt-3">
                            <input id="" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}">

                            @if ($errors->has('dob'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-md-right">{{ __('User Name') }}</label>

                        <div class="col-md-8 mt-3">
                            <input id="" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}">

                            @if ($errors->has('user_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-8 mt-3">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-8 mt-3">
                            <input id="" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0 mt-3">
                        <div class="col-md-8 offset-md-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
       </div>
   </div>

@endsection
