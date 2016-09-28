@extends('layouts.app')
@section('title')
    Update Tracking
@endsection
@section('stylesheets')
@endsection
@section('content')
    <h1 class="headline lighter text-center">Tracking</h1>

    <div class="row">
        <div class="small-12 medium-8 large-6 columns medium-offset-2 large-offset-3 end">
            {!! Form::open(['url' => '/tracking/update']) !!}
            {{ Form::label('trackingnumber', 'Tracking #') }}
            {{ Form::text('trackingnumber', null, ['autofocus']) }}
            {{ Form::submit('Søg', ['class' => 'large button']) }}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <div class="small-12 medium-8 large-6 columns medium-offset-2 large-offset-3 end">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>


@endsection
@section('scripts')
@endsection