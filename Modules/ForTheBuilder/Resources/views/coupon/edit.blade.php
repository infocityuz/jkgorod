@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ __('locale.edit') }}
@endsection

@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('locale.Coupon') }} {{ __('locale.edit') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('forthebuilder.index') }}">{{ __('locale.home') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('forthebuilder.coupon.index') }}">{{ __('locale.Coupon') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('locale.edit') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('forthebuilder.coupon.update', $model->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="coupon_name">{{ __('locale.coupon name') }}</label>
                            <input type="text" name="name" id="coupon_name"
                                class="form-control @error('name') error-data-input is-invalid @enderror"
                                value="{{ $model->name ?? old('name') }}">
                            <span class="error-data">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="percent">{{ __('locale.percent') }} %</label>
                            <input type="number" name="percent" id="percent"
                                class="form-control @error('percent') error-data-input is-invalid @enderror"
                                value="{{ $model->percent ?? old('percent') }}" min="0" max="20">
                            <span class="error-data">
                                @error('percent')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-success">{{ __('locale.Confirm') }}</button>
                            </div>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
        let page_name = 'coupon';
    </script>
@endsection
