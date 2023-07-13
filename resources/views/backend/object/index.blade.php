@extends('layouts.backend')
@section('title')
    Object
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('locale.object') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">{{ __('locale.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('locale.object') }}</li>
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
                            {{--                            <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ route('student.destroyMultiple') }}">Belgilangan talabalarni o'chirish</button> --}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="create-data" style="float: right;">
                            <a href="{{ route('object.create', app()->getLocale()) }}"
                               class=" style-add btn btn-primary">{{ __('locale.create') }}</a>
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
                        <th>{{ __('locale.title') }}</th>
                        <th>{{ __('locale.user') }}</th>
                        <th>{{ __('locale.address') }}</th>
                        <th>{{ __('locale.price') }}</th>
                        <th>{{ __('locale.image') }}</th>
                        <th>{{ __('locale.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($models as $key => $model)
                        <tr>
                            {{-- @dd($model->main_image) --}}
                            <td><input type="checkbox" class="sub_chk" data-id="{{ $model->id }}"></td>
                            <td scope="row">{{ $models->firstItem() + $key }}</td>
                            <td>{{ $model->title }}</td>
                            <td>{{ $model->user->first_name }}</td>
                            <td>{{ $model->address }}</td>
                            <td>{{ $model->price }}</td>
                            <td style="text-align: center">
                                @if (!empty($model->mainImage))
                                    <img src="{{ asset('/uploads/object/images/' . $model->id . '/m_' . $model->mainImage->guid) }}"
                                         class="img-fluid mb-2" alt="" style="width: 100px; height: 100px" />
                                @endif
                            </td>
                            <td>
                                <div style="text-align: center;">
                                    <a href="{{ route('object.show', [app()->getLocale(), $model->id]) }}"
                                       class="btn btn-primary" title="show"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('object.edit', [app()->getLocale(), $model->id]) }}"
                                       class="btn btn-primary" title="update"><i class="fas fa-pencil-alt"></i></a>
                                    <form style="display: inline-block;"
                                          action="{{ route('object.destroy', [app()->getLocale(), $model->id]) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-data-item btn btn-danger" title="delete"><i
                                                    class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $models->links() }}
            </div>
        </div>



    </div>

    <style>

    </style>
@endsection

@section('scripts')
    <script src="{{ asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#dashboard_datatable").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "paging": false,
                "language": {
                    "url": "{{ asset('/backend-assets/plugins/datatables/dataTables.russian.json') }}"
                }

            });

            let sessionSuccess = "{{ session('success') }}";
            if (sessionSuccess) {
                toastr.success(sessionSuccess)
            }
            let sessionWarning = "{{ session('warning') }}";
            if (sessionWarning) {
                toastr.success(sessionWarning)
            }
            let sessionError = "{{ session('error') }}";
            if (sessionError) {
                toastr.success(sessionError)
            }

            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });

            // $('[data-toggle=confirmation]').confirmation({
            //     rootSelector: '[data-toggle=confirmation]',
            //     onConfirm: function(event, element) {
            //         element.trigger('confirm');
            //     }
            // });

            $(document).on('confirm', function(e) {
                var ele = e.target;
                e.preventDefault();

                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function(data) {
                        alert(data.responseText);
                    }
                });

                return false;
            });

        });
    </script>
@endsection
