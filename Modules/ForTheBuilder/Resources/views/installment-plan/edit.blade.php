@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{translate('update')}} @endsection
<link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/datatables/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/bootstrap-datetimepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css')}}">
@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <form action="{{route('forthebuilder.installment-plan.update', $model->id)}}" class="installment-plan" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('locale.name')}} {{__('locale.customer')}}</label>
                                    <input type="text" name="name" id="name"
                                           class="form-control"
                                           value="{{$model->deal->personal_informations->full_name}}" readonly>

                                </div>
                                <div class="form-group">
                                    <label for="number">{{__('locale.house_flat_number')}}</label>
                                    <input type="text" name="number" id="number"
                                           class="form-control"
                                           value="{{$model->deal->house_flat->number_of_flat}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="price_commas">{{__('locale.Sum')}}</label>
                                    <input type="number" name="price" id="price"
                                           class="form-control" value="{{$model->all_sum}}" readonly>
                                    <input type="hidden" name="price_commas" id="price_commas"
                                           class="form-control" value="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="period">{{__('locale.period')}}</label>
                                    <select name="period" id="period" data-placeholder="{{__('locale.select')}}" class="form-control select2
                                @error('period') is-invalid error-data-input @enderror">
                                        <option value="12 месяц" {{ ($model->period === '12 месяц') ? 'selected' : '' }}>
                                            12 месяц
                                        </option>
                                        <option value="18 месяц" {{ ($model->period === '18 месяц') ? 'selected' : '' }}>
                                            18 месяц
                                        </option>
                                    </select>
                                    <span class="error-data">@error('period'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="percent">{{__('locale.percent')}}</label>
                                    <select name="percent" id="percent" data-placeholder="{{__('locale.select')}}" class="form-control select2
                                @error('percent') is-invalid error-data-input @enderror">
                                        <option value="" selected>{{__('locale.select')}}</option>
                                        <option value="30">
                                            30 %
                                        </option>
                                        <option value="50">
                                            50 %
                                        </option>
                                    </select>
                                    <span class="error-data">@error('percent'){{$message}}@enderror</span>
                                </div>

                                <div class="form-group">
                                    <label for="an_initial_fee">{{__('locale.an_initial_fee')}}</label>
                                    <input type="text" name="an_initial_fee" id="an_initial_fee"
                                           class="form-control @error('an_initial_fee') error-data-input is-invalid @enderror"
                                           value="{{ $model->an_initial_fee }}" >
                                    <span class="error-data">@error('an_initial_fee'){{$message}}@enderror</span>
                                </div>

                                <div class="form-group">
                                    <label for="start_date">{{__('locale.start_date_text')}}</label>
                                    <input type="text" name="start_date" id="start_date"
                                           class="form-control @error('start_date') error-data-input is-invalid @enderror"
                                           value="{{ $model->start_date }}">
                                    <span class="error-data">@error('start_date'){{$message}}@enderror</span>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="month_pay_first">{{__('locale.Second payment')}}</label>
                                        <input type="text" name="month_pay_first" id="month_pay_first"
                                               class="form-control @error('month_pay_first') error-data-input is-invalid @enderror"
                                               value="{{ $model->month_pay_first }}" >
                                        <span class="error-data">@error('month_pay_first'){{$message}}@enderror</span>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="month_pay_second">{{__('locale.Third payment')}}</label>
                                        <input type="text" name="month_pay_second" id="month_pay_second"
                                               class="form-control @error('month_pay_second') error-data-input is-invalid @enderror"
                                               value="{{ empty(!$model->month_pay_second) ? $model->month_pay_second : '' }}" >
                                        <span class="error-data">@error('month_pay_second'){{$message}}@enderror</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div>
                            <button type="submit" class="ml-2 btn btn-success">{{__('locale.update')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
<script src="{{ asset('/backend-assets/forthebuilders/javascript/jquery-3.6.1.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/select/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/moment/js/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/toastr/js/toastr.min.js')}}"></script>
    <script defer src="{{asset('/backend-assets/forthebuilders/bootstrap-datetimepicker.js')}}"></script>
<script>
    let page_name = 'installment-plan';
    $(document).ready(function () {
        $('#start_date').datetimepicker({
            format: 'Y-M-D',
        });
        deal()
        // Rasrochka hisob kitoblari amalga oshirilmoqda

        let startPrice1 = parseInt($('#an_initial_fee').val());
        let price1 = parseInt($('#price').val());

        function deal(){
            let price = parseInt($('#price').val());
            let percent = parseInt($('#percent').val())/100;
            if($('#percent').val() != undefined){
                $('#an_initial_fee').val(price*percent)
                let price_comma = parseInt(Math.ceil(price*percent)).toLocaleString('en-US', {
                    style: "currency",
                    currency: "USD" ,
                });
                $('#price_commas').val(price_comma)
            }else{
                $('#an_initial_fee').val(price)
                let price_comma = parseInt(Math.ceil(price)).toLocaleString('en-US', {
                    style: "currency",
                    currency: "USD" ,
                });
                $('#price_commas').val(price_comma)
            }
            let startPrice = parseInt($('#an_initial_fee').val());

            let period = $('#period').val();
            if(period === '18 месяц'){
                if(percent == 0.3){
                    let result2 = ((price)*0.3);
                    let result = ((price)*0.4);

                    if(result > 0){
                        $('#month_pay_second').val(result2.toFixed(3));
                        $('#month_pay_first').val(result.toFixed(3));
                    }
                }else{
                    let result2 = ((price)*0.2);
                    let result = ((price)*0.3);

                    if(result > 0){
                        $('#month_pay_second').val(result2.toFixed(3));
                        $('#month_pay_first').val(result.toFixed(3));
                    }
                }
            }else{
                if(percent == 0.3){
                    let result2 = ((price)*0.3);
                    let result = ((price)*0.4);

                    if(result > 0){
                        $('#month_pay_second').val(result2.toFixed(3));
                        $('#month_pay_first').val(result.toFixed(3));
                    }
                }else{
                    let result2 = ((price)*0.2);
                    let result = ((price)*0.3);

                    if(result > 0){
                        $('#month_pay_second').val(result2.toFixed(3));
                        $('#month_pay_first').val(result.toFixed(3));
                    }
                }
            }
        }

        $('#an_initial_fee').on('input',function (e) {
            deal()
        })
        $('#percent').on('change',function (e) {
            deal()
        })

        $('#period').on('change',function (e) {
            deal()
        })

        $('#an_initial_fee').on('input',function (e) {
            deal()
        })
        // Rasrochka hisob kitoblari amalga oshirilmoqda

    });
</script>
