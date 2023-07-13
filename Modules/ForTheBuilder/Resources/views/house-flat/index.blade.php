@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{__('locale.house')}} @endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
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
                        <h1 class="m-0">{{__('locale.house')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.house')}}</li>
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
{{--                            <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ route('student.destroyMultiple') }}">Belgilangan talabalarni o'chirish</button>--}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="create-data" style="float: right;">
                            <a href="{{route('forthebuilder.house-flat.create')}}" class=" style-add btn btn-primary">{{__('locale.create')}}</a>
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
                    <th>{{__('locale.house_name')}}</th>
                    <th>{{__('locale.flat')}}</th>
                    <th>{{__('locale.price')}}</th>
                    <th>{{__('locale.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($models))
                    @foreach($models as $key => $model)
                        <tr>
                            <td><input type="checkbox" class="sub_chk" data-id="{{$model->id}}"></td>
                            <td scope="row">{{ $models->firstItem()+$key }}</td>
                            <td>{{$model->house->house_number}}</td>
                            <td>{{$model->number_of_flat}}</td>
                            <td>
                                @if(!empty($model->price))
                                    {{$model->price}}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div style="text-align: center;">
                                    <a href="{{route('forthebuilder.house-flat.show',$model->id)}}" class="btn btn-primary" title="show"><i class="fas fa-eye"></i></a>
                                    <a href="{{route('forthebuilder.house-flat.edit',$model->id)}}" class="btn btn-primary" title="update"><i class="fas fa-pencil-alt"></i></a>
                                    <form style="display: inline-block;" action="{{route('forthebuilder.house-flat.destroy',$model->id)}}" method="POST">
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
              <div class="mt-2">
                  {{ $models->links() }}
              </div>
            </div>
        </div>

    </div>


@endsection

@section('scripts')
    <script src="{{asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>
<script>
    let page_name = 'house-flat';
    $(document).ready(function () {
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







