@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{__('locale.task')}} @endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/toastr/toastr.min.css')}}">

    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css')}}">

@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('locale.task')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.task')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="breadcrumb-and-filter">
                <div class="row">
                    <div class="col-md-9">
                        <div class="action-content">
                            {{-- <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ route('student.destroyMultiple') }}">Belgilangan talabalarni o'chirish</button> --}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="create-data" style="float: right;">
                            <a href="{{route('forthebuilder.task.create')}}"
                               class=" style-add btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                {{__('locale.create')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <table id="dashboard_datatable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th ><input type="checkbox" id="master"></th>
                    <th >#</th>
                    <th >{{__('locale.task_user_id')}}</th>
                    <th>{{__('locale.task_date')}}</th>
                    <th>{{__('locale.type')}}</th>
                    <th>{{__('locale.status')}}</th>
                    <th>{{__('locale.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($models))
                    @foreach($models as $key => $model)
                        <tr>
                            <td style="width: 50px"><input type="checkbox" class="sub_chk" data-id="{{$model->id}}"></td>
                            <td style="width: 50px">{{ $models->firstItem()+$key }}</td>

                            <td>@if($model->userTask->first_name){{$model->userTask->first_name}}@endif</td>

                            <td>{{$model->task_date}}</td>
                            <td>{{$model->task_type}}</td>
                            <td>{{ $model->status }}</td>
                            {{--                            <td><a href="#" class="show-status" data-id="{{ $model->id }}" data-price-two="{{ $model->deal->plan->month_pay_second }}" data-price="{{ $model->deal->plan->month_pay_first }}">{{__('locale.show-status')}}</a></td>--}}
                            <td>
                                <div style="text-align: center;">
                                    <a href="{{route('forthebuilder.task.show',$model->id)}}" class="btn btn-primary" title="show"><i class="fas fa-eye"></i></a>
                                    <a href="{{route('forthebuilder.task.edit',$model->id)}}" class="btn btn-primary" title="update"><i class="fas fa-pencil-alt"></i></a>
                                    <form style="display: inline-block;" action="{{route('forthebuilder.task.destroy',$model->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-data-item btn btn-danger" title="delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog" style="max-width: 700px">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h4 class="modal-title">Default Modal</h4>--}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  id="modal-form" action="{{route('forthebuilder.task.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-primary" style="height: 95%">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="title">{{__('locale.title')}}</label>
                                            <input type="text" name="title" id="title"
                                                   class="form-control @error('title') error-data-input is-invalid @enderror"
                                                   value="{{ old('title') }}">
                                            <span class="error-data">@error('title'){{$message}}@enderror</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="user_task_id">{{__('locale.task_user_id')}}</label>
                                            <select name="user_task_id" id="user_task_id"
                                                    data-placeholder="{{__('locale.select')}}"
                                                    class="form-control select2 @error('user_task_id') is-invalid error-data-input @enderror" >
                                                <option value="">------------</option>
                                                @empty(!$users)
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ (Auth::user()->id == $user->id) ? 'selected' : '' }}>{{ $user->first_name }}</option>
                                                    @endforeach
                                                @endempty
                                            </select>
                                            <span class="error-data">@error('user_task_id'){{$message}}@enderror</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="lead_id">{{__('locale.leads')}}</label>
                                            <select name="lead_id" id="lead_id"
                                                data-placeholder="{{__('locale.select')}}"
                                                class="form-control select2bs4 @error('lead_id') is-invalid error-data-input @enderror" 
                                            >
                                                <option value="">------------</option>
                                                @empty(!$listLeads)
                                                    @foreach($listLeads as $lead)
                                                        <option value="{{ $lead->id }}" >{{ $lead->name . ' (' . $lead->series_number . ')' }}</option>
                                                    @endforeach
                                                @endempty
                                            </select>
                                            <span class="error-data">@error('lead_id'){{$message}}@enderror</span>
                                        </div>

                                        {{-- <div class="form-group">--}}
                                        {{-- <label for="user_task_id">{{__('locale.user_task_id')}}</label>--}}
                                        {{--                            <select name="user_task_id" id="user_task_id"--}}
                                        {{--                                    data-placeholder="{{__('locale.select')}}"--}}
                                        {{--                                    class="form-control select2 @error('user_task_id') is-invalid error-data-input @enderror" >--}}
                                        {{--                                <option value="">------------</option>--}}
                                        {{--                                @empty(!$users)--}}
                                        {{--                                    @foreach($users as $user)--}}
                                        {{--                                        <option value="{{ $user->id }}" >{{ $user->first_name }}</option>--}}
                                        {{--                                    @endforeach--}}
                                        {{--                                @endempty--}}
                                        {{--                            </select>--}}
                                        {{--                            <span class="error-data">@error('user_task_id'){{$message}}@enderror</span>--}}
                                        {{--                        </div>--}}

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="task_type">{{__('locale.task_type')}}</label>
                                            <select name="task_type" id="task_type"
                                                    data-placeholder="{{__('locale.select')}}"
                                                    class="form-control select2 @error('task_type') is-invalid error-data-input @enderror" >
                                                <option value="Связаться">Связаться</option>
                                                <option value="Встреча">Встреча</option>
                                                <option value="Внедрение">Внедрение</option>
                                            </select>
                                            <span class="error-data">@error('task_type'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="prioritet">{{__('locale.prioritet')}}</label>
                                            <select name="prioritet" id="prioritet"
                                                    data-placeholder="{{__('locale.select')}}"
                                                    class="form-control select2 @error('prioritet') is-invalid error-data-input @enderror" >
                                                <option value="Срочно">Срочно </option>
                                                <option value="Очень срочно">Очень срочно </option>
                                            </select>
                                            <span class="error-data">@error('prioritet'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="task_date">{{__('locale.task_date')}}</label>
                                            <input type="text" name="task_date" id="task_date"
                                                   class="form-control @error('task_date') error-data-input is-invalid @enderror"
                                                   value="{{ old('task_date') }}" >
                                            <span class="error-data">@error('task_date'){{$message}}@enderror</span>
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
                </div>
{{--                <div class="modal-footer justify-content-between">--}}
{{--                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                </div>--}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

{{--    <aside class="main-sidebar sidebar-dark-primary elevation-4 right__sidebar ">--}}
{{--        <!-- Sidebar -->--}}
{{--        <div class="sidebar">--}}
{{--            <nav class="mt-2">--}}

{{--                <div class="close_sidebar">--}}
{{--                    <span>×</span>--}}
{{--                </div>--}}
{{--                <div id="flatItemDetailImg">--}}

{{--                </div>--}}
{{--                <table class="table-status" id="flatItemDetailTable">--}}
{{--                    <tr>--}}
{{--                        <th>№</th>--}}
{{--                        <th>Статус</th>--}}
{{--                        <th>Цена</th>--}}
{{--                        <th>Дата начала</th>--}}
{{--                    </tr>--}}

{{--                    <tr class="status-tr" data-id="1">--}}
{{--                        <td class="status-number">1</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="2">--}}
{{--                        <td class="status-number">2</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="3">--}}
{{--                        <td class="status-number">3</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="4">--}}
{{--                        <td class="status-number">4</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="5">--}}
{{--                        <td class="status-number">5</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="6">--}}
{{--                        <td class="status-number">6</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="7">--}}
{{--                        <td class="status-number">7</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="8">--}}
{{--                        <td class="status-number">8</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="9">--}}
{{--                        <td class="status-number">9</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="10">--}}
{{--                        <td class="status-number">10</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="11">--}}
{{--                        <td class="status-number">11</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr" data-id="12">--}}
{{--                        <td class="status-number">12</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status" >--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}

{{--                    <tr class="status-tr two" data-id="13">--}}
{{--                        <td class="status-number">13</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="14">--}}
{{--                        <td class="status-number">14</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="15">--}}
{{--                        <td class="status-number">15</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="16">--}}
{{--                        <td class="status-number">16</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="17">--}}
{{--                        <td class="status-number">17</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="18">--}}
{{--                        <td class="status-number">18</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="19">--}}
{{--                        <td class="status-number">19</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="20">--}}
{{--                        <td class="status-number">20</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="21">--}}
{{--                        <td class="status-number">21</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="22">--}}
{{--                        <td class="status-number">22</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="23">--}}
{{--                        <td class="status-number">23</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status">--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}
{{--                    <tr class="status-tr two" data-id="24">--}}
{{--                        <td class="status-number">24</td>--}}
{{--                        <td >--}}
{{--                            <select class="plan_status" >--}}

{{--                            </select>--}}
{{--                        </td>--}}
{{--                        <td class="status-price"></td>--}}
{{--                        <td class="status-date"></td>--}}
{{--                    </tr>--}}

{{--                </table>--}}

{{--                <div class="text-center" style="display: flex;justify-content: center;align-items: center">--}}
{{--                    <div id="for-preloader" role="status">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </nav>--}}
{{--        </div>--}}
{{--        <!-- /.sidebar -->--}}
{{--    </aside>--}}

@endsection

@section('scripts')
    <script src="{{asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>

    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

    <script>
        let page_name = 'tasks';
    $(document).ready(function () {
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            // tags: "true",
            // placeholder: "Select an option",
            // allowClear: true,
            // autoFocus: true
        })

        $('#task_date').datetimepicker({
            format: 'Y-M-D',
        });
        $('#modal-form').validate({
            rules: {
                task_date: {
                    required: true,
                },
            },
            messages: {
                task_date: {
                    required: " task date Поле, обязательное для заполнения.",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        //pay-status

        $('.show-status').on('click',function (e) {

            e.preventDefault();

            $('.forthebuilder').addClass('active');
            $('.right__sidebar').addClass('active');

            var id = $(this).data('id');
            let price = $(this).data('price');
            let priceTwo = $(this).data('price-two');

            // $.ajaxSetup({
            //     beforeSend: function() {
            //         // TODO: show your spinner
            //         $("#for-preloader").addClass('spinner-border');
            //     },
            //     complete: function() {
            //         // TODO: hide your spinner
            //         $("#for-preloader").removeClass('spinner-border');
            //     }
            // });

            $.ajax({
                url: `/forthebuilder/installment-plan/get-status/${id}`,
                // data: {status: selectedstatuses},
                type: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {

                    let statuses = data.statuses;
                    $.each(statuses, function(index, element) {
                        let i = index+1;
                        let color = '';
                        let status1 = '';
                        let status2 = '';
                        if(element.status == 'Не оплачен'){
                            color = 'red';
                            status1 = 'selected';
                        }else{
                            color = 'rgb(25,132,86)';
                            status2 = 'selected';
                        }

                        if(priceTwo>0){
                            $('#flatItemDetailTable .two').show();

                            if(i<13){
                                if($('.status-tr[data-id='+i+']').data('id') == i){
                                    $('.status-tr[data-id='+i+'] .status-price').text(price);
                                    $('.status-tr[data-id='+i+'] .status-date').text(element.pay_start_date);

                                    $('.status-tr[data-id='+i+'] .plan_status').attr('data-id',element.id);
                                    $('.status-tr[data-id='+i+'] .plan_status').css('background',color);
                                    $('.status-tr[data-id='+i+'] .plan_status').html(
                                        "<option value='Не оплачен' " + status1 + ">Не оплачен</option>" +
                                        "<option value='Оплачен'" + status2 + ">Оплачен</option>");
                                }
                            }else if(i>12){
                                if($('.status-tr[data-id='+i+']').data('id') == i){
                                    $('.status-tr[data-id='+i+'] .status-price').text(priceTwo);
                                    $('.status-tr[data-id='+i+'] .status-date').text(element.pay_start_date);

                                    $('.status-tr[data-id='+i+'] .plan_status').attr('data-id',element.id);
                                    $('.status-tr[data-id='+i+'] .plan_status').css('background',color);
                                    $('.status-tr[data-id='+i+'] .plan_status').html(
                                        "<option value='Не оплачен' " + status1 + ">Не оплачен</option>" +
                                        "<option value='Оплачен'" + status2 + ">Оплачен</option>");
                                }
                            }
                        }else{
                            $('#flatItemDetailTable .two').hide();
                            if($('.status-tr[data-id='+i+']').data('id') == i){
                                $('.status-tr[data-id='+i+'] .status-price').text(price);
                                $('.status-tr[data-id='+i+'] .status-date').text(element.pay_start_date);

                                $('.status-tr[data-id='+i+'] .plan_status').attr('data-id',element.id);
                                $('.status-tr[data-id='+i+'] .plan_status').css('background',color);
                                $('.status-tr[data-id='+i+'] .plan_status').html(
                                    "<option value='Не оплачен' " + status1 + ">Не оплачен</option>" +
                                    "<option value='Оплачен'" + status2 + ">Оплачен</option>");
                            }
                        }


                    });
                },
                error: function (data) {
                    console.log(data);
                }
            });

        });

        $('.plan_status').on('change',function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            var selectedstatuses = $(this).val();
            $.ajax({
                url: `/forthebuilder/installment-plan/update-status/${id}`,
                data: {status: selectedstatuses},
                type: 'PUT',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(data['warning']){
                        toastr.warning(data['warning']);
                    }
                    if(data['success']){
                        toastr.success(data['success']);
                    }
                    if(data['status'] == 'Не оплачен'){
                        color = 'red';
                        status1 = 'selected';
                    }else{
                        color = 'rgb(25,132,86)';
                        status2 = 'selected';
                    }
                    $('.plan_status[data-id='+data['id']+']').css('background',color);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        })

        $('.close_sidebar span').on('click',function (e) {
            e.preventDefault();
            $('.forthebuilder').removeClass('active');
            $('.right__sidebar').removeClass('active');
        });

        //pay-status

        $("#dashboard_datatable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": false,
            "language": {
                "url": "{{asset('/backend-assets/plugins/datatables/dataTables.russian.json')}}"
            }
        });

        let sessionSuccess ="{{session('success')}}";
        if(sessionSuccess){
            toastr.success(sessionSuccess)
        }
        let sessionWarning = "{{session('warning')}}";
        if(sessionWarning){
            toastr.success(sessionWarning)
        }
        let sessionError = "{{session('error')}}";
        if(sessionError){
            toastr.success(sessionError)
        }


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))
         {
            $(".sub_chk").prop('checked', true);
         } else {
            $(".sub_chk").prop('checked',false);
         }
        });

        $('.delete_all').on('click', function(e) {

            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if(allVals.length <=0)
            {
                alert("Please select row.");
            }  else {

                var check = confirm("Belgilangan qatorlarni o'chirishga ishonchingiz komilmi?");
                if(check == true){

                    var join_selected_values = allVals.join(",");

                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }
            }
        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();

            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });

            return false;
        });

    });
</script>
@endsection







