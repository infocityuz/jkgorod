@extends('forthebuilder::layouts.forthebuilder')
@php
    use Modules\ForTheBuilder\Entities\House;
    use Modules\ForTheBuilder\Entities\HouseFlat;
@endphp
@section('title')
    {{ translate('JK') }}
@endsection
<style>
    .sozdatJkData {
        height: auto !important;
    }
</style>
@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{ route('forthebuilder.deal.index') }}" class="plus2 profileMaxNazadInformatsiyaKlient">
                        <img src="{{ asset('backend-assets/forthebuilders/images/icons/arrow-left.png') }}" alt="">
                    </a>
                    <h2 class="panelUprText">{{ translate('Sale') }}</h2>
                </div>
            </div>

            <div class="sozdatJkData">
                <form id="deal-create-form" action="{{ route('forthebuilder.deal.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="prodnoDataH5Text">{{ translate('Description of the object') }}</h3>
                            <div class="form-group">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('jk') }}</h3>
                                <select class="form-control sozdatImyaSpisokSelectOptionJkProdno deal_create_house_id @error('house_id') is-invalid error-data-input @enderror"
                                    readonly id="exampleFormControlSelect1" name="house_id">
                                    {{-- <option value="default">-----------------</option> --}}
                                    @if (!empty($houses))
                                        @foreach ($houses as $house)
                                            @if (isset(request()->house_id) && $house->id == request()->house_id)
                                                <option value="{{ $house->id }}" selected>
                                                    {{ $house->name }} {{ $house->description }}
                                                </option>
                                            @elseif($house_flat->id)
                                                <option value="{{ $house->id }}" {{$house_flat->house_id == $house->id? "selected" :''}}>
                                                    {{ $house->name }} {{ $house->description }}
                                                </option>
                                            @endif

                                            {{-- @if (isset(request()->house_id) && $house->id == request()->house_id)
                                                <option value="{{ $house->id }}" selected>
                                                    {{ $house->name }} {{ $house->description }}
                                                </option>
                                            @else
                                                <option value="{{ $house->id }}" selected>
                                                    {{ $house->name }} {{ $house->description }}
                                                </option>
                                            @endif --}}
                                        @endforeach
                                    @endif
                                </select>
                                <span class="error-data">
                                    @error('house_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Apartment No.') }}</h3>
                                @if(isset(request()->house_flat_number ))
                                    <input type="text" name="house_flat_number"
                                        class="form-control sozdatImyaSpisokSelectOptionJkProdno"
                                        value="{{ request()->house_flat_number }}">
                                @elseif($house_flat != 'NUll')
                                    <input type="text" name="house_flat_number"
                                       class="form-control sozdatImyaSpisokSelectOptionJkProdno"
                                       value="{{ $house_flat->number_of_flat }}">
                                @endif
                                <span class="error-data">
                                    @error('house_flat_number')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('description') }}</h3>
                                <input type="text" name="description"
                                    class="sozdatImyaSpisokInputProdnoBig form-control @error('description') error-data-input is-invalid @enderror"
                                    id="description"
                                    placeholder="{{ translate('Brief description of the residential complex') }}"
                                    value="{{ old('description') }}">
                                <span class="error-data">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="displayNoneProdnoMobile">
                                <div class="form-group">
                                    <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Contract number') }}
                                    </h3>
                                    <input type="text" name="agreement_number"
                                        class="form-control sozdatImyaSpisokSelectOptionJkProdno select2 @error('agreement_number') is-invalid error-data-input @enderror">
                                    {{--  . '/' . date('d-m') --}}
                                    <span class="error-data">
                                        @error('agreement_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group" style="margin-left: 10px;">
                                    <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('date') }}</h3>
                                    <input id="dateInput" placeholder="{{ date('d.m.Y') }}" type="date" name="date_deal"
                                        class="form-control sozdatImyaSpisokSelectOptionJkProdnoDate @error('date_deal') error-data-input is-invalid @enderror"
                                        value="{{ old('date_deal') }}">
                                    <span class="error-data">
                                        @error('date_deal')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <h3 class="prodnoDataH5Text">{{ translate('Passport data of the client') }}</h3>

                            <div class="form-group">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Passport or ID') }}</h3>
                                <select class="form-control sozdatImyaSpisokSelectOptionJkProdno passport_or_id" id="exampleFormControlSelect3" name="passport_or_id">
                                    <option value="1">{{ translate('Passport') }}</option>
                                    <option value="0">{{ translate('ID Card') }}</option>
                                </select>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('First name') }}</h3>
                                    <input class="sozdatImyaSpisokInputProdnoBig form-control keyUpName booking-first_name @error('first_name') error-data-input is-invalid @enderror"
                                           type="text" name="first_name" value="{{ $clients != 'NULL'?$clients->first_name:'', old('first_name') }}">
                                <div class="keyUpNameResult d-none"
                                    style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="error-data">
                                    @error('first_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <input type="hidden" name="client_id" class="booking-client_id" id="" value="{{$clients != 'NULL'?$clients->id:''}}">
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Last name') }}</h3>
                                <input class="sozdatImyaSpisokInputProdnoBig keyUpName form-control booking-last_name @error('last_name') error-data-input is-invalid @enderror"
                                    type="text" name="last_name" value="{{ $clients != 'NULL'?$clients->last_name:'', old('last_name') }}">
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
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Middle name') }}</h3>
                                <input class="sozdatImyaSpisokInputProdnoBig keyUpName booking-middle_name form-control @error('middle_name') error-data-input is-invalid @enderror"
                                    type="text" name="middle_name" value="{{ $clients != 'NULL'?$clients->middle_name:'', old('middle_name') }}">
                                <div class="keyUpNameResult d-none"
                                    style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="error-data">
                                    @error('middle_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Gender') }}</h3>
                                <select class="form-control sozdatImyaSpisokSelectOptionJkProdno"
                                    id="exampleFormControlSelect1" name="gender">
                                    @if($clients != 'NULL')
                                        <option value="1" {{$clients->gender == 1 ?? "selected"}}>{{ translate('Man') }}</option>
                                        <option value="0" {{$clients->gender == 0 ?? "selected"}}>{{ translate('Woman') }}</option>
                                    @else
                                        <option value="1">{{ translate('Man') }}</option>
                                        <option value="0">{{ translate('Woman') }}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">
                                    {{ translate('Birth date') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInputProdnoBig form-control @error('birth_date') error-data-input is-invalid @enderror"
                                    value="{{ $clients != 'NULL' ? $clients->birth_date : '', old('birth_date') }}" type="date" name="birth_date" id="birth_date">
                                <span class="error-data">
                                    @error('birth_date')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Serial number of the passport') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInputProdnoBig keyUpName booking-series_number form-control @error('series_number') error-data-input is-invalid @enderror"
                                    type="text" name="series_number" id="series_number" value="{{ $clients != 'NULL'?$clients->informations->series_number:'', old('series_number') }}">
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
                                <h3 class="sozdatImyaSpisokH3Prodno">
                                    {{ translate('Issued by (Date of issue and expiration date)') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInputProdnoBig booking-given_date form-control @error('given_date') error-data-input is-invalid @enderror"
                                    value="{{ $clients != 'NULL'?$clients->informations->given_date:'', old('given_date') }}" type="date" name="given_date" id="given_date">
                                <span class="error-data">
                                    @error('given_date')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">
                                    {{ translate('Issued by') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInputProdnoBig booking-issued_by form-control @error('issued_by') error-data-input is-invalid @enderror"
                                    value="{{ $clients != 'NULL'?$clients->informations->issued_by:'', old('issued_by') }}" type="text" name="issued_by" id="issued_by">
                                <span class="error-data">
                                    @error('issued_by')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Registration by passport') }}</h3>
                                <input class="sozdatImyaSpisokInputProdnoBig booking-issued_by form-control @error('live_address') error-data-input is-invalid @enderror"
                                    value="{{ $clients != 'NULL'?$clients->informations->live_address:'', old('live_address') }}" type="text" name="live_address"
                                    id="live_address">
                                <span class="error-data">
                                    @error('live_address')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('PINFL or TIN') }}</h3>
                                <input class="sozdatImyaSpisokInputProdnoBig booking-inn @error('inn') error-data-input is-invalid @enderror"
                                    value="{{ $clients != 'NULL'?$clients->informations->inn:'', old('inn') }}" type="text" name="inn" id="inn">
                                <span class="error-data">
                                    @error('inn')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <h3 class="prodnoDataH5Text">{{ translate('Contact details') }}</h3>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Phone number') }}</h3>
                                <div class="d-flex">
                                    <div>
                                        <img src="{{ asset('backend-assets/forthebuilders/images/region.png') }}"
                                            alt="Region">
                                    </div>
                                    <div>
                                        <label style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;" for="+998">+998</label>
                                        <input type="hidden" name="phone_code" value="+998">
                                        <input class="sozdatImyaSpisokInputTel keyUpName booking-phone @error('phone') error-data-input is-invalid @enderror"
                                            type="tel" id="phone" name="phone_number"
                                            value="{{ $clients != 'NULL'?$clients->phone_number:'', old('phone_number') }}">
                                        {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}
                                        <span class="error-data">
                                            @error('phone_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Additional phone number') }}</h3>
                                <div class="d-flex">
                                    <div>
                                        <img src="{{ asset('backend-assets/forthebuilders/images/region.png') }}"
                                            alt="Region">
                                    </div>
                                    <div>
                                        <label
                                            style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                            for="+998">+998</label>
                                        <input class="sozdatImyaSpisokInputTel keyUpName booking-additional_phone @error('additional_phone') error-data-input is-invalid @enderror"
                                            type="tel" id="phone" name="additional_phone"
                                            value="{{ $clients != 'NULL'?$clients->additional_phone:'', old('additional_phone') }}">
                                        {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}
                                    </div>
                                </div>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Email address') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInputProdnoBig booking-email form-control @error('email') error-data-input is-invalid @enderror"
                                    value="{{ old('email') }}" type="email" name="email" id="email">
                                <span class="error-data">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            {{-- <div class="d-flex">
                                <label class="login_file">
                                    <input class="login_file" type="file" style="display: none;">
                                    <div class="d-flex">
                                        <button class="dobavitFotoPolzovatel">+</button>
                                        <h5 class="dobavitFotoTextPolzovatel">Прикрепить файл</h5>
                                    </div>
                                </label>
                            </div> --}}
                            {{-- <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('file__upload') }}</h3>
                            <input type="file" name="files[]" id="files" multiple> --}}

                            <div class="d-flex">
                                <label class="login_file">
                                    <input class="login_file" type="file" style="display: none;" name="files">
                                    <div class="d-flex">
                                        <button type="button"
                                            class="dobavitFotoPolzovatel btn btnDealCreateFile">+</button>
                                        <h5 class="dobavitFotoTextPolzovatel clickDealCreateFile">
                                            {{ translate('Attach file') }}</h5>
                                    </div>
                                </label>
                            </div>

                        </div>

                        <div class="d-flex prodnoRightImportData" style="margin-top: 40px;">
                            <div>
                                <div class="form-group">
                                    <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Registry number') }}</h3>
                                    <select
                                        class="form-control sozdatImyaSpisokSelectOptionJkProdno deal_create_registry_number @error('house_flat_id') error-data-input is-invalid @enderror"
                                        id="exampleFormControlSelect1" name="house_flat_id" readonly>
                                        {{-- <option value=" "> </option> --}}
                                        @if(isset($house_flat->id))
                                            <option value="{{ $house_flat->id }}" {{$house_flat->id?"selected":''}}>
                                                {{ request()->house_flat_number ?? $house_flat->id }}</option>
                                        @else
                                            <option value="{{ request()->house_flat_id??'' }}">
                                            {{ request()->house_flat_number??''}}</option>

                                        @endif
                                    </select>
                                    <span class="error-data">
                                        @error('house_flat_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <input type="hidden" name="doc_number"
                                    value="{{ request()->house_flat_number ?? '' }}">

                                <div class="form-group" style="margin-right: 30px;">
                                    <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('price') }}</h3>
                                    @if(isset($house_flat->id))
                                        <input type="text" name="price_sell"
                                               class="form-control sozdatImyaSpisokSelectOptionJkProdno dealCreatePrice @error('price_sell') error-data-input is-invalid @enderror"
                                               value="{{ $house_flat->price ?? old('price_sell') }}" step="0.01"
                                               min="0" original-price="{{ $house_flat->price ?? old('price_sell') }}">
                                    @else
                                        <input type="text" name="price_sell"
                                               class="form-control sozdatImyaSpisokSelectOptionJkProdno dealCreatePrice @error('price_sell') error-data-input is-invalid @enderror"
                                               value="{{ request()->flat_price ?? old('price_sell') }}" step="0.01"
                                               min="0" original-price="{{ request()->flat_price ?? old('price_sell') }}">
                                    @endif

                                    <span class="error-data">
                                        @error('price_sell')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group" style="margin-right: 30px;">
                                    <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Price in words') }}</h3>
                                    <input type="text" name="price_sell_word" class="form-control sozdatImyaSpisokSelectOptionJkProdno @error('price_sell_word') error-data-input is-invalid @enderror" value="{{ old('price_sell_word') }}">

                                    <span class="error-data">
                                        @error('price_sell')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group" style="margin-right: 30px;">
                                    <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Price m2') }}</h3>
                                    <input type="text" name="price_sell_m2" class="form-control sozdatImyaSpisokSelectOptionJkProdno dealCreatePriceM2 @error('price_sell_m2') error-data-input is-invalid @enderror" value="{{ request()->price_m2 ?? old('price_sell_m2') }}" step="0.01" min="0" original-price="{{ request()->price_m2 ?? old('price_sell_m2') }}">

                                    <span class="error-data">
                                        @error('price_sell')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <!-- <div class="form-group">
                                    <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Gender') }}</h3>
                                    <select class="form-control sozdatImyaSpisokSelectOptionJkProdno"
                                        id="exampleFormControlSelect1" name="gender">
                                        <option value="1">{{ translate('Man') }}</option>
                                        <option value="0">{{ translate('Woman') }}</option>
                                    </select>
                                </div> -->

                                <div class="form-group" style="margin-right: 30px; width: 250px;">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Coupon') }}</h3>
                                    <input class="sozdatImyaSpisokInput" style="padding-right: 10px;" type="text"
                                        name="coupon" autocomplete="off" id="coupon-in-deal" value="">
                                    <span id="applied" style="color: green"></span>
                                    <input type="hidden" name="coupon_percent" id="coupon_percent">
                                    <button class="calculate_coupon_price d-none">Calculate Coupon Price</button>
                                </div>

                                <div>
                                    <div class="rassrochkaProdnoCheckBox7">
                                        <label class="d-flex flexDropdownRassrochka mt-1">
                                            <input class="rassrochkaProdnoCheck mt-2" type="checkbox"
                                                name="is_installment" id=""> {{ translate('Installment plan') }}
                                            <span class="error-data">
                                                @error('is_installment')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>

                                        <div id="noneDownDrop" class="noneDropDown">
                                            <div class="polniy_DropDown">
                                                <h3 class="sozdatImyaDropDowno">{{ translate('Installment period') }}</h3>
                                                <select class="form-control sozdatImyaSpisokDropDown selectPeriod"
                                                    id="exampleFormControlSelect1" name="period">
                                                    <option value=" "> </option>
                                                    @empty(!$installmentPlan)
                                                    
                                                        @foreach ($installmentPlan as $val)
                                                            @if($val->period > 0)  
                                                            <option value="{{ $val->id }}"
                                                                data-percent="{{ $val->percent_type }}">{{ $val->period }}
                                                                {{ translate('month') }}</option>
                                                            @endif;
                                                        @endforeach
                                                    @endempty
                                                    {{-- <option value="Apple">Apple</option> --}}
                                                </select>
                                            </div>

                                            <div class="polniy_DropDown">
                                                <h3 class="sozdatImyaDropDowno">{{ translate('Installment percent') }}
                                                </h3>
                                                <select class="form-control sozdatImyaSpisokDropDown selectPercent"
                                                    id="exampleFormControlSelect1" name="percent">
                                                    <option value=" "> </option>
                                                    @empty(!$installmentPlan)
                                                        @foreach ($installmentPlan as $val)
                                                            <option value="{{ $val->id }}"
                                                                data-percent="{{ $val->percent_type }}">
                                                                {{ $val->percent_type }} %
                                                            </option>
                                                        @endforeach
                                                    @endempty
                                                    {{-- <option value="Apple">Apple</option> --}}
                                                </select>
                                            </div>

                                            <div class="polniy_DropDown">
                                                <h3 class="sozdatImyaDropDowno">{{ translate('An initial fee') }}</h3>
                                                <input class="form-control sozdatImyaSpisokDropDown initialFeeDeal"
                                                    type="text" name="initial_fee">
                                                <span class="error-data">
                                                    @error('initial_fee')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="polniy_DropDown">
                                                <h3 class="sozdatImyaDropDowno">{{ translate('Installment start date') }}
                                                </h3>
                                                <input id="dateInput3" class="form-control sozdatImyaSpisokDropDown"
                                                    type="date" name="installment_date" value="{{ date('Y-m-d'); }}">
                                                <span class="error-data">
                                                    @error('installment_date')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="form-group" style="margin-right: 30px;">
                                    <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('price') }}</h3>
                                    <input type="hidden" name="price_sell" id="price_sell"
                                        class="form-control @error('price_sell') error-data-input is-invalid @enderror"
                                        value="{{ old('price_sell') }}" step="0.01" min="0">
                                    <input type="text" name="price_sell_commas"
                                        class="form-control sozdatImyaSpisokSelectOptionJkProdno @error('price_sell') error-data-input is-invalid @enderror"
                                        value="{{ old('price_sell') }}" step="0.01" min="0">
                                    <span class="error-data">
                                        @error('price_sell')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> --}}
                            </div>

                            <div class="displayNoneProdno">
                                <div class="form-group">
                                    <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Contract number') }}</h3>
                                    <input type="text" class="form-control sozdatImyaSpisokSelectOptionJkProdno" name="contract_number">
                                </div>

                                <div class="form-group">
                                    <h3 class="sozdatImyaSpisokH3Prodno">{{ translate('Date') }}</h3>
                                    <input id="dateInput" placeholder="{{ date('d.m.Y') }}" type="date"
                                        class="form-control sozdatImyaSpisokSelectOptionJkProdnoDate">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="model_deal_id" id="deal_id">
                    <input type="hidden" name="model_personal_id" id="personal_id">
                    <input type="hidden" name="model_budget" class="modalMiniCapsule text-left" id="budget_input">
                    <input type="hidden" name="model_looking_for" class="modalMiniCapsule2 text-left" id="looking_for_input">
                    <input type="hidden" name="model_house_id" id="model_house_id" value="{{$house_flat->house_id}}">
                    <input type="hidden" name="model_house_flat_id" id="model_house_flat_id" value="{{$house_flat->id}}">
                    <input type="hidden" name="model_client_id" id="model_client_id">
                    <input type="hidden" name="model_type" id="model_type" value="3">
                    <button type="submit" class="sozdatImyaSpisokSozdatButtonSave text-light saveDealDogovor"
                        style="cursor: pointer;">{{ translate('Save') }}</button>
                </form>
            </div>

        </div>
    </div>
    <script>
        let page_name = 'deal';
        let budget_input = document.getElementById('budget_input')
        let looking_for_input = document.getElementById('looking_for_input')
        let series_number = document.getElementById('series_number')
        let live_address = document.getElementById('live_address')
        let inn = document.getElementById('inn')
        let model_house_id = document.getElementById('model_house_id')
        let model_house_flat_id = document.getElementById('model_house_flat_id')
        let deal_id = document.getElementById('deal_id')
        let personal_id = document.getElementById('personal_id')

        if (localStorage.getItem('model_budget') != null) {
            budget_input.value = localStorage.getItem('model_budget')
        }
        if (localStorage.getItem('model_looking_for') != null) {
            looking_for_input.value = localStorage.getItem('model_looking_for')
        }
        if (localStorage.getItem('model_series_number') != null) {
            series_number.value = localStorage.getItem('model_series_number')
        }
        if (localStorage.getItem('model_issued_by') != null) {
            live_address.value = localStorage.getItem('model_issued_by')
        }
        if (localStorage.getItem('model_inn') != null) {
            inn.value = localStorage.getItem('model_inn')
        }
        if (localStorage.getItem('model_deal_id') != null) {
            deal_id.value = localStorage.getItem('model_deal_id')
        }
        if (localStorage.getItem('model_personal_id') != null) {
            personal_id.value = localStorage.getItem('model_personal_id')
        }
    </script>
@endsection
{{-- @extends('forthebuilder::house.extra') --}}
