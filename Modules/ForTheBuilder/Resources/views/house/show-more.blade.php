@extends('forthebuilder::layouts.forthebuilder')
@php
    use Modules\ForTheBuilder\Entities\House;
@endphp
@section('title')
    {{ translate('JK') }}
@endsection
@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{ route('forthebuilder.house.index') }}" class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="{{ asset('backend-assets/forthebuilders/images/icons/arrow-left.png') }}" alt=""></a>
                    <h2 class="panelUprText">{{ $model->name }}</h2>
                    {{-- <button class="plus2">+</button> --}}
                </div>
            </div>

            <div class="d-flex justify-content-center" style="margin-bottom: 15px; margin-left: 130px;">
                <button class="vseButton btn-filter btn" data-filter="all">
                    {{ translate('All') }} ( {{ $arr['count_all'] }} )
                </button>
                {{-- (50 кв) --}}
                <button class="svobodnoButton btn-filter btn" style="background: {{ $colors[0] ?? '' }};" data-filter="0">
                    {{ translate('Free') }} ( {{ $arr['count_free'] }} )
                </button>
                {{-- (20 кв.) --}}
                <button class="zanyatoButton btn-filter btn" style="background: {{ $colors[1] ?? '' }};" data-filter="1">
                    {{ translate('Busy') }} ( {{ $arr['count_bookings'] }} )
                </button>
                {{-- (10 кв.) --}}
                <button class="prodnoButton btn-filter btn" style="background: {{ $colors[2] ?? '' }};" data-filter="2">
                    {{ translate('Sold') }} ( {{ $arr['count_solds'] }} )
                </button>
                {{-- (20 кв.) --}}
            </div>

            <div class="sozdatJkDaleData">
                <div class="d-flex">
                    <div class="dalePodyedzEtaj" style="margin: 55px 20px 0 0;">
                        @empty(!$arr['entrance_count'])
                            @foreach ($arr['entrance_count'] as $val_entrance_count)
                                {{-- <h2 class="etajNameNomerDale" style="height: 25px;">{{ $val_entrance_count }}</h2> --}}
                            @endforeach
                        @endempty
                    </div>

                    <div class="d-flex" style="overflow: scroll">
                        @empty(!$arr['list'])
                            @php
                                $n = 0;
                                $first = true;
                            @endphp
                            @foreach ($arr['list'] as $key => $val)
                                @php
                                    $n++;
                                    if ($status == 'client') {
                                        $house_details_url = e(url('forthebuilder/clients/client-show-details')) . '/' . $model->id . '/' . ($val['entrance'] ?? 0) . '/' . 0 . '/' . $client_id;
                                    } else {
                                        $house_details_url = e(url('forthebuilder/house/show-details')) . '/' . $model->id . '/' . ($val['entrance'] ?? 0) . '/' . 0;
                                    }
                                @endphp
                                <a href="{{ $house_details_url }}" style="display: inline; margin-bottom: 10px;">
                                    {{-- <a href="{{ e(url('forthebuilder/house/show-details')) . '/' . $model->id . '/' . ($val['entrance'] ?? '') . '/' . 0 }}"
                                style="display: inline;" class="col-md-3"> --}}
                                    <div class="dalePodyedzBig">
                                        <h2 class="podyedzNameDale">
                                            {{ translate('Entrance') . ' ' . ($val['entrance'] ?? '') }}
                                        </h2>
                                        
                                        @empty(!$arr['list'])
                                            @foreach ($val['list'] as $key2 => $val2)
                                                <div class="d-flex">
                                                    @if ($first)
                                                        <h2 class="etajNameNomerDale" style="width: 120px; margin-top: 10px;">{{ $key2 }}</h2>
                                                    @endif
                                                    @foreach ($val2 as $val3)
                                                        <div style="min-width: 60px; height: 60px;">
                                                            <div class="podyedzNameDaleNol padyedzNameJkSeeaGreen btn-filter-flat flat-button"
                                                                style="background-color: {{ $colors[$val3['color_status']] }};"
                                                                data-category="{{ $val3['color_status'] }}">
                                                                {{ $val3['room_count'] ?? 0 }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        @endempty
                                    </div>
                                </a>
                                @php
                                    $first = false;
                                @endphp
                            @endforeach
                        @endempty
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;">
                <div class="modal-body">
                    <h2 class="modalVideystvitelno">Вы действительно хотите удалить</h2>
                    <div class="d-flex justify-content-center mt-5">
                        <button class="modalVideystvitelnoDa" data-dismiss="modal">Да</button>
                        <button class="modalVideystvitelnoNet" data-dismiss="modal">Нет</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('forthebuilder::house.extra')
