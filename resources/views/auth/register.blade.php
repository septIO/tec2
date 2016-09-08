@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="small-12 medium-6 medium-offset-3 large-4 large-offset-4 columns">
            <h1 class="headline lighter text-center">Register</h1>

            <form method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>

                    <input id="name" type="text" class="form-control" aria-describedby="nameHelpText" name="name"
                           value="{{ old('name') }}" autofocus>
                    @if ($errors->has('name'))
                        <p class="help-text error-text" id="nameHelpText">* {{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address</label>

                    <input id="email" type="email" class="form-control" aria-describedby="emailHelpText" name="email"
                           value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <p class="help-text error-text" id="emailHelpText">* {{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>

                    <input id="password" type="password" aria-describedby="passwordHelpText" class="form-control"
                           name="password">

                    @if ($errors->has('password'))
                        <p class="help-text error-text" id="passwordHelpText">* {{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm">Confirm Password</label>

                    <input id="password-confirm" type="password" aria-describedby="confirmHelpText" class="form-control"
                           name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <p class="help-text error-text" id="confirmHelpText">
                            * {{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="button expanded text-white">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
