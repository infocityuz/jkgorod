@extends('forthebuilder::layouts.forthebuilder')
@extends('forthebuilder::layouts.forthemodals')
@section('title') {{ __("locale.show") }} @endsection

@section('content')
    <div class="page-header card">
    </div>
    <div class="status">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="badge badge-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="m-0">
                            <b>{{ __('locale.house') }} : </b>{{ $model->house_number }}
                            <span class="house-flat-info" style="font-size: 16px;">(Всего {{ $arr['count_all'] }} кв. бронь {{ $arr['count_bookings'] }}, свободно {{ $arr['count_free'] }}, продано {{ $arr['count_solds'] }} )</span>
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('forthebuilder.index') }}">{{ __("locale.home") }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('forthebuilder.house.index') }}">{{ __("locale.house") }}</a></li>
                            <li class="breadcrumb-item active">{{ $model->house_number }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-header" style="padding-left: 0;padding-right: 0">
                <div class="breadcrumb-and-filter">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="action-content">
                                {{-- <p><b>{{ __('locale.house') }} : </b>{{ $model->house_number}}</p> --}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="action-content" style="text-align: right">
                                <a href="{{ route('forthebuilder.house-flat.create',['house_id' => $model->id, 'house_name' => $model->house_number,'enterance' => $model->max('enterance_count'),'floor' => $model->max('floor_count'),]) }}" class="style-add btn btn-primary" >
                                    {{ __('locale.create') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-block table-border-style">
                @for($j = 1; $j <= $model->enterance_count; $j++)
                    @php
                        $mf_count = [];
                        $mffree_count = [];
                        $mfbought_count = [];
                        $mfborrowing_count = [];
                    @endphp
                    @foreach($model->house_flat as $mflat)
                        @if($mflat->enterance == $j)
                            @php
                                $mf_count[] = $mflat;
                            @endphp
                        @endif
                        @if($mflat->enterance == $j && $mflat->status == 0)
                            @php
                                $mffree_count[] = $mflat->status;
                            @endphp
                        @endif
                        @if($mflat->enterance == $j && $mflat->status == 1)
                            @php
                                $mfbought_count[] = $mflat->status;
                            @endphp
                        @endif
                        @if($mflat->enterance == $j && $mflat->status == 2)
                            @php
                                $mfborrowing_count[] = $mflat->status;
                            @endphp
                        @endif
                    @endforeach
                @endfor
                @foreach($arr['list'] as $enterance => $floors)
                    <div class="card card-default collapsed-card">
                        <div class="card-header card_header" data-card-widget="collapse">
                            <h3 class="card-title card-title-white">
                                <span class="card-title_text"> Подъезд № {{ $enterance }}</span>
                                <span class="house-flat-info" style="font-size: 16px">(Всего {{ $floors['enterance_all'] ?? 0 }} кв. продано {{ $floors['enterance_solds'] ?? 0 }}, свободно {{ $floors['enterance_free'] ?? 0 }}, бронь {{ $floors['enterance_bookings'] ?? 0 }})</span>
                            </h3>
                            <div class="card-tools">
                                <button  style="color:#fff" type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <!-- Main content -->
                            <section class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-primary">
                                                <div class="card-body">
                                                    <div>
                                                        <div class="btn-group w-100 mb-2">
                                                            <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> Все </a>
                                                            <a class="btn btn-info" href="javascript:void(0)" data-filter="0" style="background: {{ $colors[0] }}; border-color: transparent"> {{ __("locale.Free") }} </a>
                                                            <a class="btn btn-info" href="javascript:void(0)" data-filter="1" style="background: {{ $colors[1] }};border-color: transparent"> {{ __("locale.Busy") }} </a>
                                                            <a class="btn btn-info" href="javascript:void(0)" data-filter="2" style="background: {{ $colors[2] }};border-color: transparent"> {{ __("locale.Sales") }} </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.container-fluid -->
                            </section>
                            <!-- /.content -->
                            <table class="table table-bordered table-hover ">
                                <thead>
                                    <tr class="one_top">
                                        <th class="floor">{{ __("locale.floor_count") }}</th>
                                        <th style="vertical-align: middle">
                                            Подъезд № {{ $enterance ?? 0 }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="filter-house">
                                    @foreach($floors['list'] as $floor => $flats)
                                        <tr>
                                            <td class="floor" style="vertical-align: middle; text-align: center">
                                                {{ $floor }}
                                            </td>
                                            <td>
                                                @if (!empty($flats))
                                                    <div class="house-boxes">
                                                        @foreach($flats as $flat)
                                                            {{-- @php echo "<pre>"; print_r($flat); die(); @endphp --}}
                                                            <a title="номер комнаты" data-id="{{ $flat['id'] }}"
                                                                data-contractNumber="{{ $flat['contract_number'] }}"
                                                                class="house-box filtr-item"
                                                                style="background-color: {{ $colors[$flat['color_status']] ?? '#117a8b' }}"
                                                                data-category="{{ $flat['color_status'] }}"
                                                            >
                                                                <span>{{ $flat['number_of_flat'] }}</span>
                                                                <span>{{ $flat['total_area'] }} м<sup>2</sup></span>
                                                                <span>{{ $flat['price'] }}$ </span>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@extends('forthebuilder::house.extra')