@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ translate('deal-lists') }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
@endsection
@section('content')
    <div class="page-header card"></div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ translate('deal') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('forthebuilder.index') }}">{{ translate('home') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ translate('List') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function drag(ev) {
            ev.dataTransfer.setData("id", ev.target.id);
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drop(ev) {
            ev.preventDefault();
            var id = ev.dataTransfer.getData("id");
            ev.currentTarget.appendChild(document.getElementById(id));
            var type = ev.currentTarget.getAttribute('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/forthebuilder/client-lists/update-type/" + id,
                data: {
                    type: type
                },
                type: 'PUT',
                dataType: "json",
                success: function(data) {
                    let statusCounts = data['mStatus'];
                    for (const [key, value] of Object.entries(statusCounts)) {
                        $(`#status-id-${key}`).text(`${value}`);
                    }

                    toastr.success(data['success']);
                },
                error: function(data) {
                    console.log(data.responseText);
                }
            });
        }
    </script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper kanban">
        <section class="content pb-3">
            <div class="container-fluid h-100">
                @empty(!$model)
                    @foreach ($model as $key => $value)
                        <div class="card card-row ">
                            <div class="card-header lead-list-header">
                                <h3 class="card-title lead-list-header-title">
                                    {{ $key }}
                                </h3>
                                <h3 class="card-title lead-list-header-title">
                                    <span id="status-id-{{ 1 }}">{{ count($value['list']) }}</span>
                                </h3>
                            </div>
                            <div class="lead-list-create">
                                <a href="{{ route('forthebuilder.clients.create', ['status' => 1]) }}"
                                    class="lead-list-create-a">
                                    {{ translate('create lead') }}
                                    {{-- {{ __('locale.create') }} {{ __('locale.lead') }} --}}
                                </a>
                            </div>
                            <div class="card-body " id="{{ $value['type'] }}" ondrop="drop(event)"
                                ondragover="allowDrop(event)">
                                @foreach ($value['list'] as $val)
                                    <div class="items-1-id" id="{{ $val['id'] }}" draggable="true"
                                        ondragstart="drag(event)">
                                        <div class="card card-light card-outline">
                                            <div class="card-header">
                                                <div class="">
                                                    <p>
                                                        <small>
                                                            {{ translate('Responsible') . ': ' }}
                                                            {{-- {{ __('locale.admin_id') . ': ' }} --}}
                                                            <b>
                                                                {{ $val['responsible'] }}
                                                            </b>
                                                        </small>
                                                    </p>
                                                    <h5 class="card-title lead-list-item-title">
                                                        <ion-icon name="person" style="color: #6c757d"></ion-icon>
                                                        <a href="{{ route('forthebuilder.clients.show', [$val['client_id'], '0', '0']) }}">{{ $val['client'] }}
                                                            <br></a>
                                                        {{-- <ion-icon name="call" style="color: #6c757d"></ion-icon> {{ $val['phone'] }} --}}
                                                    </h5>
                                                </div>
                                                <div>
                                                    <p>
                                                        <small class="float-right">{{ translate('Date') . ': ' . $val['day'] }}
                                                        </small>
                                                    </p>
                                                    <br>
                                                    <p>
                                                        <small
                                                            class="float-right">{{ translate('Time') . ': ' . $val['time'] }}
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endempty
            </div>
        </section>
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
        let page_name = 'clients';
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
            // run function when user click load more button
            function loadMoreData(paginate) {
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/forthebuilder/client-lists/getLeadList?page=' + paginate,
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
                                                        <ion  -icon name="call" style="color: #212529"></ion-icon> ${model.phone}
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
    </script>
@endsection
