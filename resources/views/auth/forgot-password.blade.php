@extends('layouts.app')
@section('content')

   <div class="row d-flex justify-content-center mt-5">
       <div class="col-md-6">
        <div class="card">
            <div class="card-header">Enter Your User Name To retrive Password</div>
            <div class="card-body">
            @if(session('message'))
                <div class="alert-{{ session('key') }}">{{ session('message') }}</div>
            @endif
                <form method="POST" action="{{ route('password.reset') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label text-md-right">{{ __('User Name') }}</label>

                        <div class="col-md-6">
                            <input id="" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}" placeholder="Your username">

                            @if ($errors->has('user_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0 mt-3">
                        <div class="col-md-8 offset-md-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
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
