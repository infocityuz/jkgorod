@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{__('locale.lead-lists')}} @endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/fullcalendar/main.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('locale.leads')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.lead-lists')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function drag(ev) {
            ev.dataTransfer.setData("id", ev.target.id);
            // console.log(ev.target.id);
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drop(ev) {
            ev.preventDefault();
            var id = ev.dataTransfer.getData("id");
            ev.currentTarget.appendChild(document.getElementById(id));
            var status = ev.currentTarget.getAttribute('id');

            // console.log('id',id)
            // console.log('status',status)


            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/forthebuilder/lead-lists/update-status/"+id,
                data: {
                    status: status
                },
                type: 'PUT',
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    let statusCounts = data['mStatus'];
                    for (const [key, value] of Object.entries(statusCounts)) {
                        console.log(key, value);
                        $(`#status-id-${key}`).text(`${value}`);
                    }

                    toastr.success(data['success']);

                },
                error: function (data) {
                    // console.log(data.responseText);
                    console.log(data.responseText);
                }
            });

        }

    </script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper kanban">

        <section class="content pb-3">
            <div class="container-fluid h-100">
                @empty(!$leadStatuses)
                    @foreach($leadStatuses as $leadstatus)

                    <div class="card card-row ">

                        <div class="card-header lead-list-header">
                            <h3 class="card-title lead-list-header-title">
                                {{ $leadstatus->name }}
                            </h3>
                            <h3 class="card-title lead-list-header-title">
                                <span id="status-id-{{$leadstatus->id}}">{{$leadstatus->leads->count()}}</span>
                            </h3>
                        </div>
                        <div class="lead-list-create">
                            <a href="{{route('forthebuilder.leads.create',['status' => $leadstatus->id])}}" class="lead-list-create-a">
                                {{__('locale.create')}} {{__('locale.lead')}}
                            </a>
                        </div>
                        <div class="card-body " id="{{ $leadstatus->id }}" ondrop="drop(event)" ondragover="allowDrop(event)">
                            @foreach($leadstatus->leads as $leads)

                                    <div class="items-1-id"  id="{{$leads->id}}" draggable="true" ondragstart="drag(event)">
                                        <div class="card card-light card-outline">
                                            <div class="card-header">
                                                <h5 class="card-title lead-list-item-title">
                                                    <ion-icon name="person" style="color: #6c757d"></ion-icon>
                                                    <a href="{{route('forthebuilder.leads.show',$leads->id)}}">{{$leads->name}} <br></a>
                                                    <ion-icon name="call" style="color: #6c757d"></ion-icon> {{$leads->phone}}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                            @endforeach
                        </div>

{{--                        <div class="card-header lead-list-header">--}}
{{--                            <h3 class="card-title lead-list-header-title">--}}
{{--                                {{ $leadstatus->name }}--}}
{{--                            </h3>--}}
{{--                            <h3 class="card-title lead-list-header-title">--}}
{{--                                <span id="new-lead-count">{{$mStatus['Новый'] ?? 0}}</span>--}}
{{--                            </h3>--}}
{{--                        </div>--}}
{{--                        <div class="lead-list-create">--}}
{{--                            <a href="{{route('forthebuilder.leads.create',['status' => $leadstatus->name])}}" class="lead-list-create-a">--}}
{{--                                {{__('locale.create')}} {{__('locale.lead')}}--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="card-body " id="new-lead" ondrop="drop(event)" ondragover="allowDrop(event)">--}}
{{--                            @foreach($models as $model)--}}
{{--                                @if($model->status == $leadstatus->name)--}}
{{--                                    <div class="items-1-id"  id="{{$model->id}}" draggable="true" ondragstart="drag(event)">--}}
{{--                                        <div class="card card-light card-outline">--}}
{{--                                            <div class="card-header">--}}
{{--                                                <h5 class="card-title lead-list-item-title">--}}
{{--                                                    <ion-icon name="person" style="color: #6c757d"></ion-icon>--}}
{{--                                                    <a href="{{route('forthebuilder.leads.show',$model->id)}}">{{$model->name}} <br></a>--}}
{{--                                                    <ion-icon name="call" style="color: #6c757d"></ion-icon> {{$model->phone}}--}}
{{--                                                </h5>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
                    </div>
                    @endforeach
                @endempty
            </div>
        </section>
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
        let page_name = 'clients';
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

            // var paginate = 1;
            // loadMoreData(paginate);
            $('#load-more').click(function() {
                var page = $(this).data('paginate');
                loadMoreData(page);
                $(this).data('paginate', page+1);
            });
            // run function when user click load more button
            function loadMoreData(paginate) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '/forthebuilder/lead-lists/getLeadList?page=' + paginate,
                    type: 'GET',
                    datatype: 'json',
                    beforeSend: function() {
                        $('#load-more').text('загрузка...');
                    }
                })
                .done(function(data) {
                    console.log(data)
                    if(data.length == 0) {
                        $('.invisible').removeClass('invisible');
                        $('#load-more').hide();
                        return;
                    } else {
                        $('#load-more').text('Загрузи больше...');

                        var models = data.data
                        var leadLists = '';
                        models.forEach(model => {
                            leadLists += `<div class="items-1-id"  id="${model.id}" draggable="true" ondragstart="drag(event)">
                                <div class="card card-light card-outline">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <a href="forthebuilder/leads/show/+${model.id}" style="color: #212529">
                                            <ion-icon name="person" style="color: #212529"></ion-icon> ${model.name} <br>
                                            <ion-icon name="call" style="color: #212529"></ion-icon> ${model.phone}
                                            </a>
                                        </h5>
                                        </div>
                                    </div>
                                </div>
`
                        });
                        // $('.deal-closed-none').css('display','none');
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







