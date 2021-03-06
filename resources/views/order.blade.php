@extends('layouts.app')
@section('title')
    Bestil levering
@endsection
@section('content')
    <div ng-controller="orderController">
        <h1 class="headline lighter text-center">Bestil Levering</h1>
        {!! Form::Open(['url' => 'order/create']) !!}
        <div class="row">
            <div class="small-12 large-6 columns order-box">
                <h2 class="headline text-center">Afhentning</h2>
                <div class="row">
                    <div class="small-4 columns">
                        {!! Form::label('a_name', 'Navn') !!}
                        {!! Form::text('a_name', null, ['placeholder' => 'F.eks Jens Jensen']) !!}
                        <p class="help-text">{{$errors->first('a_name')}}</p>
                    </div>

                    <div class="small-3 columns">
                        {!! Form::label('a_phone', 'Telefon') !!}
                        {!! Form::text('a_phone', null, ['placeholder' => 'F.eks 12345678']) !!}
                        <p class="help-text">{{$errors->first('a_phone')}}</p>
                    </div>

                    <div class="small-5 columns">
                        {!! Form::label('a_email', 'Email') !!}
                        {!! Form::email('a_email', null, ['placeholder' => 'F.eks din@email.dk']) !!}
                        <p class="help-text">{{$errors->first('a_email')}}</p>
                    </div>

                    <div class="small-6 columns">
                        {!! Form::label('a_address', 'Adresse') !!}
                        {!! Form::text('a_address', null, ['placeholder' => 'F.eks Grønnevænget 47, 1. tv']) !!}
                        <p class="help-text">{{$errors->first('a_address')}}</p>
                    </div>

                    <div class="small-2 columns">
                        {!! Form::label('a_zipcode', 'Postnummer') !!}
                        {!! Form::number('a_zipcode', null, ['placeholder' => 'F.eks 4000']) !!}
                        <p class="help-text">{{$errors->first('a_zipcode')}}</p>
                    </div>

                    <div class="small-4 columns">
                        {!! Form::label('a_city', 'By') !!}
                        {!! Form::text('a_city', null, ['placeholder' => 'F.eks Roskilde']) !!}
                        <p class="help-text">{{$errors->first('a_city')}}</p>
                    </div>

                    <div class="small-6 columns">
                        {!! Form::label('a_date', 'Afhentnings dato') !!}
                        {!! Form::date('a_date', date('Y-m-d', strtotime('tomorrow'))) !!}
                        <p class="help-text">{{$errors->first('a_date')}}</p>
                    </div>

                    <div class="small-6 columns">
                        {!! Form::label('a_time', 'Afhentnings tidspunkt') !!}
                        {!! Form::time('a_time', date('H:i', strtotime('8am'))) !!}
                        <p class="help-text">{{$errors->first('a_time')}}</p>
                    </div>
                </div>
            </div>

            <div class="small-12 large-6 columns order-box">
                <h2 class="headline text-center">Levering</h2>
                <div class="row">
                    <div class="small-4 columns">
                        {!! Form::label('l_name', 'Navn') !!}
                        {!! Form::text('l_name', null, ['placeholder' => 'F.eks Jens Jensen']) !!}
                        <p class="help-text">{{$errors->first('l_name')}}</p>
                    </div>

                    <div class="small-3 columns">
                        {!! Form::label('l_phone', 'Telefon') !!}
                        {!! Form::text('l_phone', null, ['placeholder' => 'F.eks 12345678']) !!}
                        <p class="help-text">{{$errors->first('l_phone')}}</p>
                    </div>

                    <div class="small-5 columns">
                        {!! Form::label('l_email', 'Email') !!}
                        {!! Form::email('l_email', null, ['placeholder' => 'F.eks din@email.dk']) !!}
                        <p class="help-text">{{$errors->first('l_email')}}</p>
                    </div>

                    <div class="small-6 columns">
                        {!! Form::label('l_address', 'Adresse') !!}
                        {!! Form::text('l_address', null, ['placeholder' => 'F.eks Grønnevænget 47, 1. tv']) !!}
                        <p class="help-text">{{$errors->first('l_address')}}</p>
                    </div>

                    <div class="small-2 columns">
                        {!! Form::label('l_zipcode', 'Postnummer') !!}
                        {!! Form::number('l_zipcode', null, ['placeholder' => 'F.eks 4000']) !!}
                        <p class="help-text">{{$errors->first('l_zipcode')}}</p>
                    </div>

                    <div class="small-4 columns">
                        {!! Form::label('l_city', 'By') !!}
                        {!! Form::text('l_city', null, ['placeholder' => 'F.eks Roskilde']) !!}
                        <p class="help-text">{{$errors->first('l_city')}}</p>
                    </div>

                    <div class="small-6 columns">
                        {!! Form::label('l_date', 'Afhentnings dato') !!}
                        {!! Form::date('l_date', date('Y-m-d', strtotime('tomorrow'))) !!}
                        <p class="help-text">{{$errors->first('l_date')}}</p>
                    </div>

                    <div class="small-6 columns">
                        {!! Form::label('l_time', 'Afhentnings tidspunkt') !!}
                        {!! Form::time('l_time', date('H:i', strtotime('12:00'))) !!}
                        <p class="help-text">{{$errors->first('l_time')}}</p>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($errors->all() as $e)
            {{ $e }}
        @endforeach
        <div class="row order-items">
            <div class="small-12 columns">
                <table>
                    <tr>
                        <th>Antal</th>
                        <th>Type</th>
                        <th>Beskrivelse</th>
                        <th>Vægt (KG)</th>
                        <th>Størrelse (L x H x D) cm</th>
                    </tr>
                    <tr ng-repeat="i in _.range(items)">
                        <td><input type="number" name="items[<% i %>][amount]"/></td>
                        <td>{{ Form::select('items[<% i %>][type]', \App\ItemTypes::pluck('type', 'id')) }}</td>
                        <td>{{ Form::textarea('items[<% i %>][message]') }}</td>
                        <td>{{ Form::number('items[<% i %>][weight]') }}</td>
                        <td class="item-sizes">
                            {{ Form::number('items[<% i %>][length]') }}
                            {{ Form::number('items[<% i %>][height]') }}
                            {{ Form::number('items[<% i %>][width]') }}
                        </td>
                    </tr>
                </table>
                <button class="large button warning" type="button" ng-click="items=items+1">Tilføj flere</button>
            </div>
        </div>
        <div class="row">
            <div class="small-12 medium-6 medium-offset-3 large-4 large-offset-4 columns">
                {!! Form::submit('Send', ['class' => 'large button expanded']) !!}
            </div>
        </div>
    </div>
    {!! Form::Close() !!}

@endsection
