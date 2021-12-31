@extends('layouts.app')
@section('content')

   <div class="row d-flex justify-content-center mt-5">
       <div class="col-md-6">
        <div class="card">
          <div class="card-header">Set your New Password</div>
            <div class="card-body">
                @if(session('message'))
                    <div class="alert-{{ session('key') }}">{{ session('message') }}</div>
                @endif
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label text-md-right">{{ __('User Name') }}</label>

                        <div class="col-md-8 mt-3">
                            <input id="" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ $user->user_name }}" readonly>
                            <input id="" type="hidden" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" readonly>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
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
                                {{ __('Reset Password') }}
                            </button>

                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Back to Login') }}
                            </a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
       </div>
   </div>

@endsection
