@extends('forthebuilder::layouts.forthebuilder')
{{-- @extends('forthebuilder::layouts.forthemodals') --}}
@php
    use Modules\ForTheBuilder\Entities\House;
@endphp
@section('title')
    {{ translate('JK') }}
@endsection
@section('content')
    <style>
        .file-preview {
            display: none !important;
        }
    </style>
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{ route('forthebuilder.house.index') }}" class="plus2 profileMaxNazadInformatsiyaKlient">
                        <img src="{{ asset('backend-assets/forthebuilders/images/icons/arrow-left.png') }}" alt="">
                    </a>
                    <h2 class="panelUprText">{{ $model->name }}</h2>
                    <!-- <button class="plus2">+</button> -->
                </div>
            </div>

            <div class="sozdatJkDaleData">
                <div class="d-flex">
                    {{-- <div class="dalePodyedzEtaj col-md-1" style="margin: 50px 20px 0 0;">
                        @empty(!$arr['entrance_count'])
                            @foreach ($arr['entrance_count'] as $val_entrance_count)
                                <h2 class="etajNameNomerDale">{{ $val_entrance_count }}</h2>
                            @endforeach
                        @endempty
                    </div> --}}

                    <div class="d-flex" style="overflow: scroll">
                        @empty(!$arr['list'])
                            @php
                                $n = 0;
                            @endphp
                            @foreach ($arr['list'] as $key => $val)
                                {{-- @if ($n % 3 == 0) --}}
                                    {{-- <div class="dalePodyedzEtaj col-md-1" style="margin: 50px 20px 0 0;">
                                        @empty(!$arr['entrance_count'])
                                            @foreach ($arr['entrance_count'] as $val_entrance_count)
                                                <h2 class="etajNameNomerDale">{{ $val_entrance_count }}</h2>
                                            @endforeach
                                        @endempty
                                    </div> --}}
                                {{-- @endif --}}
                                @php
                                    $n++;
                                @endphp
                                <div class="dalePodyedzBig">
                                    <h2 class="podyedzNameDale">{{ translate('Entrance') . ' ' . ($val['entrance'] ?? '') }}
                                    </h2>
                                    @empty(!$arr['list'])
                                        @foreach ($val['list'] as $key2 => $val2)
                                            <div class="d-flex hover-remove-add">
                                                <h2 class="etajNameNomerDale" style="min-width: 30px; margin-top: 10px;">{{ $key2 }}</h2>
                                                @foreach ($val2 as $val3)

                                                    @php
                                                        $class = 'btn btn-secondary apartments-button btn-flat';
                                                        $disabled = 0;
                                                        if ($val3['room_count']) {
                                                            $class = 'btn btn-success apartments-button btn-flat';
                                                            $disabled = 1;
                                                        }
                                                    @endphp
                                                    <div style="min-width: 60px; height: 50px;">
                                                        {{-- <a href="{{ e(url('forthebuilder/house/show-details')) . '/' . $model->id . '/' . $val['entrance'] . '/' . $val3['id'] }}" --}}

                                                        <button
                                                            class="podyedzNameDaleNol padyedzNameJkSeeaGreen btn-filter-flat flat-button {{ $class }}"
                                                            disabled data-id="{{ $val3['id'] }}" data-disabled="{{ $disabled }}"
                                                            data-category="{{ $val3['color_status'] }}"
                                                            data-def='0'>{{ $val3['room_count'] ?? 0 }}</button>
                                                    </div>
                                                @endforeach
                                                    <div class="floor-action d-none" style="min-width: 60px; height: 50px; margin-bottom: 10px">
                                                        <i class="fa fa-trash float-left bascket-float-remove"
                                                           data-house-id="{{ $model->id }}"
                                                           data-entrance="{{ $val['entrance'] }}" data-floor="{{ $key2 }}"
                                                           style="color: red; cursor: pointer;"></i>
                                                        &nbsp; &nbsp;
                                                        <i class="fa fa-plus bascket-float-add" data-house-id="{{ $model->id }}"
                                                           data-entrance="{{ $val['entrance'] }}" data-floor="{{ $key2 }}"
                                                           style="color: #007bff; cursor: pointer;"></i>

                                                        {{-- <i class="fa fa-compress bascket-float-marge"
                                                           data-house-id="{{ $model->id }}"
                                                           data-entrance="{{ $val['entrance'] }}" data-floor="{{ $key2 }}"
                                                           style="color: #28a745; cursor: pointer; margin-left: 5px;"></i> --}}

                                                    </div>
                                                    <div class="floor-marge-action d-none" style="min-width: 60px; height: 60px;">
                                                        <i class="fa fa-check save-bascket-float-marge"
                                                           data-house-id="{{ $model->id }}"
                                                           data-entrance="{{ $val['entrance'] }}" data-floor="{{ $key2 }}"
                                                           style="color: #28a745; cursor: pointer; margin-left: 5px;"></i>
                                                    </div>
                                            </div>
                                        @endforeach
                                    @endempty
                                </div>
                            @endforeach
                        @endempty
                    </div>
                </div>
                {{-- <center> --}}
                {{-- <button class="btn btn-primary room-count-button" data-number='1'>{{ translate('1 room') }}</button> --}}
                {{-- <button class="btn btn-primary room-count-button" data-number='2'>{{ translate('2 room') }}</button> --}}
                {{-- <button class="btn btn-primary room-count-button" data-number='3'>{{ translate('3 room') }}</button> --}}
                {{-- <button class="btn btn-primary room-count-button" data-number='4'>{{ translate('4 room') }}</button> --}}
                {{-- <button class="btn btn-primary room-count-button" data-number='5'>{{ translate('5 room') }}</button> --}}
                <div class="d-flex justify-content-center align-items-center">
                    <div class="d-flex">
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='1'
                            data-def='0'>{{ translate('1 room') }}</button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='2'
                            data-def='0'>{{ translate('2 room') }}</button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='3'
                            data-def='0'>{{ translate('3 room') }}</button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='4'
                            data-def='0'>{{ translate('4 room') }}</button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='5'
                            data-def='0'>{{ translate('5 room') }}</button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='c' 
                            data-def='0'>{{ translate('Commercial') }}</button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='p' 
                            data-def='0'>{{ translate('Parking') }}</button>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center mt-3">
                    <div class="d-flex">
                        <div class="podyedzNameDaleNol count-rooms">0</div>
                        <input placeholder="{{ translate('Apartments to description') }}" type="text"
                            class="KvartirKopisaniyu show-hidden-input">
                    </div>
                </div>

                {{-- <p>
                <button class="btn btn-secondary disabled count-rooms">0</button>
                <span class="show-hidden-input">{{ translate('Apartments to description') }}</span>
            </p> --}}
                {{-- </center> --}}
                @if ($show_next_button)
                    <input type="hidden" id="basket-id" value="{{ $basket_id }}">
                    <button type="submit" data-toggle="modal" data-target="#exampleModalNext"
                        class="sozdatImyaSpisokSozdatButtonSave attach-order btn">{{ translate('Next') }}</button>

                    {{-- <button class="btn btn-primary attach-order" data-toggle="modal"
                    data-target="#modal-default-free">{{ translate('Next') }}</button> --}}
                @else
                    <button type="submit" data-toggle="modal" data-target="#exampleModal"
                        class="sozdatImyaSpisokSozdatButtonSave save-flats btn" disabled>{{ translate('save') }}</button>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;background-color: #E8F0FF;width: 315px;margin-left: 185px;">
                <div class="modal-body">
                    <form action="{{ route('forthebuilder.house.update-flats-data') }}" method="POST"
                        enctype="multipart/form-data" id="chees-modal">
                        <div class="change_content">
                            <div class="mt-3">
                                <h3 class="sozdatJkSpisokH3722">{{ translate('Total area') }}</h3>
                                <input type="number" name="total_area" class="modalMiniCapsule4 text-left">
                            </div>

                            <div class="mt-3">
                                <h3 class="sozdatJkSpisokH3722">{{ translate('Living space') }}</h3>
                                <input type="number" name="living_space" class="modalMiniCapsule4 text-left">
                            </div>

                            <div class="mt-3">
                                <h3 class="sozdatJkSpisokH3722">{{ translate('Kitchen area') }}</h3>
                                <input type="number" name="kitchen_area" class="modalMiniCapsule4 text-left">
                            </div>

                            <div class="mt-3">
                                <h3 class="sozdatJkSpisokH3722">{{ translate('Terrace') }} <input type="checkbox"
                                        id="terassa"></h3>
                                <input type="number" placeholder="" name="terassa" class="modalMiniCapsule4 text-left"
                                    id="terassa_input" disabled>
                            </div>

                            <div class="mt-3">
                                <h3 class="sozdatJkSpisokH3722">{{ translate('Balcony') }} <input type="checkbox"
                                        id="balcony"></h3>
                                <input type="text" placeholder="" name="balcony" class="modalMiniCapsule4 text-left"
                                    id="balcony_input" disabled>
                            </div>
                        </div>

                        {{-- <div class="d-flex">
                        <button class="plusFlexModalInformation">+</button>
                        <h3 class="plusFlexModalInformationDobavitCvartir"> Добавить квартиру</h3>
                    </div> --}}
                        <label for="files">{{ __('locale.file__upload') }}</label>
                        <input type="file" name="files[]" id="files" multiple>

                        <input type="submit" value="{{ translate('Save') }}"
                            class="mdodalSaxranitSozdatJkDale float-right save-flats-form btn">
                        {{-- <a href="./jk.html" class="mdodalSaxranitSozdatJkDale">{{ translate('Save') }}</a> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalNext" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;background-color: #E8F0FF;width: 315px;margin-left: 185px;">
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <form action="">
        @csrf
    </form>
    <script>
        let page_name = 'house';
    </script>
@endsection

 @extends('forthebuilder::house.extra')
