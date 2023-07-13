@extends('forthebuilder::layouts.forthebuilder')

@php
    use Modules\ForTheBuilder\Entities\Constants;
@endphp
@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{route('forthebuilder.clients.index')}}" class="plus2 profileMaxNazadInformatsiyaKlient">
                        <img src="{{ asset('backend-assets/forthebuilders/images/icons/arrow-left.png') }}" alt="">
                    </a>
                    <h2 class="panelUprText">{{ translate('update') }}</h2>
                </div>
            </div>

            <div class="sozdatJkData">
                <form action="{{ route('forthebuilder.clients.update', $model->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="client_id" class="booking-client_id" id="">
                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('First name') }}</h3>
                        <input
                                class="sozdatImyaSpisokInput keyUpName booking-first_name @error('first_name') error-data-input is-invalid @enderror"
                                type="text" name="first_name" id="first_name" autocomplete="off"
                                value="{{ $model->first_name, old('first_name') }}">
                        <div class="keyUpNameResult d-none"
                             style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                        </div>
                        <span class="error-data">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Last name') }}</h3>
                        <input
                                class="sozdatImyaSpisokInput keyUpName booking-last_name @error('last_name') error-data-input is-invalid @enderror"
                                type="text" name="last_name" id="last_name" autocomplete="off"
                                value="{{ $model->last_name,old('last_name') }}">
                        <div class="keyUpNameResult d-none"
                             style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                        </div>
                        <span class="error-data">
                            @error('last_name')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Middle name') }}</h3>
                        <input
                                class="sozdatImyaSpisokInput keyUpName booking-middle_name @error('middle_name') error-data-input is-invalid @enderror"
                                type="text" name="middle_name" id="middle_name" autocomplete="off"
                                value="{{ $model->middle_name,old('middle_name') }}">
                        <div class="keyUpNameResult d-none"
                             style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                        </div>
                        <span class="error-data">
                            @error('middle_name')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Phone number') }}</h3>
                        <div class="d-flex">
                            <div>
                                <img src="{{ asset('backend-assets/forthebuilders/images/region.png') }}" alt="Region">
                            </div>
                            <div>
                                <label
                                        style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                        for="+998">+998</label>
                                <input
                                        class="sozdatImyaSpisokInputTel keyUpName booking-phone @error('phone') error-data-input is-invalid @enderror"
                                        type="tel" id="phone" name="phone" {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}
                                        value="{{ $model->phone,old('phone') }}">
                                <div class="keyUpNameResult d-none"
                                     style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="error-data">
                                    @error('phone')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Additional phone number') }}</h3>
                        <div class="d-flex">
                            <div>
                                <img src="{{ asset('backend-assets/forthebuilders/images/region.png') }}" alt="Region">
                            </div>
                            <div>
                                <label
                                        style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                        for="+998">+998</label>
                                <input
                                        class="sozdatImyaSpisokInputTel keyUpName booking-additional_phone @error('additional_phone') error-data-input is-invalid @enderror"
                                        type="tel" id="additional_phone" name="additional_phone" {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}
                                        value="{{ $model->additional_phone,old('additional_phone') }}">
                                <div class="keyUpNameResult d-none"
                                     style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="error-data">
                                    @error('additional_phone')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('email') }}</h3>
                        <input class="sozdatImyaSpisokInput @error('email') error-data-input is-invalid @enderror"
                               type="email" name="email" id="email" value="{{ $model->email,old('email') }}">
                        <span class="error-data">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Source') }}</h3>
                        <input class="sozdatImyaSpisokInput @error('source') error-data-input is-invalid @enderror"
                               type="text" name="source" id="source" value="{{ $model->source,old('source') }}">
                        <span class="error-data">
                            @error('source')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('status') }}</h3>
                        <select
                                class="form-control sozdatImyaSpisokSelectOption @error('lead_status') is-invalid error-data-input @enderror"
                                id="exampleFormControlSelect1" name="lead_status" data-placeholder="{{ translate('select') }}">
                            <option value="{{ Constants::FIRST_CONTACT }}">{{ translate('First contact') }}</option>
                            <option value="{{ Constants::NEGOTIATION }}">{{ translate('Negotiation') }}</option>
                        </select>
                        <span class="error-data">
                            @error('lead_status')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <button type="submit" class="sozdatImyaSpisokSozdatButton btn">{{ translate('update') }}</button>
                    {{-- <a href="./lidi.html" class="sozdatImyaSpisokSozdatButton">{{ translate('create') }}</a> --}}
                </form>
            </div>

        </div>
    </div>
    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>

    <script>
        let page_name = 'clients';
        $(document).ready(function() {
            $('#sent').datetimepicker({
                format: 'Y-M-D',
            });
            $('input[type=tel]').mask("(99) 999-99-99");

            let sessionWarning = "{{ session('warning') }}";
            if (sessionWarning) {
                toastr.warning(sessionWarning)
            }
        });
    </script>
@endsection
