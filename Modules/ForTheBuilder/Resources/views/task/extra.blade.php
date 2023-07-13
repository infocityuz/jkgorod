@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ translate('lead-lists') }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css') }}">
@endsection

<div class="modal fade" id="modal-default">
    <div class="modal-dialog" style="max-width: 700px">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h4 class="modal-title">Default Modal</h4> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="modal-form" action="{{ route('forthebuilder.task.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-primary" style="height: 95%">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="title">{{ __('locale.title') }}</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control @error('title') error-data-input is-invalid @enderror"
                                            value="{{ old('title') }}">
                                        <span class="error-data">
                                            @error('title')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="user_task_id">{{ __('locale.task_user_id') }}</label>
                                        <select name="user_task_id" id="user_task_id"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control select2 @error('user_task_id') is-invalid error-data-input @enderror">
                                            <option value="">------------</option>
                                            @empty(!$users)
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ Auth::user()->id == $user->id ? 'selected' : '' }}>
                                                        {{ $user->first_name }}</option>
                                                @endforeach
                                            @endempty
                                        </select>
                                        <span class="error-data">
                                            @error('user_task_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lead_id">{{ __('locale.leads') }}</label>
                                        <select name="lead_id" id="lead_id"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control select2bs4 @error('lead_id') is-invalid error-data-input @enderror">
                                            <option value="">------------</option>
                                            @empty(!$listLeads)
                                                @foreach ($listLeads as $lead)
                                                    <option value="{{ $lead->id }}">
                                                        {{ $lead->name . ' (' . $lead->series_number . ')' }}</option>
                                                @endforeach
                                            @endempty
                                        </select>
                                        <span class="error-data">
                                            @error('lead_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="task_type">{{ __('locale.task_type') }}</label>
                                        <select name="task_type" id="task_type"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control select2 @error('task_type') is-invalid error-data-input @enderror">
                                            <option value="Связаться">Связаться</option>
                                            <option value="Встреча">Встреча</option>
                                            <option value="Внедрение">Внедрение</option>
                                        </select>
                                        <span class="error-data">
                                            @error('task_type')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="prioritet">{{ __('locale.prioritet') }}</label>
                                        <select name="prioritet" id="prioritet"
                                            data-placeholder="{{ __('locale.select') }}"
                                            class="form-control select2 @error('prioritet') is-invalid error-data-input @enderror">
                                            <option value="Срочно">Срочно </option>
                                            <option value="Очень срочно">Очень срочно </option>
                                        </select>
                                        <span class="error-data">
                                            @error('prioritet')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="task_date">{{ __('locale.task_date') }}</label>
                                        <input type="text" name="task_date" id="task_date"
                                            class="form-control @error('task_date') error-data-input is-invalid @enderror"
                                            value="{{ old('task_date') }}">
                                        <span class="error-data">
                                            @error('task_date')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-footer justify-content-end" style="">
                                <button type="submit" class="btn btn-success">{{ __('locale.create') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <script>
        let page_name = 'tasks';
        $(document).ready(function() {

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

            $('#load-more').click(function() {
                var page = $(this).data('paginate');
                loadMoreData(page);
                $(this).data('paginate', page + 1);
            });

            $('#task_date').datetimepicker({
                format: 'Y-M-D',
            });

            // run function when user click load more button
            function loadMoreData(paginate) {
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/forthebuilder/lead-lists/getLeadList?page=' + paginate,
                        type: 'GET',
                        datatype: 'json',
                        beforeSend: function() {
                            $('#load-more').text('загрузка...');
                        }
                    })
                    .done(function(data) {
                        console.log(data)
                        if (data.length == 0) {
                            $('.invisible').removeClass('invisible');
                            $('#load-more').hide();
                            return;
                        } else {
                            $('#load-more').text('Загрузи больше...');
                            var models = data.data
                            var leadLists = '';
                            models.forEach(model => {
                                leadLists += `
                                <div class="items-1-id"  id="${model.id}" draggable="true" ondragstart="drag(event)">
                                    <div class="card card-light card-outline">
                                        <div class="card-header">
                                            <h5 class="card-title">
                                                <a href="forthebuilder/leads/show/+${model.id}" style="color: #212529">
                                                    <ion-icon name="person" style="color: #212529"></ion-icon> ${model. name} <br>
                                                    <ion-icon name="call" style="color: #212529"></ion-icon> ${model.phone}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            `
                            });
                            $('#deal-closed').append(leadLists);
                        }
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log('Something went wrong.');
                    });
            }
        });

        $(document).on('change', ':radio[name="filter"]', function() {
            var url = '/forthebuilder/task/';
            if ($(this).val() == '1') {
                var url = '/forthebuilder/task/filter-index';
            }

            window.location.replace(url)
        })
    </script>
@endsection
