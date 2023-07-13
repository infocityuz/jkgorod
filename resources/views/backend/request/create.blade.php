@extends('layouts.backend')
@section('title')
    {{__('locale.apartment_sale')}} {{__('locale.create')}}
@endsection
@section('styles')

    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>
@endsection
<style>
    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        font-weight: bold;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }
    #checkBoxes {
        border: 1px #8DF5E4 solid;
    }

    #checkBoxes label {
        display: block;
    }

    #checkBoxes label:hover {
        background-color: #4F615E;
    }

    #checkBoxes label:hover{
        color: white;
    }
    .display {
        display: none;
    }

    .display-none{
        display:none;
    }
    .modal-body{
        padding:20px 44px 44px 44px;
    }
    .house-status{
        display: flex;
        flex-direction: column;
        border: solid 1px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        width: 100%;
        padding: 14px 6px;
    }
    .house_status_value{
        color:black !important;
        transition: 1s;
        padding: 10px 14px;
        border-radius: 4px;
        width: 100%;
    }
    .metro_status, .house_status_{
        border: solid 1px rgba(0, 0, 0, 0.1);
    }
    .house_status_value:hover{
        transform: scale(1.01);
    }
    .house-status a{
        color:black !important;
        transition: 1s;
        border-radius: 4px;
        padding: 0px 18px;
    }
    #busy:hover, #sales:hover, #free:hover{
        transform: scale(1.04);
        background-color: rgba(0, 0, 0, 0.2);
    }

    .select2-results__option:hover {
        background-color: rgba(0, 0, 0, 0.2);
    }
    .checkbox {
        width: 20px;
        height:20px;
    }
    #prepayment_submit_{
        padding: 7px 14px ;
        background-color: green;
        color: black;
    }
    .btn-tool{
        margin: 0 0 !important;
    }
    .metro_content{
        position: absolute;
        background-color: white;
        z-index: 4;
    }
    .metro_content >.house-status{
        height: 300px;
        padding: 14px 0px;
        overflow: auto;
    }
    .house-status a{
        padding: 7px 2px;
        transition: 1s;
    }
    .house-status a:hover{
        background-color: silver;
        transform: scale(1.03);
    }
    .price-form-group{
        display:flex;
        justify-content: space-around;
    }
    .price-form-group .form-group{
        width:47%;
        text-align:center
    }
</style>
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('locale.Request')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('backend.index', app()->getLocale())}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('request.index', app()->getLocale())}}">{{__('locale.Request')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.create')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('request.store', app()->getLocale())}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="modal fade" id="modal-default-organization">
                        <div class="modal-dialog" style="max-width: 700px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__('locale.R_S name')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="text_name">{{__('locale.R_S')}}</label>
                                                <input type="text" name="organization" id="text_name" list="browsers"
                                                       class="form-control @error('text_name') error-data-input is-invalid @enderror keyUpName"
                                                       value="{{old('organization') }}"
                                                       autocomplete="off">
                                            </div>
                                            <input type="hidden" id="hidden_name" name="hidden_name">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="justify-content-end" style="">
                                                <button  data-dismiss="modal" aria-label="Close" class="close" id="prepayment_submit_">{{__('locale.create')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                <div class="modal-footer justify-content-between">--}}
                                {{--                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                                {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                                {{--                </div>--}}
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <div class="modal fade" id="modal-default-metro">
                        <div class="modal-dialog" style="max-width: 700px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__('locale.Distance to metro')}}  <b id="metro_name"></b></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="distanceToMetro">{{__('locale.Distance')}}</label>
                                                <input type="number" name="distance_to_metro" step="0.01" min="0"  id="distanceToMetro" list="browsers"
                                                       class="form-control @error('text_name') error-data-input is-invalid @enderror keyUpName"
                                                       value="{{ $model->distance_to_metro??'' }}"
                                                       autocomplete="off">
                                            </div>
                                            <input type="hidden" id="hidden_name" name="hidden_name">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="justify-content-end" style="">
                                                <button  data-dismiss="modal" aria-label="Close" class="close" id="prepayment_submit_">{{__('locale.Enter')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="type" class="type_layout">{{ __('locale.type') }}</label>
                            <a data-placeholder="{{ __('locale.type') }}" id="showCheckboxes"
                               class="form-control"></a>
                            <div id="checkBoxes" class="p-3 display-none">
                                <label for="sale">
                                    <input type="checkbox" class="flat_types" name="flat_types[]" value="Продажа"/>
                                    {{__('locale.sale')}}
                                </label>
                                <label for="rent">
                                    <input type="checkbox" class="flat_types" name="flat_types[]" value="Аренда долгосрочная"/>
                                    {{__('locale.rent')}}
                                </label>
                                <label for="exchange">
                                    <input type="checkbox" class="flat_types" name="flat_types[]" value="Обмен"/>
                                    {{__('locale.exchange')}}
                                </label>
                                <label for="daily_rent">
                                    <input type="checkbox" class="flat_types" name="flat_types[]" value="Посуточная аренда"/>
                                    {{__('locale.daily_rent')}}
                                </label>
                            </div>
                            <span class="error-data">
                                @error('type')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="type">{{__('locale.type')}}</label>--}}
                        {{--                            <select required name="type" id="type"--}}
                        {{--                                    data-placeholder="{{__('locale.type')}}"--}}
                        {{--                                    class="form-control select2 @error('type') is-invalid error-data-input @enderror" >--}}

                        {{--                                <option value="">---------------------</option>--}}
                        {{--                                <option value="Аренда долгосрочная">Аренда долгосрочная</option>--}}
                        {{--                                <option value="Продажа">Продажа</option>--}}
                        {{--                                <option value="Обмен">Обмен</option>--}}
                        {{--                                <option value="Посуточная аренда">Посуточная аренда</option>--}}

                        {{--                            </select>--}}
                        {{--                            <span class="error-data">@error('type'){{$message}}@enderror</span>--}}
                        {{--                        </div>--}}

                        <div class="form-group">
                            <label for="titleId">{{__('locale.title')}}</label>
                            <input type="text" name="title" id="titleId" class="form-control @error('title') error-data-input is-invalid @enderror" value="{{ old('title') }}">
                            <span class="error-data">@error('title'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="addressId">{{__('locale.address')}}</label>
                            <input type="text" name="address" id="addressId" class="form-control @error('address') error-data-input is-invalid @enderror" value="{{ old('address') }}">
                            <span class="error-data">@error('address'){{$message}}@enderror</span>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="object_region_id">{{ __('locale.Region') }}</label>
                                <select name="region_id" id="object_security"
                                        data-placeholder="{{ __('locale.select') }}"
                                        class="form-control @error('object_security') is-invalid error-data-input @enderror">
                                    <option value="">------------</option>
                                    @if (!empty($region))
                                        @foreach ($region as $val)
                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    @endif
                                </select>

                                {{-- <label for="object_region_id">{{ __('locale.Region') }}</label>
                                <input type="text" name="region" id="object_region_id"
                                    data-placeholder="{{ __('locale.select') }}"
                                    class="form-control select2 @error('object_region_id') is-invalid error-data-input @enderror" value="{{ old('object_region_id') }}"> --}}
                                <span class="error-data">
                                        @error('region_id')
                                    {{ $message }}
                                    @enderror
                                    </span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="district_id">{{ __('locale.Town') }}</label>
                                <select name="town_id" id="district_id" data-placeholder="{{ __('locale.select') }}"
                                        class="form-control @error('district_id') is-invalid error-data-input @enderror">
                                    <option value="">------------</option>
                                    {{-- @if (!empty($town))
                                        @foreach ($town as $val)
                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    @endif --}}
                                </select>
                                {{-- <input type="text" name="town" id="district_id"
                                    data-placeholder="{{ __('locale.select') }}"
                                    class="form-control select2 @error('district_id') is-invalid error-data-input @enderror"
                                    value="{{ old('district_id') }}"> --}}
                                <span class="error-data">
                                        @error('district_id')
                                    {{ $message }}
                                    @enderror
                                    </span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="area_id">{{ __('locale.Area') }}</label>
                                <select name="area_id" id="area_id" data-placeholder="{{ __('locale.select') }}"
                                        class="form-control @error('area_id') is-invalid error-data-input @enderror">
                                    <option value="">------------</option>
                                    {{-- @if (!empty($area))
                                        @foreach ($area as $val)
                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    @endif --}}
                                </select>
                                {{-- <input type="text" name="area" id="areaId"
                                    class="form-control select2 @error('area_id') is-invalid error-data-input @enderror"
                                    data-placeholder="{{ __('locale.select') }}" value="{{ old('area') }}"> --}}
                                <span class="error-data">
                                        @error('area_id')
                                    {{ $message }}
                                    @enderror
                                    </span>
                            </div>
                            <div class="form-group col-lg-6">
                                <div class="form-group">
                                    <label for="metroId">{{ __('locale.Metro') }}</label>
                                    <a type="button" class="house_status_value metro_status fa fa-angle-down" id="metroId">
                                        {{__('locale.Select Metro')}}
                                    </a>
                                    <input type="hidden" id="metro_value" name="metro" value="">
                                    <div class="metro_content">
                                        <div class="house-status display-none" id="MetroItem">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="landmark">{{__('locale.landmark')}}</label>
                            <input type="text" name="landmark" id="landmark" class="form-control @error('landmark') error-data-input is-invalid @enderror" value="{{ old('landmark') }}" >
                            <span class="error-data">@error('landmark'){{$message}}@enderror</span>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <div class="flatItemStatus form-group" >
                                    <label for="housing_type">{{ __('locale.house_type') }}</label>
                                    <a type="button" class="house_status_value house_status_ fa fa-angle-down" id="house_status_value">
                                        {{__('locale.Housing type')}}
                                    </a>
                                    <input type="hidden" id="flat_status_value_" name="housing_type" value="{{old('housing_type')}}">
                                    <div class="house-status display-none" id="flatItemStatus">
                                        <a type="button" id="new_house" value="Новостройка" data-toggle="modal" data-target="#modal-default-organization"> {{__('locale.new_house')}} </a>
                                        <a type="button" id="secondary_market" value="Вторичный рынок"> {{__('locale.secondary_market')}} </a>
                                        {{-- <a type="button" id="sales_" value="2"> {{__('locale.Sales')}} </a> --}}
                                    </div>
                                </div>
                                {{--                                <label for="housing_type">{{__('locale.house_type')}}</label>--}}
                                {{--                                <select required name="housing_type" id="housing_type"  data-placeholder="{{__('locale.select')}}" class="form-control select2 @error('housing_type') is-invalid error-data-input @enderror" >--}}

                                {{--                                    <option value="">---------------------</option>--}}
                                {{--                                    <option value="Новостройка">Новостройка</option>--}}
                                {{--                                    <option value="Вторичный рынок">Вторичный рынок</option>--}}

                                {{--                                </select>--}}
                                <span class="error-data">@error('housing_type'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="building_type">{{__('locale.building_type')}}</label>
                                <select name="building_type" id="building_type"  data-placeholder="{{__('locale.select')}}" class="form-control select2 @error('building_type') is-invalid error-data-input @enderror" >
                                    <option value="">---------------------</option>
                                    <option value="Деревянный">{{__('locale.Wood')}}</option>
                                    <option value="Блочный">{{__('locale.Block')}}</option>
                                    <option value="Монолитный">{{__('locale.Monolithic')}}</option>
                                    <option value="Панельный">{{__('locale.Panel')}}</option>
                                    <option value="Кирпичный">{{__('locale.Brick')}}</option>
                                </select>
                                <span class="error-data">@error('building_type'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="bathroom">{{__('locale.bathroom')}}</label>
                                <select name="bathroom" id="bathroom"  data-placeholder="{{__('locale.select')}}" class="form-control select2 @error('bathroom') is-invalid error-data-input @enderror" >
                                    <option value="">---------------------</option>
                                    <option value="2 и более">{{__('locale.2 or more')}}</option>
                                    <option value="Совмещенный">{{__('locale.Combined')}}</option>
                                    <option value="Раздельный">{{__('locale.Separated')}}</option>

                                </select>
                                <span class="error-data">@error('bathroom'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="repair">{{__('locale.repair')}}</label>
                                <select name="repair" id="repair"
                                        data-placeholder="{{__('locale.select')}}"
                                        class="form-control select2 @error('repair') is-invalid error-data-input @enderror" >
                                    <option value="">---------------------</option>
                                    <option value="Предчистовая Отделка">{{__('locale.Prefinishing Finish')}}</option>
                                    <option value="Черновая Отделка">{{__('locale.Rough Finish')}}</option>
                                    <option value="Требуется Ремонт">{{__('locale.Requires Repair')}}</option>
                                    <option value="Средний Ремонт">{{__('locale.Medium Repair')}}</option>
                                    <option value="ЕвроРемонт">{{__('locale.EuroRepair')}}</option>
                                    <option value="Авторский Проект">{{__("locale.Author's Project")}}</option>

                                </select>
                                <span class="error-data">@error('repair'){{$message}}@enderror</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="layout">{{__('locale.layout')}}</label>
                            <select name="layout" id="layout"  data-placeholder="{{__('locale.select')}}" class="form-control select2 @error('layout') is-invalid error-data-input @enderror" >
                                <option value="">---------------------</option>
                                <option value="Малосемейка">{{__('locale.Little family')}}</option>
                                <option value="МногоУровневая">{{__('locale.Multilevel')}}</option>
                                <option value="Пентхаус">{{__('locale.Penthouse')}}</option>
                                <option value="Студия">{{__('locale.Studio')}}</option>
                                <option value="Смежно-Раздельная">{{__('locale.Adjacent-Separate')}}</option>
                                <option value="Раздельная">{{__('locale.Separate')}}</option>
                                <option value="Смежная">{{__('locale.Adjacent')}}</option>

                            </select>
                            <span class="error-data">@error('layout'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="descriptionId">{{__('locale.description')}}</label>
                            <textarea type="text" name="description"
                                      id="descriptionId"
                                      class="form-control @error('description') error-data-input is-invalid @enderror" style="height: 100px">{{ old('description') }}</textarea>
                            <span class="error-data">@error('description'){{$message}}@enderror</span>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="apartment_hasId">{{__('locale.apartment_has')}}</label>--}}
                        {{--                            <select required name="apartment_has[]" multiple="multiple" id="apartment_hasId"  data-placeholder="{{__('locale.select')}}" class="form-control select2 @error('apartment_has') is-invalid error-data-input @enderror" >--}}
                        {{--                                @if(!empty($apartments))--}}
                        {{--                                    <option value="">---------------------</option>--}}
                        {{--                                    @foreach($apartments as $apartment)--}}
                        {{--                                        <option value="{{$apartment->id}}">{{$apartment->name}}</option>--}}
                        {{--                                    @endforeach--}}
                        {{--                                @endif--}}
                        {{--                            </select>--}}
                        {{--                            <span class="error-data">@error('apartment_has'){{$message}}@enderror</span>--}}
                        {{--                        </div>--}}


                        <div class="form-group">
                            <label for="build_type">{{__('locale.apartment_has')}}</label>
                            @if(!empty($apartments))
                                <div class="row">
                                    @foreach($apartments as $apartment)
                                        <div class="col-lg-6">
                                            <div class="form-group clearfix mb-0">
                                                <div class="icheck-primary d-flex align-items-center">
                                                    <input  type="checkbox" name="apartment_has[]"
                                                            id="apartment_has_{{$apartment->id}}" value="{{$apartment->id}}">
                                                    <label for="apartment_has_{{$apartment->id}}" class="mb-0" style="font-weight: 500">
                                                        {{$apartment->name}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <span class="error-data">@error('apartment_has'){{$message}}@enderror</span>

                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="there_is_nearbyId">{{__('locale.there_is_nearby')}}</label>--}}
                        {{--                            <select required name="there_is_nearby[]" multiple="multiple"--}}
                        {{--                                    id="there_is_nearbyId"  data-placeholder="{{__('locale.select')}}"--}}
                        {{--                                    class="form-control select2 @error('there_is_nearby') is-invalid error-data-input @enderror" >--}}
                        {{--                                @if(!empty($there_is_nearbies))--}}
                        {{--                                    <option value="">---------------------</option>--}}
                        {{--                                    @foreach($there_is_nearbies as $there_is_nearby)--}}
                        {{--                                        <option value="{{$there_is_nearby->id}}">{{$there_is_nearby->name}}</option>--}}
                        {{--                                    @endforeach--}}
                        {{--                                @endif--}}
                        {{--                            </select>--}}
                        {{--                            <span class="error-data">@error('there_is_nearby'){{$message}}@enderror</span>--}}
                        {{--                        </div>--}}

                        <div class="form-group" style="border-top:1px solid #000">
                            <label for="build_type">{{__('locale.there_is_nearby')}}</label>
                            @if(!empty($there_is_nearbies))
                                <div class="row">
                                    @foreach($there_is_nearbies as $there_is_nearby)
                                        <div class="col-lg-6">
                                            <div class="form-group clearfix mb-0">
                                                <div class="icheck-primary d-flex align-items-center">
                                                    <input  type="checkbox" name="there_is_nearby[]"
                                                            id="there_is_nearby_{{$there_is_nearby->id}}" value="{{$there_is_nearby->id}}">
                                                    <label for="there_is_nearby_{{$there_is_nearby->id}}" class="mb-0" style="font-weight: 500">
                                                        {{$there_is_nearby->name}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <span class="error-data">@error('there_is_nearby'){{$message}}@enderror</span>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="floor_id">{{__('locale.floor')}}</label>
                            <input type="number" name="floor" id="floor_id" class="form-control @error('floor') error-data-input is-invalid @enderror" value="{{ old('floor') }}">
                            <span class="error-data">@error('floor'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="floors_of_houseId">{{__('locale.floors_of_house')}}</label>
                            <input type="number" name="floors_of_house" id="floors_of_houseId" class="form-control @error('floors_of_house') error-data-input is-invalid @enderror" value="{{ old('floors_of_house') }}">
                            <span class="error-data">@error('floors_of_house'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">

                            <label >{{ __('locale.cellar') }}</label> <br>

                            <input class="checkbox m-1" type="checkbox" id="have_cellar" name="have_cellar">
                            <label  for="have_cellar">{{ __('locale.have') }}</label>

                            <input  class="checkbox ml-4 m-1" type="checkbox" id="no_cellar" name="no_cellar">
                            <label   for="no_cellar">{{ __('locale.no') }}</label>
                            <span class="error-data">
                                @error('floors_of_house')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kitchen_area_id">{{__('locale.kitchen_area')}}</label>
                            <input type="number" step=0.01 name="kitchen_area" id="kitchen_area_id" class="form-control @error('kitchen_area') error-data-input is-invalid @enderror" value="{{ old('kitchen_area') }}">
                            <span class="error-data">@error('kitchen_area'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="living_space_id">{{__('locale.living_space')}}</label>
                            <input type="number" step=0.01 name="living_space" id="living_space_id" class="form-control @error('living_space') error-data-input is-invalid @enderror" value="{{ old('living_space') }}">
                            <span class="error-data">@error('living_space'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="total_areaId">{{__('locale.total_area')}}</label>
                            <input type="number" step=0.01 name="total_area" id="total_areaId" class="form-control @error('total_area') error-data-input is-invalid @enderror" value="{{ old('total_area') }}">
                            <span class="error-data">@error('total_area'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="number_of_rooms_id">{{__('locale.number_of_rooms')}}</label>
                            <input type="number" name="number_of_rooms" id="number_of_rooms_id" class="form-control @error('number_of_rooms') error-data-input is-invalid @enderror" value="{{ old('number_of_rooms') }}">
                            <span class="error-data">@error('number_of_rooms'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="ceiling_heightId">{{__('locale.ceiling_height')}}</label>
                            <input type="number" step=0.01 name="ceiling_height" id="ceiling_heightId" class="form-control @error('ceiling_height') error-data-input is-invalid @enderror" value="{{ old('ceiling_height') }}">
                            <span class="error-data">@error('ceiling_height'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="year_constructionId">{{__('locale.year_construction')}}</label>
                            <input type="text" id="year_construction" name="year_construction" class="form-control " value="">
                            <span class="error-data"></span>
                        </div>

                        <div class="form-group">
                            <p class="input-title-p">{{__('locale.currency')}}</p>
                            <div class="custom-control custom-radio d-flex" >
                                <div style="margin-right: 50px">
                                    <input class="custom-control-input" name="currency" type="radio" checked id="uzsId" value="1">
                                    <label for="uzsId" class="custom-control-label">{{__('locale.uzs')}}</label>
                                    <span class="error-data">@error('currency'){{$message}}@enderror</span>
                                </div>
                                <div>
                                    <input class="custom-control-input" type="radio" name="currency" id="usdId" value="2">
                                    <label for="usdId" class="custom-control-label">{{__('locale.usd')}}</label>
                                    <span class="error-data">@error('currency'){{$message}}@enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group price-form-group">
                            <div class="form-group">
                                <label for="price_from">{{__('locale.price from')}}</label>
                                <input autocomplete="off" type="number" name="price_from" step=0.01 id="price_from" class="form-control @error('price_from') error-data-input is-invalid @enderror" value="{{ old('price_from') }}">
                                <span class="error-data">@error('price_from'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="price_to">{{__('locale.price to')}}</label>
                                <input autocomplete="off" type="number" name="price_to" step=0.01 id="price_to" class="form-control @error('price_to') error-data-input is-invalid @enderror" value="{{ old('price_to') }}">
                                <span class="error-data">@error('price_to'){{$message}}@enderror</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_exchange" class="custom-control-input" id="is_exchange_id">
                                <label class="custom-control-label" for="is_exchange_id">{{__('locale.is_exchange')}}</label>
                                <span class="error-data">@error('is_exchange'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_furnished" class="custom-control-input" id="is_furnishedId">
                                <label class="custom-control-label" for="is_furnishedId">{{__('locale.is_furnished')}}</label>
                                <span class="error-data">@error('is_furnished'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_commission" class="custom-control-input" id="is_commissionId">
                                <label class="custom-control-label" for="is_commissionId">{{__('locale.is_commission')}}</label>
                                <span class="error-data">@error('is_commission'){{$message}}@enderror</span>
                            </div>
                            <div class="commission__items row">
                                <div class="commission__item col-lg-6">
                                    <label for="is_commission_percent">{{__('locale.is_commission_percent')}}</label>
                                    <input type="text" name="is_commission_percent" id="is_commission_percent"
                                           class="form-control @error('is_commission_percent') error-data-input is-invalid @enderror"
                                           value="{{ old('is_commission_percent') }}">
                                    <span class="error-data">@error('is_commission_percent'){{$message}}@enderror</span>
                                </div>
                                <div class="commission__item col-lg-6">
                                    <label for="is_commission_number">{{__('locale.is_commission_number')}}</label>
                                    <input type="text" name="is_commission_number" id="is_commission_number"
                                           class="form-control @error('price') error-data-input is-invalid @enderror"
                                           value="{{ old('is_commission_number') }}">
                                    <span class="error-data">@error('is_commission_number'){{$message}}@enderror</span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-default collapsed-card">
                    <div class="card-header" data-card-widget="collapse">

                        <h3 class="card-title" style="font-weight: 700">{{__('locale.contacts')}}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_nameId">{{__('locale.first_name')}}</label>
                            <input type="text" name="first_name" id="first_nameId" class="form-control @error('first_name') error-data-input is-invalid @enderror" value="{{ old('first_name') }}" >
                            <span class="error-data">@error('first_name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{__('locale.last_name')}}</label>
                            <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') error-data-input is-invalid @enderror" value="{{ old('last_name') }}" >
                            <span class="error-data">@error('last_name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="surname">{{__('locale.patronymic')}}</label>
                            <input type="text" name="surname" id="surname" class="form-control @error('surname') error-data-input is-invalid @enderror" value="{{ old('surname') }}" >
                            <span class="error-data">@error('surname'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">{{__('locale.phone_number')}}</label>
                            <div class="number_block">
                                <input type="text" name="phone_code" class="form-control" value=" + 9 9 8" readonly>
                                <input type="tel" name="phone_number" id="phone_number"
                                       class="form-control object_number @error('phone_number') error-data-input is-invalid @enderror"
                                       value="{{ old('phone_number') }}">
                            </div>
                            <span class="error-data">@error('phone_number'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="additional_phone_number">{{translate('additional phone number')}}</label>
                            {{--                            <input type="text" name="additional_phone_number" id="additional_phone_number" class="form-control @error('additional_phone_number') error-data-input is-invalid @enderror" value="{{ old('additional_phone_number') }}" >--}}

                            <div class="number_block">
                                <input type="text" name="phone_code2" class="form-control" value=" + 9 9 8" readonly>
                                <input style="border-left:0;border-top-left-radius: 0;border-bottom-left-radius: 0;" type="tel" name="additional_phone_number" id="additional_phone_number"
                                       class="form-control object_number @error('phone_number') error-data-input is-invalid @enderror"
                                       value="{{ old('additional_phone_number') }}">
                            </div>

                            <span class="error-data">@error('additional_phone_number'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('locale.email')}}</label>
                            <input type="text" name="email" id="email" class="form-control @error('email') error-data-input is-invalid @enderror" value="{{ old('email') }}" >
                            <span class="error-data">@error('email'){{$message}}@enderror</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">{{__('locale.create')}}</button>
                </div>
            </div>
        </div>
    </form>
    {{--    https://laraveldaily.com/multiple-file-upload-with-dropzone-js-and-laravel-medialibrary-package/--}}
@endsection

@section('scripts')
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/jquery.maskedinput.min.js')}}"></script>

    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/sortable.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/filetype.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/buffer.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/locales/ru.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            function flatstatus(){
                if($('#flatItemStatus').hasClass('display-none')){
                    $('#flatItemStatus').removeClass('display-none')
                }else{
                    $('#flatItemStatus').addClass('display-none')
                }
            }
            function metroItemFunc(){
                if($('#MetroItem').hasClass('display-none')){
                    $('#MetroItem').removeClass('display-none')
                }else{
                    $('#MetroItem').addClass('display-none')
                }
            }
            $.get('/backend-assets/metro.json', function (data) {
                let select_city = "{{__('locale.Select Metro')}}"
                $.each(data, function(index, value) {
                    $('#MetroItem').append(`<a type="button" class="metro_item" value="${value}" data-toggle="modal" data-target="#modal-default-metro"> ${value} </a>`)
                });
                $('.metro_item').on('click', function () {
                    $('#metroId').text(` ${$(this).attr('value')}`)
                    $('#metro_name').text(` ${$(this).attr('value')}`)
                    $('#metro_value').attr('value', $(this).attr('value'))
                    $('#MetroItem').addClass('display-none')
                });
            });
            $(document).on('change', '#object_security', function(e) {
                e.preventDefault()
                $('#district_id').parent('div').show()
                $('#district_id').html('<option value="0">------------</option>')
                $('#area_id').html('<option value="0">------------</option>')
                var id = $(this).val()
                $.ajax({
                    url: `/${current_language}/real-estate/object/find-town/${id}`,
                    type: 'GET',
                    success: function(responce) {
                        if (responce.area == true) {
                            $('#area_id').html(responce.data)
                            $('#district_id').parent('div').hide()
                        } else {
                            $('#district_id').html(responce.data)
                        }
                    }
                });
            })
            $(document).on('change', '#district_id', function(e) {
                e.preventDefault()
                var id = $(this).val()
                $.ajax({
                    url: `/${current_language}/real-estate/object/find-area/${id}`,
                    type: 'GET',
                    success: function(responce) {
                        $('#area_id').html(responce)
                    }
                });
            })
            $('#house_status_value').on('click', function (){
                flatstatus()
            });
            $('.flat_types').on('click', function(){
                if($(this).is(':checked')){
                    $('#showCheckboxes').append(`${this.value}, `)
                }else{
                    $('#showCheckboxes').html($('#showCheckboxes').html().replace(`${this.value}, `, ''))
                }
            });
            $('#showCheckboxes').on('click', function() {
                if($('#checkBoxes').hasClass('display-none')){
                    $('#checkBoxes').removeClass('display-none')
                }else{
                    $('#checkBoxes').addClass('display-none')
                }
            });
            $('#metroId').on('click', function (){
                metroItemFunc()
            });
            $('#secondary_market').on('click', function (){
                flatstatus()
                $('#house_status_value').text($(this).text())
                $('#flat_status_value_').val($(this).attr('value'))
            });
            $('#sales_').on('click', function (){
                flatstatus()
                $('#house_status_value').text($(this).text())
                $('#flat_status_value_').val($(this).attr('value'))
            });
            $('#new_house').on('click', function (){
                flatstatus()
                $('#house_status_value').text($(this).text())
                $('#flat_status_value_').val($(this).attr('value'))
            });
            let current_language = '{{app()->getLocale()}}'

            let sessionSuccess ="{{session('success')}}";
            if(sessionSuccess){
                toastr.success(sessionSuccess)
            }
            let sessionWarning = "{{session('warning')}}";
            if(sessionWarning){
                toastr.success(sessionWarning)
            }
            let sessionError = "{{session('error')}}";
            if(sessionError){
                toastr.success(sessionError)
            }
            let living_space = 0
            let kitchen_area = 0
            $('#kitchen_area_id').on('change', function () {
                kitchen_area = this.value
                $('#total_areaId').val(`${parseInt(kitchen_area) + parseInt(living_space)}`)
            });
            $('#living_space_id').on('change', function () {
                living_space = this.value
                $('#total_areaId').val(`${parseInt(kitchen_area) + parseInt(living_space)}`)
            });
            $('#year_construction').datetimepicker({
                format: 'Y-M-D',
            });

            $('input[type=tel]').mask("(99) 999-99-99");

            // kartik fileinput upload files

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#is_commissionId').on('click',function (e) {
                $('.commission__items').toggleClass('active');
            });


            $('#is_commission_percent').on('input',function (e) {

                let totalPrice = parseFloat($('#priceId').val());
                let percent = parseInt($(this).val());
                // parseInt($(this).val(percent))

                if(percent >= 0){
                    $('#is_commission_number').val(totalPrice*(percent/100));
                }else{
                    $('#is_commission_number').val('');
                }


            })

            $('#is_commission_number').on('input',function (e) {

                let totalPrice = parseFloat($('#priceId').val());
                let comissionNumber = parseInt($(this).val());
                if (comissionNumber >= 0){
                    $('#is_commission_percent').val(100*(comissionNumber/totalPrice));
                }else{
                    $('#is_commission_percent').val('');
                }

            })

        });
    </script>
@endsection




