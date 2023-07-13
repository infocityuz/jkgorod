@extends('forthebuilder::layouts.forthebuilder')
@section('title') {{__("locale.show")}} @endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__("locale.leads")}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__("locale.home")}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.house.index')}}">{{__("locale.house")}}</a></li>
                            <li class="breadcrumb-item active">{{__("locale.show")}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <div class="card-block table-border-style">
            @for($j = 1; $j <= (int)$model->max('enterance'); $j++)
            <table class="table table-bordered table-hover">
                <thead>
                <tr class=" one_top">
{{--                    <th class="one ">--}}
{{--                        <div class="top_head">--}}
{{--                            <span class="number">{{__("locale.enterance")}}</span>--}}
{{--                            <span class="floor">{{__("locale.floor")}}</span>--}}
{{--                        </div>--}}
{{--                    </th>--}}
                    <th class="floor">{{__("locale.floor")}}</th>
                    <th>Подъезд № {{ $j }}</th>

                </tr>
                </thead>
                <tbody>
                @for($i = (int)$model->max('floor'); $i >= 1; $i--)
                    <tr>
                        <td class="floor">{{ $i}}</td>
                        <td>
                            <div class="house-boxes">
                                @foreach($houses as $house)
                                    @if($house->floor == $i && $house->enterance == $j)
                                        <a href="{{route('forthebuilder.house.show',$house->id)}}" title="номер комнаты"
                                           class="house-box @if($house->status == 2) red @elseif($house->status == 1) yellow @else white @endif">
                                            <span>{{$house->number}}</span>
                                            <span>{{$house->total_area}} м<sup>2</sup></span>
                                            <span>{{$house->price}} {{($house->currency == 1) ? 'сум' : '$'}} </span>

                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </td>
                    </tr>

                @endfor
                </tbody>
            </table>
            @endfor
            </div>
        </div>
    </div>
@endsection
@section('scripts')
  <script>
      let page_name = 'house-flat';
  </script>
@endsection







