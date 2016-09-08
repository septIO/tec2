@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="medium-6 medium-offset-3 large-4 large-offset-4 columns ">

            <h1 class="headline lighter text-center">Login</h1>
            <form method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <label>E-Mail Address
                    <input type="email" aria-describedby="emailHelpText" name="email" value="{{ old('email') }}"
                           autofocus>
                </label>
                @if ($errors->has('email'))
                    <i class="help-text error-text" id="emailHelpText">* {{ $errors->first('email') }}</i>
                @endif


                <label>Password
                    <input id="password" type="password" name="password">
                </label>
                @if ($errors->has('password'))
                    <i class="help-text error-text" id="emailHelpText">*{{ $errors->first('password') }}</i>
                @endif

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>

                <button type="submit" class="button expanded white-text">
                    Login
                </button>

                <a class="pull-left" href="{{ url('/register') }}">
                    Registrer
                </a>

                <a class="pull-right" href="{{ url('/password/reset') }}">
                    Glemt password?
                </a>
            </form>
        </div>
    </div>
@endsection
