@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{translate('Currency create')}} @endsection
<link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/datatables/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css')}}">

@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <form action="{{route('forthebuilder.currency.store')}}" class="currency_store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="USD">{{__('locale.USD')}}</label>
                                    <input type="number" name="USD" id="USD"
                                           class="form-control @error('name') error-data-input is-invalid @enderror"
                                           value="{{$model->USD??0}}" min="0" required>
                                    <span class="error-data">@error('name'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sum_uzb">{{__('locale.SUM UZB')}}</label>
                                    <input type="number" name="sum_uzb" id="sum_uzb"
                                           class="form-control @error('sum_uzb') error-data-input is-invalid @enderror"
                                           value="{{$model->SUM??0}}" min="0" step="0.01" required>
                                    <span class="error-data">@error('sum_uzb'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="submit" class="btn btn-success">{{__('locale.Confirm')}}</button>
                                    </div>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        let page_name = 'currency';
    </script>
@endsection
