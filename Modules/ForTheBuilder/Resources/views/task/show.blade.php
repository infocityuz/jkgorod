@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ translate('show') }}
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
                        <h1 class="m-0">{{ translate('installment_plan') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('forthebuilder.index') }}">{{ translate('home') }}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('forthebuilder.task.index') }}">{{ translate('task') }}</a></li>
                            <li class="breadcrumb-item active">{{ translate('show') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-block table-border-style">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Атрибут</th>
                            <th>Данные</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><b>{{ translate('title') }}</b></td>
                            <td>{{ $model->title }}</td>
                        </tr>
                        <tr>
                            <td><b>{{ translate('task_user_id') }}</b></td>
                            <td>{{ isset($model->performer) ? $model->performer->last_name . ' ' . $model->performer->first_name . ' ' . $model->performer->middle_name : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td><b>{{ translate('type') }}</b></td>
                            <td>{{ $model->type }}</td>
                        </tr>
                        <tr>
                            <td><b>{{ translate('task_date') }}</b></td>
                            <td>{{ $model->task_date }}</td>
                        </tr>
                        <tr>
                            <td><b>{{ translate('prioritet') }}</b></td>
                            <td>{{ $model->prioritet }}</td>
                        </tr>
                        <tr>
                            <td><b>{{ translate('status') }}</b></td>
                            <td>
                                <select name="status" id="status" data-id="{{ $model->id }}"
                                    data-placeholder="{{ translate('select') }}"
                                    class="form-control select2 @error('status') is-invalid error-data-input @enderror">
                                    <option value="Новый" {{ $model->status == 'Новый' ? 'selected' : '' }}>Новый
                                    </option>
                                    <option value="Процес" {{ $model->status == 'Процес' ? 'selected' : '' }}>Процес
                                    </option>
                                    <option value="Закрыто" {{ $model->status == 'Закрыто' ? 'selected' : '' }}>Закрыто
                                    </option>
                                </select>
                                <span class="error-data">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>

    <script>
        let page_name = 'tasks';
        $('#status').on('change', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            var selectedstatuses = $(this).val();
            console.log(id)
            $.ajax({
                url: `/forthebuilder/task/update-status/${id}`,
                data: {
                    status: selectedstatuses
                },
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data['warning']) {
                        toastr.warning(data['warning']);
                    }
                    if (data['success']) {
                        toastr.success(data['success']);
                    }
                    // if(data['status'] == 'Не оплачен'){
                    //     color = 'red';
                    //     status1 = 'selected';
                    // }else{
                    //     color = 'rgb(25,132,86)';
                    //     status2 = 'selected';
                    // }
                    // $('.plan_status[data-id='+data['id']+']').css('background',color);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        })
    </script>
@endsection
