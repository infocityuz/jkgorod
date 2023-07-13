@extends('forthebuilder::layouts.forthebuilder')
@section('title') {{__("locale.show")}} @endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/toastr/toastr.min.css')}}">
@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="status">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="badge badge-danger">
                    {{$error}}
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
                            <b>{{__('locale.house')}} : </b>{{$model->house_number}}
                            <span class="house-flat-info" style="font-size: 16px;">(Всего {{$model->house_flat->count()}} кв. бронь {{$model->house_flat_borrowing->count()}}, свободно {{$model->house_flat_free->count()}}, продано {{$model->house_flat_bought->count()}})</span>
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__("locale.home")}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.house.index')}}">{{__("locale.house")}}</a></li>
                            <li class="breadcrumb-item active">{{$model->house_number}}</li>
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
                                {{-- <p><b>{{__('locale.house')}} : </b>{{$model->house_number}}</p> --}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="action-content" style="text-align: right">
                                <a href="{{route('forthebuilder.house-flat.create',['house_id' => $model->id, 'house_name' => $model->house_number,'enterance' => $model->max('enterance_count'),'floor' => $model->max('floor_count'),])}}" class="style-add btn btn-primary" >
                                    {{__('locale.create')}}
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

                    <div class="card card-default collapsed-card">
                        <div class="card-header card_header" data-card-widget="collapse">
                            <h3 class="card-title card-title-white">
                                <span class="card-title_text"> Подъезд № {{ $j }}</span>
                                <span class="house-flat-info" style="font-size: 16px">(Всего {{count($mf_count)}} кв. продано {{count($mfborrowing_count)}}, свободно {{count($mffree_count)}}, бронь {{count($mfbought_count)}})</span>
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
                                                            <a class="btn btn-info" href="javascript:void(0)" data-filter="0" style="background: {{ $colors[0] }}; border-color: transparent"> {{__("locale.Free")}} </a>
                                                            <a class="btn btn-info" href="javascript:void(0)" data-filter="1" style="background: {{ $colors[1] }};border-color: transparent"> {{__("locale.Busy")}} </a>
                                                            <a class="btn btn-info" href="javascript:void(0)" data-filter="2" style="background: {{ $colors[2] }};border-color: transparent"> {{__("locale.Sales")}} </a>
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
                                    <tr class=" one_top">
                                        <th class="floor">{{__("locale.floor_count")}}</th>
                                        <th style="vertical-align: middle">
                                            Подъезд № {{ $j }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="filter-house">
                                @for($i = $model->floor_count; $i >= 1; $i--)
                                    <tr>
                                        <td class="floor" style="vertical-align: middle;text-align: center">
                                            {{ $i}}
                                        </td>
                                        <td>
                                            <div class="house-boxes">
                                                @foreach($flats as $flat)
                                                    @if($flat->floor == $i && $flat->enterance == $j)
                                                        {{--                                                {{route('forthebuilder.house-flat.show',$flat->id)}}--}}
                                                        <a title="номер комнаты" data-id="{{$flat->id}}"
                                                           data-contractNumber="{{$flat->contract_number}}"
                                                           class="house-box filtr-item"
                                                           style="background-color: {{ $colors[$flat->status]; }}"
                                                           data-category="{{$flat->status}}">
                                                        <!-- class="house-box filtr-item  @if($flat->status == 2) red @elseif($flat->status == 1) yellow @else white @endif" -->
                                                            <span>{{$flat->number_of_flat}}</span>
                                                            <span>{{$flat->total_area}} м<sup>2</sup></span>
                                                            <span>{{$flat->price}}$ </span>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog" style="max-width: 700px">
            <div class="modal-content">
                <div class="modal-header">
                    {{--                    <h4 class="modal-title">Default Modal</h4>--}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  id="modal-form" action="{{route('forthebuilder.booking.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6" id="info1_flat">

                            </div>
                            <div class="col-6" id="info2_flat">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">{{__('locale.name')}}</label>
                                    <input
                                            type="text" name="name" id="name" list="browsers"
                                            class="form-control @error('name') error-data-input is-invalid @enderror keyUpName"
                                            value="{{ old('name') }}"
                                            autocomplete="off"
                                    >
                                    <span class="select2-dropdown select2-dropdown--below" style="width: 610px; position: absolute; background: lightgrey; display: none; max-height: 177px; overflow: scroll;">
                                        <span class="select2-results">
                                            <ul class="select2-results__options" role="tree" aria-multiselectable="true" id="select2-0obe-results" aria-expanded="true" aria-hidden="false" style="padding: 0;">
                                            </ul>
                                        </span>
                                    </span>

                                    <span class="error-data">@error('name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="surname">{{__('locale.surname')}}</label>
                                    <input type="text" name="surname" id="surname"
                                           class="form-control @error('surname') error-data-input is-invalid @enderror"
                                           value="{{ old('surname') }}">
                                    <span class="error-data">@error('surname'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="patronymic">{{__('locale.patronymic')}}</label>
                                    <input type="text" name="patronymic" id="patronymic"
                                           class="form-control @error('patronymic') error-data-input is-invalid @enderror"
                                           value="{{ old('patronymic') }}">
                                    <span class="error-data">@error('patronymic'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">{{__('locale.phone')}}</label>
                                    <input type="text" name="phone" id="phone"
                                           class="form-control @error('phone') error-data-input is-invalid @enderror"
                                           value="{{ old('phone') }}">
                                    <span class="error-data">@error('phone'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="series_number">{{__('locale.series_number')}}</label>
                                    <input type="text" name="series_number" id="series_number"
                                           class="form-control @error('series_number') error-data-input is-invalid @enderror"
                                           value="{{ old('series_number') }}">
                                    <span class="error-data">@error('series_number'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group display-none"  id="prepayment_summa">
                                    <label for="prepayment_summa">{{__('locale.prepayment summa')}}</label>
                                    <input type="text" name="prepayment_summa"
                                           class="form-control @error('prepayment_summa') error-data-input is-invalid @enderror"
                                           value="{{ old('prepayment_summa') }}">
                                    <span class="error-data">@error('prepayment_summa'){{$message}}@enderror</span>
                                </div>
                                <input type="hidden" id="house_flat_id" name="house_flat_id">
                                <div class="form-group">
                                    <label for="prepayment">{{__('locale.prepayment')}}</label>
                                    <input type="checkbox" name="prepayment" id="prepayment"
                                           class="@error('prepayment') error-data-input is-invalid @enderror">
                                    <span class="error-data">@error('prepayment'){{$message}}@enderror</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-footer justify-content-end" style="">
                                    <button type="submit" class="btn btn-success" id="prepayment_submit">{{__('locale.create')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <div class="modal fade" id="modal-default-free">
        <div class="modal-dialog" style="max-width: 500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('locale.Vacate the apartment again')}} ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="justify-content-center">
                                <a type="submit" class="btn btn-success" id="renew_flat">{{__('locale.Release')}}</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <aside class="main-sidebar sidebar-dark-primary elevation-4 right__sidebar ">
        <!-- Sidebar -->
        <div class="sidebar">
            <nav class="mt-2">

                <div class="close_sidebar">
                    <span>×</span>
                </div>
                <div id="flatItemDetailImg">

                </div>
                <table class="table table-bordered" id="flatItemDetailTable">
                    <tr>
                        <td>{{__('locale.price')}}</td>
                        <td id="flatItemDetailPrice"></td>
                    </tr>
                    <tr>
                        <td>{{__('locale.room_count')}}</td>
                        <td id="flatItemDetailRoomCount"></td>
                    </tr>
                </table>
                <div class="flatItemStatus form-group" >
                    <a type="button" class="house_status_value fa fa-angle-down" id="house-status-value">

                    </a>
                    <input type="hidden" id="flat_status_value">
                    <div class="house-status display-none" id="flatItemStatus">
                        <a type="button" id="free" value="0" data-toggle="modal" data-target="#modal-default-free"> {{__('locale.Free')}} </a>
                        <a type="button" id="busy" value="1" data-toggle="modal" data-target="#modal-default"> {{__('locale.Busy')}} </a>
                        <a type="button" id="sales" value="2"> {{__('locale.Sales')}} </a>
                    </div>
                </div>
                <table class="table table-bordered" id="flatItemDetailClientTable">
                    <tr>
                        <td>{{__('locale.client_name')}}</td>
                        <td id="flatItemDetailClientName"></td>
                    </tr>
                    <tr>
                        <td>{{__('locale.client_surename')}}</td>
                        <td id="flatItemDetailClientSurename"></td>
                    </tr>
                    <tr>
                        <td>{{__('locale.client_phone')}}</td>
                        <td id="flatItemDetailClientPhone"></td>
                    </tr>
                    <tr>
                        <td>{{__('locale.client_prepayment')}}</td>
                        <td id="flatItemDetailClientPrepayment"></td>
                    </tr>
                </table>
                <table class="table table-bordered" id="flatItemDetailNoClientTable">
                    <tr>
                        <td class="text-center">{{__('locale.no_client')}}</td>
                    </tr>
                </table>
                <div id="flatItemDetailShow" style="display: flex;justify-content: space-between"></div>
                <div class="text-center" style="display: flex;justify-content: center;align-items: center">
                    <div id="for-preloader" role="status">
                    </div>
                </div>

            </nav>
        </div>
        <!-- /.sidebar -->
    </aside>
    <style>
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
            padding: 7px 24px;
            border: solid 1px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            width: 100%;
        }

        .house_status_value:hover{
            transform: scale(1.04);
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
    </style>

@endsection
@section('scripts')
    <script defer src="{{asset('/backend-assets/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
    <script defer src="{{asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
    <script defer src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>
    <script defer>
        let page_name = 'house';
        $(document).ready(function () {
            function flatstatus(){
                if($('#flatItemStatus').hasClass('display-none')){
                    $('#flatItemStatus').removeClass('display-none')
                }else{
                    $('#flatItemStatus').addClass('display-none')
                }
            }
            $('#house-status-value').on('click', function (){
                flatstatus()
            });
            function flat_status_click(){
                $('#busy').on('click', function (){
                    flatstatus()
                    select_status($(this).attr('value'))
                    $('#house-status-value').text($(this).text())
                    $('#flat_status_value').val(1)
                });
                $('#sales').on('click', function (){
                    flatstatus()
                    select_status($(this).attr('value'))
                    $('#house-status-value').text($(this).text())
                    $('#flat_status_value').val(2)
                });
                $('#free').on('click', function (){
                    flatstatus()
                    select_status($(this).attr('value'))
                    $('#house-status-value').text($(this).text())
                    $('#flat_status_value').val(0)
                });
            }

            let sessionSuccess ="{{session('success')}}";
            if(sessionSuccess){
                toastr.success(sessionSuccess)
            }
            let sessionWarning = "{{session('warning')}}";
            if(sessionWarning){
                toastr.warning(sessionWarning)
            }
            let sessionError = "{{session('error')}}";
            if(sessionError){
                toastr.warning(sessionError)
            }

            //checkbox orqali modal oknadagi submit knopkani va avans to'lov polyasini yaratish
            if($('#prepayment').is(':checked')){
                if($('#prepayment_summa').hasClass('display-none')){
                    $('#prepayment_summa').removeClass('display-none')
                }
            }
            else{
                if(!$('#prepayment_summa').hasClass('display-none')){
                    $('#prepayment_summa').addClass('display-none')
                }
            }
            $('#prepayment').change(function (){
                if($(this).is(':checked')){
                    if($('#prepayment_summa').hasClass('display-none')){
                        $('#prepayment_summa').removeClass('display-none')
                    }
                }else{
                    if(!$('#prepayment_summa').hasClass('display-none')){
                        $('#prepayment_summa').addClass('display-none')
                    }
                }
            });

            //house-box
            var gId = '';
            var number_of_flat = '';
            var contract_number = '';
            let house_id;

            $('.house-box').on('click',function (e) {
                var id = $(this).data('id');
                house_id = $(this).data('id')
                number_of_flat = $(this).data('name');
                contract_number = $(this).data('contractnumber');
                gId = id;
                e.preventDefault();
                $('.forthebuilder').addClass('active');
                $('.right__sidebar').addClass('active');
                $('#flatItemDetailShow').empty();
                $('#flatItemDetailImg').empty();

                $.ajaxSetup({
                    beforeSend: function() {
                        // TODO: show your spinner
                        $("#for-preloader").addClass('spinner-border');
                        $('#flatItemDetailTable').hide();
                        $('#flatItemStatusSelect').hide();
                        $('#change-status').hide();
                    },
                    complete: function() {
                        // TODO: hide your spinner
                        $("#for-preloader").removeClass('spinner-border');
                        $('#flatItemDetailTable').show();
                        $('#flatItemStatusSelect').show();
                        $('#change-status').show();
                    }
                });

                //            kvartiragani avans orqali band qilish modal oynasi
                $.get('/forthebuilder/house/show-more-item-detail/'+id, function (data) {
                    if(data['flatItemDetailImg'] != null){
                        let imgurl = 'm_'+data['flatItemDetailImg']['guid']
                        $('#flatItemDetailImg').append(`<img src='/uploads/house-flat/${id}/${imgurl}' class='img-fluid mb-2'alt='white sample'/>`);
                    }else{
                        $('#flatItemDetailImg').append("<img src='/backend-assets/img/no-photo.png' class='img-fluid mb-2'alt='white sample'/>");
                    }
                    if(data['flatItemDetail']['status'] == 0){
                        $('#house-status-value').text(' Свободно')
                        $('#flat_status_value').val(0)
                    }
                    if(data['flatItemDetail']['status'] == 1){
                        $('#house-status-value').text(' Занят')
                        $('#flat_status_value').val(1)
                    }
                    if(data['flatItemDetail']['status'] == 2){
                        $('#house-status-value').text(' Продано')
                        $('#flat_status_value').val(2)
                    }
                    flat_status_click()
                    $('#info1_flat div').remove()
                    $('#house_flat_id').val(`${data.flatItemDetail.id}`);
                    $('#info1_flat').append(`<div><span>{{__('locale.Number of flat')}}: </span><b>${data.flatItemDetail.number_of_flat}</b></div>`)
                    $('#info1_flat').append(`<div><span>{{__('locale.Flat price')}}: </span><b>${(Math.round(data.flatItemDetail.total_area) * data.flatItemDetail.price).toLocaleString('en-US', {
                        style: "currency",
                        currency: "USD" ,
                    })}</b> $</div>`)
                    $('#info2_flat div').remove()
                    $('#info2_flat').append(`<div><span>{{__('locale.Total area')}}: </span><b>${data.flatItemDetail.total_area}</b> m<sup>2</sup></div>`)
                    $('#info2_flat').append(`<div><span>{{__('locale.Room of flat')}}: </span><b>${data.flatItemDetail.room_count}</b></div>`)

                    $('#flatItemDetailPrice').text(data['flatItemDetail']['price']);
                    $('#flatItemDetailRoomCount').text(data['flatItemDetail']['room_count']);
                    $('#flatItemDetailClientTable').hide();
                    $('#flatItemDetailNoClientTable').hide();
                    $('#flatItemDetailClientName').text('');
                    $('#flatItemDetailClientSurename').text('');
                    $('#flatItemDetailClientPhone').text('');
                    $('#flatItemDetailClientPrepayment').text('');
                    if (data['flatItemDetailClient'] != null) {
                        $('#flatItemDetailClientTable').show();
                        $('#flatItemDetailNoClientTable').hide();
                        $('#flatItemDetailClientName').text(data['flatItemDetailClient']['name']);
                        $('#flatItemDetailClientSurename').text(data['flatItemDetailClient']['surname']);
                        $('#flatItemDetailClientPhone').text(data['flatItemDetailClient']['phone']);
                        $('#flatItemDetailClientPrepayment').text(data['flatItemDetailClient']['prepayment']);
                    } else {
                        $('#flatItemDetailNoClientTable').show();
                        $('#flatItemDetailClientTable').hide();
                    }

                    $('#flatItemDetailShow').empty();
                    $('#flatItemDetailShow').append(`<a href='/forthebuilder/house-flat/show/${id}' class='style-add btn btn-primary' style='color:#fff'>{{__('locale.show')}}</a>`);
                    $('#flatItemStatusSelect').attr("data-id",`${id}`);

                })
            });

            $('#renew_flat').on('click', function(){
                $.get('/forthebuilder/house/show-more-item-detail/'+gId, function (data) {
                    if (data['flatItemDetail']['status'] == 2) {
                        $.ajax({
                            url: `/forthebuilder/house-flat/update-status/${gId}`,
                            data: {status: 0},
                            type: 'PUT',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function (data) {
                                location.reload();
                                if (data['warning']) {
                                    toastr.warning(data['warning']);
                                }
                                if (data['success']) {
                                    toastr.success(data['success']);
                                }
                                // $('.house-box').data('id');
                            },
                            error: function (data) {
                                console.log(data);
                            }
                        });
                    }else if(data['flatItemDetail']['status'] == 1){
                        toastr.warning("{{__('locale.impossible the apartment is booked')}}");
                    }else{
                        toastr.warning("{{__('locale.the apartment is already new')}}");
                    }
                });
            });
            function select_status(val) {
                $.get('/forthebuilder/house/show-more-item-detail/'+gId, function (data) {
                    if(data['flatItemDetail']['status'] == 0){
                        // e.preventDefault();
                        switch (val) {
                            case '2':
                                // location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + '&name=' + number_of_flat + '&house_id=' + '{{$model->id}}' + '&house_name=' +'{{$model->house_number}}'  + '&contract_number=' + contract_number);
                                location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + "&house_flat_number=" + data.flatItemDetail.number_of_flat + "&house_id=" + '{{$model->id}}' + '&house_name=' + '{{$model->house_number}}' + '&contract_number=' + data.flatItemDetail.contract_number);
                        }
                    }else if(data['flatItemDetail']['status'] == 1){
                        switch (val) {

                            case '1':
                                toastr.warning("{{__('locale.the apartment is already booked')}}");
                                break;
                            case '2':
                                // location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + '&name=' + number_of_flat + '&house_id=' + '{{$model->id}}' + '&house_name=' +'{{$model->house_number}}'  + '&contract_number=' + contract_number);
                                location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + "&house_flat_number=" + data.flatItemDetail.number_of_flat + "&house_id=" + '{{$model->id}}' + '&house_name=' + '{{$model->house_number}}' + '&contract_number=' + data.flatItemDetail.contract_number);
                        }
                    }
                    else{
                        switch (val) {
                            case '1':
                                toastr.warning("{{__('locale.the apartment is already sold')}}");
                                break;
                            case '2':
                                // location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + '&name=' + number_of_flat + '&house_id=' + '{{$model->id}}' + '&house_name=' +'{{$model->house_number}}'  + '&contract_number=' + contract_number);
                                location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + "&house_flat_number=" + data.flatItemDetail.number_of_flat + "&house_id=" + '{{$model->id}}' + '&house_name=' + '{{$model->house_number}}' + '&contract_number=' + data.flatItemDetail.contract_number);
                        }
                    }
                });
            }

            $('.close_sidebar span').on('click',function (e) {
                e.preventDefault();
                $('.forthebuilder').removeClass('active');
                $('.right__sidebar').removeClass('active');
            });
            //house-box

            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
                let filter = $(this).data('filter');

                $('.filter-house a').addClass('hide');
                if(filter == 0){
                    console.log($('.filter-house a[data-category=0]'));
                    $('.filter-house a[data-category=0]').removeClass('hide');
                }else if(filter == 1){
                    $('.filter-house a[data-category=1]').removeClass('hide');
                }else if(filter == 2){
                    $('.filter-house a[data-category=2]').removeClass('hide');
                }else{
                    $('.filter-house a').removeClass('hide');
                }
            });

            // kvartiragani avans orqali band qilishda ism maydoniga keyUp qilinganda bazadan like orqali qidirib kelish
            $('.keyUpName').on('keyup',function (e) {
                e.preventDefault();
                var name = $(this).val();
                $('.select2-dropdown--below').hide();

                // kvartiragani avans orqali band qilishda ism maydoniga keyUp qilinganda bazadan like orqali qidirib kelish AJAX SEND
                $.get('/forthebuilder/house/search-by-name/'+name, function (data) {
                    if (data['searchedLeadList'].length != 0) {
                        $('.select2-dropdown--below').show();
                        // } else {
                        var listData = '';
                        $.each(data['searchedLeadList'], function( index, value ) {
                            listData += `<li style="list-style: none; padding: 10px;" class="select2-results__option" surname="`+ value['surname'] +`" phone="`+ value['phone'] +`" patronymic="`+ value['patronymic'] +`" series_number="`+ value['series_number'] +`">`+ value['name'] +`</li>`;
                        });

                        $('#select2-0obe-results').html(listData);
                    }

                })
            });
        });

        $(document).on('click', '.select2-results__option', function(e) {
            e.preventDefault()
            var name = $(this).text()
            var surname = $(this).attr('surname')
            var phone = $(this).attr('phone')
            var patronymic = $(this).attr('patronymic')
            var series_number = $(this).attr('series_number')
            if (!surname) {
                surname = '';
            }

            $('#name').val(name)
            $('#surname').val(surname)
            $('#phone').val(phone)
            $('#patronymic').val(patronymic)
            $('#series_number').val(series_number)

            $('.select2-dropdown--below').hide();
        })

        $(document).on('click', 'body', function() {
            $('.select2-dropdown--below').hide();
        })
    </script>
@endsection

