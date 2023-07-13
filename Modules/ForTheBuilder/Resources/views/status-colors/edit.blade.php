@extends('forthebuilder::layouts.forthebuilder')
@section('title')
    {{__('locale.Change color status')}}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> {{__('locale.Change color status')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.task.index')}}">{{__('locale.task')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.Status Colors')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('forthebuilder.status-colors.update', $model->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">

                <div class="form-group">
                    <!-- <input type="hidden" name="status_color_id" value="{{ $model->id }}"> -->
                    <label for="colors">{{__('locale.Colors')}}</label>
                    <input 
                        type="text" name="colors" id="colors"
                        class="form-control @error('colors') error-data-input is-invalid @enderror my-colorpicker1"
                        value="{{ $model->color }}"
                    >
                </div>

                <div class="form-group">
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

@endsection

@section('scripts')
    <script src="{{asset('/backend-assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script>
        let page_name = 'status-colors';
        $(document).ready(function() {
            $('.my-colorpicker1').colorpicker()
        })
    </script>
@endsection
