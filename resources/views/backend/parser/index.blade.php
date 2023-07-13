@extends('layouts.backend')
@section('title') {{__('locale.apartment_sale')}}  @endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/toastr/toastr.min.css')}}">
@endsection
<style>
    .display-none{
        display: none;
    }
    @media screen and (max-width: 600px) {
        .modal-dialog{
            max-width: 94%
        }
    }
    @media screen and (min-width: 601px) {
        .modal-dialog{
            max-width: 70% !important;
        }
    }
    .modal-dialog-interval{
        display: flex;
        justify-content: center;
    }
    .modal-content-interval{
        width: 60%;
        text-align: center;
        border-radius: 4px;
    }
    #parsing_filter_process{
        padding: 7px 0px;
        background-color: green;
        margin-bottom: 20px;
    }
    .green{
        color: green;
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
                        <h1 class="m-0">{{__('locale.Parser')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.Parser')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default-parsing_filter">
        <div class="modal-dialog modal-dialog-interval">
            <div class="modal-content modal-content-interval">
                <div class="modal-header">
                    <h4 class="modal-title" id="parsing_filter_header"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="justify-content-center">
                                <h2><span id="interval_minut"></span></h2>
                            </div>
                            <div class="justify-content-center display-none" id="parsing_filter_process">

                            </div>
                            <div class="justify-content-end display-none" id="parsing_filter_submit">
                                <button type="button" class="btn btn-success" id="parsing_filter_submit_button">{{__('locale.Accepted')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-default-parser_flat">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('locale.Apartment filtering')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="justify-content-center">
                                <form class="row" action="{{route('parsing_filter', app()->getLocale())}}" method="POST">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="card card-primary">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="business_private">{{__('locale.type')}}</label>
                                                    <select name="business_private" id="business_private"  data-placeholder="{{__('locale.select')}}" class="form-control select2">
                                                        <option value="Все объявления" style="opacity: 0.4">{{__('locale.All announcements')}}</option>
                                                        <option value="business" style="opacity: 0.4">{{__('locale.Business')}}</option>
                                                        <option value="private" style="opacity: 0.4">{{__('locale.Private')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="flat_type">{{__('locale.Category')}}</label>
                                                    <select name="type" id="flat_type" data-placeholder="{{__('locale.type')}}"
                                                            class="form-control select2 @error('type') is-invalid error-data-input @enderror" >
                                                        <option value="">{{__('locale.All announcements')}}</option>
                                                        <option value="Аренда долгосрочная">{{__('locale.Long term rental')}}</option>
                                                        <option value="Продажа">{{__('locale.Sale')}}</option>
                                                        <option value="Обмен">{{__('locale.Exchange')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="region">{{__('locale.Region')}}</label>
                                                    <select name="region" id="region"  data-placeholder="{{__('locale.select')}}" class="form-control select2 @error('housing_type') is-invalid error-data-input @enderror" >
                                                        <option value="no">{{__('locale.Choose an area')}}</option>
                                                        <option value="andizhanskaya-oblast">Андижанская область</option>
                                                        <option value="buharskaya-oblast">Бухарская область</option>
                                                        <option value="dzhizakskaya-oblast">Джизакская область</option>
                                                        <option value="karakalpakstan">Каракалпакстан</option>
                                                        <option value="kashkadarinskaya-oblast">Кашкадарьинская область</option>
                                                        <option value="navoijskaya-oblast">Навоийская область</option>
                                                        <option value="namanganskaya-oblast">Наманганская область</option>
                                                        <option value="samarkandskaya-oblast">Самаркандская область</option>
                                                        <option value="surhandarinskaya-oblast">Сурхандарьинская область</option>
                                                        <option value="syrdarinskaya-oblast">Сырдарьинская область</option>
                                                        <option value="toshkent-oblast">Ташкентская область</option>
                                                        <option value="tashkent">Ташкент город</option>
                                                        <option value="ferganskaya-oblast">Ферганская область</option>
                                                        <option value="horezmskaya-oblast">Хорезмская область</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="city">{{__('locale.City')}}</label>
                                                    <select name="district" id="district"  data-placeholder="{{__('locale.select')}}" class="form-control select2">
                                                        <option value="" style="opacity: 0.4">{{__('locale.City')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group display-none" id="Furnished">
                                                    <label for="Furnished">{{__('locale.Furnished')}}</label>
                                                    <select name="furnished" class="form-control">
                                                        <option value="Все объявления">{{__('locale.All announcements')}}</option>
                                                        <option value="Да">{{__('locale.Yes')}}</option>
                                                        <option value="Нет">{{__('locale.No')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group display-none" id="Commission">
                                                    <label for="Commission">{{__('locale.Commission')}}</label>
                                                    <select name="commission" class="form-control">
                                                        <option value="Все объявления">{{__('locale.All announcements')}}</option>
                                                        <option value="Да">{{__('locale.Yes')}}</option>
                                                        <option value="Нет">{{__('locale.No')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group display-none" id="Housing_type">
                                                    <label for="Housing_type">{{__('locale.Housing type')}}</label>
                                                    <select name="housing_type" class="form-control">
                                                        <option value="Все объявления">{{__('locale.All announcements')}}</option>
                                                        <option value="Новостройки">Новостройки</option>
                                                        <option value="Вторичный рынок">Вторичный рынок</option>
                                                    </select>
                                                </div>
                                                <div class="row" id="price">
                                                    <div class="col-lg-1"></div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="price_from">{{__('locale.price from')}}</label>
                                                        <input list="pricefrom" name="price_from" id="price_from" autocomplete="off" class="form-control" placeholder="{{__('locale.in sum')}}">
                                                        <datalist id="pricefrom">
                                                            <option value="500 000">500 000</option>
                                                            <option value="1 000 000">1 000 000</option>
                                                            <option value="5 000 000">5 000 000</option>
                                                            <option value="10 000 000">10 000 000</option>
                                                            <option value="50 000 000">50 000 000</option>
                                                            <option value="100 000 000">100 000 000</option>
                                                            <option value="200 000 000">200 000 000</option>
                                                            <option value="300 000 000">300 000 000</option>
                                                            <option value="400 000 000">400 000 000</option>
                                                            <option value="500 000 000">500 000 000</option>
                                                            <option value="600 000 000">600 000 000</option>
                                                            <option value="700 000 000">700 000 000</option>
                                                            <option value="1 000 000 000">1 000 000 000</option>
                                                            <option value="2 000 000 000">2 000 000 000</option>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-lg-2"></div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="price_to">{{__('locale.price to')}}</label>
                                                        <input list="priceto" name="price_to" id="price_to" autocomplete="off" class="form-control" placeholder="{{__('locale.in sum')}}">
                                                        <datalist id="priceto">
                                                            <option value="500 000">500 000</option>
                                                            <option value="1 000 000">1 000 000</option>
                                                            <option value="5 000 000">5 000 000</option>
                                                            <option value="10 000 000">10 000 000</option>
                                                            <option value="50 000 000">50 000 000</option>
                                                            <option value="100 000 000">100 000 000</option>
                                                            <option value="200 000 000">200 000 000</option>
                                                            <option value="300 000 000">300 000 000</option>
                                                            <option value="400 000 000">400 000 000</option>
                                                            <option value="500 000 000">500 000 000</option>
                                                            <option value="600 000 000">600 000 000</option>
                                                            <option value="700 000 000">700 000 000</option>
                                                            <option value="1 000 000 000">1 000 000 000</option>
                                                            <option value="2 000 000 000">2 000 000 000</option>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-lg-1"></div>
                                                </div>
                                                <div class="row" id="rooms">
                                                    <div class="col-lg-1"></div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="rooms_from">{{__('locale.Number of rooms from')}}</label>
                                                        <input list="roomsfrom" name="rooms_from" id="rooms_from" class="form-control">
                                                        <datalist id="roomsfrom">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-lg-2"></div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="rooms_to">{{__('locale.Number of rooms to')}}</label>
                                                        <input list="roomsto" name="rooms_to" id="rooms_to" class="form-control">
                                                        <datalist id="roomsto">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-lg-1"></div>
                                                </div>
                                                <div class="row" id="area">
                                                    <div class="col-lg-1"></div>
                                                    <div class="col-lg-4">
                                                        <label for="area_from">{{__('locale.total area from')}}</label>
                                                        <input list="areafrom" name="area_from" id="area_from" class="form-control">
                                                        <datalist id="areafrom">
                                                            <option value="10">10</option>
                                                            <option value="20">20</option>
                                                            <option value="30">30</option>
                                                            <option value="40">40</option>
                                                            <option value="50">50</option>
                                                            <option value="60">60</option>
                                                            <option value="70">70</option>
                                                            <option value="80">80</option>
                                                            <option value="90">90</option>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-4">
                                                        <label for="area_to">{{__('locale.total area to')}}</label>
                                                        <input list="areato" name="area_to" id="area_to" class="form-control">
                                                        <datalist id="areato">
                                                            <option value="10">10</option>
                                                            <option value="20">20</option>
                                                            <option value="30">30</option>
                                                            <option value="40">40</option>
                                                            <option value="50">50</option>
                                                            <option value="60">60</option>
                                                            <option value="70">70</option>
                                                            <option value="80">80</option>
                                                            <option value="90">90</option>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-lg-1"></div>
                                                </div>
                                                <div class="row" id="floor">
                                                    <div class="col-lg-1"></div>
                                                    <div class="col-lg-4">
                                                        <label for="floor_from">{{__('locale.floor_from')}}</label>
                                                        <input list="floorfrom" name="floor_from" id="floor_from" class="form-control">
                                                        <datalist id="floorfrom">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-4">
                                                        <label for="floor_to">{{__('locale.floor_to')}}</label>
                                                        <input list="floorto" name="floor_to" id="floor_to" class="form-control">
                                                        <datalist id="floorto">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-lg-1"></div>
                                                </div>
                                                <div class="row" id="floors_of_house">
                                                    <div class="col-lg-1"></div>
                                                    <div class="col-lg-4">
                                                        <label for="floors_of_house_from">{{__('locale.floors_of_house from')}}</label>
                                                        <input list="floors_of_housefrom" name="floors_of_house_from" id="floors_of_house_from" class="form-control">
                                                        <datalist id="floors_of_housefrom">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-4">
                                                        <label for="floors_of_house_to">{{__('locale.floors_of_house to')}}</label>
                                                        <input list="floors_of_houseto" name="floors_of_house_to" id="floors_of_house_to" class="form-control">
                                                        <datalist id="floors_of_houseto">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-lg-1"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="create-data" style="float: right;">
                                        {{--                                        <a type="submit" id="parsing_flat" lang="{{app()->getLocale()}}" class=" style-add btn btn-info">{{__('locale.Parser')}}</a>--}}
                                        <button class="btn btn-success" type="submit" id="parsing_filter" data-toggle="modal" data-target="#modal-default-parsing_filter" lang="{{app()->getLocale()}}" >{{__('locale.Parsing')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="card">
        <div class="card-header">
            <div class="breadcrumb-and-filter">
                <div class="row">
                    <div class="col-md-6">
                        <div class="action-content">
                            {{--                            <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ route('student.destroyMultiple') }}">Belgilangan talabalarni o'chirish</button>--}}
                        </div>
                        <form style="display: inline-block;" action="{{route('parser.alldestroy', app()->getLocale())}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-data-item btn btn-danger" title="delete"><i class="fas fa-trash">&nbsp;</i> {{__('locale.Delete all')}}</button>
                        </form>
                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        <div class="create-data" style="float: right;">
                            <a type="button" id="parser_flat" value="0" class="style-add btn btn-info" data-toggle="modal" data-target="#modal-default-parser_flat"> {{__('locale.Parser filter')}} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <table id="dashboard_datatable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="master"></th>
                            <th>#</th>
                            <th>{{__('locale.author')}}</th>
                            <th>{{__('locale.title')}}</th>
                            <th>{{__('locale.address')}}</th>
                            <th>{{__('locale.price')}}</th>
                            <th>{{__('locale.image')}}</th>
                            <th>{{__('locale.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!empty($models))
                        @foreach($models as $key => $model)
                            <tr>
                                <td><input type="checkbox" class="sub_chk" data-id="{{$model->id}}"></td>
                                <td>{{ $models->firstItem()+$key }}</td>
                                <td>
                                    @if ($model->user)
                                        {{$model->user->first_name}}
                                    @else
                                        {{__('locale.Parser')}}
                                    @endif
                                </td>
                                <td>{{$model->title}}</td>
                                <td>{{$model->address}} </td>
                                <td>{{number_format(round($model->price, 2))}} {{ ($model->currency == 2) ? ' Сум' : ' Доллар'}}</td>
                                <td style="text-align: center">
                                    @if ($model->main_image && $model->main_image->guid)
                                        <img src="{{ asset('/uploads/apartment-sale/'.$model->id.'/m_'. $model->main_image->guid)}}" class="img-fluid mb-2" alt="" style="width: 100px; height: 100px"/>
                                    @endif
                                    @if($model->images)
                                        @if(is_array($model->images))
                                            @php($fimg = $model->images)
                                        @else
                                            @php($fimg = json_decode($model->images))
                                        @endif
                                        @if(is_array($fimg)&&isset($fimg[0]))
                                            <img src="{{$fimg[0]}}" class="img-fluid mb-2" alt="" style="width: 100px; height: 100px"/>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div style="text-align: center;">
                                        <a href="{{route('parser.show', [app()->getLocale(), $model->id])}}" class="btn btn-primary" title="show"><i class="fas fa-eye"></i></a>
                                        <a href="{{route('parser.edit', [app()->getLocale(), $model->id])}}" class="btn btn-primary" title="update"><i class="fas fa-pencil-alt"></i></a>
                                        <form style="display: inline-block;" action="{{route('parser.destroy', [app()->getLocale(), $model->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-data-item btn btn-danger" title="delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a href="{{route('to_apartment', [app()->getLocale(), $model->id])}}" class="btn btn-default" title="update"><i class="fas fa-download green"></i></a>
                                        {{-- <div style="clear:both !important">
                                        </div> --}}
                                        {{--                                        <a class="btn btn-primary" id="btnParsing" title="show"><i class="fas fa-phone"></i></a>--}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $models->links() }}
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    {{--    <script src="{{asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    {{--    <script src="{{asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/backend-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/backend-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/backend-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>--}}
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            let current_language = '{{app()->getLocale()}}'

            let flat_uploaded = `{{__('locale.flats are uploaded')}}`
            let uploaded_success = `{{__('locale.Uploaded successfully')}}`
            let parsing ="{{__('locale.Parsing continues 1 minute')}}";
            $("#flat_type").on('change', function(){
                let flat_type = $(this).val()
                switch(flat_type){
                    case "Аренда долгосрочная":
                        if(!$("#Housing_type").hasClass('display-none')){
                            $("#Housing_type").addClass('display-none')
                        }
                        if($("#Commission").hasClass('display-none')){
                            $("#Commission").removeClass('display-none')
                        }
                        if($("#Furnished").hasClass('display-none')){
                            $("#Furnished").removeClass('display-none')
                        }
                        break;
                    case "Продажа":
                        if($("#Housing_type").hasClass('display-none')){
                            $("#Housing_type").removeClass('display-none')
                        }
                        if($("#Commission").hasClass('display-none')){
                            $("#Commission").removeClass('display-none')
                        }
                        if($("#Furnished").hasClass('display-none')){
                            $("#Furnished").removeClass('display-none')
                        }
                        break;
                    case "Обмен":
                        if($("#Commission").hasClass('display-none')){
                            $("#Commission").removeClass('display-none')
                        }
                        if(!$("#Housing_type").hasClass('display-none')){
                            $("#Housing_type").addClass('display-none')
                        }
                        if(!$("#Furnished").hasClass('display-none')){
                            $("#Furnished").addClass('display-none')
                        }
                        break;
                    default:
                        if(!$("#Commission").hasClass('display-none')){
                            $("#Commission").addClass('display-none')
                        }
                        if(!$("#Housing_type").hasClass('display-none')){
                            $("#Housing_type").addClass('display-none')
                        }
                        if(!$("#Furnished").hasClass('display-none')){
                            $("#Furnished").addClass('display-none')
                        }
                }
            });
            $("#parsing_flat").on('click', function(){
                let parsing ="{{__('locale.Parsing continues 1 minute')}}";
                toastr.success(parsing)
                $.get(`/${current_language}/real-estate/parsing`, function (data) {
                });
                location.reload();
            });
            $("#parsing_filter").on('click', function(){
                if($('#modal-default-parser_flat').hasClass('show')){
                    $('#modal-default-parser_flat').removeClass('show')
                }
                $('#parsing_filter_header').html("")
                $('#parsing_filter_header').append(parsing)
                let old_number_flats = 0
                let count_number_flats = "{{__('locale.flats parsed')}}";
                $.get(`/${current_language}/real-estate/count-flats`, function (data) {
                    old_number_flats = parseInt(data)
                    localStorage.old_number_flats = old_number_flats
                });
                let min = -1
                let process_min = 0
                var interval_min = setInterval(function() {
                    min = min+1
                    process_min = process_min +1
                    if(min <= 100){
                        document.getElementById('interval_minut').innerHTML = min + ' %'
                    }
                    if($('#parsing_filter_process').hasClass('display-none')){
                        $('#parsing_filter_process').removeClass('display-none')
                    }
                    $('#parsing_filter_process').css('width', `${process_min}%`)
                }, 600);
                setTimeout(function(){
                    // $.get(`/${current_language}/count-flats`, function (data) {
                    //     new_number_flats = parseInt(data)
                    //     localStorage.parsed_flats = new_number_flats - old_number_flats+1
                    // });
                    setTimeout(function(){
                        clearInterval(interval_min)
                        window.location.href = `reload-page`
                    }, 3000);
                }, 57000);

            });


            let sessionConfirm ="{{session('confirm')}}";
            if(sessionConfirm){
                let new_number_flats = 0
                $.get(`/${current_language}/real-estate/count-flats`, function (data) {
                    new_number_flats = parseInt(data)
                });
                setTimeout(function(){
                    if(!$('#modal-default-parsing_filter').hasClass('show')){
                        $('#modal-default-parsing_filter').addClass('show')
                        $('#modal-default-parsing_filter').show();
                        $('#parsing_filter_header').append(uploaded_success)
                    }
                    if($('#parsing_filter_submit').hasClass('display-none')){
                        $('#parsing_filter_submit').removeClass('display-none')
                    }
                    $('#interval_minut').html("")
                    $('#interval_minut').append(`<b>${new_number_flats - localStorage.getItem('old_number_flats')}</b> ${flat_uploaded}`)

                }, 1500);
            }

            $('#parsing_filter_submit_button').on('click', function () {
                if($('#modal-default-parsing_filter').hasClass('show')){
                    $('#modal-default-parsing_filter').removeClass('show')
                    $('#modal-default-parsing_filter').hide();
                }
                if(!$('#parsing_filter_submit').hasClass('display-none')){
                    $('#parsing_filter_submit').addClass('display-none')
                }
            })
            $.get('/backend-assets/region.json', function (data) {
                $('#region').on('change', function () {
                    $('#district').empty()
                    let region = $(this).val()
                    let select_city = "{{__('locale.Select city')}}"
                    if(region != "no"){
                        $('#district').append(`<option value="">${select_city}</option>`)
                        $.each(data, function(index, value) {
                            if(region == value.region[1]){
                                $.each(value.values, function(index_r, value_r) {
                                    $('#district').append(`<option value="${value_r[1]}">${value_r[0]}</option>`)
                                });
                            }
                        });
                    }
                });
            });

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
            $('#master').on('click', function(e) {
                if($(this).is(':checked',true))
                {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked',false);
                }
            });
            $('.delete_all').on('click', function(e) {
                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });
                if(allVals.length <=0)
                {
                    alert("Выберите строку.");
                }  else {
                    var check = confirm("Вы уверены, что хотите удалить выбранные строки?");
                    if(check == true){
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                        $.each(allVals, function( index, value ) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });
            // $('[data-toggle=confirmation]').confirmation({
            //     rootSelector: '[data-toggle=confirmation]',
            //     onConfirm: function (event, element) {
            //         element.trigger('confirm');
            //     }
            // });
            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();
                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
                return false;
            });
        });
    </script>
@endsection

