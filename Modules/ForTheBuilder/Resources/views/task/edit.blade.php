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
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.task.index')}}">{{__('locale.task')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.update')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('forthebuilder.task.update',$model->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">{{__('locale.title')}}</label>
                            <input type="text" name="title" id="title"
                                   class="form-control @error('title') error-data-input is-invalid @enderror"
                                   value="{{ $model->title }}">
                            <span class="error-data">@error('title'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="performer_id">{{__('locale.task_user_id')}}</label>
                            <select name="performer_id" id="performer_id"
                                    data-placeholder="{{__('locale.select')}}"
                                    class="form-control select2 @error('performer_id') is-invalid error-data-input @enderror" >
                                @empty(!$users)
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ ($model->performer_id == $user->id) ? 'selected' : '' }}>{{ $user->first_name }}</option>
                                    @endforeach
                                @endempty
                            </select>
                            <span class="error-data">@error('performer_id'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="prioritet">{{__('locale.prioritet')}}</label>
                            <select name="prioritet" id="prioritet"
                                    data-placeholder="{{__('locale.select')}}"
                                    class="form-control select2 @error('prioritet') is-invalid error-data-input @enderror" >
                                <option value="Срочно" {{ ($model->prioritet == 'Срочно') ? 'selected' : '' }}>Срочно </option>
                                <option value="Очень срочно" {{ ($model->prioritet == 'Очень срочно') ? 'selected' : '' }}>Очень срочно </option>
                            </select>
                            <span class="error-data">@error('prioritet'){{$message}}@enderror</span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="type">{{__('locale.type')}}</label>
                            <select name="type" id="type"
                                    data-placeholder="{{__('locale.select')}}"
                                    class="form-control select2 @error('type') is-invalid error-data-input @enderror" >
                                <option value="Связаться" {{ ($model->type == 'Связаться') ? 'selected' : '' }}>Связаться</option>
                                <option value="Встреча" {{ ($model->type == 'Встреча') ? 'selected' : '' }}>Встреча</option>
                                <option value="Внедрение" {{ ($model->type == 'Внедрение') ? 'selected' : '' }}>Внедрение</option>
                            </select>
                            <span class="error-data">@error('type'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="task_date">{{__('locale.task_date')}}</label>
                            <input type="text" name="task_date" id="task_date"
                                   class="form-control @error('task_date') error-data-input is-invalid @enderror"
                                   value="{{ $model->task_date }}" required>
                            <span class="error-data">@error('task_date'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="status">{{__('locale.status')}}</label>
                            <select name="status" id="status"
                                    data-placeholder="{{__('locale.select')}}"
                                    class="form-control select2 @error('status') is-invalid error-data-input @enderror" >
                                <option value="Новый" {{ ($model->status == 'Новый') ? 'selected' : '' }}>Новый</option>
                                <option value="Процес" {{ ($model->status == 'Процес') ? 'selected' : '' }}>Процес</option>
                                <option value="Закрыто" {{ ($model->status == 'Закрыто') ? 'selected' : '' }}>Закрыто</option>
                            </select>
                            <span class="error-data">@error('status'){{$message}}@enderror</span>
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

@endsection

@section('scripts')
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>

    <script>
        let page_name = 'tasks';
        $(document).ready(function () {

            $('#start_date').datetimepicker({
                format: 'Y-M-D',
            });

            // Rasrochka hisob kitoblari amalga oshirilmoqda

            let startPrice1 = parseInt($('#an_initial_fee').val());
            let price1 = parseInt($('#price').val());

            $('#an_initial_fee').on('input',function (e) {
                let price = parseInt($('#price').val());
                let percent = parseInt($('#percent').val())/100;
                let startPrice = parseInt($('#an_initial_fee').val());

                let period = $('#period').val();

                let result = ((price - startPrice) + (price - startPrice)*percent) / 12;
                if(price > 0){
                    $('#month_pay_first').val(result.toFixed(3));
                }

            })

            $('#percent').on('input',function (e) {
                let price = parseInt($('#price').val());
                let percent = parseInt($('#percent').val())/100;
                let startPrice = parseInt($('#an_initial_fee').val());

                let period = $('#period').val();

                if(period === '24 месяц'){
                    let firstYear = ((price - startPrice) + (price - startPrice)*percent)/2;
                    let result2 = (firstYear + firstYear*percent)/12;
                    let result = ((price - startPrice) + (price - startPrice)*percent) / 24;

                    if(result > 0){
                        $('#month_pay_second').val(result2);
                        $('#month_pay_first').val(result.toFixed(3));
                    }else{
                        $('#month_pay_first').val('');
                        $('#month_pay_first').val('');
                    }
                }else{
                    let result = ((price - startPrice) + (price - startPrice)*percent) / 12;

                    if(result > 0){
                        $('#month_pay_first').val(result.toFixed(3));
                    }else{
                        $('#month_pay_first').val('');
                    }
                }

            })

            $('#period').on('change',function (e) {
                let price = parseInt($('#price').val());
                let percent = parseInt($('#percent').val())/100;
                let startPrice = parseInt($('#an_initial_fee').val());

                let period = $('#period').val();

                if(period === '24 месяц'){
                    let firstYear = ((price - startPrice) + (price - startPrice)*percent)/2;
                    let result2 = (firstYear + firstYear*percent)/12;
                    let result = ((price - startPrice) + (price - startPrice)*percent) / 24;

                    if(result > 0){
                        $('#month_pay_second').val(result2);
                        $('#month_pay_first').val(result.toFixed(3));
                    }
                }else{
                    let result = ((price - startPrice) + (price - startPrice)*percent) / 12;
                    $('#month_pay_second').val('');
                    if(result > 0){
                        $('#month_pay_first').val(result.toFixed(3));
                    }
                }

            })

            // Rasrochka hisob kitoblari amalga oshirilmoqda

        });
    </script>
@endsection

