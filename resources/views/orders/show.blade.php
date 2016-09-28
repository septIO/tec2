@extends('layouts.app')
@section('stylesheets')
@endsection
@section('content')
    <h1 class="headline lighter text-center hide-for-print">Tracking Status</h1>
    <div class="row">
        <div class="small-12 medium-6 columns">
            <div class="row">
                <div class="small-12 columns">
                    <h3 class="text-center hide-for-print">Status</h3>
                    <div class="pull-right show-for-print">
                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($data["order"]->guid, "C128")}}" />
                    </div>
                    <table class="tracking-table">
                        @if($data['order']->accepted == 0)
                            <p class="text-center hide-for-print">Afventer svar</p>
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
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <div class="row">
                        <div class="small-6 columns">
                            <h6>Afhentes fra</h6>
                            <p>
                                {{$data['order']->a_name}}<br/>
                                {{$data['order']->a_address}}<br/>
                                {{$data['order']->a_zipcode}} {{$data['order']->a_city}}
                            </p>
                            <p>
                                <b>Forventet afhentning:</b><br/>
                                {{date('d. M Y',$data['order']->a_time)}}
                                {{date('H:i', $data['order']->a_time)}}
                            </p>
                        </div>

                        <div class="small-6 columns">
                            <h6>Leveres til</h6>
                            <p>
                                {{$data['order']->l_name}}<br/>
                                {{$data['order']->l_address}}<br/>
                                {{$data['order']->l_zipcode}} {{$data['order']->l_city}}
                            </p>
                            <p>
                                <b>Forventet levering:</b><br/>
                                {{date('d. M Y',$data['order']->l_time)}}
                                {{date('H:i', $data['order']->l_time)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="small-12 medium-6 medium columns">
            <h3 class="text-center">Forsendelse</h3>
            <table class="tracking-table">
                <tr>
                    <th>PakkeID</th>
                    <th>Total</th>
                    <th>Størrelse (cm)</th>
                    <th>Vægt</th>
                </tr>
                @foreach ($data['items'] as $item)
                    <tr>
                        <td>{{$item->trackingnumber}}</td>
                        <td>1</td>
                        <td>{{$item->height}} x {{$item->width}} x {{$item->depth}}</td>
                        <td>{{$item->weight}}kg</td>
                    </tr>
                    <tr class="item-info">
                        <td colspan="42">
                            <table>
                                @php($tracking = DB::table('invoice_items_tracking')->where('trackingnumber', $item->trackingnumber)->get())
                                @if(count($tracking)>0)
                                    @foreach($tracking as $t)
                                        <tr>
                                            <td>{{date('d M Y - H:i', strtotime($t->updated_at))}}</td>
                                            <td>{{\App\StatusMessages::find($t->status)->text}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center"><i>Afventer svar</i></td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
@section('scripts')
@endsection