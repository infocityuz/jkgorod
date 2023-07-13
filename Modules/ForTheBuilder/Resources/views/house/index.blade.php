@extends('forthebuilder::layouts.forthebuilder')
@php
    use Modules\ForTheBuilder\Entities\House;
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
                    <h2 class="panelUprText">{{ translate('JK') }}</h2>
                    @if(Auth::user()->role_id == Constants::SUPERADMIN)
                        <a href="{{ route('forthebuilder.house.create') }}" class="plus2">+</a>
                    @endif
                </div>
                <div class="miniSearchDiv5">
                    <ion-icon class="miniSearchIconInput md hydrated" name="search-outline" role="img"
                        aria-label="search outline"></ion-icon>
                    <input placeholder="{{ translate('Search by objects') }}" class="miniInputSdelka5 searchTable"
                        type="text">
                </div>
            </div>
            <div class="jkData">
                <div class="jkMiniData2" >
                    <div class="checkboxDivInput jkNumberInputChick">
                        <input class="checkBoxInput" type="checkbox">
                    </div>
                    <div class="checkboxDivInput jkNumberInputChick">
                        №
                    </div>
                    <div class="checkboxDivTextInput">
                        {{ translate('house_name') }}
                    </div>
                    <div class="checkboxDivTextInput2">
                        {{ translate('corpas') }}
                    </div>
                    <div class="checkboxDivTextInput">
                        {{ translate('info') }}
                    </div>
                    <div class="checkboxDivTextInput4 deystvieJkHome">
                        {{ translate('actions') }}
                    </div>
                </div>

                @if (!empty($models))
                    @foreach ($models as $key => $model)
                        <div class="jkMiniData mt-1 hideData" >
                            <input type="hidden" class="hiddenData"
                                value="{{ $model->name }} {{ $model->corpus }} {{ $model->description }}">
                            @php
                                if ($status == 'client') {
                                    $house_url = route('forthebuilder.client.houseFlat', [$model->id, $client_id]);
                                } else {
                                    $house_url = route('forthebuilder.house.show-more', $model->id);
                                }
                            @endphp
                            <div class="jkMiniData" >
                                <a href="{{ $house_url }}" class="checkboxDivInput jkNumberInputChick">
                                    <input class="checkBoxInput" type="checkbox">
                                </a>
                                <a href="{{ $house_url }}" class="checkboxDivInput jkNumberInputChick">
                                    {{ $models->firstItem() + $key }}
                                </a>
                                <a href="{{ $house_url }}" class="checkboxDivTextInput">
                                    {{ $model->name }}
                                </a>
                                <a href="{{ $house_url }}" class="checkboxDivTextInput2">
                                    @if (!empty($model->corpus))
                                        {{ $model->corpus }}
                                    @else
                                        -
                                    @endif
                                </a>
                                <a href="{{ $house_url }}" class="checkboxDivTextInput48">
                                    {{ $model->description }}
                                </a>
                                <div class="checkboxDivTextInput4 deystvieJkHome">
                                    <a href="{{ route('forthebuilder.house.show-more', $model->id) }}"
                                        class="seaDiv">
                                            <img style="margin-top: 4px;" width="25" height="25"
                                                src="{{ asset('backend-assets/forthebuilders/images/eye.png') }}"
                                                alt="Eye">
                                    </a>
                                    <a href="#" class="seaDiv deleteHouses" data-delete_url="{{ route('forthebuilder.house.destroy', $model->id ?? 0) }}">
                                        <img class="mt-1" width="20" height="20" data-toggle="modal"
                                            data-target="#exampleModalLong"
                                            src="{{ asset('backend-assets/forthebuilders/images/trash.png') }}"
                                            alt="Trash">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="aiz-pagination mt-4">
                    {{ $models->links() }}
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
                        <form style="display: inline-block;"
                            action="{{ route('forthebuilder.house.destroy', $model->id ?? 0) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="modalVideystvitelnoDa">{{ translate('Yes') }}</button>
                        </form>
                        <button class="modalVideystvitelnoNet" data-dismiss="modal">{{ translate('No') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let page_name = 'house';
    </script>
@endsection
