@extends('forthebuilder::layouts.forthebuilder')
@php
    use Modules\ForTheBuilder\Entities\House;
    use Modules\ForTheBuilder\Entities\HouseFlat;
    use Modules\ForTheBuilder\Entities\Constants;
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
                    <h2 class="panelUprText">{{ translate('Add') }}</h2>
                </div>
            </div>

            <div class="sozdatSpisokData">
                {{-- <form id="modal-form" action="{{ route('forthebuilder.booking.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf --}}
                <form action="{{ route('forthebuilder.house-flat.update', $model->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div style="width: 100%;" class="d-flex">
                        <div class="lidiMarginRight1272">
                            <div class="sozdatImyaSpsok">
                                @if (is_int($model->room_count))
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Apartment number') }}</h3>
                                @elseif ($model->room_count == 'p')
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Parking number') }}</h3>
                                @else
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Commercial number') }}</h3>
                                @endif
                                <input
                                    class="sozdatImyaSpisokInput1272 @error('number_of_flat') error-data-input is-invalid @enderror"
                                    type="text" value="{{ $model->number_of_flat }}" name="number_of_flat">
                                <span class="error-data">
                                    @error('number_of_flat')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('Entrance') }}</h3>
                                <select
                                    class="form-control sozdatImyaSpisokSelectOption1272 @error('entrance') error-data-input is-invalid @enderror"
                                    id="exampleFormControlSelect1" name="entrance">
                                    @empty(!$model->house)
                                        @for ($i = 1; $i <= $model->house->entrance_count; $i++)
                                            @php
                                                $selectedI = '';
                                                if ($i == $model->entrance) {
                                                    $selectedI = 'selected';
                                                }
                                            @endphp
                                            <option value="{{ $i }}" {{ $selectedI }}>{{ $i }}
                                            </option>
                                        @endfor
                                    @endempty
                                </select>
                                <span class="error-data">
                                    @error('entrance')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('Floor') }}</h3>
                                <select
                                    class="form-control sozdatImyaSpisokSelectOption1272 @error('floor') error-data-input is-invalid @enderror"
                                    id="exampleFormControlSelect1" name="floor">
                                    @empty(!$model->house)
                                        @for ($j = 1; $j <= $model->house->floor_count; $j++)
                                            @php
                                                $selectedJ = '';
                                                if ($j == $model->floor) {
                                                    $selectedJ = 'selected';
                                                }
                                            @endphp
                                            <option value="{{ $j }}" {{ $selectedJ }}>{{ $j }}
                                            </option>
                                        @endfor
                                    @endempty
                                </select>
                                <span class="error-data">
                                    @error('floor')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            @php
                                $areas = json_decode($model->areas);
                            @endphp
                            <div class="sozdatImyaSpsok d-none">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('Living area m2') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInput1272 @error('area_housing') error-data-input is-invalid @enderror"
                                    type="text" value="{{ $areas->housing ?? 0 }}" name="area_housing">
                                <span class="error-data">
                                    @error('area_housing')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            @if (is_int($model->room_count))
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Hotel area m2') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('area_hotel') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $areas->hotel ?? 0}}" name="area_hotel">
                                    <span class="error-data">
                                        @error('area_hotel')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endif

                            @if (is_int($model->room_count))
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Bedroom area m2') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('area_bedroom') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $areas->bedroom ?? 0}}" name="area_bedroom">
                                    <span class="error-data">
                                        @error('area_bedroom')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endif

                            @if ($areas->basement > 0)
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Area (Ground) m2') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('area_basement') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $areas->basement }}" name="area_basement">
                                    <span class="error-data">
                                        @error('area_basement')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endif

                            @if ($areas->terraca > 0)
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Area (Terrace) m2') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('area_terraca') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $areas->terraca }}" name="area_terraca">
                                    <span class="error-data">
                                        @error('area_terraca')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endif

                            @if ($areas->attic > 0)
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Area (Attic) m2') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('area_attic') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $areas->attic }}" name="area_attic">
                                    <span class="error-data">
                                        @error('area_attic')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endif

                            @if ($areas->balcony > 0)
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Balcony m2') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('area_balcony') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $areas->balcony }}" name="area_balcony">
                                    <span class="error-data">
                                        @error('area_balcony')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endif

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('Total area m2') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInput1272 @error('area_total') error-data-input is-invalid @enderror"
                                    type="text" value="{{ $areas->total }}" name="area_total">
                                <span class="error-data">
                                    @error('area_total')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div>
                            {{-- <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('PINFL or TIN') }}</h3>
                                <input class="sozdatImyaSpisokInput1272" type="text" value="{{ $areas->total }}">
                            </div> --}}

                            <div class="sozdatImyaSpsok">
                                @if (is_int($model->room_count))
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Registry number') }}</h3>
                                @elseif ($model->room_count == 'p')
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Registry parking number') }}</h3>
                                @else
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Registry commercial number') }}</h3>
                                @endif
                                <input
                                    class="sozdatImyaSpisokInput1272 @error('doc_number') error-data-input is-invalid @enderror"
                                    type="text" value="{{ $model->doc_number ?? $model->number_of_flat }}"
                                    name="doc_number" readonly>
                                <span class="error-data">
                                    @error('doc_number')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            @php
                                $ares_price = json_decode($model->ares_price);
                            @endphp
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInput1272 @error('price') error-data-input is-invalid @enderror"
                                    type="text" name="price" value="{{ $ares_price->hundred->total ?? 0.0 }}">
                                <span class="error-data">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (30%)') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInput1272 @error('price_30') error-data-input is-invalid @enderror"
                                    type="text" value="{{ $ares_price->thirty->total ?? 0.0 }}" name="price_30">
                                <span class="error-data">
                                    @error('price_30')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (50%)') }}</h3>
                                <input
                                    class="sozdatImyaSpisokInput1272 @error('price_50') error-data-input is-invalid @enderror"
                                    type="text" value="{{ $ares_price->fifty->total ?? 0.0 }}" name="price_50">
                                <span class="error-data">
                                    @error('price_50')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            @if ($areas->basement > 0)
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (Ground)') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('price_basement') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $ares_price->hundred->basement ?? 0.0 }}"
                                        name="price_basement">
                                    <span class="error-data">
                                        @error('price_basement')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (Ground 30%)') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('price_basement_30') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $ares_price->thirty->basement ?? 0.0 }}"
                                        name="price_basement_30">
                                    <span class="error-data">
                                        @error('price_basement_30')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (Ground 50%)') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('price_basement_50') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $ares_price->fifty->basement ?? 0.0 }}"
                                        name="price_basement_50">
                                    <span class="error-data">
                                        @error('price_basement_50')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endif

                            @if ($areas->attic > 0)
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (Attic)') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('price_attic') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $ares_price->hundred->attic ?? 0.0 }}"
                                        name="price_attic">
                                    <span class="error-data">
                                        @error('price_attic')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (Attic 30%)') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('price_attic_30') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $ares_price->thirty->attic ?? 0.0 }}"
                                        name="price_attic_30">
                                    <span class="error-data">
                                        @error('price_attic_30')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (Attic 50%)') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('price_attic_50') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $ares_price->fifty->attic ?? 0.0 }}"
                                        name="price_attic_50">
                                    <span class="error-data">
                                        @error('price_attic_50')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endif

                            @if ($areas->terraca > 0)
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (Terrace)') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('price_terrace') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $ares_price->hundred->terraca ?? 0.0 }}"
                                        name="price_terrace">
                                    <span class="error-data">
                                        @error('price_terrace')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (Terrace 30%)') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('price_terrace_30') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $ares_price->thirty->terraca ?? 0.0 }}"
                                        name="price_terrace_30">
                                    <span class="error-data">
                                        @error('price_terrace_30')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3">{{ translate('Price for 1m2 (Terrace 50%)') }}</h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 @error('price_terrace_50') error-data-input is-invalid @enderror"
                                        type="text" value="{{ $ares_price->fifty->terraca ?? 0.0 }}"
                                        name="price_terrace_50">
                                    <span class="error-data">
                                        @error('price_terrace_50')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- <button type="submit"
                        class="">{{ translate('Attach file') }}</button> --}}
                    @if (is_int($model->room_count))
                        <input type="file" class="sozdatImyaSpisokSozdatButton1272" id="" name="files">
                        {{-- @dd($model->files); --}}
                        @if (!empty($model->files))
                            @foreach ($model->files as $img)
                                {{-- @dd($model); --}}
                                <img width="30" height="30" class="madlImageJkEdit"
                                    src="{{ asset('/uploads/house-flat/' . $model->house_id . '/m_' . $img->guid) }}"
                                    alt="Home">
                            @endforeach
                        @endif
                    @endif
                    {{-- <div>
                        <div class="seaDiv1272">
                            <img width="30" height="30"
                                src="{{ asset('backend-assets/forthebuilders/images/trash.png') }}" alt="Trash">
                        </div>
                        <img class="homeSozdatImage"
                            src="{{ asset('backend-assets/forthebuilders/images/m_b36a3adc8277086c6618f837ba24a5ce 1.png') }}"
                            alt="House">
                    </div> --}}
                    <button type="submit" class="sozdatImyaSpisokSozdatButton1272sozdat"
                        style="cursor: pointer;">{{ translate('Create') }}</button>
                </form>
            </div>


        </div>
    </div>
    <script>
        let page_name = 'house-flat';
    </script>
@endsection
{{-- @extends('forthebuilder::house.extra') --}}
