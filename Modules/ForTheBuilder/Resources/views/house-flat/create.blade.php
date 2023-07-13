@extends('forthebuilder::layouts.forthebuilder')

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
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/toastr/toastr.min.css') }}">
@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('locale.house') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('forthebuilder.index') }}">{{ __('locale.home') }}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('forthebuilder.house.index') }}">{{ __('locale.house') }}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('forthebuilder.house.show-more', request()->house_id) }}">{{ request()->house_name }}</a>
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
    @if (session('fail'))
        <div class="alert alert-danger">
            <ul>
                {{ session('fail') }}
            </ul>
        </div>
    @endif
    <form id="" action="{{ route('forthebuilder.house-flat.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" name="house_id" id="house_id" class="form-control"
                                value="{{ request()->house_id }}">
                        </div>

                        <div class="form-group">
                            <label for="number_of_flat">{{ __('locale.house_number') }}</label>
                            <input type="number" name="number_of_flat" id="number_of_flat"
                                class="form-control @error('number_of_flat') error-data-input is-invalid @enderror"
                                value="{{ 0, old('number_of_flat') }}" required>
                            <span class="error-data">
                                @error('number_of_flat')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="enterance">{{ __('locale.enterance') }}</label>
                            <select name="enterance" id="enterance" data-placeholder="{{ __('locale.select') }}"
                                class="form-control select2 @error('enterance') is-invalid error-data-input @enderror"
                                required>
                                @for ($e = 1; $e <= request()->enterance; $e++)
                                    <option value="">-----------------------</option>
                                    <option value="{{ $e }}">{{ $e }}</option>
                                @endfor
                            </select>
                            <span class="error-data">
                                @error('enterance')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="floor">{{ __('locale.floor') }}</label>
                            <select name="floor" id="floor" data-placeholder="{{ __('locale.select') }}"
                                class="form-control select2 @error('floor') is-invalid error-data-input @enderror" required>
                                @for ($f = 1; $f <= request()->floor; $f++)
                                    <option value="">-----------------------</option>
                                    <option value="{{ $f }}">{{ $f }}</option>
                                @endfor
                            </select>
                            <span class="error-data">
                                @error('floor')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- <div class="form-group">
                            <label for="enterance">{{__('locale.enterance')}}</label>
                            <input type="number" name="enterance" id="enterance"
                                   class="form-control @error('enterance') error-data-input is-invalid @enderror"
                                   value="{{ old('enterance') }}" required>
                            <span class="error-data">@error('enterance'){{$message}}@enderror</span>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="floor">{{__('locale.floor')}}</label>
                            <input type="number" name="floor" id="floor"
                                   class="form-control @error('floor') error-data-input is-invalid @enderror"
                                   value="{{ old('floor') }}" required>
                            <span class="error-data">@error('floor'){{$message}}@enderror</span>
                        </div> --}}

                        <div class="form-group">
                            <label for="area">{{ __('locale.living_space') }} m<sup>2</sup></label>
                            <input type="number" name="area" id="area"
                                class="form-control @error('area') error-data-input is-invalid @enderror"
                                value="{{ old('area') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('area')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="basement_area">{{ __('locale.area') }} ({{ __('locale.basement') }})
                                m<sup>2</sup></label>
                            <input type="number" name="basement_area" id="basement_area"
                                class="form-control @error('basement_area') error-data-input is-invalid @enderror"
                                value="{{ old('basement_area') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('basement_area')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="terrace_area">{{ __('locale.area') }} ({{ __('locale.terrace') }})
                                m<sup>2</sup></label>
                            <input type="number" name="terrace_area" id="terrace_area"
                                class="form-control @error('terrace_area') error-data-input is-invalid @enderror"
                                value="{{ old('terrace_area') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('terrace_area')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="mansard_area">{{ __('locale.area') }} ({{ __('locale.mansard') }})
                                m<sup>2</sup></label>
                            <input type="number" name="mansard_area" id="mansard_area"
                                class="form-control @error('mansard_area') error-data-input is-invalid @enderror"
                                value="{{ old('mansard_area') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('mansard_area')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="balcony">{{ __('locale.balcony') }} m<sup>2</sup></label>
                            <input type="number" name="balcony" id="balcony"
                                class="form-control @error('balcony') error-data-input is-invalid @enderror"
                                value="{{ old('balcony') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('balcony')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="total_area">{{ __('locale.total_area') }} m<sup>2</sup></label>
                            <input type="number" name="total_area" id="total_area"
                                class="form-control @error('total_area') error-data-input is-invalid @enderror"
                                value="{{ old('total_area') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('total_area')
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
                            <label for="room_count">{{ __('locale.room_count') }}</label>
                            <input type="number" name="room_count" id="room_count"
                                class="form-control @error('room_count') error-data-input is-invalid @enderror"
                                value="{{ old('room_count') }}">
                            <span class="error-data">
                                @error('room_count')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{-- <div class="form-group">
                            <label for="date">{{__('locale.date')}}</label>
                            <input type="text" name="date" id="date"
                                   class="form-control @error('date') error-data-input is-invalid @enderror"
                                   value="{{ old('date') }}">
                            <span class="error-data">@error('date'){{$message}}@enderror</span>
                        </div> --}}

                        <div class="form-group">
                            <label for="contract_number">{{ __('locale.contract_number') }}</label>
                            <input type="number" name="contract_number" id="contract_number"
                                class="form-control @error('contract_number') error-data-input is-invalid @enderror"
                                value="{{ 0, old('contract_number') }}">
                            <span class="error-data">
                                @error('contract_number')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="price">{{ __('locale.price') }} за 1m<sup>2</sup></label>
                            <input type="number" name="price" id="price"
                                class="form-control @error('price') error-data-input is-invalid @enderror"
                                value="{{ old('price') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="price_pay_30">{{ __('locale.price') }} за 1m<sup>2</sup> (30%)</label>
                            <input type="number" name="price_pay_30" id="price_pay_30"
                                class="form-control @error('price_pay_30') error-data-input is-invalid @enderror"
                                value="{{ old('price_pay_30') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('price_pay_30')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="price_pay_50">{{ __('locale.price') }} за 1m<sup>2</sup> (50%)</label>
                            <input type="number" name="price_pay_50" id="price_pay_50"
                                class="form-control @error('price_pay_50') error-data-input is-invalid @enderror"
                                value="{{ old('price_pay_50') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('price_pay_50')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="basement">{{ __('locale.price') }} за 1m<sup>2</sup> ({{ __('locale.basement') }}
                                этаж)</label>
                            <input type="number" name="basement" id="basement"
                                class="form-control @error('basement') error-data-input is-invalid @enderror"
                                value="{{ old('basement') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('basement')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="basement_price_pay_30">{{ __('locale.price') }} за 1m<sup>2</sup>
                                ({{ __('locale.basement') }} этаж 30%)</label>
                            <input type="number" name="basement_price_pay_30" id="basement_price_pay_30"
                                class="form-control @error('basement') error-data-input is-invalid @enderror"
                                value="{{ old('basement') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('basement')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="basement_price_pay_50">{{ __('locale.price') }} за 1m<sup>2</sup>
                                ({{ __('locale.basement') }} этаж 50%)</label>
                            <input type="number" name="basement_price_pay_50" id="basement_price_pay_50"
                                class="form-control @error('basement') error-data-input is-invalid @enderror"
                                value="{{ old('basement') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('basement')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{--                        <div class="form-group"> --}}
                        {{--                            <label for="terrace">{{__('locale.price')}} за 1m<sup>2</sup> ({{__('locale.terrace')}})</label> --}}
                        {{--                            <input type="number" name="terrace" id="terrace" --}}
                        {{--                                   class="form-control @error('terrace') error-data-input is-invalid @enderror" --}}
                        {{--                                   value="{{ old('terrace') }}" step="0.01" min="0"> --}}
                        {{--                            <span class="error-data">@error('terrace'){{$message}}@enderror</span> --}}
                        {{--                        </div> --}}
                        <div class="form-group">
                            <label for="mansard">{{ __('locale.price') }} за 1m<sup>2</sup>
                                ({{ __('locale.mansard') }})</label>
                            <input type="number" name="mansard" id="mansard"
                                class="form-control @error('mansard') error-data-input is-invalid @enderror"
                                value="{{ old('mansard') }}" step="0.01" min="0">
                            <span class="error-data">
                                @error('mansard')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="files">{{ __('locale.file__upload') }}</label>
                            <input type="file" name="files[]" id="files" multiple="multiple">
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

    {{--    https://laraveldaily.com/multiple-file-upload-with-dropzone-js-and-laravel-medialibrary-package/ --}}
@endsection


@section('scripts')
    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>


    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/filetype.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/buffer.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/locales/ru.js') }}"></script>

    <script>
        let page_name = 'house-flat';
        $(document).ready(function() {

            $('form .select2').select2();

            // kartik fileinput upload files
            var $el1 = $("#files");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#files").fileinput({
                language: 'ru',
                uploadUrl: "/forthebuilder/house-flat/file-upload",
                // deleteUrl: '/forthebuilder/house-flat/file-delete-all',
                allowedFileExtensions: ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'png', 'jpg', 'jpeg', 'svg'],
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
                            "{{ asset('/uploads/tmp_files/' . Auth::user()->id . '/house-flat/' . $files_savedItem->getFilename()) }}",
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
                                    url: '/forthebuilder/house-flat/file-delete/' +
                                        '{{ $files_savedItem->getFilename() }}',
                                    key: "{{ $files_savedItem->getFilename() }}"
                                },
                            @else
                                {
                                    type: "{{ $files_savedItem->getExtension() }}",
                                    caption: "{{ $files_savedItem->getFilename() }}",
                                    size: "{{ $files_savedItem->getSize() }}",
                                    width: "120px",
                                    url: '/forthebuilder/house-flat/file-delete/' +
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
    </script>
@endsection
