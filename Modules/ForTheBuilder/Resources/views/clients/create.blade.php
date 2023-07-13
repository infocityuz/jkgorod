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
                    <h2 class="panelUprText">{{ translate('Creating a new client') }}</h2>
                </div>
            </div>

            <div class="sozdatJkData">
                <form id="" action="{{ route('forthebuilder.clients.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <input type="hidden" name="client_id" class="booking-client_id" id="">
                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('First name') }}</h3>
                        <input
                            class="sozdatImyaSpisokInput keyUpName booking-first_name @error('first_name') error-data-input is-invalid @enderror"
                            type="text" name="first_name" id="first_name" autocomplete="off"
                            value="{{ $data['first_name'] ?? old('first_name') }}">
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
                            value="{{ $data['last_name'] ?? old('last_name') }}">
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
                            value="{{ $data['middle_name'] ?? old('middle_name') }}">
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
                                    value="{{ $data['phone'] ?? old('phone') }}">
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
                                    value="{{ $data['additional_phone'] ?? old('additional_phone') }}">
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
                            type="email" name="email" id="email" value="{{ $data['email'] ?? old('email') }}">
                        <span class="error-data">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3">{{ translate('Source') }}</h3>
                        <input class="sozdatImyaSpisokInput @error('source') error-data-input is-invalid @enderror"
                            type="text" name="source" id="source" value="{{ $data['source'] ?? old('source') }}">
                        <span class="error-data">
                            @error('source')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="form-group width_45">
                            <h3 class="sozdatImyaSpisokH3">{{ translate('status') }}</h3>
                            <select class="form-control width_100 sozdatImyaSpisokSelectOption @error('lead_status') is-invalid error-data-input @enderror"
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
                        <div class="sozdatImyaSpsok1 width_45">
                            <h3 class="sozdatImyaSpisokH3">{{ translate('What is looking for') }}</h3>
                            <input class="sozdatImyaSpisokInput @error('looking_for') error-data-input is-invalid @enderror"
                                   type="text" name="looking_for" id="looking_for"
                                   value="{{ $data['looking_for'] ?? old('looking_for') }}">
                            <span class="error-data">
                                @error('looking_for')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="sozdatImyaSpsok width_45">
                            <h3 class="sozdatImyaSpisokH3">{{ translate('Serial number of the passport') }}</h3>
                            <input
                                class="sozdatImyaSpisokServerniyNomer keyUpName booking-series_number @error('series_number') error-data-input is-invalid @enderror"
                                type="text" placeholder="AA1234567" name="series_number" id="series_number"
                                value="{{ $data['series_number'] ?? old('series_number') }}" autocomplete="off">
                            <div class="keyUpNameResult d-none"
                                style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                            </div>
                            <span class="error-data">
                                @error('series_number')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="sozdatImyaSpsok width_45">
                            <h3 class="sozdatImyaSpisokH3">{{ translate('Issued by') }}</h3>
                            <input class="sozdatImyaSpisokInput @error('issued_by') error-data-input is-invalid @enderror"
                                type="text" name="issued_by" id="issued_by"
                                value="{{ $data['issued_by'] ?? old('issued_by') }}">
                            <span class="error-data">
                                @error('issued_by')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="sozdatImyaSpsok width_45">
                            <h3 class="sozdatImyaSpisokH3">{{ translate('PINFL or INN') }}</h3>
                            <input class="sozdatImyaSpisokPinfl width_100 @error('inn') error-data-input is-invalid @enderror"
                                type="text" name="inn" id="inn" value="{{ $data['inn'] ?? old('inn') }}">
                            <span class="error-data">
                                @error('inn')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="sozdatImyaSpsok1 width_45 d-none" id="budget_modal">
                            <h3 class="sozdatImyaSpisokH3">{{ translate('Budget') }}</h3>
                            <input class="sozdatImyaSpisokInput @error('budget') error-data-input is-invalid @enderror"
                                   type="number" name="budget" id="budget"
                                   value="{{ $data['budget'] ?? old('budget') }}">
                            <span class="error-data">
                                @error('budget')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    @if($house_flat != '')
                        <input type="hidden" value="{{ $house_flat->house_id }}" name="house_id">
                        <input type="hidden" value="{{ $house_flat->id }}" name="house_flat_id">
                    @else
                        <input type="hidden" value="" name="house_id">
                        <input type="hidden" value="" name="house_flat_id">
                    @endif
                    <div class="sozdatImyaSpsok width_45 d-none" id="flat_modal">
                        <div class="d-flex mt-3">
                            <a href="{{ route('forthebuilder.client.house', '0') }}" class="plusFlexModalInformation color_black" id="select_flat">+</a>
                            <h3 class="plusFlexModalInformationDobavitCvartir"> {{ translate('Change apartment') }}
                            </h3>
                            @if($house_flat != '')
                                <span class="plusFlexModalInformationDobavitCvartir" id="interested_flat">{{ $house_flat->house->name . ': ' . translate('entrance') . ': ' . $house_flat->entrance .'  '. translate('flat') . ': ' . $house_flat->number_of_flat}}</span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="sozdatImyaSpisokSozdatButton btn" id="create">{{ translate('create') }}</button>
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
            if($('#exampleFormControlSelect1').val() == 2){
                if($('#flat_modal').hasClass('d-none')){
                    $('#flat_modal').removeClass('d-none');
                }
                if($('#budget_modal').hasClass('d-none')){
                    $('#budget_modal').removeClass('d-none');
                }
            }
            $('#exampleFormControlSelect1').on('change', function(){
                if($(this).val() == 2){
                    if($('#flat_modal').hasClass('d-none')){
                        $('#flat_modal').removeClass('d-none');
                    }
                    if($('#budget_modal').hasClass('d-none')){
                        $('#budget_modal').removeClass('d-none');
                    }
                }else{
                    if(!$('#flat_modal').hasClass('d-none')){
                        $('#flat_modal').addClass('d-none');
                    }
                    if(!$('#budget_modal').hasClass('d-none')){
                        $('#budget_modal').addClass('d-none');
                    }
                }
            });
            @if($house_flat != '')
                if(localStorage.getItem('first_name') != undefined){
                    $('#first_name').val(localStorage.getItem('first_name'))
                }
                if(localStorage.getItem('last_name') != undefined){
                    $('#last_name').val(localStorage.getItem('last_name'))
                }
                if(localStorage.getItem('middle_name') != undefined){
                    $('#middle_name').val(localStorage.getItem('middle_name'))
                }
                if(localStorage.getItem('phone') != undefined){
                    $('#phone').val(localStorage.getItem('phone'))
                }
                if(localStorage.getItem('additional_phone') != undefined){
                    $('#additional_phone').val(localStorage.getItem('additional_phone'))
                }
                if(localStorage.getItem('email') != undefined){
                    $('#email').val(localStorage.getItem('email'))
                }
                if(localStorage.getItem('source') != undefined){
                    $('#source').val(localStorage.getItem('source'))
                }
                if(localStorage.getItem('looking_for') != undefined){
                    $('#looking_for').val(localStorage.getItem('looking_for'))
                }
                if(localStorage.getItem('series_number') != undefined){
                    $('#series_number').val(localStorage.getItem('series_number'))
                }
                if(localStorage.getItem('issued_by') != undefined){
                    $('#issued_by').val(localStorage.getItem('issued_by'))
                }
                if(localStorage.getItem('inn') != undefined){
                    $('#inn').val(localStorage.getItem('inn'))
                }
                if(localStorage.getItem('budget') != undefined){
                    $('#budget').val(localStorage.getItem('budget'))
                }
            @endif
            $('#select_flat').on('click', function() {
                if($('#first_name').val() != undefined){
                    localStorage.setItem('first_name', $('#first_name').val())
                }
                if($('#last_name').val() != undefined){
                    localStorage.setItem('last_name', $('#last_name').val())
                }
                if($('#middle_name').val() != undefined){
                    localStorage.setItem('middle_name', $('#middle_name').val())
                }
                if($('#phone').val() != undefined){
                    localStorage.setItem('phone', $('#phone').val())
                }
                if($('#additional_phone').val() != undefined){
                    localStorage.setItem('additional_phone', $('#additional_phone').val())
                }
                if($('#email').val() != undefined){
                    localStorage.setItem('email', $('#email').val())
                }
                if($('#source').val() != undefined){
                    localStorage.setItem('source', $('#source').val())
                }
                if($('#looking_for').val() != undefined){
                    localStorage.setItem('looking_for', $('#looking_for').val())
                }
                if($('#series_number').val() != undefined){
                    localStorage.setItem('series_number', $('#series_number').val())
                }
                if($('#issued_by').val() != undefined){
                    localStorage.setItem('issued_by', $('#issued_by').val())
                }
                if($('#inn').val() != undefined){
                    localStorage.setItem('inn', $('#inn').val())
                }
                if($('#budget').val() != undefined){
                    localStorage.setItem('budget', $('#budget').val())
                }
            });
            $('#create').on('click', function(){
                localStorage.removeItem('first_name')
                localStorage.removeItem('last_name')
                localStorage.removeItem('middle_name')
                localStorage.removeItem('phone')
                localStorage.removeItem('additional_phone')
                localStorage.removeItem('email')
                localStorage.removeItem('source')
                localStorage.removeItem('looking_for')
                localStorage.removeItem('series_number')
                localStorage.removeItem('issued_by')
                localStorage.removeItem('inn')
                localStorage.removeItem('budget')
            });
        });
    </script>
@endsection


