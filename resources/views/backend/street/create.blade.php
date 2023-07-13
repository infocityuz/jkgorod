@extends('layouts.backend')
@section('title')
    {{__('locale.create')}}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/dropzone/min/dropzone.min.css')}}">
@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('locale.street')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('backend.index')}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('street.index')}}">{{__('locale.street')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.create')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form  id="" action="{{route('street.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{__('locale.name')}}</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') error-data-input is-invalid @enderror"
                                   value="{{ old('name') }}" required>
                            <span class="error-data">@error('name'){{$message}}@enderror</span>
                        </div>

                    </div>
                </div>


            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-footer justify-content-end" style="">
                    <button type="submit" class="btn btn-success">{{__('locale.create')}}</button>
                </div>
            </div>
        </div>
    </form>
    {{--    https://laraveldaily.com/multiple-file-upload-with-dropzone-js-and-laravel-medialibrary-package/--}}
@endsection


@section('scripts')
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            // $('#year_constructionId').datetimepicker({
            //     format: 'Y-M-D',
            // });
            $("#year_constructioninputid").inputmask("9999-99-99",{ "placeholder": "yyyy-mm-dd" });

        });


    </script>
@endsection




