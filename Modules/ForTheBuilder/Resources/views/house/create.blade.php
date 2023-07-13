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
                    <h2 class="panelUprText">{{ translate('Create a new JK') }}</h2>
                </div>
            </div>

            <div class="sozdatJkData">
                <form id="" action="{{ route('forthebuilder.house.new-basket-house') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Name of JK') }}</h3>
                        <input class="sozdatImyaSpisokInput @error('name') error-data-input is-invalid @enderror"
                            type="text" name="name" value="{{ old('name') }}">
                        <span class="error-data">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Corpas') }}</h3>
                        <input class="sozdatImyaSpisokKorpus @error('corpus') error-data-input is-invalid @enderror"
                            type="text" name="corpus" value="{{ old('corpus') }}">
                        <span class="error-data">
                            @error('corpus')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Object status') }}</h3>
                        <select
                            class="form-control sozdatImyaSpisokSelectOption2 @error('project_stage') errpr-data-input is-invalid @enderror"
                            id="exampleFormControlSelect1" name="project_stage">
                            <option value="{{ House::DESIGN }}">{{ translate('Design') }}</option>
                            <option value="{{ House::AT_THE_FOUNDATION_STAGE }}">
                                {{ translate('At the foundation stage') }}</option>
                            <option value="{{ House::AT_THE_PRE_SALE_STAGE }}">
                                {{ translate('At the pre-sale stage') }}</option>
                            <option value="{{ House::START_OF_OFFICIAL_SALES }}">
                                {{ translate('Start of official sales') }}</option>
                            <option value="{{ House::STATUS_COMPLATED }}">
                                {{ translate('Completed') }}</option>
                        </select>
                        <span class="error-data">
                            @error('project_stage')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Description of the object') }}</h3>
                        <input class="sozdatImyaSpisokInput @error('description') error-data-input is-invalid @enderror"
                            type="text" name="description" value="{{ old('description') }}">
                        <span class="error-data">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="sozdatJkFlex">
                        <div>
                            <div class="sozdatImyaSpsok widthSozdatJk2">
                                <h3 class="sozdatJkSpisokH3">{{ translate('Enterance count') }}</h3>
                                <input
                                    class="sozdatImyaSpisokKorpus houesCreateCalculateTotal @error('entrance_count') error-data-input is-invalid @enderror"
                                    type="number" value="{{ old('entrance_count') }}" name="entrance_count"
                                    id="entrance_count">
                                <span class="error-data">
                                    @error('entrance_count')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok widthSozdatJk">
                                <h3 class="sozdatJkSpisokH3">{{ translate('Floors') }}</h3>
                                <input
                                    class="sozdatImyaSpisokKorpus houesCreateCalculateTotal @error('floor_count') error-data-input is-invalid @enderror"
                                    type="number" name="floor_count" value="{{ old('floor_count') }}" id="floor_count">
                                <span class="error-data">
                                    @error('floor_count')
                                        {{ $message }}
                                    @enderror
                            </div>

                            {{-- <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatJkSpisokH3">{{ translate('Number of apartments in the entrance') }}
                                    </h3>
                                    <input class="sozdatImyaSpisokKorpus houesCreateCalculateTotal" type="text">
                                </div> --}}
                        </div>

                        <div>
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatJkSpisokH3">{{ translate('Number of apartments on one floor') }}</h3>
                                <input
                                    class="sozdatImyaSpisokKorpus houesCreateCalculateTotal marginRightSozdatJkKolichistva @error('entrance_one_floor_count') error-data-input is-invalid @enderror"
                                    type="number" name="entrance_one_floor_count"
                                    value="{{ old('entrance_one_floor_count') }}" id="entrance_one_floor_count">
                                <span class="error-data">
                                    @error('entrance_one_floor_count')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="sozdatImyaSpsok sozdatJkLast">
                                <h3 class="sozdatJkSpisokH3">{{ translate('Total apartments') }}</h3>
                                <input
                                    class="sozdatImyaSpisokKorpus @error('total_flat') error-data-input is-invalid @enderror"
                                    type="number" name="total_flat" value="{{ old('total_flat') }}" id="total_flat"
                                    readonly>
                                <span class="error-data">
                                    @error('total_flat')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div>
                                <label class="sozdatJkSpisokH3">
                                    {{ translate('Add basement') }}
                                    <input type="checkbox" name="has_basement"
                                        class="@error('has_basement') error-data-input is-invalid @enderror"
                                        {{ old('has_basement') ? 'checked="checked"' : '' }}>
                                </label>
                                <span class="error-data">
                                    @error('has_basement')
                                        {{ $message }}
                                    @enderror
                                </span>

                                <label class="sozdatJkSpisokH3">
                                    {{ translate('Add attic') }}
                                    <input type="checkbox" name="has_attic"
                                        class="@error('has_attic') error-data-input is-invalid @enderror"{{ old('has_attic') ? 'checked="checked"' : '' }}>
                                </label>
                                <span class="error-data">
                                    @error('has_attic')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="sozdatImyaSpisokSozdatButton"
                        style="cursor: pointer;">{{ translate('Further') }}</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        let page_name = 'house';
    </script>
@endsection
