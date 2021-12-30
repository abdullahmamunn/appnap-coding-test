@extends('layouts.app')
@section('content')

   <div class="row d-flex justify-content-center mt-5">
       <div class="col-md-6">
        <div class="card">
            <div class="card-header">Signin</div>
            <div class="card-body">
                <form method="POST" action="{{ route('submit.login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-md-right">{{ __('User Name') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}">

                            @if ($errors->has('user_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6 mt-3">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
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
