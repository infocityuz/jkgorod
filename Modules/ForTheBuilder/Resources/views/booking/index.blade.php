@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ translate('leads') }}
@endsection

<style>
    .bronyaData {
        width: 86% !important;
    }

    .jkMiniData2,
    .jkMiniData {
        width: 98% !important;
    }
</style>

@php
    use Modules\ForTheBuilder\Entities\Clients;
    use Modules\ForTheBuilder\Entities\Constants;
    $list = [];
        foreach ($booking as $key => $model) {
            if ($client = Clients::where('id', $model->client_id)->where('status', Constants::CLIENT_ACTIVE)->first()) {
                // $client = Clients::where('id', $model->client_id)->first();
                // dd($model);
                $data = [
                    'id' => $model->id,
                    'full_name' => ($client) ? $client->first_name . ' ' . $client->last_name . ' ' . $client->middle_name : '',
                    'phone' => ($client) ? $client->phone : '',
                    'status' => $model->status,
                    'prepayment' => $model->prepayment,
                ];
                array_push($list, $data);
            }
        }
        $models=$list;
@endphp

@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            <div style="max-width: 1394px;">
                @include('forthebuilder::layouts.content.header')
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <h2 class="panelUprText">{{ translate('booking') }}</h2>
                </div>
                <div class="miniSearchDivaffloDour">
                    <ion-icon class="miniSearchIconInput" name="search-outline"></ion-icon>
                    <input placeholder="{{ translate('Search by booking') }}" class="miniInputSdelka5 searchTable"
                        type="text">
                </div>
            </div>
            <div class="bronyaData">
                <div class="jkMiniData2">
                    <a href="" class="d-flex">
                        <div class="checkboxDivInput">
                            <input class="checkBoxInput" type="checkbox">
                        </div>
                        <div class="checkboxDivInput">
                            №
                        </div>
                        <div class="bronyaFio" style="justify-content: center;">
                            {{-- Ф.И.О --}}
                            {{ translate('Full Name') }}
                        </div>
                        <div class="bronyaTelefon">
                            {{-- Телефон --}}
                            {{ translate('Phone') }}
                        </div>
                        <div class="checkboxDivTextInput3 srokDeystvieBronya">
                            {{-- Срок действия --}}
                            {{ translate('Palidity') }}
                        </div>
                        <div class="checkboxDivTextInput" style="width: 19vw;">
                            {{-- Предоплата --}}
                            {{ translate('Prepayment') }}
                        </div>
                    </a>
                    <div class="checkboxDivTextInput4 bronyaDeystvie">
                        {{-- Действиe --}}
                        {{ translate('Actions') }}
                    </div>
                </div>
                {{-- @dd($models) --}}
                @if (!empty($models))
                    @foreach ($models as $key => $model)
                        <div class="jkMiniData mb-1 hideData">
                            <input type="hidden" class="hiddenData"
                                value="{{ $model['full_name'] . ' ' . $model['phone'] }} {{ $model['status'] == 1 ? translate('Active') : translate('No active') }} {{ $model['prepayment'] }}">
                            <div class="d-flex">
                                <a href="{{ route('forthebuilder.booking.show', $model['id']) }}" class="checkboxDivInput">
                                    <input class="checkBoxInput sub_chk" data-id="{{ $model['id'] }}" type="checkbox">
                                </a>
                                <a href="{{ route('forthebuilder.booking.show', $model['id']) }}" class="checkboxDivInput">
                                    {{ $key + 1 }}
                                </a>
                                <a href="{{ route('forthebuilder.booking.show', $model['id']) }}" class="bronyaFio ">
                                    {{ $model['full_name'] }}
                                </a>
                                <a href="{{ route('forthebuilder.booking.show', $model['id']) }}" class="bronyaTelefon">
                                    {{ $model['phone'] }}
                                </a>
                                @if ($model['status'] == 1)
                                    <a href="{{ route('forthebuilder.booking.show', $model['id']) }}" class="bronyaActivniy text-info">
                                        {{ translate('Active') }}
                                    </a>
                                @else
                                    <a href="{{ route('forthebuilder.booking.show', $model['id']) }}" class="bronyaActivniy text-danger">
                                        {{ translate('No active') }}
                                    </a>
                                @endif
                                <a href="{{ route('forthebuilder.booking.show', $model['id']) }}" class="checkboxDivTextInput" style="width: 19vw;">
                                    {{ $model['prepayment'] }}
                                </a>
                            </div>
                            <div class="checkboxDivTextInput4">
                                <a href="{{ route('forthebuilder.booking.show', $model['id']) }}" class="seaDiv">
                                    <img style="margin-top: 4px;" width="25" height="25"
                                        src="{{ asset('/backend-assets/forthebuilders/images/eye.png') }}" alt="Eye">
                                </a>
                                <a href="{{ route('forthebuilder.booking.show', $model['id']) }}" class="seaDiv">
                                    <img class="mt-1" width="20" height="20"
                                        src="{{ asset('/backend-assets/forthebuilders/images/edit.png') }}" alt="Edit">
                                </a>
                                <a class="button seaDiv" style="cursor: pointer;">
                                    <input type="hidden" class="model_id" value="{{ $model['id'] }}">
                                    <img class="mt-1" data-toggle="modal" data-target="#exampleModalLong" class="mt-1"
                                        width="20" height="20"
                                        src="{{ asset('/backend-assets/forthebuilders/images/trash.png') }}"
                                        alt="Trash">
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif


                <div class="aiz-pagination mt-2">
                    {{-- @dd($models->links()->elements) --}}
                    {{ $booking->links() }}
                </div>

            </div>

        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;">
                <div class="modal-body">
                    <h2 class="modalVideystvitelno">{{ translate('Do you really want to delete') }}</h2>
                    <div class="d-flex justify-content-center mt-5">
                        <button class="modalVideystvitelnoDa" data-dismiss="modal">{{ translate('Yes') }}</button>
                        <button class="modalVideystvitelnoNet" data-dismiss="modal">{{ translate('No') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- @section('scripts') --}}


<script src="{{ asset('/backend-assets/forthebuilders/javascript/jquery.min.js') }}"></script>
<script>
    let page_name = 'booking';
    console.log(page_name)
    $(document).ready(function() {
        $('.modalVideystvitelnoDa').on('click', function() {
            // var model_id=document.getElementById("model_id").value;
            var model_id = $('.model_id').val();
            //    console.log(model_id);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "booking/destroy/" + model_id,
                type: 'DELETE',
                data: {
                    booking_id: model_id
                },
                success: function(response) {
                    console.log(response);
                    // location.reload();
                }
            });
        });
    });
</script>
