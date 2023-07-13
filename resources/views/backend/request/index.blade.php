@extends('layouts.backend')
@section('title') {{__('locale.apartment_sale')}}  @endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/toastr/toastr.min.css')}}">
@endsection
<style>
    .display-none{
        display: none;
    }
    @media screen and (max-width: 600px) {
        .modal-dialog{
            max-width: 94%
        }
    }
    @media screen and (min-width: 601px) {
        .modal-dialog{
            max-width: 70%
        }
    }
    .modal-dialog-interval{
        display: flex;
        justify-content: center;
    }
    .modal-content-interval{
        width: 40%;
        text-align: center;
        border-radius: 4px;
    }
    #parsing_filter_process{
        padding: 7px 0px;
        background-color: green;
        margin-bottom: 20px;
    }
</style>
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('locale.Request')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.Request')}}</li>
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
                    <div class="col-md-6">
                        <div class="action-content">
                            {{--                            <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ route('student.destroyMultiple') }}">Belgilangan talabalarni o'chirish</button>--}}
                        </div>
                        <form style="display: inline-block;" action="{{route('request.alldestroy', app()->getLocale())}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-data-item btn btn-danger" title="delete"><i class="fas fa-trash">&nbsp;</i> {{__('locale.Delete all')}}</button>
                        </form>
                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        <div class="create-data" style="float: right;">
                            <a href="{{route('request.create', app()->getLocale())}}" class=" style-add btn btn-primary">{{__('locale.create')}}</a>
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
                        <th><input type="checkbox" id="master"></th>
                        <th>#</th>
                        <th>{{__('locale.author')}}</th>
                        <th>{{__('locale.title')}}</th>
                        <th>{{__('locale.address')}}</th>
                        <th>{{__('locale.price')}}</th>
                        <th>{{__('locale.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($models))
                        @foreach($models as $key => $model)
                            <tr>
                                <td><input type="checkbox" class="sub_chk" data-id="{{$model->id}}"></td>
                                <td>{{ $models->firstItem()+$key }}</td>
                                <td>
                                    @if ($model->user)
                                        {{$model->user->first_name}}
                                    @endif
                                </td>
                                <td>{{$model->title}}</td>
                                <td>{{$model->address}} </td>
                                <td>{{number_format(round($model->price_from, 2)) .' - '.number_format(round($model->price_to, 2))}} {{ ($model->currency == 1) ? ' Сум' : ' Доллар'}}</td>
                                <td>
                                    <div style="text-align: center;">
                                        <a href="{{route('request.show', [app()->getLocale(), $model->id])}}" class="btn btn-primary" title="show"><i class="fas fa-eye"></i></a>
                                        <a href="{{route('request.edit', [app()->getLocale(), $model->id])}}" class="btn btn-primary" title="update"><i class="fas fa-pencil-alt"></i></a>
                                        <form style="display: inline-block;" action="{{route('request.destroy', [app()->getLocale(), $model->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-data-item btn btn-danger" title="delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                        {{-- <div style="clear:both !important">
                                        </div> --}}
                                        {{--                                        <a class="btn btn-primary" id="btnParsing" title="show"><i class="fas fa-phone"></i></a>--}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $models->links() }}
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    {{--    <script src="{{asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    {{--    <script src="{{asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/backend-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/backend-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/backend-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>--}}
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>
    <script>

        let current_language = '{{app()->getLocale()}}'

        $(document).ready(function () {
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
                    alert("Выберите строку.");
                }  else {
                    var check = confirm("Вы уверены, что хотите удалить выбранные строки?");
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

