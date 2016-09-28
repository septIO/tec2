@extends('layouts.app')

@section('content')
    @foreach($items as $item)
        <div class="row">
            <div class="small-12">
                <h3>{{$item->trackingnumber}}</h3>
            </div>
            <div class="small-6">blah</div>
            <div class="small-6"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($item->trackingnumber, "C128")}}" /></div>
        </div>
    @endforeach
@endsection
