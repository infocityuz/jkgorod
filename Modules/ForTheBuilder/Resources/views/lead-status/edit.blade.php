@extends('forthebuilder::layouts.forthebuilder')
@section('title')
    {{__('locale.update')}}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/toastr/toastr.min.css')}}">
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
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.lead-status.index')}}">{{__('locale.lead-status')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.update')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('forthebuilder.lead-status.update',$model->id)}}" method="POST" enctype="multipart/form-data">
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
                                   value="{{ $model->name}}">
                            <span class="error-data">@error('name'){{$message}}@enderror</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="order">{{__('locale.order')}}</label>
                            <input type="text" name="order" id="order"
                                   class="form-control @error('order') error-data-input is-invalid @enderror"
                                   value="{{ $model->order}}">
                            <span class="error-data">@error('order'){{$message}}@enderror</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-footer justify-content-end" style="">
                    <button type="submit" class="btn btn-success">{{__('locale.update')}}</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        let page_name = 'lead-status';
    </script>
@endsection

@section('scripts')
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>

    <script>
        $(document).ready(function () {


        });
    </script>
@endsection

