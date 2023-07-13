@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ __('locale.leads') }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/toastr/toastr.min.css') }}">
@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('locale.lead-lists') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('forthebuilder.index') }}">{{ __('locale.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('locale.leads') }}</li>
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
                            <a href="{{ route('forthebuilder.leads.create') }}"
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
                            {{-- <th><input type="checkbox" id="master"></th> --}}
                            <th>#</th>
                            <th>{{ __('locale.name') }}</th>
                            <th>{{ __('locale.phone_number') }}</th>
                            <th>{{ __('locale.referer') }}</th>
                            <th>{{ __('locale.sent') }}</th>
                            <th>{{ __('locale.status') }}</th>
                            <th>{{ __('locale.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($models))
                            @foreach ($models as $key => $model)
                                <tr>
                                    {{-- <td><input type="checkbox" class="sub_chk" data-id="{{$model->id}}"></td> --}}
                                    <td scope="row">{{ $models->firstItem() + $key }}</td>
                                    <td>{{ $model->name }}</td>
                                    <td>{{ $model->phone }}</td>
                                    <td>{{ $model->referer }}</td>
                                    <td>{{ $model->created_at }}</td>
                                    {{--                            <td>{{$model->interview_date}}</td> --}}
                                    <td>{{ $model->leadStatus->name }}</td>
                                    <td>
                                        <div style="text-align: center;">
                                            <a href="{{ route('forthebuilder.leads.show', $model->id) }}"
                                                class="btn btn-primary" title="show"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('forthebuilder.leads.edit', $model->id) }}"
                                                class="btn btn-primary" title="update"><i class="fas fa-pencil-alt"></i></a>
                                            <form style="display: inline-block;"
                                                action="{{ route('forthebuilder.leads.destroy', $model->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-data-item btn btn-danger"
                                                    title="delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ !empty($models) ? $models->links() : '' }}
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        let page_name = 'leads';
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

        });
    </script>
@endsection
