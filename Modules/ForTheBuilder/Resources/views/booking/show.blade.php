@extends('forthebuilder::layouts.forthebuilder')
@section('title')
    {{ translate('Booking') }}
@endsection

<style>
    .select-items > div:nth-child(2) {
    background-color: #B1FF9D !important;
}
</style>
@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            <div style="max-width: 1394px;">
                @include('forthebuilder::layouts.content.header')
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{ route('forthebuilder.booking.index') }}" class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="{{ asset('/backend-assets/forthebuilders/images/icons/arrow-left.png') }}"
                            alt=""></a>
                    <h2 class="panelUprText">{{ translate('Booking') }}</h2>
                </div>
            </div>

            <div class="sozdatBronyaData">
                <div style="width: 100%;" class="d-flex">
                    <div>
                        @php
                            $areaPrices = NULL;
                            if ($model->ares_price)
                                $areaPrices = json_decode($model->ares_price);

                            if ($areaPrices != NULL)
                                $priceForM2 = $areaPrices->hundred->total;
                        @endphp
                        {{-- @dd($priceForM2) --}}
                        <div class="sozdatImyaSpsok">
                            <h3 class="sozdatImyaSpisokH3">{{ translate('Client Full Name') }}</h3>
                            <div class="sozdatImyaSpisokInput1272">
                                @php
                                    echo ($model->client_first_name ?? '') . ' ' . ($model->client_last_name ?? '') . ' ' . ($model->client_middle_name ?? '');
                                @endphp
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="lidiMarginRight1272">
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Phone') }}</h3>
                                    <div class="sozdatImyaSpisokInputTel1272">{{ $model->phone ?? '' }}</div>
                                </div>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"> {{ translate('Passport data ') }}</h3>
                                    <div class="sozdatImyaSpisokInputPasport1272">{{ $model->series_number ?? '' }}</div>
                                </div>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Booking period') }}</h3>
                                    <div class="sozdatImyaSpisokInputPasport1272">

                                        @php
                                            if ($model->expire_dates) {
                                                $array = json_decode($model->expire_dates);
                                                $array = end($array);
                                                echo $array->date ?? '';
                                            }
                                        @endphp
                                    </div>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('House name') }}</h3>
                                    <div class="sozdatImyaSpisokInputKvartira1272">{{ $model->house_name }}</div>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Apartment') }}</h3>
                                    <div class="sozdatImyaSpisokInputKvartira1272">{{ $model->number_of_flat }}</div>
                                </div>
                            </div>

                            <div class="lidiMarginRight1272">
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Corpus') }}</h3>
                                    <div class="sozdatImyaSpisokInputKvartira1272">{{ $model->corpus }}</div>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Entrance') }}</h3>
                                    <div class="sozdatImyaSpisokInputKvartira1272">{{ $model->entrance }}</div>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Floor') }}</h3>
                                    <div class="sozdatImyaSpisokInputKvartira1272">{{ $model->floor }}</div>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Prepayment') }}</h3>
                                    <div class="sozdatImyaSpisokInputPredoplata1272">{{ (int) $model->prepayment }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="sozdatBronImya">{{ translate('Responsible') }}: <br>
                            @php
                                echo $model->manager_first_name . ' ' . $model->manager_last_name . ' ' . $model->manager_middle_name;
                            @endphp
                        </p>
                        {{-- <img class="homeSozdatImage1272" src="{{ asset('/uploads/house-flat/' . $model->house_flat_id . '/m_' . $model->guid) }}"
                                                 class="img-fluid mb-2" alt="red sample" /> --}}
                                  {{-- @dd($model)  
                                      --}}
                        @if ($model->guid != null)
                        
                            <img style="width:100%; height: 200px"  class="homeSozdatImage1272" src="{{ asset('/uploads/house-flat/' . $model->house_id . '/m_' . $model->guid) }}" alt="Home">

                            {{-- <img style="width:100%; height: 400px"  class="homeSozdatImage1272" src="{{ asset('/uploads/house-flat/' . $house->id . '/l_' . $guid) }}" alt="Home"> --}}


                        @else
                            <img style="width:100%; height: 200px"  class="homeSozdatImage1272" src="{{ asset('/backend-assets/forthebuilders/images/a6d5ae15f8f52bd6b9db53be7746c650 1.png') }}" alt="Home">

                        @endif
                        {{-- <img class="homeSozdatImage1272" {{$model->guid}} ? src="{{ asset('/uploads/house-flat/' . $model->house_id . '/' . $model->guid) }}" :  alt="House"> --}}
                        <div class="d-flex dropdownsBron">
                            <div class="dropdown">
                                <button class="btn modalYearSelect2 dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ translate('Booking status') }}</button>
                                <div class="dropdown-menu dropdownBodyKalendar" aria-labelledby="dropdownMenuButton"
                                    x-placement="bottom-start"
                                    style="position: absolute; transform: translate3d(0px, 37px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    {{-- @php
                                        dd($model);
                                    @endphp --}}
                                    {{-- @dd($model) --}}
                                    <a class="dropdown-item yearNameKalendar2" href="{{route('forthebuilder.deal.create',['house_flat_id'=>$model->house_flat_id,'house_flat_number'=>$model->number_of_flat,'house_id'=>$model->house_id,'house_name'=>$model->house_name,'contract_number'=>$model->doc_number,'flat_price'=>$model->price,'price_m2'=>$priceForM2])}}">{{ translate('Sell') }}</a>
                                    {{-- location.replace("/forthebuilder/deal/create?house_flat_id=" + house_flat_id +
                                            "house_flat_number=" +
                                            house_number_of_flat + "&house_id=" + house_house_id + '&house_name=' + house_house_name +
                                            '&contract_number=' + house_contract_number + '&flat_price=' + flat_price + '&price_m2=' + price_m2); --}}
                                    <a class="dropdown-item yearNameKalendar2"  data-toggle="modal" data-target="#exampleModal2" href="#">{{ translate('Extend') }}</a>
                                    <a class="dropdown-item yearNameKalendar2" href="#">{{ translate('reissue') }}</a>
                                    {{-- <a class="dropdown-item yearNameKalendar2" href="#">Прекратить</a>  --}}
                                </div>
                            </div>

                            <div class="custom-select PerviyContactGreen2" style="width:200px; margin-top: 4px;">
                                <input type="hidden" id="model_id" value="{{ $model->id }}">
                                {{-- @dd($model->status) --}}
                                <select class="option_status" id="option_status" >
                                    <option>
                                        {{ translate('Status') }}
                                    </option>
                                    <option @if ($model->status == 0) selected @endif value="0">
                                        {{ translate('Not active') }}
                                    </option>
                                    <option style="background-color:green" @if ($model->status == 1) selected @endif value="1">
                                        {{ translate('Active') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div class="modal fade" id="exampleModal2" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="modal-form" action="{{ route('forthebuilder.booking.period.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="booking_id" value="{{$model->id}}">
                {{-- @dd($model) --}}
                <div class="modal-content modalMyJk2">
                    <div class="modal-header border border-0">
                        <div class="d-flex justify-content-between" style="width: 100%;">
                            <div>
                                <h5 class="nomerKvartiraChenaKvartiri">{{ translate('Apartment number') }}: <b
                                        class="apartment_number">{{ (int) $model->prepayment }} sum</b> <br> {{ translate('Apartment price') }}:
                                    <b class="apartment_price">41850</b> у.е.
                                </h5>
                            </div>
                            <div>
                                <h5 class="nomerKvartiraChenaKvartiri">{{ translate('Total area') }}: <b>45 m2</b> <br>
                                    {{ translate('Apartment price') }}:
                                    <b>41
                                        850</b> у.е.
                                </h5>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span id="closeSpan" aria-hidden="true">&times;</span>
                        </button>
                    </div>
        
                    <div class="modal-body">
        
                        
                        <div style="width: 500px;">
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('First name') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInput keyUpName booking-first_name @error('first_name') error-data-input is-invalid @enderror"
                                    type="text" name="first_name" value="{{ $model->client_first_name }}"
                                    autocomplete="off" readonly>
                                <div class="keyUpNameResult d-none"
                                    style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="select2-dropdown select2-dropdown--below"
                                    style="width: 610px; position: absolute; background: lightgrey; display: none; max-height: 177px; overflow: scroll;">
                                    <span class="select2-results">
                                        <ul class="select2-results__options" role="tree" aria-multiselectable="true"
                                            id="select2-0obe-results" aria-expanded="true" aria-hidden="false"
                                            style="padding: 0;">
                                        </ul>
                                    </span>
                                </span>

                                <span class="error-data">
                                    @error('first_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('Last name') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInput keyUpName booking-last_name @error('last_name') error-data-input is-invalid @enderror"
                                    value="{{ $model->client_last_name }}" type="text" name="last_name" readonly>
                                <div class="keyUpNameResult d-none"
                                    style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="error-data">
                                    @error('last_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('Middle name') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInput keyUpName booking-middle_name @error('middle_name') error-data-input is-invalid @enderror"
                                    value="{{ $model->client_middle_name }}" type="text" name="middle_name" readonly>
                                <div class="keyUpNameResult d-none"
                                    style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="error-data">
                                    @error('middle_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                    <div class="sozdatImyaSpsok">
                                        <h3 class="sozdatImyaSpisokH3">{{ translate('Phone number') }}</h3>
                                        <div class="d-flex">
                                            <div>
                                                <img src="{{ asset('backend-assets/forthebuilders/images/region.png') }}"
                                                    alt="Region">
                                            </div>
                                            <div>
                                                <label
                                                    style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                                    for="+998">+998</label>
                                                <input
                                                    class="sozdatImyaSpisokInputTel keyUpName booking-phone @error('phone') error-data-input is-invalid @enderror"
                                                    value="{{ $model->phone }}" type="tel" id="phone" name="phone"
                                                    readonly>
                                                <div class="keyUpNameResult d-none"
                                                    style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                                </div>
                                                {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}
                                                <span class="error-data">
                                                    @error('phone')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sozdatImyaSpsok">
                                        <h3 class="sozdatImyaSpisokH3">{{ translate('additional_phone_number') }}</h3>
                                        <div class="d-flex">
                                            <div>
                                                <img src="{{ asset('backend-assets/forthebuilders/images/region.png') }}"
                                                    alt="Region">
                                            </div>
                                            <div>
                                                <label
                                                    style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                                    for="+998">+998</label>
                                                <input
                                                    class="sozdatImyaSpisokInputTel keyUpName booking-additional_phone @error('additional_phone') error-data-input is-invalid @enderror"
                                                    value="{{ $model->additional_phone }}" type="tel"
                                                    id="additional_phone" name="additional_phone" readonly>
                                                <div class="keyUpNameResult d-none"
                                                    style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                                </div>
                                                {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}
                                                <span class="error-data">
                                                    @error('additional_phone')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div>
                            <div class="col-md-7">
                                    <div class="sozdatImyaSpsok">
                                        <h3 class="sozdatImyaSpisokH3">{{ translate('Serial number of the passport') }}</h3>
                                        <input
                                            class="sozdatImyaSpisokInput keyUpName booking-series_number @error('series_number') error-data-input is-invalid @enderror"
                                            value="{{ $model->series_number }}" type="text" name="series_number" style="margin-bottom:25px; margin-top:3px; width: 300px;
                                            height: 40px;" readonly>
                                        <div class="keyUpNameResult d-none"
                                            style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                        </div>
                                        <span class="error-data">
                                            @error('series_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="sozdatImyaSpsok">
                                        <h3 class="sozdatImyaSpisokH3">{{ translate('Prepayment amount') }}</h3>
                                        <input
                                            class="sozdatImyaSpisokInput booking-prepayment_summa"
                                            value="{{ (int) $model->prepayment }}" type="number" name="prepayment_summa" style="margin-bottom:25px; width: 300px;
                                            height: 40px;">
                                    </div>
                                    {{-- @dd($model) --}}
                                    <div class="sozdatImyaSpsok" >
                                        <h3 class="sozdatImyaSpisokH3" >{{ translate('Booking period') }}</h3>
                                            <input id="dateInput" placeholder="{{ date('Y-m-d') }}" type="date" name="date_deal"
                                                class="form-control sozdatImyaSpisokSelectOptionJkProdnoDate @error('date_deal') error-data-input is-invalid @enderror"
                                                >
                                            <span class="error-data">
                                                @error('date_deal')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                    </div>
                            </div>
                        </div>
                        <button type="submit" class="sozdatImyaSpisokSozdatButton btn  text-light">{{ translate('Create') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
      </div>





    {{-- <script src="{{ asset('/backend-assets/forthebuilders/javascript/sozdatBron.js') }}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    {{-- <script src="{{ asset('/backend-assets/forthebuilders/javascript/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('/backend-assets/forthebuilders/javascript/modalBackground.js') }}"></script>
    
    <script>
        let page_name = 'page-booking';
        $(document).on('click', '.select-hide', function() {
            var _this = $(this)

            var booking_status = $('.option_status').val();
            var model_id = $('#model_id').val();
            console.log(model_id);
            // var parsing_olx_url = $(this).siblings(".parsing_olx_url").val();
            // var parsing_id = $(this).siblings("parsing_id").val();

            // var parsing_olx_url=document.getElementsByClassName("parsing_olx_url").value;
            // var parsing_id=document.getElementsByClassName("parsing_id").value;

            $.post('{{ route('client.status.update') }}', {
                // _token: '{{ csrf_token() }}',
                // id: index,
                _token: '{{ csrf_token() }}',
                booking_status: booking_status,
                booking_id: model_id,
            }, function(data) {
                // element.removeClass("data");
                console.log(data);
                location.reload();
                // _this.siblings('.parsing_olx_url').attr('type', 'text').val(data);
                // document.getElementById("parsing_olx_url").value(data)
                // console.log(document.getElementById("parsing_olx_url").value);

            });
        })

        const backgorund12 = document.querySelector('.select-items');
        const backgroiund21 = document.querySelector('.PerviyContactGreen2');
        const backgorund42 = document.querySelector('.select-selected');
        console.log(backgorund42);
        backgorund42.classList.add('selectSelectInportantDropDownGreen2');
        const optionTest = backgorund42;

        backgorund42.addEventListener('click', function(){
            if (backgorund42.innerHTML = `{{ translate('Not active') }}`) {
                dkfjs.style.background = '#FF9D9D' 
                backgorund12.style.background = 'transparent' 
                backgroiund21.style.background = '#FF9D9D' 
                dkfjs.style.margin = "-4px 10px 0px 0px"
                dkfjs.style.height = "22px"
            } else if (backgorund42.innerHTML = `{{ translate('Active') }}`) {
                dkfjs.style.background = '#B1FF9D'
                backgorund12.style.background = 'transparent' 
                backgroiund21.style.background = '#B1FF9D'
                dkfjs.style.margin = "-4px 10px 0px 0px"
                dkfjs.style.height = "22px"
            }
        });
    </script>
    
    
@endsection
