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
    <div class="status">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="badge badge-danger">
                    {{$error}}
                </div>
            @endforeach
        @endif
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
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.booking.index')}}">{{__('locale.booking')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.update')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('forthebuilder.booking.update',$model->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-6">
                {{__("locale.Number of flat")}}:<b> {{$model->HouseFlat->number_of_flat}}</b><br>
                {{__("locale.Total area")}}:<b> {{$model->HouseFlat->total_area}}</b> m<sup>2</sup>
            </div>
            <div class="col-6">
                {{__("locale.Flat price")}}:<b> {{number_format($model->HouseFlat->price*$model->HouseFlat->total_area, 2)}}</b>  $<br>
                {{__("locale.Room of flat")}}:<b> {{$model->HouseFlat->room_count}}</b>
            </div>
        </div>
        @if($model->read == 1)
            <div class="row">
                <div class="col-12 color-yellow">
                    <span>{{__('locale.advance period expired')}}</span>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="name">{{__('locale.name')}}</label>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') error-data-input is-invalid @enderror"
                           value="{{$model->name, old('name') }}">
                    <span class="error-data">@error('name'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="surname">{{__('locale.surname')}}</label>
                    <input type="text" name="surname" id="surname"
                           class="form-control @error('surname') error-data-input is-invalid @enderror"
                           value="{{$model->surname,  old('surname') }}">
                    <span class="error-data">@error('surname'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="patronymic">{{__('locale.patronymic')}}</label>
                    <input type="text" name="patronymic" id="patronymic"
                           class="form-control @error('patronymic') error-data-input is-invalid @enderror"
                           value="{{$model->patronymic,  old('patronymic') }}">
                    <span class="error-data">@error('patronymic'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="phone">{{__('locale.phone')}}</label>
                    <input type="text" name="phone" id="phone"
                           class="form-control @error('phone') error-data-input is-invalid @enderror"
                           value="{{$model->phone,  old('phone') }}">
                    <span class="error-data">@error('phone'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="series_number">{{__('locale.series_number')}}</label>
                    <input type="text" name="series_number" id="series_number"
                           class="form-control @error('series_number') error-data-input is-invalid @enderror"
                           value="{{$model->series_number,  old('series_number') }}">
                    <span class="error-data">@error('series_number'){{$message}}@enderror</span>
                </div>
                <div class="form-group"  id="prepayment_summa">
                    <label for="prepayment_summa">{{__('locale.prepayment summa')}}</label>
                    <input type="text" name="prepayment_summa"
                           class="form-control @error('prepayment_summa') error-data-input is-invalid @enderror"
                           value="{{$model->prepayment, old('prepayment_summa') }}">
                    <span class="error-data">@error('prepayment_summa'){{$message}}@enderror</span>
                </div>
                <input type="hidden" id="house_flat_id" name="house_flat_id" value="{{$model->house_flat_id}}">
                <div class="form-group">
                    <span class="error-data">{{__('locale.the day of the advance')}}: {{$model->updated_at}}</span>
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
    <style>
        .color-yellow{
            color: #AA6F01;
            display:flex;
            justify-content: center;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script>
        let page_name = 'booking';
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

    </script>
@endsection

