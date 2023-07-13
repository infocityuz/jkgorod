@extends('forthebuilder::layouts.forthebuilder')
@php
    use Modules\ForTheBuilder\Entities\House;
    use Modules\ForTheBuilder\Entities\Constants;
@endphp
@section('title')
    {{ translate('JK') }}
@endsection

<style>
    .error-data {
        color: red;
    }
</style>

@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{ route('forthebuilder.settings.index') }}" class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="{{ asset('backend-assets/forthebuilders/images/icons/arrow-left.png') }}" alt=""></a>
                    <h2 class="panelUprText">{{ translate('Price formation') }}</h2>
                </div>
            </div>

            <form id="" action="{{ route('forthebuilder.house.save-price-information') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="priseObrazavaniyaData">
                    {{-- @dd($model); --}}
                    <select class="obrazavaniyaSelect priceInformationSelectHouse" name="house_id"
                        style="opacity: {{ old('house_id') ? 1 : 0.25 }};">
                        <option aria-placeholder="{{ translate('Select LCD') }}" selected hidden disabled>
                            {{ translate('Select LCD') }}
                        </option>
                        @empty(!$model)
                            @foreach ($model as $value)
                                @php
                                    $selected = old('house_id') == $value->id ? 'selected' : '';
                                @endphp
                                <option value="{{ $value->id }}" {{ $selected }}>
                                    {{ $value->name . ' (' . $value->corpus . ')' }}</option>
                            @endforeach
                        @endempty
                    </select>
                    <span class="error-data">
                        @error('house_id')
                            {{ $message }}
                        @enderror
                    </span>

                    <select class="obrazavaniyaSelect" name="price_type"
                        style="opacity: {{ old('price_type') ? 1 : 0.25 }};">
                        <option aria-placeholder="{{ translate('Choose an object') }}" selected hidden disabled>
                            {{ translate('Choose an object') }}
                        </option>
                        {{-- @php
                            $selected = old('house_id') == $value->id ? 'selected' : '';
                        @endphp --}}
                        <option value="{{ Constants::PRICE_M2 }}"
                            {{ old('price_type') == Constants::PRICE_M2 ? 'selected' : '' }}>
                            {{ translate('Price per m2') }}
                        </option>
                        <option value="{{ Constants::PRICE_TERRACE }}"
                            {{ old('price_type') == Constants::PRICE_TERRACE ? 'selected' : '' }}>
                            {{ translate('Price per m2 with terrace') }}
                        </option>
                        <option value="{{ Constants::PRICE_ATTIC }}"
                            {{ old('price_type') == Constants::PRICE_ATTIC ? 'selected' : '' }}>
                            {{ translate('Price per m2 in attic') }}
                        </option>
                        <option value="{{ Constants::PRICE_BASEMENT }}"
                            {{ old('price_type') == Constants::PRICE_BASEMENT ? 'selected' : '' }}>
                            {{ translate('Price per m2 on the ground floor') }}
                        </option>
                    </select>
                    <span class="error-data">
                        @error('price_type')
                            {{ $message }}
                        @enderror
                    </span>

                    <button type="button" class="obrazavaniyaSelect text-left btn priceFormationOpenFlats"
                        data-toggle="modal" data-target="#exampleModalLong"
                        style="opacity: {{ old('house_flats') ? 1 : 0.25 }};">{{ translate('Choose a flat') }}</button>
                    <span class="error-data">
                        @error('house_flats')
                            {{ $message }}
                        @enderror
                    </span>
                    {{-- <div class="obrazavaniyaSelect" style="cursor: pointer;">{{ translate('Choose a flat') }}</div> --}}

                    {{-- <select class="obrazavaniyaSelect">
                        <option aria-placeholder="Выберите объект" selected hidden disabled>Выберите объект</option>
                        <option>Test</option>
                    </select> --}}

                    <div>
                        <div class="d-flex divForSummPrice">
                            <div style="width: 49%;">
                                <select class="obrazavaniyaSelect" name="payment[0][payment_type]"
                                    style="opacity: {{ old('payment_type') ? 1 : 0.25 }};">
                                    <option aria-placeholder="{{ translate('Payment %') }}" selected hidden disabled>
                                        {{ translate('Payment %') }}
                                    </option>
                                    <option value="{{ Constants::PAYMENT_30 }}"
                                        {{ old('payment_type') == Constants::PAYMENT_30 ? 'selected' : '' }}>
                                        {{ translate('at 30% payment') }}</option>
                                    
                                    <option value="{{ Constants::PAYMENT_70 }}"
                                        {{ old('payment_type') == Constants::PAYMENT_70 ? 'selected' : '' }}>
                                        {{ translate('at 70% payment') }}
                                    </option>

                                    <option value="{{ Constants::PAYMENT_50 }}"
                                        {{ old('payment_type') == Constants::PAYMENT_50 ? 'selected' : '' }}>
                                        {{ translate('at 50% payment') }}</option>
                                    <option value="{{ Constants::PAYMENT_100 }}"
                                        {{ old('payment_type') == Constants::PAYMENT_100 ? 'selected' : '' }}>
                                        {{ translate('at 100% payment') }}</option>
                                </select>
                                <span class="error-data">
                                    @error('payment_type')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div style="width: 49%; margin-left: auto">
                                <input type="number" class="obrazavaniyaSelect obrazavaniyaSelectInput"
                                    style="opacity: {{ old('amount') ? 1 : 0.25 }};"
                                    placeholder="{{ translate('Enter amount') }}" name="payment[0][amount]" value="{{ old('amount') }}">
                                <span class="error-data">
                                    @error('amount')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" id="price_formaition_id" name="house_flats" value="{{ old('house_flats') }}">

                    <button type="submit" class="sozdatImyaSpisokSozdatButton text-light btn float-left">{{ translate('Save') }}</button>

                    <div class="float-right" style="width: 5%; margin-top: 20px;">
                        <button class="obrazavaniyaSelect btn btn-success plusForSummPrice" data-count="0" style="padding-left: 14px; background-color: #44BE26; opacity: 0.8; border: none">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    
                    <div class="float-right" style="width: 5%; margin-top: 20px; margin-right: 10px;">
                        <button class="obrazavaniyaSelect btn btn-danger minusForSummPrice" style="padding-left: 14px; background-color: #FB3030; opacity: 0.8; border: none">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal_test" role="document">
            <div class="modal-content">
                <div class="modal-header border border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ----- ---- ---
                </div>
                <div class="modal-footer">
                    <button class="btn sozdatImyaSpisokSozdatButton text-light mt-0 savePriceFormation"
                        data-dismiss="modal">{{ translate('Save') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;">
                <div class="modal-body">
                    <h2 class="modalVideystvitelno">{{ translate('First select an object') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        let page_name = 'settings';
    </script>
@endsection
