@extends('base')

@section('title')
    {{trans('auth/login.login')}}
    @parent
@stop

@section('content')

    {{--@include('notifications')--}}

    <!-- Logo & Navigation starts -->

    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Logo -->
                    <div class="logo text-center">
                        <h1><a href="index.html">Olson Admin</a></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logo & Navigation ends -->

    <!-- Page content -->
    <div class="page-content blocky">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="awidget login-reg">
                        <div class="awidget-head">
                        </div>
                        <div class="awidget-body">
                            <!-- Page title -->
                            <div class="page-title text-center">
                                <h2>Login</h2>
                                <hr/>
                            </div>
                            <!-- Page title -->
                            <br/>

                            <form class="form-horizontal" role="form" action="{{ url('/auth/login') }}" method="POST">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="input-group {{ $errors->first('email', 'has-error') }}">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="{{trans('auth/login.email_address')}}"
                                           value="{{{ Input::old('email') }}}"></div>
                                <span class="help-block">{{ $errors->first('email', ':message') }}</span>

                                <div class="input-group {{ $errors->first('password', 'has-error') }}">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                    <input type="password" class="form-control" name="password"
                                           placeholder="{{trans('auth/login.password')}}">
                                </div>
                                <span class="help-block">{{ $errors->first('password', ':message') }}</span>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">
                                        {{trans('auth/login.remember_me')}}
                                    </label>
                                </div>
                                <input type="submit" class="btn btn-md btn-success btn-block"
                                       value="{{trans('auth/login.login')}}"/>
                                <a class=""
                                   href="{{ url('/password/email') }}">{{trans('auth/login.forgot_your_password')}}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection