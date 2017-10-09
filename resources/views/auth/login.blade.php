@extends('layouts.app')

@section('head')
@endsection

@section('content')

    <div class="container login">
        <div class="row vertical-offset">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6 text-center">
                            <div class="row">
                                <div class="col-md-12"><img src="{{url('/public/img/logo.png')}}"  width="110"/><br></div>
                                <div class="col-md-12"><a href="{{ route('password.request') }}" class="btn btn-link"> Reset Password </a></div>
                                <div class="col-md-12"><a href="{{ route('register') }}" class="btn btn-link"> Apply For a New Account </a></div>
                                <div class="col-md-12">
                                    <a  href="" class="btn btn-danger">
                                        <i class="fa fa-google-plus"></i> Sign in with Google
                                    </a>
                                </div>
                                <br>
                            </div>
                        </div>
                        <form class="col-md-6 form-horizontal" method="POST" action="{{ route('login') }}"  >
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 ">Login Email Address</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-12">Password</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('foot')
@endsection
