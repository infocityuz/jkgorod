@extends('layouts.backend')
@section('title')
    {{ __('locale.create') }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('locale.object') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                        href="{{ route('backend.index', app()->getLocale()) }}">{{ __('locale.home') }}</a></li>
                            <li class="breadcrumb-item"><a
                                        href="{{ route('object.index', app()->getLocale()) }}">{{ __('locale.object') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('locale.create') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="student_form" action="{{ route('object.store', app()->getLocale()) }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="card-footer">
            <button type="submit" class="btn btn-success">{{ __('locale.create') }}</button>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                   aria-controls="nav-home" aria-selected="true">
                    {{ __('locale.total') }}
                </a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                   aria-controls="nav-profile" aria-selected="false">
                    {{ __('locale.add') }}
                </a>
                <a class="nav-item nav-link" id="nav-img-tab" data-toggle="tab" href="#nav-img" role="tab"
                   aria-controls="nav-img" aria-selected="false">
                    {{ __('locale.images') }}
                </a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                   aria-controls="nav-contact" aria-selected="false">
                    {{ __('locale.contacts_contract') }}
                </a>
                <a class="nav-item nav-link" id="nav-file-tab" data-toggle="tab" href="#nav-file" role="tab"
                   aria-controls="nav-file" aria-selected="false">
                    {{ __('locale.files') }}
                </a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="titleId">{{ __('locale.title') }}</label>
                                    <input type="text" name="title" id="titleId"
                                           class="form-control @error('title') error-data-input is-invalid @enderror"
                                           value="{{ old('title') }}" required>
                                    <span class="error-data">
                                        @error('title')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="object_category">{{ __('locale.object_category') }}</label>
                                    <select required name="category_id" id="object_category"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control select2  @error('object_category') is-invalid error-data-input @enderror">
                                        <option value="" multiple></option>
                                        @if (!empty($category))
                                            @foreach ($category as $value)
                                                @php
                                                    $selected = '';
                                                    if (old('category_id') == $value->id) {
                                                        $selected = 'selected';
                                                    }
                                                @endphp
                                                <option value="{{ $value->id }}" {{ $selected }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                        {{-- <option value="Поселок">Поселок</option>
                                        <option value="Бизнес Центр">Бизнес Центр</option>
                                        <option value="Жилой комплекс">БЦ</option> --}}

                                    </select>
                                    <span class="error-data">
                                        @error('object_category')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="object_parent_element">{{ __('locale.object_parent_element') }}</label>
                                    <select name="object_parent_element" id="object_parent_element"
                                        data-placeholder="{{ __('locale.select') }}"
                                        class="form-control select2 @error('object_parent_element') is-invalid error-data-input @enderror">
                                        @if (!empty($parent))
                                            <option value="" multiple></option>
                                            @foreach ($parent as $child)
                                                <option value="{{ $child->id }}">{{ $child->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="error-data">
                                        @error('object_parent_element')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label for="build_type">{{ __('locale.build_type') }}</label>
                                    @if (!empty($buildingTypes))
                                        <div class="row">
                                            @foreach ($buildingTypes as $buildingType)
                                                <div class="col-lg-3">
                                                    <div class="form-group clearfix mb-0">
                                                        <div class="icheck-primary d-flex align-items-center">
                                                            <input type="checkbox" name="build_type[]"
                                                                id="checkboxPrimary_{{ $buildingType->id }}"
                                                                value="{{ $buildingType->id }}">
                                                            <label for="checkboxPrimary_{{ $buildingType->id }}"
                                                                class="mb-0 checkbox-label-style">
                                                                {{ $buildingType->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <span class="error-data">
                                        @error('build_type')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div> --}}

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <p class="input-title-p">{{ __('locale.currency') }}</p>
                                        <div class="custom-control custom-radio d-flex">
                                            <div style="margin-right: 50px">
                                                <input class="custom-control-input" name="currency" type="radio"
                                                       id="uzsId" value="1" checked>
                                                <label for="uzsId"
                                                       class="custom-control-label">{{ __('locale.uzs') }}</label>
                                            </div>
                                            <div>
                                                <input class="custom-control-input" type="radio" name="currency"
                                                       id="usdId" value="2">
                                                <label for="usdId"
                                                       class="custom-control-label">{{ __('locale.usd') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="priceId">{{ __('locale.price') }}</label>
                                        <input type="number" name="price" id="priceId"
                                               class="form-control @error('price') error-data-input is-invalid @enderror"
                                               value="{{ old('price') }}" required>
                                        <span class="error-data">
                                            @error('price')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="service_fee">{{ __('locale.service_fee') }}</label>
                                    <input type="number" name="service_fee" id="service_fee"
                                           class="form-control @error('service_fee') error-data-input is-invalid @enderror"
                                           value="{{ old('service_fee') }}" required>
                                    <span class="error-data">
                                        @error('service_fee')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-radio d-flex">
                                        <div style="margin-right: 50px">
                                            <input class="custom-control-input" name="site" type="checkbox"
                                                   id="site" value="1">
                                            <label for="site"
                                                   class="custom-control-label">{{ __('locale.site') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descriptionId">{{ __('locale.comment') }}</label>
                                    <textarea id="descriptionId" name="description"
                                              class="form-control @error('description') error-data-input is-invalid @enderror"
                                              style="height: 85px; width: 100%">{{ old('description') }}</textarea>
                                    <span class="error-data">
                                        @error('description')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="addressId">{{ __('locale.address') }}</label>
                                    <input type="text" name="address" id="addressId"
                                           class="form-control @error('address') error-data-input is-invalid @enderror"
                                           value="{{ old('address') }}" required>
                                    <span class="error-data">
                                        @error('address')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="object_region_id">{{ __('locale.Region') }}</label>
                                    <select name="region_id" id="object_security"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('object_security') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        @if (!empty($region))
                                            @foreach ($region as $val)
                                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    {{-- <label for="object_region_id">{{ __('locale.Region') }}</label>
                                    <input type="text" name="region" id="object_region_id"
                                        data-placeholder="{{ __('locale.select') }}"
                                        class="form-control select2 @error('object_region_id') is-invalid error-data-input @enderror" value="{{ old('object_region_id') }}"> --}}
                                    <span class="error-data">
                                        @error('region_id')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="district_id">{{ __('locale.Town') }}</label>
                                    <select name="town_id" id="district_id" data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('district_id') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        {{-- @if (!empty($town))
                                            @foreach ($town as $val)
                                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                                            @endforeach
                                        @endif --}}
                                    </select>
                                    {{-- <input type="text" name="town" id="district_id"
                                        data-placeholder="{{ __('locale.select') }}"
                                        class="form-control select2 @error('district_id') is-invalid error-data-input @enderror"
                                        value="{{ old('district_id') }}"> --}}
                                    <span class="error-data">
                                        @error('district_id')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="area_id">{{ __('locale.Area') }}</label>
                                    <select name="area_id" id="area_id" data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('area_id') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        {{-- @if (!empty($area))
                                            @foreach ($area as $val)
                                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                                            @endforeach
                                        @endif --}}
                                    </select>
                                    {{-- <input type="text" name="area" id="areaId"
                                        class="form-control select2 @error('area_id') is-invalid error-data-input @enderror"
                                        data-placeholder="{{ __('locale.select') }}" value="{{ old('area') }}"> --}}
                                    <span class="error-data">
                                        @error('area_id')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="street_id">{{ __('locale.street_id') }}</label>
                                    <input type="text" name="street" id="street_id"
                                           data-placeholder="{{ __('locale.select') }}"
                                           class="form-control select2 @error('street_id') is-invalid error-data-input @enderror"
                                           value="{{ old('street_id') }}">
                                    <span class="error-data">
                                        @error('street_id')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="house_number">{{ __('locale.House') }}</label>
                                    <input type="text" name="house_number" id="house_number"
                                           class="form-control @error('house_number') error-data-input is-invalid @enderror"
                                           value="{{ old('house_number') }}" required>
                                    <span class="error-data">
                                        @error('house_number')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="card card-primary category__elements">
                            <div class="card-body">
                                <div class="form-group cat_0 cat_1">
                                    <label for="village_name">{{ __('locale.village_name') }}</label>
                                    <input type="text" name="village_name" id="village_name"
                                           class="form-control @error('village_name') error-data-input is-invalid @enderror"
                                           value="{{ old('village_name') }}">
                                    <span class="error-data">
                                        @error('village_name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0 cat_1 cat_2">
                                    <label for="build_year">{{ __('locale.build_year') }}</label>
                                    <input type="text" name="build_year" id="build_year"
                                           class="form-control @error('build_year') error-data-input is-invalid @enderror"
                                           value="{{ old('build_year') }}">
                                    <span class="error-data">
                                        @error('build_year')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0 cat_1">
                                    <label for="object_security">{{ __('locale.object_security') }}</label>
                                    <select name="object_security" id="object_security"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('object_security') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="Нет">Нет</option>
                                        <option value="Есть">Есть</option>
                                    </select>
                                    <span class="error-data">
                                        @error('object_security')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0">
                                    <label for="house_count">{{ __('locale.house_count') }}</label>
                                    <input type="number" name="house_count" id="house_count"
                                           class="form-control @error('house_count') error-data-input is-invalid @enderror"
                                           value="{{ old('house_count') }}">
                                    <span class="error-data">
                                        @error('house_count')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0">
                                    <label for="work_type">{{ __('locale.work_type') }}</label>
                                    <select name="work_type" id="work_type" data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('work_type') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="work_type">круглосуточный</option>
                                        <option value="сдан в эксплуатацию">сдан в эксплуатацию</option>
                                        <option value="рабочий">рабочий</option>
                                    </select>
                                    <span class="error-data">
                                        @error('work_type')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0">
                                    <label for="cost_of_legal_address">{{ __('locale.cost_of_legal_address') }}</label>
                                    <input type="number" name="cost_of_legal_address" id="cost_of_legal_address"
                                           class="form-control @error('cost_of_legal_address') error-data-input is-invalid @enderror"
                                           value="{{ old('cost_of_legal_address') }}">
                                    <span class="error-data">
                                        @error('cost_of_legal_address')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0 cat_1 cat_2">
                                    <label for="repair">{{ __('locale.repair') }}</label>
                                    <select name="repair" id="repair" data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('repair') is-invalid error-data-input @enderror">

                                        <option value="">------</option>
                                        <option value="Предчистовая Отделка">Предчистовая Отделка</option>
                                        <option value="Черновая Отделка">Черновая Отделка</option>
                                        <option value="Требуется Ремонт">Черновая Отделка</option>
                                        <option value="Средний Ремонт">Средний Ремонт</option>
                                        <option value="ЕвроРемонт">ЕвроРемонт</option>
                                        <option value="Авторский Проект">Авторский Проект</option>

                                    </select>
                                    <span class="error-data">
                                        @error('repair')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0 cat_2 cat_3">
                                    <label for="building_section">{{ __('locale.building_section') }}</label>
                                    <input type="text" name="building_section" id="building_section"
                                           class="form-control @error('building_section') error-data-input is-invalid @enderror"
                                           value="{{ old('building_section') }}">
                                    <span class="error-data">
                                        @error('building_section')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0 cat_2 cat_3">
                                    <label for="building_state">{{ __('locale.building_state') }}</label>
                                    <select name="building_state" id="building_state"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('building_state') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="дом построен, но не сдан">дом построен, но не сдан</option>
                                        <option value="сдан в эксплуатацию">сдан в эксплуатацию</option>
                                        <option value="строится">строится</option>
                                    </select>
                                    <span class="error-data">
                                        @error('building_state')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0">
                                    <label for="ready_quarter">{{ __('locale.ready_quarter') }}</label>
                                    <select name="ready_quarter" id="ready_quarter"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('ready_quarter') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    <span class="error-data">
                                        @error('ready_quarter')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0 cat_1 cat_3">
                                    <label for="floor">{{ __('locale.floor') }}</label>
                                    <input type="number" name="floor" id="floor"
                                           class="form-control @error('floor') error-data-input is-invalid @enderror"
                                           value="{{ old('floor') }}">
                                    <span class="error-data">
                                        @error('floor')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0 cat_1 cat_2">
                                    <label for="floor_count">{{ __('locale.floor_count') }}</label>
                                    <input type="number" name="floor_count" id="floor_count"
                                           class="form-control @error('floor_count') error-data-input is-invalid @enderror"
                                           value="{{ old('floor_count') }}">
                                    <span class="error-data">
                                        @error('floor_count')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_0">
                                    <label for="material">{{ __('locale.material') }}</label>
                                    <select name="material" id="material" data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('material') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="Кирпич">Кирпич</option>
                                        <option value="Брус">Брус</option>
                                        <option value="Бревно">Бревно</option>
                                        <option value="Сэндвич-панели">Сэндвич-панели</option>
                                        <option value="Ж/б панели">Ж/б панели</option>
                                        <option value="Панельный">Панельный</option>
                                        <option value="Блочный">Блочный</option>
                                        <option value="Монолитный">Монолитный</option>
                                        <option value="Металл">Металл</option>
                                        <option value="Экспериментальные материалы">Экспериментальные материалы</option>
                                    </select>
                                    <span class="error-data">
                                        @error('material')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_0 cat_2">
                                    <label for="ceiling_height">{{ __('locale.ceiling_height') }}</label>
                                    <input type="number" name="ceiling_height" id="ceiling_height"
                                           class="form-control @error('ceiling_height') error-data-input is-invalid @enderror"
                                           value="{{ old('ceiling_height') }}">
                                    <span class="error-data">
                                        @error('ceiling_height')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_1">
                                    <label for="village_lastname">{{ __('locale.village_lastname') }}</label>
                                    <input type="text" name="village_lastname" id="village_lastname"
                                           class="form-control @error('village_lastname') error-data-input is-invalid @enderror"
                                           value="{{ old('village_lastname') }}">
                                    <span class="error-data">
                                        @error('village_lastname')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_1 cat_2 cat_3">
                                    <label for="build_area">{{ __('locale.build_area') }}</label>
                                    <input type="number" name="build_area" id="build_area"
                                           class="form-control @error('build_area') error-data-input is-invalid @enderror"
                                           value="{{ old('build_area') }}">
                                    <span class="error-data">
                                        @error('build_area')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_1">
                                    <label for="house_area_min">{{ __('locale.house_area_min') }}</label>
                                    <input type="number" name="house_area_min" id="house_area_min"
                                           class="form-control @error('house_area_min') error-data-input is-invalid @enderror"
                                           value="{{ old('house_area_min') }}">
                                    <span class="error-data">
                                        @error('house_area_min')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_1">
                                    <label for="house_area_max">{{ __('locale.house_area_max') }}</label>
                                    <input type="number" name="house_area_max" id="house_area_max"
                                           class="form-control @error('house_area_max') error-data-input is-invalid @enderror"
                                           value="{{ old('house_area_max') }}">
                                    <span class="error-data">
                                        @error('house_area_max')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_1">
                                    <label for="yard_count">{{ __('locale.yard_count') }}</label>
                                    <input type="number" name="yard_count" id="yard_count"
                                           class="form-control @error('yard_count') error-data-input is-invalid @enderror"
                                           value="{{ old('yard_count') }}">
                                    <span class="error-data">
                                        @error('yard_count')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_1">
                                    <label for="yard_area_min">{{ __('locale.yard_area_min') }}</label>
                                    <input type="number" name="yard_area_min" id="yard_area_min"
                                           class="form-control @error('yard_area_min') error-data-input is-invalid @enderror"
                                           value="{{ old('yard_area_min') }}">
                                    <span class="error-data">
                                        @error('yard_area_min')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_1">
                                    <label for="yard_area_max">{{ __('locale.yard_area_max') }}</label>
                                    <input type="number" name="yard_area_max" id="yard_area_max"
                                           class="form-control @error('yard_area_max') error-data-input is-invalid @enderror"
                                           value="{{ old('yard_area_max') }}">
                                    <span class="error-data">
                                        @error('yard_area_max')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_1 cat_2">
                                    <label
                                            for="external_infrastructure">{{ __('locale.external_infrastructure') }}</label>
                                    <input type="text" name="external_infrastructure" id="external_infrastructure"
                                           class="form-control @error('external_infrastructure') error-data-input is-invalid @enderror"
                                           value="{{ old('external_infrastructure') }}">
                                    <span class="error-data">
                                        @error('external_infrastructure')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_1 cat_2">
                                    <label
                                            for="internal_infrastructure">{{ __('locale.internal_infrastructure') }}</label>
                                    <input type="text" name="internal_infrastructure" id="internal_infrastructure"
                                           class="form-control @error('internal_infrastructure') error-data-input is-invalid @enderror"
                                           value="{{ old('internal_infrastructure') }}">
                                    <span class="error-data">
                                        @error('internal_infrastructure')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_2 cat_3">
                                    <label for="building_class">{{ __('locale.building_class') }}</label>
                                    <select name="building_class" id="building_class"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('building_class') is-invalid error-data-input @enderror">
                                        <option value="">------</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                    <span class="error-data">
                                        @error('building_class')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_3">
                                    <label for="building_name">{{ __('locale.building_name') }}</label>
                                    <input type="text" name="building_name" id="building_name"
                                           class="form-control @error('building_name') error-data-input is-invalid @enderror"
                                           value="{{ old('building_name') }}">
                                    <span class="error-data">
                                        @error('building_name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_3">
                                    <label for="legal_address">{{ __('locale.legal_address') }}</label>
                                    <select name="legal_address" id="legal_address"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('legal_address') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="предоставляется">предоставляется</option>
                                        <option value="не предоставляется">не предоставляется</option>
                                    </select>
                                    <span class="error-data">
                                        @error('legal_address')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group cat_3">
                                    <label for="access">{{ __('locale.access') }}</label>
                                    <select name="access" id="access" data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('access') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="свободный">свободный</option>
                                        <option value="по пропускам">по пропускам</option>
                                        <option value="электронный к/д">электронный к/д</option>
                                    </select>
                                    <span class="error-data">
                                        @error('access')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_3">
                                    <label for="parking">{{ __('locale.parking') }}</label>
                                    <select name="parking" id="parking" data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('parking') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="платная">платная</option>
                                        <option value="бесплатная">бесплатная</option>
                                        <option value="охраняемая">охраняемая</option>
                                        <option value="наземная">наземная</option>
                                        <option value="подземная">подземная</option>
                                        <option value="хаотичная">хаотичная</option>
                                    </select>
                                    <span class="error-data">
                                        @error('parking')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_3">
                                    <label for="parking_price">{{ __('locale.parking_price') }}</label>
                                    <input type="number" name="parking_price" id="parking_price"
                                           class="form-control @error('parking_price') error-data-input is-invalid @enderror"
                                           value="{{ old('parking_price') }}">
                                    <span class="error-data">
                                        @error('parking_price')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_3">
                                    <label for="internet">{{ __('locale.internet') }}</label>
                                    <select name="internet" id="internet" data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('internet') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="Нет">Нет</option>
                                        <option value="Есть">Есть</option>
                                    </select>
                                    <span class="error-data">
                                        @error('internet')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_3">
                                    <label for="internet_type">{{ __('locale.internet_type') }}</label>
                                    <input type="text" name="internet_type" id="internet_type"
                                           class="form-control @error('internet_type') error-data-input is-invalid @enderror"
                                           value="{{ old('internet_type') }}">
                                    <span class="error-data">
                                        @error('internet_type')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_3">
                                    <label for="work_plan">{{ __('locale.work_plan') }}</label>
                                    <select name="work_plan" id="work_plan"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control @error('work_plan') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="круглосуточный">круглосуточный</option>
                                        <option value="рабочий">рабочий</option>
                                    </select>
                                    <span class="error-data">
                                        @error('work_plan')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_3">
                                    <label for="lift">{{ __('locale.lift') }}</label>
                                    <select name="lift" id="lift" data-placeholder="{{ __('locale.select') }}"
                                            class="form-control select2 @error('lift') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="Нет">Нет</option>
                                        <option value="Есть">Есть</option>
                                    </select>
                                    <span class="error-data">
                                        @error('lift')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group cat_3">
                                    <label for="lift_person_count">{{ __('locale.lift_person_count') }}</label>
                                    <input type="number" name="lift_person_count" id="internet_type"
                                           class="form-control @error('lift_person_count') error-data-input is-invalid @enderror"
                                           value="{{ old('lift_person_count') }}">
                                    <span class="error-data">
                                        @error('lift_person_count')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="ads">{{ __('locale.ads') }}</label>
                                    <textarea id="ads" name="ads" class="form-control @error('ads') error-data-input is-invalid @enderror"
                                              style="height: 125px; width: 100%">{{ old('ads') }}</textarea>
                                    <span class="error-data">
                                        @error('ads')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="body">{{ __('locale.body') }}</label>
                                    <textarea id="body" name="body" class="form-control @error('body') error-data-input is-invalid @enderror"
                                        style="height: 125px; width: 100%">{{ old('body') }}</textarea>
                                    <span class="error-data">
                                        @error('body')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-img" role="tabpanel" aria-labelledby="nav-img-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group ">
                            <label for="images">{{ __('locale.image') }}</label>
                            <input type="file" name="images[]" id="images" multiple>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="phone__number">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="phone_number">{{ __('locale.phone_number') }}</label>
                                            <div class="number_block">
                                                {{--                                            <span class="flag"><img src="/backend-assets/img/flag.webp" alt="" ></span> --}}
                                                <input type="text" name="phone_code" value=" + 9 9 8" readonly>
                                                <input type="tel" name="phone_number" id="phone_number"
                                                       class="form-control object_number @error('phone_number') error-data-input is-invalid @enderror"
                                                       value="{{ old('phone_number') }}">
                                            </div>

                                            <span class="error-data">
                                                @error('phone_number')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                            <p class="result"></p>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label
                                                    for="additional_phone">{{ __('locale.additional_phone_number') }}</label>
                                            <div class="number_block">
                                                {{--                                            <span class="flag"><img src="/backend-assets/img/flag.webp" alt="" ></span> --}}
                                                <input type="text" name="additional_phone_code" value=" + 9 9 8"
                                                       readonly>
                                                <input type="tel" name="additional_phone" id="additional_phone"
                                                       class="form-control object_number @error('additional_phone') error-data-input is-invalid @enderror"
                                                       value="{{ old('additional_phone') }}">
                                            </div>

                                            <span class="error-data">
                                                @error('additional_phone')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                            <p class="result"></p>
                                        </div>
                                        <div class="more__info-btn">
                                            <a href="#" disabled=""
                                               class="btn btn-default float-right">Создать</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="form-group user_contact">
                                    <label for="user_info">{{ __('locale.user_info') }}</label>
                                    <input type="text" name="user_info" id="user_info"
                                        class="form-control @error('user_info') error-data-input is-invalid @enderror"
                                        value="{{ old('user_info') }}">
                                    <span class="error-data">
                                        @error('user_info')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> --}}

                                <div class="form-group user_contact">
                                    <label for="last_name">{{ __('locale.last_name') }}</label>
                                    <input type="text" name="last_name" id="last_name"
                                           class="form-control @error('last_name') error-data-input is-invalid @enderror"
                                           value="{{ old('last_name') }}">
                                    <span class="error-data">
                                        @error('last_name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group user_contact">
                                    <label for="first_name">{{ __('locale.first_name') }}</label>
                                    <input type="text" name="first_name" id="first_name"
                                           class="form-control @error('first_name') error-data-input is-invalid @enderror"
                                           value="{{ old('first_name') }}">
                                    <span class="error-data">
                                        @error('first_name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group user_contact">
                                    <label for="username">{{ __('locale.patronymic') }}</label>
                                    <input type="text" name="surename" id="username"
                                           class="form-control @error('username') error-data-input is-invalid @enderror"
                                           value="{{ old('username') }}">
                                    <span class="error-data">
                                        @error('username')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group user_contact">
                                    <label for="email">{{ __('locale.email') }}</label>
                                    <input type="text" name="email" id="email"
                                           class="form-control @error('email') error-data-input is-invalid @enderror"
                                           value="{{ old('email') }}">
                                    <span class="error-data">
                                        @error('email')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group user_contact">
                                    <label for="more_info">{{ __('locale.more_info') }}</label>
                                    <textarea id="more_info" name="more_info"
                                              class="form-control @error('more_info') error-data-input is-invalid @enderror"
                                              style="height: 125px; width: 100%">{{ old('more_info') }}</textarea>
                                    <span class="error-data">
                                        @error('more_info')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                {{-- <div class="form-group user_contact">
                                    <label for="admin_id">{{ __('locale.admin_id') }}</label>
                                    <select name="admin_id" id="admin_id" data-placeholder="{{ __('locale.select') }}"
                                        class="form-control select2 @error('admin_id') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-data">
                                        @error('admin_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> --}}
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">

                                <div class="form-group user_contact">
                                    <label for="user_type">{{ __('locale.user_type') }}</label>
                                    <select name="user_type" id="user_type"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control select2 @error('user_type') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="Продавец">Продавец</option>
                                        <option value="Покупатель">Покупатель</option>
                                        <option value="Партнер">Партнер</option>
                                        <option value="Не целевой">Не целевой</option>
                                    </select>
                                    <span class="error-data">
                                        @error('user_type')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group user_contact">
                                    <label for="admin_id">{{ __('locale.admin_id') }}</label>
                                    <select name="admin_id" id="admin_id" data-placeholder="{{ __('locale.select') }}"
                                            class="form-control select2 @error('admin_id') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-data">
                                        @error('admin_id')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="contract_admin_id">{{ __('locale.contract_admin_id') }}</label>
                                    <select name="contract_admin_id" id="contract_admin_id"
                                        data-placeholder="{{ __('locale.select') }}"
                                        class="form-control select2 @error('contract_admin_id') is-invalid error-data-input @enderror">
                                        <option value="">------------</option>
                                        <option value="1">Admin</option>
                                    </select>
                                    <span class="error-data">
                                        @error('contract_admin_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> --}}

                                <div class="form-group">
                                    <label for="start_date">{{ __('locale.start_date') }}</label>
                                    <input type="text" id="start_date" name="start_date" class="form-control "
                                           value="">
                                    <span class="error-data">
                                        @error('start_date')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="finish_date">{{ __('locale.finish_date') }}</label>
                                    <input type="text" name="finish_date" id="finish_date"
                                           class="form-control @error('finish_date') error-data-input is-invalid @enderror"
                                           value="{{ old('finish_date') }}">
                                    <span class="error-data">
                                        @error('finish_date')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="contract_number">{{ __('locale.contract_number') }}</label>
                                    <textarea id="contract_number" name="contract_number"
                                              class="form-control @error('contract_number') error-data-input is-invalid @enderror"
                                              style="height: 125px; width: 100%">{{ old('contract_number') }}</textarea>
                                    <span class="error-data">
                                        @error('contract_number')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="contract_fee">{{ __('locale.contract_fee') }}</label>
                                    <textarea id="contract_fee" name="contract_fee"
                                              class="form-control @error('contract_fee') error-data-input is-invalid @enderror"
                                              style="height: 125px; width: 100%">{{ old('contract_fee') }}</textarea>
                                    <span class="error-data">
                                        @error('contract_fee')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-file" role="tabpanel" aria-labelledby="nav-file-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group ">

                            <label for="files">{{ __('locale.files') }}</label>
                            <input type="file" name="files[]" id="files" multiple>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <style>
        .form-input-item {
            border: 1px solid red !important;
        }

        .form-select-item {
            border: 1px solid red !important;
        }
    </style>

@endsection


@section('scripts')
    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/jquery.maskedinput.min.js') }}"></script>

    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/filetype.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/buffer.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/locales/ru.js') }}"></script>

    <script>
        $(document).ready(function() {

            let current_language = '{{ app()->getLocale() }}'

            $('#start_date').datetimepicker({
                format: 'Y-M-D',
            });

            $('#finish_date').datetimepicker({
                format: 'Y-M-D',
            });


            $('input[type=tel]').mask("(99) 999-99-99");

            $('.object_number').on('keyup', function(e) {
                $('.phone__number a').addClass('active');
            })
            let numberInput = $('.object_number');

            $('.phone__number a').on('click', function(e) {
                e.preventDefault();
                const phoneVal = $('.object_number').val();
                $('.user_contact').addClass('active');
                // $('input[type=hidden]').val(phoneVal);
                numberInput.css('disabled');
            })

            // kartik fileinput upload files
            var $el2 = $("#images");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#images").fileinput({
                language: 'ru',
                uploadUrl: `/${current_language}/real-estate/object/image-upload`,
                // deleteUrl: '/forthebuilder/house-flat/file-delete-all',
                allowedFileExtensions: ['jpeg', 'png', 'jpg', 'svg'],
                uploadAsync: false,
                maxFileSize: 150000,
                maxFilesNum: 25,
                showUpload: false,
                showCaption: true,
                showRemove: false,
                removeClass: "btn btn-danger",
                removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
                overwriteInitial: false,
                // removeLabel: "Delete",
                // minFileCount: 1,
                // maxFileCount: 5,
                // hideThumbnailContent:false,
                // preferIconicPreview: true,
                browseOnZoneClick: true,
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreview: [
                    @if (!empty($images_saved))
                            @foreach ($images_saved as $files_savedItem)
                        "{{ asset('/uploads/tmp_files/' . Auth::user()->id . '/object/images/' . $files_savedItem->getFilename()) }}",
                    @endforeach
                    @endif
                ],
                initialPreviewConfig: [
                        @if (!empty($images_saved))
                        @foreach ($images_saved as $files_savedItem)
                        @if (
                            $files_savedItem->getExtension() == 'jpg' ||
                                $files_savedItem->getExtension() == 'jpeg' ||
                                $files_savedItem->getExtension() == 'png')
                    {
                        caption: "{{ $files_savedItem->getFilename() }}",
                        size: "{{ $files_savedItem->getSize() }}",
                        width: "120px",
                        url: `/${current_language}/real-estate/object/image-delete/` +
                            '{{ $files_savedItem->getFilename() }}',
                        key: "{{ $files_savedItem->getFilename() }}"
                    },
                        @else
                    {
                        type: "{{ $files_savedItem->getExtension() }}",
                        caption: "{{ $files_savedItem->getFilename() }}",
                        size: "{{ $files_savedItem->getSize() }}",
                        width: "120px",
                        url: `/${current_language}/real-estate/object/image-delete/` +
                            '{{ $files_savedItem->getFilename() }}',
                        key: "{{ $files_savedItem->getFilename() }}"
                    },
                    @endif
                    @endforeach
                    @endif
                ]
            }).on("filebatchselected", function(event, files) {
                $el2.fileinput("upload");
            }).on('filesorted', function(e, params) {

            }).on('fileuploaded', function(e, params) {
                console.log('file uploaded', e, params);
            }).on('filesuccessremove', function(e, id) {
                console.log('file success remove', e, id);
            });
            // kartik fileinput upload files

            // kartik fileinput upload files
            var $el1 = $("#files");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#files").fileinput({
                language: 'ru',
                uploadUrl: `/${current_language}/real-estate/object/file-upload`,
                // deleteUrl: '/forthebuilder/house-flat/file-delete-all',
                allowedFileExtensions: ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg'],
                uploadAsync: false,
                maxFileSize: 150000,
                maxFilesNum: 25,
                showUpload: false,
                showCaption: true,
                showRemove: false,
                removeClass: "btn btn-danger",
                removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
                overwriteInitial: false,
                // removeLabel: "Delete",
                // minFileCount: 1,
                // maxFileCount: 5,
                // hideThumbnailContent:false,
                // preferIconicPreview: true,
                browseOnZoneClick: true,
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreview: [
                    @if (!empty($files_saved))
                            @foreach ($files_saved as $files_savedItem)
                        "{{ asset('/uploads/tmp_files/' . Auth::user()->id . '/object/files/' . $files_savedItem->getFilename()) }}",
                    @endforeach
                    @endif
                ],
                initialPreviewConfig: [
                        @if (!empty($files_saved))
                        @foreach ($files_saved as $files_savedItem)
                        @if (
                            $files_savedItem->getExtension() == 'jpg' ||
                                $files_savedItem->getExtension() == 'jpeg' ||
                                $files_savedItem->getExtension() == 'png')
                    {
                        caption: "{{ $files_savedItem->getFilename() }}",
                        size: "{{ $files_savedItem->getSize() }}",
                        width: "120px",
                        url: `/${current_language}/real-estate/object/file-delete/` +
                            '{{ $files_savedItem->getFilename() }}',
                        key: "{{ $files_savedItem->getFilename() }}"
                    },
                        @else
                    {
                        type: "{{ $files_savedItem->getExtension() }}",
                        caption: "{{ $files_savedItem->getFilename() }}",
                        size: "{{ $files_savedItem->getSize() }}",
                        width: "120px",
                        url: `/${current_language}/real-estate/object/file-delete/` +
                            '{{ $files_savedItem->getFilename() }}',
                        key: "{{ $files_savedItem->getFilename() }}"
                    },
                    @endif
                    @endforeach
                    @endif
                ]
            }).on("filebatchselected", function(event, files) {
                $el1.fileinput("upload");
            }).on('filesorted', function(e, params) {

            }).on('fileuploaded', function(e, params) {
                console.log('file uploaded', e, params);
            }).on('filesuccessremove', function(e, id) {
                console.log('file success remove', e, id);
            });
            // kartik fileinput upload files

        });

        $(document).on('change', '#object_security', function(e) {
            e.preventDefault()
            $('#district_id').parent('div').show()
            $('#district_id').html('<option value="0">------------</option>')
            $('#area_id').html('<option value="0">------------</option>')
            var id = $(this).val()
            $.ajax({
                url: `find-town/${id}`,
                type: 'GET',
                success: function(responce) {
                    if (responce.area == true) {
                        $('#area_id').html(responce.data)
                        $('#district_id').parent('div').hide()
                    } else {
                        $('#district_id').html(responce.data)
                    }
                }
            });
        })

        $(document).on('change', '#district_id', function(e) {
            e.preventDefault()
            var id = $(this).val()
            $.ajax({
                url: `find-area/${id}`,
                type: 'GET',
                success: function(responce) {
                    $('#area_id').html(responce)
                }
            });
        })
    </script>
@endsection
