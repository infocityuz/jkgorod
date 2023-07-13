@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ __('locale.create') }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css') }}">
@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('locale.leads') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('forthebuilder.index') }}">{{ __('locale.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('forthebuilder.leads.index') }}">{{ __('locale.leads') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('locale.create') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form  id="" action="{{ route('forthebuilder.leads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('locale.name') }}</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') error-data-input is-invalid @enderror"
                                value="{{ $data['name'] ?? old('name') }}" required 
                            >
                            <span class="error-data">@error('name'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="surname">{{ __('locale.surname') }}</label>
                            <input type="text" name="surname" id="surname"
                                class="form-control @error('surname') error-data-input is-invalid @enderror"
                                value="{{ $data['surname'] ?? old('surname') }}" required
                            >
                            <span class="error-data">@error('surname'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="patronymic">{{ __('locale.patronymic') }}</label>
                            <input type="text" name="patronymic" id="patronymic"
                                class="form-control @error('patronymic') error-data-input is-invalid @enderror"
                                value="{{ $data['patronymic'] ?? old('patronymic') }}"
                            >
                            <span class="error-data">@error('patronymic'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('locale.phone_number') }}</label>
                            <div class="number_block">
                                <input type="text" name="phone_code" value=" + 9 9 8" readonly>
                                <input type="tel" name="phone" id="phone"
                                    class="form-control object_number @error('phone') error-data-input is-invalid @enderror"
                                    value="{{ $data['phone'] ?? old('phone') }}"
                                >
                            </div>
                            <span class="error-data">@error('phone'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="additional_phone">{{ __('locale.additional_phone_number') }}</label>
                            <div class="number_block">
                                <input type="text" name="phone_code" class="additional_phone_code" value=" + 9 9 8" readonly>
                                <input type="tel" name="additional_phone" id="additional_phone"
                                    class="form-control object_number @error('additional_phone') error-data-input is-invalid @enderror"
                                    value="{{ $data['additional_phone'] ?? old('additional_phone') }}"
                                >
                            </div>
                            <span class="error-data">@error('additional_phone'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('locale.email') }}</label>
                            <div class="number_block">
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') error-data-input is-invalid @enderror"
                                    value="{{ $data['email'] ?? old('email') }}"
                                >
                            </div>
                            <span class="error-data">@error('email'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="source">{{ __('locale.Source') }}</label>
                            <input type="text" name="source" id="source"
                                class="form-control @error('source') error-data-input is-invalid @enderror"
                                value="{{ $data['source'] ?? old('source') }}"
                            >
                            <span class="error-data">@error('source'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group d-none">
                            <label for="status">{{ __('locale.status') }}</label>
                            <select 
                                name="lead_status_id" id="status" data-placeholder="{{ __('locale.select') }}"  class="form-control select2
                                @error('lead_status_id') is-invalid error-data-input @enderror"
                            >
                                {{-- @foreach($leadStatuses as $status) --}}
                                    <option value="{{ $request_status }}" selected>
                                        Новый
                                    </option>
                                {{-- @endforeach --}}
                            </select>
                            <span class="error-data">@error('lead_status_id'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="series_number">{{ __('locale.series_number') }}</label>
                            <input type="text" name="series_number" id="series_number"
                                class="form-control @error('series_number') error-data-input is-invalid @enderror"
                                value="{{ $data['series_number'] ?? old('series_number') }}" placeholder="AA1234567"
                            >
                            <span class="error-data">@error('series_number'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="issued_by">{{ __('locale.Issued by') }}</label>
                            <div class="number_block">
                                <input type="text" name="issued_by" id="issued_by"
                                    class="form-control @error('issued_by') error-data-input is-invalid @enderror"
                                    value="{{ $data['issued_by'] ?? old('issued_by') }}"
                                >
                            </div>
                            <span class="error-data">@error('email'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="interview_date">{{__('locale.interview_date')}}</label>
                            <input type="text" name="interview_date" id="interview_date"
                                   class="form-control @error('interview_date') error-data-input is-invalid @enderror"
                                   value="{{$data['interview_date'] ?? old('interview_date') }}">
                            <span class="error-data">@error('interview_date'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="INN">{{ __('locale.inn') }}</label>
                            <input type="text" name="inn" id="INN"
                                class="form-control @error('inn') error-data-input is-invalid @enderror"
                                value="{{ $data['inn'] ?? old('inn') }}" 
                            >
                            <span class="error-data">@error('inn'){{ $message }}@enderror</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-footer justify-content-end" style="">
                    <button type="submit" class="btn btn-success">{{ __('locale.create') }}</button>
                </div>
            </div>
        </div>
    </form>
    <style>
        .additional_phone_code{
            border-color: #CED4DA;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>

    <script>
        let page_name = 'leads';
        $(document).ready(function () {
            $('#sent').datetimepicker({
                format: 'Y-M-D',
            });
            $('input[type=tel]').mask("(99) 999-99-99");

            let sessionWarning = "{{session('warning') }}";
            if(sessionWarning){
                toastr.warning(sessionWarning)
            }
            $('#interview_date').datetimepicker({
                format: 'Y-M-D',
            });
        });
    </script>
@endsection