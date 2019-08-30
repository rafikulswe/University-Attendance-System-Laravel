@extends('softAdmin.master_login')

@section('content')
<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo pull-left">
            <img src="{{ asset('contents/images/logo.png') }}" height="54" alt="Porto Admin" />
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
            </div>
            <div class="panel-body">
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-lg">
                        <label for="email">Email</label>
                        <div class="input-group input-group-icon">

                            <input id="email" type="email" class="form-control input-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-user"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-lg">
                        <div class="clearfix">
                            <label class="pull-left" for="password">Password</label>
                            <a href="pages-recover-password.html" class="pull-right">Lost Password?</a>
                        </div>
                        <div class="input-group input-group-icon">

                            <input id="password" type="password" class="form-control input-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox-custom checkbox-default">
                                <!-- <input id="RememberMe" name="rememberme" type="checkbox"/> -->
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="RememberMe">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="submit" class="btn btn-primary hidden-xs">{{ __('Sign In') }}</button>
                            <!-- <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button> -->
                        </div>
                    </div>

                    <span class="mt-lg mb-lg line-thru text-center text-uppercase">
                        <span>or</span>
                    </span>

                    <div class="mb-xs text-center">
                        <a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
                        <a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
                    </div>

                    <p class="text-center">Don't have an account yet? <a href="#">Sign Up!</a>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection


