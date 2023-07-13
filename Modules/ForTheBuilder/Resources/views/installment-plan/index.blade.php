@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ translate('update') }}
@endsection
<link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/datatables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('/backend-assets/forthebuilders/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css') }}">

<style>
    /* .jkMiniData,
    .jkMiniData2 {
        width: 1000px !important;
    } */

    .sdelkaData {
        width: 90% !important;
    }
    .bronyaFiofirst{
         overflow: hidden !important;
        white-space: nowrap !important;
        padding-left: 5px !important;
        justify-content:left !important;
    }
</style>

@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="panelUprText">{{ translate('Installment plan') }}</h2>
                </div>
                <div class="miniSearchDiv6">
                    <ion-icon class="miniSearchIconInput" name="search-outline"></ion-icon>
                    <input placeholder="{{ translate('Search by installment plan') }}" class="miniInputSdelka5 searchTable"
                        type="text">
                </div>
            </div>

            <div style="width: auto;" class="sdelkaData">
                <div style="width: auto;" class="jkMiniData2">
                    <a href="" class="d-flex">
                        <div class="checkboxDivInput checkingInputRassrochkaChecked">
                            <input class="checkBoxInput" type="checkbox" id="master">
                        </div>
                        <div class="checkboxDivInput checkingInputRassrochkaChecked">
                            №
                        </div>
                        <div class="bronyaFio bronyaFioRassrochka bronyaFiofirst ">
                            {{ translate('Full name of the Customer') }}
                        </div>
                        <div class="checkboxDivTextInput2">
                            {{ translate('Apartment number') }}
                        </div>
                        <div style="width: 9.3vw;" class="sdlekaPriceJk">
                            {{ translate('Sum') }}
                        </div>
                        <div style="width: 9.3vw;" class="rassrochkaPokazatStatus">
                            {{ translate('Period') }}
                        </div>
                        <div style="width: 9.3vw;" class="rassrochkaPokazatStatus">
                            {{ translate('Status') }}
                        </div>
                    </a>
                    <div class="checkboxDivTextInput4">
                        {{ translate('Action') }}
                    </div>
                </div>

                @empty(!$models)
                    @foreach ($models as $key => $model)
                        @if ($model->client)
                            <div style="width: auto;" class="jkMiniData mb-1 hideData">
                                <input type="hidden" class="hiddenData"
                                    value="{{ !empty($model->client) ? $model->client->last_name . ' ' . $model->client->first_name . ' ' . $model->client->middle_name : '' }} {{ $model->agreement_number ?? '' }} {{ number_format($model->price_sell, 2) }} {{ $model->installmentPlan->period ?? 0 }} ">
                                <div class='d-flex'>
                                    <a href="{{ route('forthebuilder.installment-plan.show', $model->id) }}" class="checkboxDivInput checkingInputRassrochkaChecked">
                                        <input class="checkBoxInput sub_chk" type="checkbox" data-id="{{ $model->id }}">
                                    </a>
                                    <a href="{{ route('forthebuilder.installment-plan.show', $model->id) }}" class="checkboxDivInput checkingInputRassrochkaChecked">
                                        {{ $models->firstItem() + $key }}
                                    </a>
                                    <a href="{{ route('forthebuilder.installment-plan.show', $model->id) }}" class="bronyaFio">
                                        @if (!empty($model->client))
                                            {{ $model->client->last_name . ' ' . $model->client->first_name . ' ' . $model->client->middle_name }}
                                        @endif
                                    </a>
                                    <a href="{{ route('forthebuilder.installment-plan.show', $model->id) }}" class="checkboxDivTextInput2">
                                        {{ $model->agreement_number ?? '' }}
                                    </a>
                                    <a style="width: 9.3vw;" href="{{ route('forthebuilder.installment-plan.show', $model->id) }}" class="sdlekaPriceJk">
                                        {{ number_format($model->price_sell, 2) }}
                                    </a>
                                    <a style="width: 9.3vw;" href="{{ route('forthebuilder.installment-plan.show', $model->id) }}" class="rassrochkaPokazatStatus">
                                        {{ $model->installmentPlan->period ?? 0 }}
                                    </a>
                                    <a style="width: 9.3vw;" href="{{ route('forthebuilder.installment-plan.show', $model->id) }}" class="rassrochkaPokazatStatusGreen show-status" data-id="{{ $model->id }}"
                                        data-period="{{ (($model->installmentPlan) ?  $model->installmentPlan->period : '') }}"
                                        data-price="{{ $model->price_sell }}">
                                        {{ translate('Show status') }}
                                    </a>
                                    <div class="checkboxDivTextInput4">
                                        <a href="{{ route('forthebuilder.installment-plan.show', $model->id) }}" class="seaDiv">
                                            <img style="margin-top: 4px;" width="25" height="25"
                                                src="{{ asset('/backend-assets/forthebuilders/images/eye.png') }}" alt="Eye">
                                        </a>
                                        <a href="{{ route('forthebuilder.installment-plan.edit', $model->id) }}" class="seaDiv">
                                            <img class="mt-1" width="20" height="20"
                                                src="{{ asset('/backend-assets/forthebuilders/images/edit.png') }}" alt="Edit">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endempty

                <div class="aiz-pagination mt-2">
                    {{ $models->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        let page_name = 'installment-plan';
    </script>
@endsection
