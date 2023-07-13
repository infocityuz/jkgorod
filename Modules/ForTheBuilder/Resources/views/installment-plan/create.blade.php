@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{__('locale.create')}}
@endsection
@section('styles')


@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('locale.lead-status')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.lead-status.index')}}">{{__('locale.lead-status')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.create')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form  id="" action="{{route('forthebuilder.lead-status.store')}}" method="POST" enctype="multipart/form-data">
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
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{__('locale.order')}}</label>
                            <input type="text" name="order" id="order"
                                   class="form-control @error('order') error-data-input is-invalid @enderror"
                                   value="{{ old('order') }}" required>
                            <span class="error-data">@error('order'){{$message}}@enderror</span>
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
@endsection


@section('scripts')
    <script>
        let page_name = 'installment-plan';
    </script>
@endsection




