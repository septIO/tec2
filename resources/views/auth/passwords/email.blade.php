@extends('layouts.app')
@section('title')
    Glemt password
@endsection
<!-- Main Content -->
@section('content')
    <div class="row">
        <div class="medium-6 medium-offset-3 large-4 large-offset-4 columns ">
            <h1 class="headline lighter text-center">Reset Password</h1>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}

                    <label>E-Mail Address
                        <input type="email" aria-describedby="emailHelperText" name="email" value="{{ old('email') }}">
                    </label>

                    @if ($errors->has('email'))
                        <i class="help-text" id="emailHelperText"> {{ $errors->first('email') }}</i>
                    @endif

                    <button type="submit" class="button expanded">
                        Send Password Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
