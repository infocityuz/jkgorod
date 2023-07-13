@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{__('locale.update')}}
@endsection

@section('styles')

    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
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
                        <h1 class="m-0"> {{__('locale.update')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}"> {{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.leads.index')}}">{{__('locale.leads')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.update')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <form action="{{route('forthebuilder.leads.update', $model->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">{{__('locale.name')}}</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') error-data-input is-invalid @enderror"
                                   value="{{ $model->name, old('name') }}" required>
                            <span class="error-data">@error('name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="surname">{{__('locale.surname')}}</label>
                            <input type="text" name="surname" id="surname"
                                   class="form-control @error('surname') error-data-input is-invalid @enderror"
                                   value="{{ $model->surname,  old('surname') }}" required>
                            <span class="error-data">@error('surname'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="patronymic">{{__('locale.patronymic')}}</label>
                            <input type="text" name="patronymic" id="patronymic"
                                   class="form-control @error('patronymic') error-data-input is-invalid @enderror"
                                   value="{{ $model->patronymic, old('patronymic') }}">
                            <span class="error-data">@error('patronymic'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{__('locale.phone_number')}}</label>
                            <div class="number_block">
                                <input type="text" name="phone_code" class="phone_code" value=" + 9 9 8" readonly>
                                <input type="tel" name="phone" id="phone"
                                       class="form-control @error('phone') error-data-input is-invalid @enderror"
                                       value="{{ltrim($model->phone, ' + 9 9 8'), old('phone') }}" required>
                            </div>
                            <span class="error-data">@error('phone'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="additional_phone">{{translate('additional phone number')}}</label>
                            <div class="number_block">
                                <input type="text" name="additional_phone_code" class="phone_code" value=" + 9 9 8" readonly>
                                <input type="tel" name="additional_phone" id="additional_phone"
                                       class="form-control object_number @error('additional_phone') error-data-input is-invalid @enderror"
                                       value="{{ltrim($model->additional_phone, ' + 9 9 8'), old('additional_phone') }}">
                                </div>
                            <span class="error-data">@error('additional_phone'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('locale.email')}}</label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') error-data-input is-invalid @enderror"
                                   value="{{$model->email, old('email') }}">
                            <span class="error-data">@error('email'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="source">{{__('locale.Source')}}</label>
                            <input type="text" name="source" id="source"
                                   class="form-control @error('source') error-data-input is-invalid @enderror"
                                   value="{{$model->source, old('source') }}">
                            <span class="error-data">@error('source'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="series_number">{{__('locale.series_number')}}</label>
                            <input type="text" name="series_number" id="series_number"
                                   class="form-control @error('series_number') error-data-input is-invalid @enderror"
                                   value="{{$model->series_number, old('series_number') }}" placeholder="AA1234567">
                            <span class="error-data">@error('series_number'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="issued_by">{{__('locale.Issued by')}}</label>
                            <div class="number_block">
                                {{--                                            <span class="flag"><img src="/backend-assets/img/flag.webp" alt="" ></span>--}}
                                <input type="text" name="issued_by" id="issued_by"
                                       class="form-control @error('issued_by') error-data-input is-invalid @enderror"
                                       value="{{$model->issued_by, old('issued_by') }}">
                            </div>
                            <span class="error-data">@error('email'){{$message}}@enderror</span>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="referer">{{__('locale.referer')}}</label>--}}
{{--                            <input type="text" name="referer" id="referer"--}}
{{--                                   class="form-control @error('referer') error-data-input is-invalid @enderror"--}}
{{--                                   value="{{$model->referer, old('referer') }}" required>--}}
{{--                            <span class="error-data">@error('referer'){{$message}}@enderror</span>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label for="requestid">{{__('locale.requestid')}}</label>--}}
{{--                            <input type="number" name="requestid" id="requestid"--}}
{{--                                   class="form-control @error('requestid') error-data-input is-invalid @enderror"--}}
{{--                                   value="{{$model->requestid, old('requestid') }}" required>--}}
{{--                            <span class="error-data">@error('requestid'){{$message}}@enderror</span>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label for="status">{{__('locale.status')}}</label>
                            <select name="lead_status_id" id="status" data-placeholder="{{__('locale.select')}}" class="form-control select2
                                @error('lead_status_id') is-invalid error-data-input @enderror">
                                @foreach($leadStatuses as $status)
                                    <option value="{{ $status->id }}" {{$model->lead_status_id == $status->id ? 'selected' : ''}}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="error-data">@error('lead_status_id'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="interview_date">{{__('locale.interview_date')}}</label>
                            <input type="text" name="interview_date" id="interview_date"
                                   class="form-control @error('interview_date') error-data-input is-invalid @enderror"
                                   value="{{$model->interview_date, old('interview_date') }}">
                            <span class="error-data">@error('interview_date	'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="INN">{{__('locale.inn')}}</label>
                            <input type="text" name="inn" id="INN"
                                   class="form-control @error('inn') error-data-input is-invalid @enderror"
                                   value="{{$model->inn, old('inn') }}">
                            <span class="error-data">@error('inn'){{$message}}@enderror</span>
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-success">{{__('locale.update')}}</button>
                    </div>

                    </div>
                </div>
            </div>
        </div>

    </form>
    <style>
        .display-none{
            display:none;
        }
        .additional_phone_code{
            border-color: #CED4DA;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/jquery.maskedinput.min.js')}}"></script>

    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/sortable.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/filetype.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/buffer.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/locales/ru.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/jquery.maskedinput.min.js')}}"></script>
    <script>
        let page_name = 'leads';
        $(document).ready(function() {
            $('#sent').datetimepicker({
                format: 'Y-M-D',
            });
            $('input[type=tel]').mask("(99) 999-99-99");
            let sessionSuccess ="{{session('success')}}";
            if(sessionSuccess){
                toastr.success(sessionSuccess)
            }
            let sessionWarning = "{{session('warning')}}";
            if(sessionWarning){
                toastr.warning(sessionWarning)
            }
            let sessionError = "{{session('error')}}";
            if(sessionError){
                toastr.warning(sessionError)
            }
        //   $('#course_yearId').inputmask('format':'dd/mm/yyyy');
        //   $("#phone").inputmask("9999-99-99",{ "placeholder": "yyyy-mm-dd" });
            $('#add_info').prop('checked', false);
            $('#sent').datetimepicker({
                format: 'Y-M-D',
            });
            $('#interview_date').datetimepicker({
                format: 'Y-M-D',
            });
            $('#add_info').change(function() {
                if ($(this).is(':checked')) {
                    if($('#add_patronymic').hasClass('display-none')){
                        $('#add_patronymic').removeClass('display-none');
                    }
                    if($('#add_phone').hasClass('display-none')){
                        $('#add_phone').removeClass('display-none');
                    }
                    if($('#add_email').hasClass('display-none')){
                        $('#add_email').removeClass('display-none');
                    }
                } else {
                    if(!$('#add_patronymic').hasClass('display-none')){
                        $('#add_patronymic').addClass('display-none');
                    }
                    if(!$('#add_phone').hasClass('display-none')){
                        $('#add_phone').addClass('display-none');
                    }
                    if(!$('#add_email').hasClass('display-none')){
                        $('#add_email').addClass('display-none');
                    }
                }
            });
        });
    </script>
@endsection

