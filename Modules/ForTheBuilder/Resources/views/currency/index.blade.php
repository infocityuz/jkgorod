@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ translate('Currency') }}
@endsection
<link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/datatables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('/backend-assets/forthebuilders/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css') }}">

@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{ route('forthebuilder.settings.index') }}"
                        class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="{{ asset('/backend-assets/forthebuilders/images/icons/arrow-left.png') }}"
                            alt=""></a>
                    <h2 class="panelUprText">{{ translate('Currencies') }}</h2>
                    <a href="#" class="plus2 addNewCurrency">+</a>
                    {{-- {{ route('forthebuilder.currency.create') }} --}}
                </div>
            </div>

            <div class="kursValyutaDataBig">
                <div class="kursValyutaData">
                    <div class="d-flex">
                        <div class="kursValyutaUsd">
                            <img height="30"
                                src="{{ asset('/backend-assets/forthebuilders/images/2560px-Flag_of_the_United_States.png') }}"
                                alt="Usa">
                        </div>
                        <div class="kursValyutaUsd">
                            <img height="30"
                                src="{{ asset('/backend-assets/forthebuilders/images/1200px-Flag_of_Uzbekistan.png') }}"
                                alt="Uzb">
                        </div>
                    </div>

                    <div>
                        <div class="kursValyutaUsd">
                            {{ translate('Date') }}
                        </div>
                    </div>
                </div>

                <div class="kursValyutaData">
                    @if ($model)
                        <div class="d-flex">
                            <input type="hidden" id="currencyId" class="" value="{{ $model->id }}">
                            <div class="kursValyutaUsd">
                                <input type="text" value="{{ $model->USD }}" class="kursValyutaWhite currencyUpdate"
                                    disabled data-status="USD">
                                {{-- <div class="kursValyutaWhite">{{$model->USD}}</div> --}}
                            </div>
                            <div class="kursValyutaUsd">
                                <input type="text" value="{{ $model->SUM }}" class="kursValyutaWhite currencyUpdate"
                                    disabled data-status="SUM">
                                {{-- <div class="kursValyutaWhite">{{$model->SUM}}</div> --}}
                            </div>
                        </div>

                        <div>
                            <div class="kursValyutaUsd">
                                <div class="kursValyutaWhite">{{ date('d.m.Y H:i', strtotime($model->created_at)) }}</div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="kursValyutaData formNewCurrency d-none">
                    <div class="d-flex">
                        <input type="hidden" id="currencyId" class="" value="">
                        <div class="kursValyutaUsd">
                            <input type="text" value="" class="kursValyutaWhite currencyUsd" data-status="USD">
                            {{-- <div class="kursValyutaWhite">{{$model->USD}}</div> --}}
                        </div>
                        <div class="kursValyutaUsd">
                            <input type="text" value="" class="kursValyutaWhite currencyUzs" data-status="SUM">
                            {{-- <div class="kursValyutaWhite">{{$model->SUM}}</div> --}}
                        </div>
                    </div>

                    <div>
                        <div class="kursValyutaUsd">
                            <div class="checkboxDivTextInput35652">
                                <div class="seaDiv currencySave" style="cursor: pointer;">
                                    <img class="mt-1" width="20" height="20"
                                        src="{{ asset('/backend-assets/forthebuilders/images/Verifed.png') }}"
                                        alt="Trash">
                                </div>
                                <div class="seaDiv removeFormCurrency" style="cursor: pointer;">
                                    <img class="mt-1" width="20" height="20"
                                        src="{{ asset('/backend-assets/forthebuilders/images/trash.png') }}"
                                        alt="Trash">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="#" class="seaDiv" id="currencyUpdateButton" title="update"
                        style="margin-right: 10px; text-align: center">
                        {{-- {{ route('forthebuilder.currency.create') }} --}}
                        <img class="mt-1" width="20" height="20"
                            src="{{ asset('/backend-assets/forthebuilders/images/edit.png') }}" alt="Edit">
                    </a>
                    <form style="display: inline-block;" action="{{ route('forthebuilder.currency.destroy') }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <div style="margin-right: 10px; text-align: center" type="submit" class="seaDiv" title="delete">
                            <img class="mt-1" width="20" height="20"
                                src="{{ asset('/backend-assets/forthebuilders/images/trash.png') }}" alt="Trash">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        page_name = 'page-currency';
    </script>
@endsection
