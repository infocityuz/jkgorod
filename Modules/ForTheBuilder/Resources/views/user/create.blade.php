@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ translate('User create') }}
@endsection
<link rel="stylesheet" href="{{ asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/backend-assets/plugins/toastr/toastr.min.css') }}">
@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{ route('forthebuilder.user.index') }}" class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="{{ asset('/backend-assets/forthebuilders/images/icons/arrow-left.png') }}"
                            alt=""></a>
                    <h2 class="panelUprText">{{ translate('Create a new user') }}</h2>
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
            <div class="sozdatPolzavatelData">
                <form action="{{ route('forthebuilder.user.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Firstname') }}</h3>
                        <input name="first_name"
                            class="sozdatImyaSpisokInput @error('first_name') error-data-input is-invalid @enderror"
                            type="text" value="{{ old('first_name') }}" required>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Lastname') }}</h3>
                        <input name="last_name"
                            class="sozdatImyaSpisokInput @error('last_name') error-data-input is-invalid @enderror"
                            value="{{ old('last_name') }}" required type="text">
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Middlename') }}</h3>
                        <input name="middle_name"
                            class="sozdatImyaSpisokInput @error('middle_name') error-data-input is-invalid @enderror"
                            value="{{ old('middle_name') }}" type="text">
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Email') }}</h3>
                        <input name="email"
                            class="sozdatImyaSpisokInput @error('email') error-data-input is-invalid @enderror"
                            value="{{ old('email') }}" required type="email">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="sozdatImyaSpsok">
                            <h3 class="sozdatImyaSpisokH3">{{ translate('Birth date') }}</h3>
                            <input name="birth_date"
                                   class="sozdatImyaSpisokInput1272 @error('birth_date') error-data-input is-invalid @enderror"
                                   value="{{ old('birth_date') }}" type="date">
                        </div>
                        <div class="sozdatImyaSpsok">
                            <h3 class="sozdatImyaSpisokH3">{{ translate('Phone number') }}</h3>
                            <label style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                    for="+998">+998</label>
                            <input name="phone_number" style="padding-left: 54px" maxlength="9"
                                   class="sozdatImyaSpisokInput1272 @error('phone_number') error-data-input is-invalid @enderror"
                                   value="{{ old('phone_number') }}" type="text">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3"> {{ translate('Role') }}</h3>
                                <select required name="role_id" id="role_id" data-placeholder="{{ __('locale.role') }}"
                                    class="sozdatImyaSpisokInput1272 @error('role_id') is-invalid error-data-input @enderror">
                                    <option value="">---------------------</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{--                            <div class="sozdatImyaSpsok"> --}}
                            {{--                                <h3 class="sozdatImyaSpisokH3">{{translate('Status')}}</h3> --}}
                            {{--                                <input class="sozdatImyaSpisokInput1272" name="status" type="text"> --}}
                            {{--                            </div> --}}
                        </div>

                        <div>
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3"> {{ translate('Password') }}</h3>
                                <input class="sozdatImyaSpisokInput1272" type="password" name="password">
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3"> {{ translate('Password confirmation') }}</h3>
                                <input class="sozdatImyaSpisokInput1272" type="password" name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <label class="login_file">
                                <input class="login_file" name="avatar" type="file" style="display: none;">
                                <div class="d-flex">
                                    <a class="dobavitFotoPolzovatel">+</a>
                                    <h5 class="dobavitFotoTextPolzovatel">{{ translate('Add photo') }}</h5>
                                </div>
                            </label>
                        </div>

                        <button class="polzovatelSoxranitSozdat">
                            {{ translate('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let page_name = 'user';
    </script>
@endsection
