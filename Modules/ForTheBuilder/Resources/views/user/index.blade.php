@section('title')
    {{ __('locale.apartment_sale') }}
@endsection
@extends('forthebuilder::layouts.forthebuilder')

@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <h2 class="panelUprText">{{ translate('Users') }}</h2>
                    <a href="{{ route('forthebuilder.user.create') }}" class="plus2">+</a>
                </div>
                <div class="miniSearchDiv7Polzovatel">
                    <ion-icon class="miniSearchIconInput" name="search-outline"></ion-icon>
                    <input placeholder="{{ translate('Search by users') }}" class="miniInputSdelka6 searchTable"
                        type="text">
                </div>
            </div>

            <div class="polzovatelData">
                <div style="width: auto;" class="jkMiniData2">
                    <div class="checkboxDivInput">
                        <input class="checkBoxInput" type="checkbox" id="master">
                    </div>
                    <div class="checkboxDivInput">
                        №
                    </div>
                    <div class="polzovatelFioElectronieAddres">
                        {{ translate('Full name') }}
                    </div>
                    <div class="polzovatelFioElectronieAddres">
                        {{ translate('Email address') }}
                    </div>
                    <div class="pozovatelFoto">
                        {{ translate('Photo') }}
                    </div>
                    <div class="checkboxDivTextInput4 polzovatelDeystvieMax">
                        {{ translate('Action') }}
                    </div>
                </div>
                @if (!empty($models))
                    @foreach ($models as $key => $model)
                        <div style="width: auto;" class="polzovatelMiniData hideData">
                            <input type="hidden" class="hiddenData"
                                value="{{ $model->first_name . ' ' }} {{ $model->last_name }} <br> {{ $model->middle_name }} {{ $model->email }}">
                            <div class="d-flex">
                                <a href="{{ route('forthebuilder.user.show', $model->id) }}" class="polzovatelNumber">
                                    <input class="checkBoxInput sub_chk" type="checkbox" data-id="{{ $model->id }}">
                                </a>
                                <a href="{{ route('forthebuilder.user.show', $model->id) }}" class="polzovatelNumber">
                                    {{ $models->firstItem() + $key }}
                                </a>
                                <a href="{{ route('forthebuilder.user.show', $model->id) }}" class="polzovatelFioElectronieAddres2">
                                    {{ $model->first_name . ' ' }} {{ $model->last_name }} <br> {{ $model->middle_name }}
                                </a>
                                <a href="{{ route('forthebuilder.user.show', $model->id) }}" class="polzovatelFioElectronieAddres2">
                                    {{ $model->email }}
                                </a>
                                <a href="{{ route('forthebuilder.user.show', $model->id) }}" class="pozovatelFoto2">
                                    @php
                                        if(!empty($model->avatar)){
                                            $file_url = public_path('/uploads/user/' . $model->id . '/s_' . $model->avatar);
                                        }else{
                                            $file_url = "";
                                        }
                                    @endphp
                                    @if (file_exists($file_url))
                                        <img src="{{ asset('/uploads/user/' . $model->id . '/s_' . $model->avatar) }}"
                                            alt="HUman">
                                    @else
                                        <img src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}"
                                            alt="HUman">
                                    @endif
                                </a>
                                <div class="polzovatelEditImg">
                                    <a href="{{ route('forthebuilder.user.show', $model->id) }}" class="seaDiv" title="show"
                                        style="margin-right: 10px;">
                                        <img style="margin-top: 4px;" width="25" height="25"
                                            src="{{ asset('/backend-assets/forthebuilders/images/eye.png') }}" alt="Eye">
                                    </a>
                                    <a href="{{ route('forthebuilder.user.edit', $model->id) }}" class="seaDiv" title="update"
                                        style="margin-right: 10px;">
                                        <img class="mt-1" width="20" height="20"
                                            src="{{ asset('/backend-assets/forthebuilders/images/edit.png') }}" alt="Edit">
                                    </a>
                                    <form style="display: inline-block;"
                                        action="{{ route('forthebuilder.user.destroy', $model->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div style="margin-right: 10px;" type="submit" class="seaDiv" title="delete"><img
                                                class="mt-1" width="20" height="20"
                                                src="{{ asset('/backend-assets/forthebuilders/images/trash.png') }}"
                                                alt="Trash"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="aiz-pagination mt-4">
                    {{-- @dd($models->links()->elements) --}}
                    {{ $models->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        let page_name = 'user';
    </script>
@endsection
