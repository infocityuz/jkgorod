@extends('forthebuilder::layouts.forthebuilder')
@section('title')
    {{ __('locale.create') }}
@endsection
@section('styles')

    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('locale.house') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('forthebuilder.index') }}">{{ __('locale.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('forthebuilder.deal.index') }}">{{ __('locale.deal') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('locale.create') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="deal-create-form" action="{{ route('forthebuilder.deal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- <input type="hidden" name="from_booking" value="1"> --}}
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">
                        @if(!isset(request()->house_id))
                        <div class="form-group">
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                <label for="house_id">{{ __('locale.house') }}</label>

                                <select name="house_id" id="house_id"
                                    data-placeholder="{{ __('locale.select') }}"
                                    class="form-control @error('house_id') is-invalid error-data-input @enderror"
                                >
                                    @if(!empty($houses))
                                        <option value="">-----------------</option>
                                        @foreach($houses as $house)
                                            <option value="{{ $house->id }}" {{ (isset($booking->houseFlat->house) && $booking->houseFlat->house->id == $house->id) ? 'selected' : '' }}>
                                                {{ $house->house_number }} {{ $house->house_info }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="error-data">@error('house_id'){{ $message }}@enderror</span>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="house_id">{{ __('locale.house') }}</label>
                                <input type="hidden" class="form-control" id="house_id" value="{{ request()->house_id }}" readonly>
                                <input type="text" class="form-control" value="{{ request()->house_name }}" readonly>
                                <span class="error-data">@error('house_id'){{ $message }}@enderror</span>
                            </div>
                        @endif

                        <div class="form-group">
                            @php
                                // echo "<pre>";
                                // print_r($booking->houseFlat->number_of_flat);
                                // die();
                                $house_flat_number = (isset($booking->houseFlat)) ? $booking->houseFlat->number_of_flat : request()->house_flat_number;
                            @endphp
                            <label for="house_flat_number">{{ __('locale.house_flat_number') }}</label>
                            <input type="text" name="house_flat_number" class="form-control" value="{{ $house_flat_number }}" id="house_flat_number">
                            <span class="error-data">@error('house_flat_number'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('locale.description') }}</label>
                            <input type="text" name="description" id="description"
                                class="form-control @error('description') error-data-input is-invalid @enderror"
                                value="{{ old('description') }}" 
                            >
                            <span class="error-data">@error('description'){{ $message }}@enderror</span>
                        </div>
                        <br>
                        <h3 class="card-title" style="font-weight: 700">{{ __('locale.personal_informations') }}</h3>
                        <br>
                        <br>
                        <div class="form-group">
                            @php
                                $valueFullName = old('full_name');
                                if (isset($booking))
                                    $valueFullName = $booking->name . ' ' . $booking->surname . ' ' . $booking->patronymic;

                            @endphp
                            <label for="full_name">{{ __('locale.full_name') }}</label>
                            <input type="text" name="full_name" id="full_name"
                                class="form-control @error('full_name') error-data-input is-invalid @enderror"
                                value="{{ $valueFullName }}" placeholder="Ali Valiyev G'ani o'g'li"
                            >
                            <span class="error-data">@error('full_name'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="gender">{{ __('locale.Gender') }}</label>
                            <select class="form-control" name="gender" id="gender" >
                                <option value="0">{{ __('locale.Man') }}</option>
                                <option value="1">{{ __('locale.Woman') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="series_number">{{ __('locale.series_number') }}</label>
                            <input type="text" name="series_number" id="series_number"
                                class="form-control @error('series_number') error-data-input is-invalid @enderror"
                                value="{{ $booking->series_number ?? old('series_number') }}" placeholder="AA1234567">
                            <span class="error-data">@error('series_number'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="given_date">{{ __('locale.given_date') }}</label>
                            <input type="text" name="given_date" id="given_date"
                                class="form-control @error('given_date') error-data-input is-invalid @enderror"
                                value="{{ old('given_date') }}">
                            <span class="error-data">@error('given_date'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="live_address">{{ __('locale.live_address') }}</label>
                            <input type="text" name="live_address" id="live_address"
                                class="form-control @error('live_address') error-data-input is-invalid @enderror"
                                value="{{ old('live_address') }}"
                            >
                            <span class="error-data">@error('live_address'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="inn">{{ __('locale.inn') }}</label>
                            <input type="text" name="inn" id="inn"
                                class="form-control @error('inn') error-data-input is-invalid @enderror"
                                value="{{ old('inn') }}"
                            >
                            <span class="error-data">@error('inn'){{ $message }}@enderror</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">
                        @if(!isset(request()->house_flat_id))
                            <input type="hidden" name="" id="selected_house_flat_id" value="{{ $booking->houseFlat->number_of_flat }}">
                            <div class="form-group">
                                <label for="house_flat_id">{{ __('locale.contract_number') }}</label>
                                <select name="house_flat_id" id="house_flat_id"
                                    data-placeholder="{{ __('locale.select') }}" readonly
                                    class="form-control select2 @error('house_flat_id') is-invalid error-data-input @enderror"
                                >
                                </select>
                                <span class="error-data">@error('house_flat_id'){{ $message }}@enderror</span>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="house_flat_id">{{ __('locale.contract_number') }}</label>
                                <input type="hidden" name="house_flat_id" id="house_flat_sell" value="{{ request()->house_flat_id }}">
                                <input type="text" id="house_flat_id"
                                    class="form-control @error('house_flat_id') error-data-input is-invalid @enderror"
                                    value="{{ request()->contract_number }}" readonly
                                >
                                <span class="error-data">@error('house_flat_id'){{ $message }}@enderror</span>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="agreement_number">{{ __('locale.agreement_number') }}</label>
                            <input type="text" name="agreement_number" id="agreement_number"
                                class="form-control @error('agreement_number') error-data-input is-invalid @enderror"
                                value="{{ $agreement_number_increment }}/{{ date('d-m') }}"
                            >
                            <span class="error-data">@error('agreement_number'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="price_bought_commas">{{ __('locale.price') }}</label>
                            <input type="hidden" name="price_bought" id="price_bought"
                                class="form-control @error('price_bought') error-data-input is-invalid @enderror"
                                value="{{ old('price_bought') }}" step="0.01" min="0"
                            >
                            <input type="text" name="price_bought_commas" id="price_bought_commas"
                                class="form-control @error('price_bought') error-data-input is-invalid @enderror"
                                value="{{ old('price_bought') }}" step="0.01" min="0"
                            >
                            <span class="error-data">@error('price_bought'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="dateDl">{{ __('locale.date') }}</label>
                            <input type="text" name="dateDl" id="dateDl"
                                class="form-control @error('dateDl') error-data-input is-invalid @enderror"
                                value="{{ old('dateDl') }}"
                            >
                            <span class="error-data">@error('dateDl'){{ $message }}@enderror</span>
                        </div>

                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="installment_plan" class="custom-control-input" id="installment_plan" checked=''>
                            <label class="custom-control-label" for="installment_plan">{{ __('locale.installment_plan') }}</label>
                        </div>
                    </div>
                </div>

                <div class="card card-primary installment_plan">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="period">{{ __('locale.period') }}</label>
                            <select name="period" id="period" data-placeholder="{{ __('locale.select') }}" class="form-control select2
                                @error('period') is-invalid error-data-input @enderror"
                            >
                                <option value="" selected>_______________</option>
                                <option value="12 месяц">
                                    12 месяц
                                </option>
                                <option value="18 месяц">
                                    18 месяц
                                </option>
                            </select>
                            <span class="error-data">@error('period'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="percent">{{ __('locale.percent') }}</label>
                            <select name="percent" id="percent" data-placeholder="{{ __('locale.select') }}" class="form-control select2
                                @error('percent') is-invalid error-data-input @enderror"
                            >
                                <option value="" selected>{{ __('locale.select') }}</option>
                                <option value="30">
                                    30 %
                                </option>
                                <option value="50">
                                    50 %
                                </option>
                            </select>
                            <span class="error-data">@error('percent'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="an_initial_fee">{{ __('locale.an_initial_fee') }}</label>
                            <input type="hidden" name="an_initial_fee" id="an_initial_fee" readonly
                                class="form-control @error('an_initial_fee') error-data-input is-invalid @enderror"
                                value="{{ old('an_initial_fee') }}" 
                            >
                            <input type="text" name="an_initial_fee_commas" id="an_initial_fee_commas" readonly
                                class="form-control @error('an_initial_fee') error-data-input is-invalid @enderror"
                                value="{{ old('an_initial_fee') }}" 
                            >
                            <span class="error-data">@error('an_initial_fee'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="start_date">{{ __('locale.start_date_text') }}</label>
                            <input type="text" name="start_date" id="start_date"
                                class="form-control @error('start_date') error-data-input is-invalid @enderror"
                                value="{{ old('start_date') }}"
                            >
                            <span class="error-data">@error('start_date'){{ $message }}@enderror</span>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="month_pay_first">{{ __('locale.Second payment') }}</label>
                                <input type="hidden" name="month_pay_first" id="month_pay_first" readonly
                                    class="form-control @error('month_pay_first') error-data-input is-invalid @enderror"
                                    value="{{ old('month_pay_first') }}" 
                                >
                                <input type="text" name="month_pay_first_commas" id="month_pay_first_commas" readonly
                                    class="form-control @error('month_pay_first') error-data-input is-invalid @enderror"
                                    value="{{ old('month_pay_first') }}" 
                                >
                                <span class="error-data">@error('month_pay_first'){{ $message }}@enderror</span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="month_pay_second">{{ __('locale.Third payment') }}</label>
                                <input type="hidden" name="month_pay_second" id="month_pay_second" readonly
                                    class="form-control @error('month_pay_second') error-data-input is-invalid @enderror"
                                    value="{{ old('month_pay_second') }}" 
                                >
                                <input type="text" name="month_pay_second_commas" id="month_pay_second_commas" readonly
                                    class="form-control @error('month_pay_second') error-data-input is-invalid @enderror"
                                    value="{{ old('month_pay_second') }}" 
                                >
                                <span class="error-data">@error('month_pay_second'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header" data-card-widget="collapse">
                        <h2 class="card-title">
                            <b>
                                {{ __('locale.contacts') }}
                            </b>
                        </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="phone">{{ __('locale.phone_number') }}</label>
                                    <div class="number_block">
                                        {{--                                                                            <span class="flag"><img src="/backend-assets/img/flag.webp" alt="" ></span>--}}
                                        <input type="text" name="phone_code" value=" + 9 9 8" readonly>
                                        <input type="tel" name="phone" id="phone"
                                            class="form-control object_number @error('phone') error-data-input is-invalid @enderror"
                                            value="{{ $booking->phone ?? old('phone') }}"
                                        >
                                    </div>
                                    <span class="error-data">@error('phone'){{ $message }}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="additional_phone">{{ __('locale.additional_phone_number') }}</label>
                                    <div class="number_block">
                                        {{--                                    <span class="flag"><img src="/backend-assets/img/flag.webp" alt="" ></span>--}}
                                        <input type="text" name="phone_code" class="additional_phone_code" value=" + 9 9 8" readonly>
                                        
                                        <input type="tel" name="additional_phone" id="additional_phone"
                                            class="form-control"
                                            value="{{ $booking->additional_phone ?? old('additional_phone') }}"
                                        >
                                    </div>
                                    <span class="error-data">@error('additional_phone'){{ $message }}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('locale.email') }}</label>
                                    <input type="text" name="email" id="email"
                                        class="form-control @error('email') error-data-input is-invalid @enderror"
                                        value="{{ old('email') }}" 
                                    >
                                    <span class="error-data">@error('email'){{ $message }}@enderror</span>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="files">{{ __('locale.file__upload') }}</label>
                            <input type="file" name="files[]"  id="files" multiple>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-footer justify-content-end" style="">
                    <button type="submit" class="btn btn-success">{{ __('locale.create') }}</button>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('scripts')

    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/filetype.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/buffer.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/locales/ru.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/jquery.maskedinput.min.js') }}"></script>
    <script>
        let page_name = 'deal';
        $(document).ready(function() {
            $('#sent').datetimepicker({
                format: 'Y-M-D',
            });
    
            $('input[type=tel]').mask("(99) 999-99-99");
            $('#installment_plan').prop('checked', false)
            // $('#installment_sell_plan').prop('checked', false)
            $('#house_id').find('option[value=default]').attr('selected', 'selected')
    
            let mansard_price = 0;
            let basement_price = 0;
            let basement_price_pay_30 = 0;
            let basement_price_pay_50 = 0;
            let terrace_price = 0;
            function deal(){
                let price = parseInt($('#price_bought').val());
                let percent = parseInt($('#percent').val())/100;
                let price_bought_comma = price.toLocaleString('en-US', {
                    style: "currency",
                    currency: "USD" ,
                });
                $('#price_bought_commas').val(price_bought_comma)
                $('#an_initial_fee').val(price*percent)
                let an_initial_fee_comma = (price*percent).toLocaleString('en-US', {
                    style: "currency",
                    currency: "USD" ,
                });
                $('#an_initial_fee_commas').val(an_initial_fee_comma);
                let startPrice = parseInt(Math.ceil($('#an_initial_fee').val()));

                let period = $('#period').val();
                if(period === '18 месяц'){
                    if(percent == 0.3){
                        let result2 = ((price)*0.3);
                        let result = ((price)*0.4);
                        if(result > 0){
                            $('#month_pay_second_commas').val(parseInt(Math.ceil(result2.toFixed(3))).toLocaleString('en-US', {
                                style: "currency",
                                currency: "USD" ,
                            }));
                            $('#month_pay_second').val(result2.toFixed(3));
                            $('#month_pay_first_commas').val(parseInt(Math.ceil(result.toFixed(3))).toLocaleString('en-US', {
                                style: "currency",
                                currency: "USD" ,
                            }));
                            $('#month_pay_first').val(result.toFixed(3));
                        }
                    }else{
                        let result2 = ((price)*0.2);
                        let result = ((price)*0.3);

                        if(result > 0){
                            $('#month_pay_second_commas').val(parseInt(Math.ceil(result2.toFixed(3))).toLocaleString('en-US', {
                                style: "currency",
                                currency: "USD" ,
                            }));
                            $('#month_pay_second').val(result2.toFixed(3));
                            $('#month_pay_first_commas').val(parseInt(Math.ceil(result.toFixed(3))).toLocaleString('en-US', {
                                style: "currency",
                                currency: "USD" ,
                            }));
                            $('#month_pay_first').val(result.toFixed(3));
                        }
                    }
                }else{
                    if(percent == 0.3){
                        let result2 = ((price)*0.3);
                        let result = ((price)*0.4);

                        if(result > 0){
                            $('#month_pay_second_commas').val(parseInt(Math.ceil(result2.toFixed(3))).toLocaleString('en-US', {
                                style: "currency",
                                currency: "USD" ,
                            }));
                            $('#month_pay_second').val(result2.toFixed(3));
                            $('#month_pay_first_commas').val(parseInt(Math.ceil(result.toFixed(3))).toLocaleString('en-US', {
                                style: "currency",
                                currency: "USD" ,
                            }));
                            $('#month_pay_first').val(result.toFixed(3));
                        }
                    }else{
                        let result2 = ((price)*0.2);
                        let result = ((price)*0.3);

                        if(result > 0){
                            $('#month_pay_second_commas').val(parseInt(Math.ceil(result2.toFixed(3))).toLocaleString('en-US', {
                                style: "currency",
                                currency: "USD" ,
                            }));
                            $('#month_pay_second').val(result2.toFixed(3));
                            $('#month_pay_first_commas').val(parseInt(Math.ceil(result.toFixed(3))).toLocaleString('en-US', {
                                style: "currency",
                                currency: "USD" ,
                            }));
                            $('#month_pay_first').val(result.toFixed(3));
                        }
                    }
                }
            }
    
            $.ajax({
                type: "GET",
                datatype:"json",
                url: "/forthebuilder/deal/get-flat-price?id=" + $("#house_flat_sell").val(),
                success: function(data) {
                    if (data) {
                        if(data.mansard && data.mansard_area){
                            mansard_price = data.mansard*data.mansard_area
                        }else if(data.basement_area && data.basement){
                            basement_price = data.basement*data.basement_area
                        }
                        if(data.terrace_area && data.price){
                            terrace_price = data.price*data.terrace_area
                        }

                        $("#price_bought").val(Math.round(data.total_area*data.price + mansard_price + basement_price + terrace_price))

                        // $("#inputID").prop('disabled', false); //enable
                        deal()
                    }
                }
            });
    
            //kvartira ro'yhatga olish raqami orqali narxini avtomatik chiqarish
            $('#house_flat_id').on('change', function(){
                if (this.value) {
                    $.ajax({
                        type: "GET",
                        datatype:"json",
                        url: "/forthebuilder/deal/get-flat-price?id=" + this.value,
                        success: function(data) {
                            if (data) {
                                if(data.mansard && data.mansard_area){
                                    mansard_price = data.mansard*data.mansard_area
                                }else if(data.basement_area && data.basement){
                                    basement_price = data.basement*data.basement_area
                                }
                                if(data.terrace_area && data.price){
                                    terrace_price = data.price*data.terrace_area
                                }

                                $("#price_bought").val(Math.round(data.total_area*data.price + mansard_price + basement_price + terrace_price))

                                // $("#inputID").prop('disabled', false); //enable
                                deal()
                            } else {

                            }
                        }
                    });
                } else {
                    $("#house_flat_id").empty();
                }
            });

            //boshlang'ich to'lovni foiz bo'yicha chiqarish
            $('#percent').on('change', function () {
                //kvartirani sozdat qilishdagi sahifa yoki kvartirani sotishdagi sahifaligini tekshirib apiga id berish
                let house_flat_id = $("#house_flat_id").val()
                let house_flat_sell = $("#house_flat_sell").val()
                let url_id = house_flat_id
                if(house_flat_sell != null){
                    url_id = house_flat_sell
                }
                let get_percent = this.value;
                $.ajax({
                    type: "GET",
                    datatype:"json",
                    url: "/forthebuilder/deal/get-flat-price?id=" + url_id,
                    success: function(data) {
                        if (data) {
                            if(data.mansard && data.mansard_area){
                                mansard_price = data.mansard*data.mansard_area
                            }else if(data.basement_area && data.basement){
                                basement_price = data.basement*data.basement_area
                            }
                            if(data.terrace_area && data.price){
                                terrace_price = data.price*data.terrace_area
                            }
                            if(data.basement_area && data.basement_price_pay_30){
                                basement_price_pay_30 = data.basement_price_pay_30*data.basement_area
                            }
                            if(data.basement_area && data.basement_price_pay_50){
                                basement_price_pay_50 = data.basement_price_pay_50*data.basement_area
                            }
                            if(get_percent == '30'){
                                $("#price_bought").val(Math.round(data.total_area*data.price_pay_30 + mansard_price + basement_price_pay_30 + terrace_price))
                            }else{
                                $("#price_bought").val(Math.round(data.total_area*data.price_pay_50 + mansard_price + basement_price_pay_50 + terrace_price))
                            }

                            // $("#inputID").prop('disabled', false); //enable
                            deal()
                        } else {

                        }
                    }
                });
                deal()
            });

            $('form .select2').select2();
            $('#deal-create-form #dateDl').datetimepicker({
                format: 'Y-M-D',
            });

            $('#deal-create-form #start_date').datetimepicker({
                format: 'Y-M-D',
            });

            // Rasrochka hisob kitoblari amalga oshirilmoqda

            let startPrice1 = parseInt($('#an_initial_fee').val());
            let price1 = parseInt($('#price_bought').val());

            $('#an_initial_fee').on('input',function (e) {
                deal()
            })

            $('#price_bought').on('input',function (e) {
                deal()
            })

            $('#period').on('change',function (e) {
                deal()
            })

            $('#installment_plan').on('change',function (e) {
                //kvartirani sozdat qilishdagi sahifa yoki kvartirani sotishdagi sahifaligini tekshirib apiga id berish
                let house_flat_id = $("#house_flat_id").val()
                let house_flat_sell = $("#house_flat_sell").val()
                let flat_id = house_flat_id
                if(house_flat_sell != null){
                    flat_id = house_flat_sell
                }
                let checked = $(this).is(':checked')
                $('.installment_plan').toggleClass('active');
               
               
               
               
                $.ajax({
                    type: "GET",
                    datatype:"json",
                    url: "/forthebuilder/deal/get-flat-price?id=" + flat_id,
                    success: function(data) {
                        if (data) {
                            if(data.mansard && data.mansard_area){
                                mansard_price = data.mansard*data.mansard_area
                            }else if(data.basement_area && data.basement){
                                basement_price = data.basement*data.basement_area
                            }
                            if(data.terrace_area && data.price){
                                terrace_price = data.price*data.terrace_area
                            }
                            if(data.basement_area && data.basement_price_pay_30){
                                basement_price_pay_30 = data.basement_price_pay_30*data.basement_area
                            }
                            if(data.basement_area && data.basement_price_pay_50){
                                basement_price_pay_50 = data.basement_price_pay_50*data.basement_area
                            }
                            if(checked){
                                if($('#percent').val() == '30'){
                                    $("#price_bought").val(Math.round(data.total_area*data.price_pay_30 + mansard_price + basement_price_pay_30 + terrace_price))
                                }else if($('#percent').val() == '50'){
                                    $("#price_bought").val(Math.round(data.total_area*data.price_pay_50 + mansard_price + basement_price_pay_50 + terrace_price))
                                }else{
                                    $("#price_bought").val(Math.round(data.total_area*data.price + mansard_price + basement_price + terrace_price))
                                }
                            }else{
                                $("#price_bought").val(Math.round(data.total_area*data.price + mansard_price + basement_price + terrace_price))
                            }

                            // $("#inputID").prop('disabled', false); //enable
                            deal()
                        } else {
                        }
                    }
                });
                
                if($('.installment_plan').hasClass('active')){
                    $('#percent').attr("required","true");
                    $('#period').attr("required","true");
                    $('#an_initial_fee').attr("required","true");
                    $('#start_date').attr("required","true");
                }else{
                    $('#percent').removeAttr("required");
                    $('#period').removeAttr("required","true");
                    $('#an_initial_fee').removeAttr("required","true");
                    $('#start_date').removeAttr("required","true");
                }
            });

            // Rasrochka hisob kitoblari amalga oshirilmoqda
            $('#deal-create-form #house_id').on('change',function() {
                var houseID = $(this).val();
                console.log(houseID)
                var selected_flat = '';
                var selected_house_flat_id = $("#selected_house_flat_id").val();
                $("#house_flat_id").prop('disabled', true);
                if (houseID) {
                    $.ajax({
                        type: "GET",
                        datatype:"json",
                        url: "/forthebuilder/deal/get-flat?house_id=" + houseID,
                        success: function(data) {
                            // console.log(data)
                            if (data) {
                                $("#house_flat_id").empty();
                                $("#house_flat_id").append("<option val=''>-------------</option>");
                                data.forEach(function(item){
                                    if (item['number_of_flat'] == selected_house_flat_id) {
                                        var selected_flat = 'selected';
                                    }
                                    // selected_house_flat_id
                                    $("#house_flat_id").append('<option value="' + item.id + '" ' + selected_flat + '>' + item.contract_number + '</option>');
                                })
                                $("#house_flat_id").trigger("change");
                                
                                $("#house_flat_id").prop('disabled', false); //disable
                                // $("#inputID").prop('disabled', false); //enable
                            } else {
                                $("#house_flat_id").empty();
                                $("#house_flat_id").prop('disabled', false); //disable
                            }
                        }
                    });
                } else {
                    $("#house_flat_id").empty();
                }
                deal();
            });
            // $('#deal-create-form #house_flat_id').on('change',function() {
            //     var houseFlatID = $(this).val();
            //     // console.log(houseID)
            //     if (houseFlatID) {
            //         $.ajax({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             type: "GET",
            //             datatype:"json",
            //             url: "/forthebuilder/deal/get-flat-contract-number?house_flat_id=" + houseFlatID,
            //             success: function(data) {
            //                 // console.log(data)
            //                 if (data) {
            //                     $("#contract_number").empty();
            //                     $("#contract_number").val(data.contract_number);

            //                 } else {
            //                     $("#contract_number").empty();
            //                 }
            //             }
            //         });
            //     } else {
            //         $("#contract_number").empty();
            //     }
            // });

            // kartik fileinput upload files
            var $el1 = $("#files");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $("#files").fileinput({
                language:'ru',
                uploadUrl: "/forthebuilder/deal/file-upload",
                // deleteUrl: '/forthebuilder/deal/file-delete-all',
                allowedFileExtensions: ['pdf', 'doc', 'docx', 'xls', 'xlsx','png','jpg','jpeg','svg'],
                uploadAsync: false,
                maxFileSize: 150000,
                maxFilesNum: 25,
                showUpload: false,
                showCaption: true,
                showRemove: false,
                removeClass: "btn btn-danger",
                removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
                overwriteInitial: false,
                // removeLabel: "Delete",
                // minFileCount: 1,
                // maxFileCount: 5,
                // hideThumbnailContent:false,
                // preferIconicPreview: true,
                browseOnZoneClick: true,
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreview: [
                    @if(!empty($dealFiles))
                        @foreach($dealFiles as $dealItemFile)
                            "{{ asset('/uploads/tmp_files/' . Auth::user()->id.'/deal/'.$dealItemFile->getFilename()) }}",
                        @endforeach
                    @endif
                ],
        
                initialPreviewConfig: [
                    @if(!empty($dealFiles))
                        @foreach($dealFiles as $dealItemFile)
                            @if($dealItemFile->getExtension() == 'jpg' || $dealItemFile->getExtension() == 'jpeg' || $dealItemFile->getExtension() == 'png')
                                {caption: "{{ $dealItemFile->getFilename() }}", size: "{{ $dealItemFile->getSize() }}", width: "120px", url: '/forthebuilder/deal/file-delete/'+'{{ $dealItemFile->getFilename() }}', key: "{{ $dealItemFile->getFilename() }}"},
                            @else
                                {type: "{{ $dealItemFile->getExtension() }}",caption: "{{ $dealItemFile->getFilename() }}", size: "{{ $dealItemFile->getSize() }}", width: "120px", url: '/forthebuilder/deal/file-delete/'+'{{ $dealItemFile->getFilename() }}', key: "{{ $dealItemFile->getFilename() }}"},
                            @endif
                        @endforeach
                    @endif
                ]
            }).on("filebatchselected", function(event, files) {
                $el1.fileinput("upload");
            }).on('filesorted', function(e, params) {
                console.log('file sorted', e, params);
            }).on('fileuploaded', function(e, params) {
                console.log('file uploaded', e, params);
            }).on('filesuccessremove', function(e, id) {
                console.log('file success remove', e, id);
            });
            // kartik fileinput upload files

        });

        $(document).ready(function() {
            $("#house_id").trigger("change");
        })
    </script>
@endsection




