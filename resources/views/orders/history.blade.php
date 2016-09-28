@extends('layouts.app')
@section('stylesheets')
@endsection
@section('content')
    <h1 class="headline lighter text-center">Ordre historik</h1>

    <div class="row">
        <div class="small-12 columns">
            @if(count($data)>0)
                <table class="history-table">
                    <tr>
                        <th>Ordre ID</th>
                        <th>Oprettet</th>
                        <th>Sidst opdateret</th>
                        <th>Status</th>
                    </tr>

                    @foreach($data as $order)
                        <tr data-href="{{ url('/order/show', $order -> guid) }}" class>
                            <td>{{ $order -> guid }}</td>
                            <td>{{ date('D d. M Y - H:i',strtotime($order -> created_at)) }}</td>
                            <td>{{ date('D d. M Y - H:i',strtotime($order -> updated_at)) }}</td>
                            <td>{{ strtotime($order -> status) ?:'Afventer Svar' }}</td>
                        </tr>
                    @endforeach
                </table>
                @else
                <h5 class="text-center">Du har endnu ikke lavet nogle ordre <br /><a href="{{ url('/order') }}">klik her for at lave en</a> </h5>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
@endsection