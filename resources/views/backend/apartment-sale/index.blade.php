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
                        <h1 class="m-0">{{__('locale.apartment_sale')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.apartment_sale')}}</li>
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
                        <form style="display: inline-block;"  action="{{route('apartment-sale.alldestroy', app()->getLocale())}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-data-item btn btn-danger" title="delete"><i class="fas fa-trash">&nbsp;</i> {{__('locale.Delete all')}}</button>
                        </form>
                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        <div class="create-data" style="float: right;">
                            <a href="{{route('apartment-sale.create', app()->getLocale())}}" class=" style-add btn btn-primary">{{__('locale.create')}}</a>
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
                        <th>{{__('locale.image')}}</th>
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
                                    @else
                                        {{__('locale.Parser')}}
                                    @endif
                                </td>
                                <td>{{$model->title}}</td>
                                <td>{{$model->address}} </td>
                                <td>{{number_format(round($model->price, 2))}} {{ ($model->currency == 1) ? ' Доллар' : ' Сум'}}</td>
                                <td style="text-align: center">
                                    @if ($model->main_image && $model->main_image->guid)
                                        <img src="{{ asset('/uploads/apartment-sale/'.$model->id.'/m_'. $model->main_image->guid)}}" class="img-fluid mb-2" alt="" style="width: 100px; height: 100px"/>
                                    @endif
                                    @if($model->images)
                                        @if(is_array($model->images))
                                            @php($fimg = $model->images)
                                        @else
                                            @php($fimg = json_decode($model->images))
                                        @endif
                                        @if(is_array($fimg)&&$fimg[0])
                                            <img src="{{$fimg[0]}}" class="img-fluid mb-2" alt="" style="width: 100px; height: 100px"/>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div style="text-align: center;">
                                        <a href="{{route('apartment-sale.show', [app()->getLocale(), $model->id])}}" class="btn btn-primary" title="show"><i class="fas fa-eye"></i></a>
                                        <a href="{{route('apartment-sale.edit', [app()->getLocale(), $model->id])}}" class="btn btn-primary" title="update"><i class="fas fa-pencil-alt"></i></a>
                                        <form style="display: inline-block;" action="{{route('apartment-sale.destroy', [app()->getLocale(), $model->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-data-item btn btn-danger" title="delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <div style="clear:both !important">
                                        </div>

                                         {{-- @dd($model); --}}
                                        <a class="btn btn-primary btnParsing"  title="show" ><i class="fas fa-phone"></i></a>
                                        <input type="hidden" class="parsing_olx_url"  value="{{$model->olx_url}}">
                                        <input type="hidden" class="parsing_model_id"  value="{{$model->id}}">

                                          {{-- <a class="btn btn-primary" id="btnParsing" title="show"><i class="fas fa-phone"></i></a> --}}
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

    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

    <script type="text/javascript">
        $(document).on('click', '.btnParsing', function() {
            var _this = $(this)
            var parsing_olx_url = $(this).siblings(".parsing_olx_url").val();
            var parsing_model_id = $(this).siblings(".parsing_model_id").val();
            // console.log(parsing_model_id);
            $.post('{{ route('apartment-sale.parsing_numbere', app()->getLocale()) }}', {
                    _token: '{{ csrf_token() }}',
                    olx_url:parsing_olx_url ,
                    element_id: parsing_model_id,
                }, function(data) {
                    // console.log(data);
                    _this.siblings('.parsing_olx_url').attr('type', 'text').val(data);
                });
        });
    </script>













    <script>

        let current_language = '{{app()->getLocale()}}'
        // $(document).on('click', '#btnParsing', function(){
        //         // console.log('came');

        //     function parseUrl( url ) {
        //     var a = document.createElement('a');
        //     a.href = url;
        //     return a;
        // }

        // // parseUrl('http://example.com/form_image_edit.php?img_id=33').search

        //   jQuery.url.setUrl("https://www.olx.uz/d/obyavlenie/srochno-prodaetsya-svoya-kvartira-v-novostroyke-na-darhane-dyupleks-210-kv-ID2CYBM.html").attr("anchor") // returns 'footer'
        // });
        $(document).ready(function () {
            {{--$("#dashboard_datatable").DataTable({--}}
            {{--    "responsive": true,--}}
            {{--    "lengthChange": true,--}}
            {{--    "autoWidth": false,--}}
            {{--    "paging": false,--}}
            {{--    "language": {--}}
            {{--        "url": "{{asset('/backend-assets/plugins/datatables/dataTables.russian.json')}}"--}}
            {{--    }--}}
            {{--});--}}
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
            // $('[data-toggle=confirmation]').confirmation({
            //     rootSelector: '[data-toggle=confirmation]',
            //     onConfirm: function (event, element) {
            //         element.trigger('confirm');
            //     }
            // });
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

