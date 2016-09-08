@extends('layouts.app')
@section('stylesheets')
@endsection
@section('content')
    <h1 class="headline lighter text-center">Tracking Status</h1>

    <div class="row">
        <div class="small-12 medium-6 columns">
            <h3 class="text-center">Status</h3>
            <table class="tracking-table">

                @if($data['order']->accepted == 0)
                    <p class="text-center">Afventer svar</p>
                @else
                    <tr class="text-center">
                        <td>Dato</td>
                        <td>Status</td>
                        <td>Tracking nummer</td>
                    </tr>
                    @for($i = 1; $i<=$data['order']->status; $i++)
                        <tr>
                            @if($i == 1)
                                <td>{{date("j. M Y - H:i", $data['order']->accepted_at)}}</td>
                                <td>Ordre godkendt</td>
                            @elseif($i == 2)
                                <td>{{date("j. M Y - H:i", $data['order']->init_start)}}</td>
                                <td>På vej til afhentning</td>
                            @elseif($i == 3)
                                <td>{{date("j. M Y - H:i", $data['order']->init_end)}}</td>
                                <td>Afhentet hos kunden</td>
                            @elseif($i == 4)
                                <td>{{date("j. M Y - H:i", $data['order']->depart_start)}}</td>
                                <td>Ankommet hos kunden</td>
                            @elseif($i == 5)
                                <td>{{date("j. M Y - H:i", $data['order']->depart_end)}}</td>
                                <td>Leveret hos kunden</td>
                            @endif

                            <td>{{$data['order']->guid}}</td>
                        </tr>
                    @endfor
                @endif
            </table>
        </div>


        <div class="small-12 medium-6 medium columns">
            <h3 class="text-center">Forsendelse</h3>
            <table class="tracking-table">
                <tr class="text-center">
                    <td>PakkeID</td>
                    <td>Størrelse</td>
                    <td>Vægt</td>
                </tr>
                @foreach ($data['items'] as $item)
                    <tr>
                        <td>{{$data['order']->guid}}-{{$item->id}}</td>
                        <td>{{$item->height}}<sub>cm</sub> x {{$item->width}}<sub>cm</sub> x {{$item->depth}}
                            <sub>cm</sub></td>
                        <td>{{$item->weight}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
@section('scripts')
@endsection