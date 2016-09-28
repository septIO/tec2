@extends('layouts.app')
@section('title')
    Update Tracking
@endsection
@section('stylesheets')
@endsection
@section('content')
    <h1 class="headline lighter text-center">Tracking</h1>

    <h3 class="text-center">Tracking has been started</h3>
    <div class="row">
        <div class="small-12 medium-8 large-6 columns medium-offset-2 large-offset-3 end">
            {!! Form::open(['url' => '/tracking/update-items']) !!}
            {{ Form::label('trackingnumber', 'Tracking #') }}
            {{ Form::text('trackingnumber', null, ['autofocus']) }}
            {{ Form::submit('Søg', ['class' => 'large button']) }}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <table>
            @foreach ($items as $item)
                <tr>
                    <td>{{$item->trackingnumber}}</td>
                    <td>1</td>
                    <td>{{$item->height}} x {{$item->width}} x {{$item->depth}}</td>
                    <td>{{$item->weight}}kg</td>
                </tr>
            @endforeach
        </table>

        @if(count($items)==0)
            <div class="small-12">
                <h4 class="text-center">Alle varer er scannet ind!</h4>
            </div>
        @endif
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