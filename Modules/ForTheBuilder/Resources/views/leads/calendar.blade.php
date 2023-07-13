@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{translate('calendar')}} @endsection
    <link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/datatables/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/fullcalendar/main.css')}}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/bootstrap-datetimepicker.min.css') }}">
<style>
    .fc-toolbar-chunk{
        display: flex;
    }
    .fc-daygrid-event{
        display: flex;
        justify-content: center;
    }
    .calendar-text-z{
        margin-bottom: 0px;
        padding: 6px 0px;
    }
    .fc-prev-button, .fc-next-button{
        background-color: white !important;
        border: 0px !important;
    }
    .fc-prev-button span, .fc-next-button span{
        color: black;
    }
    .fc-toolbar-chunk h2{
        background-color: #94B2EB;
        padding: 20px 80px;
        border-radius: 18px;
        color: white;
    }
    .fc-today-button, .fc-dayGridMonth-button, .fc-timeGridWeek-button, .fc-timeGridDay-button{
        background-color: #94B2EB !important;
        border: 0px !important;
    }
    .fc-toolbar-chunk .btn-group .active{
        background-color: #44B2EB !important;
    }
    .fc-daygrid-day{
        background-color: rgba(0, 0, 0, 0);
    }
    .fc-daygrid-day-events a{
        border-radius: 24px;
    }
    .fc-daygrid-day-events{
        z-index: -1;
    }

     .fc-col-header-cell{
         background-color: #94B2EB;
         padding:14px 24px !important;
         color:white;
     }

    .task-calendar{
        display: flex;
        height: 80px;
    }
    .task-calendar .tasks{
        display: flex;
        align-items: flex-start;
    }
    .task-calendar .calendar{
        display: flex;
        align-items: flex-end;
    }
    .modal-header .row{
        width:100%;
    }
    .arrow, .plus{
        background-color: white;
        transition: 1s;
        color: black;
    }
    .arrow{
        height: 50px;
        padding: 0px 20px;
        display: flex;
        align-items: center;
        border-radius: 30px;
        margin-right: 40px;
    }
    .arrow:hover{
        transform: scale(1.2);
        box-shadow: 1px 1px 6px silver;
        color: black;
    }
    .plus{
        height: 40px;
        padding: 0px 14px;
        display: flex;
        align-items: center;
        border-radius:20px;
        margin-left: 40px;
    }
    .plus:hover{
        transform: scale(1.2);
        box-shadow: 1px 1px 6px silver;
        color: black;
    }
    .calendar_type{
        display: flex;
        padding: 10px;
        border-radius: 18px;
        background-color: white;
        margin: 0px 24px 6px 0px;
    }
    .calendar_type label{
        margin:0px 0px 0px 7px;
    }
    .add-task{
        display: flex;
        height: 64px;
        padding: 14px;
    }
    .modal-calendar-buttons{
        display: flex;
    }
    .modal-calendar-buttons input{
        margin-right: 14px;
    }
    .display-none{
        display: none;
    }

    #day_calendar_body{
        width: 100%;
        height: 340px;
        flex-direction: column;
    }

    .fc-toolbar.fc-header-toolbar{
        padding: 0px 14px;
    }
    .add-task>img{
        height: 16px;
        margin: 4px 4px 0px 4px;

    }
    .choise-date{
        width: 120px;
        margin-bottom: 14px;
        border-radius: 4px;
        border:0px;
    }
    #user_task_id{
        z-index: 101;
    }
    </style>
@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{route('forthebuilder.leads.index')}}" class="plus2 profileMaxNazadInformatsiyaKlient"><img src="{{asset('backend-assets/forthebuilders/images/icons/arrow-left.png')}}" alt=""></a>
                    <h2 class="panelUprText">{{translate('Task calendar')}}</h2>
                    <button class="plus2" data-toggle="modal" data-target="#exampleModal5">+</button>
                </div>
            </div>

            <div class="zadachiFlexCenter">
                <div class="d-flex">
                    <button class="zadachiFlexVse">
                        <input class="zadachiFlexInputCheck" type="checkbox" name="tasks" id="all">
                        {{translate('All')}}
                    </button>
                    <button class="zadachiFlexMoiZadachi">
                        <input class="zadachiFlexInputCheck" type="checkbox" name="tasks" id="my_tasks">
                        {{translate('My tasks')}}
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"  style="display: none">
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Draggable Events</h4>
                            </div>
                            <div class="card-body">
                                <!-- the events -->
                                <div id="external-events">
                                    <div class="external-event bg-success">Lunch</div>
                                    <div class="external-event bg-warning">Go home</div>
                                    <div class="external-event bg-info">Do homework</div>
                                    <div class="external-event bg-primary">Work on UI design</div>
                                    <div class="external-event bg-danger">Sleep tight</div>
                                    <div class="checkbox">
                                        <label for="drop-remove">
                                            <input type="checkbox" id="drop-remove">
                                            remove after drop
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create Event</h3>
                            </div>
                            <div class="card-body">
                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                    <ul class="fc-color-picker" id="color-chooser">
                                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                                <div class="input-group">
                                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                    <div class="input-group-append">
                                        <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                    </div>
                                    <!-- /btn-group -->
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper">
                    <div class="modal fade" id="day_calendar" tabindex="-1" role="dialog" aria-labelledby="day_calendar" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="border-radius: 20px !important; border: 2px solid #94B2EB; background: #F9FBFF;">
                                <div class="modal-header d-flex justify-content-center">
                                    <div class="" id="calendar_task_date"></div>
                                </div>
                                <div class="modal-body d-flex justify-content-center flex-column">
                                    <div class="d-flex" id="day_calendar_body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- THE CALENDAR -->
                    <div id="calendar">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ZadachiModalBody">
                <div class="modal-body">
                    <form action="{{ route('forthebuilder.task.calendar_store') }}" method="POST"
                          enctype="multipart/form-data" id="chees-modal">
                        @csrf
                        @method('POST')
                        <select name="user_task_id" data-placeholder="{{ __('locale.select') }}" id="user_task_id"
                               class="zadachiClient form-control select2 @error('user_task_id') is-invalid error-data-input @enderror">
                            @empty(!$users)
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                            {{ Auth::user()->id == $user->id ? 'selected' : '' }}>
                                        {{ $user->first_name }}</option>
                                @endforeach
                            @endempty
                        </select>
                        <div class="zadachiBigClientInformation">
                            <div class="row">
                                <div class="add-task">
                                    {{ translate('Task on')}}&nbsp;
                                    <input name="task_date" id="task_date" type="date"
                                           class="choise-date @error('task_date') error-data-input is-invalid @enderror"
                                           value="{{ old('task_date')}}">&nbsp; {{translate('for')}} &nbsp;
                                    <a href="#" class="choise-manager"> .......... </a>
                                    <img src="{{asset('/backend-assets/forthebuilders/images/Call.png')}}" alt="Phone Calling">
                                    <a href="#" class="choise-phone">&nbsp; {{translate('Call')}} </a>
                                </div>
                                <select name="task_type" id="task_type"
                                        data-placeholder="{{ __('locale.select') }}"
                                        class="form-control select2 d-none @error('task_type') is-invalid error-data-input @enderror">
                                    <option value="Связаться"> {{translate('Call')}}</option>
                                    <option value="Встреча"> {{translate('Meeting')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-calendar-buttons d-flex textareaButttonSend">
                            <button type="submit" class="PostavitButton">{{ translate('Put') }}</button>
                            <button class="OtmenitButton" data-dismiss="modal" aria-label="Close">{{ translate('Cancell') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

    <script src="{{ asset('/backend-assets/forthebuilders/javascript/jquery-3.6.1.js')}}"></script>
    <script src="{{ asset('/backend-assets/forthebuilders/javascript/jquery.ui.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/moment/js/moment.min.js')}}"></script>
    <script defer src="{{asset('/backend-assets/forthebuilders/fullcalendar/main.js')}}"></script>
        <script src='{{asset('/backend-assets/plugins/fullcalendar/core/locales/ru.js')}}'></script>
    <script defer src="{{ asset('/backend-assets/forthebuilders/bootstrap-datetimepicker.js') }}"></script>

    <script defer>
        let page_name = 'leads';
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
            $(function () {
                /* initialize the external events
                 -----------------------------------------------------------------*/
                function ini_events(ele) {
                    ele.each(function () {
                        // create an Event Object (https://fullcalendar.io/docs/event-object)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        }

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject)

                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex        : 1070,
                            revert        : true, // will cause the event to go back to its
                            revertDuration: 0  //  original position after the drag
                        })
                    })
                }

                ini_events($('#external-events div.external-event'))

                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date()
                var d    = date.getDate(),
                    m    = date.getMonth(),
                    y    = date.getFullYear()

                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;

                var containerEl = document.getElementById('external-events');
                var checkbox = document.getElementById('drop-remove');
                var calendarEl = document.getElementById('calendar');

                // initialize the external events
                // -----------------------------------------------------------------
                let modal_content = false;
                let day_calendar_body = false
                let models = {'id':[], 'name':[], 'surname':[], 'email':[], 'task_date':[], 'task_type':[], 'user_name':[], 'user_surname':[], 'created_at':[], 'middlename':[]};
                let my_models = {'id':[], 'name':[], 'surname':[], 'email':[], 'task_date':[], 'task_type':[], 'user_name':[], 'user_surname':[], 'created_at':[], 'middlename':[]};
                @foreach($models as $model_)
                    models.id.push('{{$model_->id}}')
                    models.name.push('{{$model_->userTask->first_name}}')
                    models.surname.push('{{$model_->userTask->last_name}}')
                    models.middlename.push('{{$model_->userTask->middle_name}}')
                    models.created_at.push('{{$model_->created_at}}')
                    models.email.push('{{$model_->userTask->email}}')
                    models.task_date.push('{{$model_->task_date}}')
                    models.task_type.push('{{$model_->task_type}}')
                    models.user_name.push('{{$model_->user->first_name??''}}')
                    models.user_surname.push('{{$model_->user->last_name??''}}')
                @endforeach
                @foreach($my_models as $my_model_)
                    my_models.id.push('{{$my_model_->id}}')
                    my_models.name.push('{{$my_model_->userTask->first_name}}')
                    my_models.surname.push('{{$my_model_->userTask->last_name}}')
                    my_models.middlename.push('{{$my_model_->userTask->middle_name}}')
                    my_models.created_at.push('{{$my_model_->created_at}}')
                    my_models.email.push('{{$my_model_->userTask->email}}')
                    my_models.task_date.push('{{$my_model_->task_date}}')
                    my_models.task_type.push('{{$my_model_->task_type}}')
                    my_models.user_name.push('{{$my_model_->user->first_name??''}}')
                    my_models.user_surname.push('{{$my_model_->user->lastname??''}}')
                @endforeach

                new Draggable(containerEl, {
                    itemSelector: '.external-event',
                    eventData: function(eventEl) {
                        return {
                            title: eventEl.innerText,
                            backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                            borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                            textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
                        };
                    }
                });

                var calendar = new Calendar(calendarEl, {
                    locale: 'ru',
                    headerToolbar: {
                        left  : 'today',
                        center: 'prev title next',
                        right : 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    themeSystem: 'bootstrap',
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end, allDays){
                        $('#day_calendar_body').html("")
                        let calendar_class = '';
                        let calendar_class_1 = '';
                        day_calendar_body = false;
                        models.task_date.forEach(myFunction);
                        $('.fc-daygrid-day').attr('data-toggle', 'modal')
                        $('.fc-daygrid-day').attr('data-target', '#day_calendar')
                        $('#calendar_task_date').text(start.startStr)
                        if(parseInt(Date.parse(date))>parseInt(Date.parse(start.startStr))){
                            if(!$('#calendar_task_date').hasClass('modalKalendarDate')){
                                $('#calendar_task_date').addClass('modalKalendarDate')
                                $('#calendar_task_date').removeClass('modalKalendarDateBlue')
                            }
                        }else{
                            if(!$('#calendar_task_date').hasClass('modalKalendarDateBlue')) {
                                $('#calendar_task_date').addClass('modalKalendarDateBlue')
                                $('#calendar_task_date').removeClass('modalKalendarDate')
                            }
                        }
                        function myFunction(item, index){
                            if(item == start.startStr){
                                day_calendar_body = true;
                                if(parseInt(Date.parse(date))>parseInt(Date.parse(start.startStr))){
                                    $('#day_calendar_body').append(`
                                    <div class='d-flex justify-content-between modalKalendarDate kalendarModalBody'>
                                        <div class="modalImyaKalendar">
                                            ${models.name[index]}&nbsp;${models.surname[index]}&nbsp;${models.middlename[index]}<br>
                                            ${models.created_at[index]}&nbsp;${models.task_type[index]}
                                        </div>
                                        <div class="modalDataKalendar">
                                            Ответственный:<br>
                                            <b>${models.user_name[index]}&nbsp;${models.user_surname[index]}</b>
                                        </div>
                                    </div><br>`)
                                }else{
                                    $('#day_calendar_body').append(`
                                    <div class='d-flex justify-content-between modalKalendarDateBlue kalendarModalBodyBlue'>
                                        <div class="modalImyaKalendar">
                                            ${models.name[index]}&nbsp;${models.surname[index]}&nbsp;${models.middlename[index]}<br>
                                            ${models.created_at[index]}&nbsp;${models.task_type[index]}
                                        </div>
                                        <div class="modalDataKalendar">
                                            Ответственный:<br>
                                            <b>${models.user_name[index]}&nbsp;${models.user_surname[index]}</b>
                                        </div>
                                    </div><br>`)
                                }
                            }
                        }
                        if(day_calendar_body == false){
                            $('#day_calendar_body').append(`
                                <div class="d-flex justify-content-center">
                                    <h3 class="modalContentCalendarNet">{{translate('No task for today')}}</h3>
                                </div>`)
                        }
                    },
                    events: [
                        @foreach($models as $model)
                            @php $status = '';
                                if(strtotime("now") > strtotime($model->task_date)){
                                    $back_color = '#FF9D9D';
                                }else{
                                    $back_color = '#94B2EB';
                                }
                            @endphp
                        {
                            {{--url: '/forthebuilder/leads/show/{{$model->id}}',--}}
                            url: '#',
                            title : "{{$model->userTask->first_name}} <br> {{$model->status}} {{$model->task_type}}",
                            customHtml : "<span>{{$model->userTask->first_name.' '}}{{$model->userTask->last_name}} <br> {{$model->user->middle_name}}</span>",
                            start          : '{{$model->task_date}}',
                            backgroundColor: '{{$back_color}}',
                            borderColor    : '{{$back_color}}', //red
                            padding: '8px',
                            allDay         : true,
                            textEscape: true
                        },
                        @endforeach
                    ],
                    eventContent: function(eventInfo) {
                        return { html: eventInfo.event.extendedProps.customHtml }
                    },
                    editable  : false,
                    droppable : false,
                    // this allows things to be dropped onto the calendar !!!
                    drop      : function(info) {
                        // is the "remove after drop" checkbox checked?
                        if (checkbox.checked) {
                            // if so, remove the element from the "Draggable Events" list
                            info.draggedEl.parentNode.removeChild(info.draggedEl);
                        }
                    }
                });

                // calendar types
                calendar.render();

                $('.fc-daygrid-day').attr('data-toggle', 'modal')
                $('.fc-daygrid-day').attr('data-target', '#day_calendar')

                var my_calendar = new Calendar(calendarEl, {
                    locale: 'ru',
                    headerToolbar: {
                        left  : 'today',
                        center: 'prev title next',
                        right : 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    themeSystem: 'bootstrap',
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end, allDays){
                        $('#day_calendar_body').html("")
                        let calendar_class = '';
                        let calendar_class_1 = '';
                        day_calendar_body = false;
                        models.task_date.forEach(myFunction);
                        $('.fc-daygrid-day').attr('data-toggle', 'modal')
                        $('.fc-daygrid-day').attr('data-target', '#day_calendar')
                        $('#calendar_task_date').text(start.startStr)
                        if(parseInt(Date.parse(date))>parseInt(Date.parse(start.startStr))){
                            if(!$('#calendar_task_date').hasClass('modalKalendarDate')){
                                $('#calendar_task_date').addClass('modalKalendarDate')
                                $('#calendar_task_date').removeClass('modalKalendarDateBlue')
                            }
                        }else{
                            if(!$('#calendar_task_date').hasClass('modalKalendarDateBlue')) {
                                $('#calendar_task_date').addClass('modalKalendarDateBlue')
                                $('#calendar_task_date').removeClass('modalKalendarDate')
                            }
                        }
                        function myFunction(item, index){
                            if(item == start.startStr){
                                day_calendar_body = true;
                                if(parseInt(Date.parse(date))>parseInt(Date.parse(start.startStr))){
                                    $('#day_calendar_body').append(`
                                    <div class='d-flex justify-content-between modalKalendarDate kalendarModalBody'>
                                        <div class="modalImyaKalendar">
                                            ${my_models.name[index]}&nbsp;${my_models.surname[index]}&nbsp;${my_models.middlename[index]}<br>
                                            ${my_models.created_at[index]}&nbsp;${my_models.task_type[index]}
                                        </div>
                                        <div class="modalDataKalendar">
                                            Ответственный:<br>
                                            <b>${my_models.user_name[index]}&nbsp;${my_models.user_surname[index]}</b>
                                        </div>
                                    </div><br>`)
                                }else{
                                    $('#day_calendar_body').append(`
                                    <div class='d-flex justify-content-between modalKalendarDateBlue kalendarModalBodyBlue'>
                                        <div class="modalImyaKalendar">
                                            ${my_models.name[index]}&nbsp;${my_models.surname[index]}&nbsp;${my_models.middlename[index]}<br>
                                            ${my_models.created_at[index]}&nbsp;${my_models.task_type[index]}
                                        </div>
                                        <div class="modalDataKalendar">
                                            Ответственный:<br>
                                            <b>${my_models.user_name[index]}&nbsp;${my_models.user_surname[index]}</b>
                                        </div>
                                    </div><br>`)
                                }
                            }
                        }
                        if(day_calendar_body == false){
                            $('#day_calendar_body').append(`
                                <div class="d-flex justify-content-center">
                                    <h3 class="modalContentCalendarNet">{{translate('No task for today')}}</h3>
                                </div>`)
                        }
                    },

                    events: [
                            @foreach($my_models as $my_model)
                            @php $status = '';
                                if(strtotime("now") > strtotime($my_model->task_date)){
                                    $back_color = '#FF9D9D';
                                    $class = 'kalendarImyaBlue';
                                }else{
                                    $back_color = '#94B2EB';
                                    $class = 'kalendarImyaRed';
                                }
                            @endphp
                        {
                            {{--url: '/forthebuilder/leads/show/{{$model->id}}',--}}
                            url: '#',
                            title : "{{$my_model->userTask->first_name}} <br> {{$my_model->status}} {{$my_model->task_type}}",
                            customHtml : "<span>{{$my_model->userTask->first_name.' '}}{{$my_model->userTask->last_name}} <br> {{$my_model->user->middle_name}}</span>",
                            start          : '{{$my_model->task_date}}',
                            backgroundColor: '{{$back_color}}',
                            borderColor    : '{{$back_color}}', //red
                            padding: '8px',
                            allDay         : true,
                            textEscape: true
                        },
                        @endforeach
                    ],
                    eventContent: function(eventInfo) {
                        return { html: eventInfo.event.extendedProps.customHtml }
                    },
                    editable  : false,
                    droppable : false,
                    // this allows things to be dropped onto the calendar !!!
                    drop      : function(info) {
                        // is the "remove after drop" checkbox checked?
                        if (checkbox.checked) {
                            // if so, remove the element from the "Draggable Events" list
                            info.draggedEl.parentNode.removeChild(info.draggedEl);
                        }
                    }
                });
                $('#all').prop('checked', true)
                $('#my_tasks').prop('checked', false)
                $('#all').on('change', function (){
                    if($(this).is(':checked')) {
                        $('#my_tasks').prop('checked', false)
                        $('#calendar').html("")
                        calendar.render();
                    }
                });
                $('#my_tasks').on('change', function (){
                    if($(this).is(':checked')) {
                        $('#all').prop('checked', false)
                        $('#calendar').html("")
                        my_calendar.render();
                    }
                });

                // adding task to leads
                // $(document).on('click', '.choise-date', function(e) {
                //     e.preventDefault();
                //     $("#task_date").datetimepicker("show");
                // })
                $(document).on('click', '.choise-manager', function(e) {
                    e.preventDefault();

                })

                $("#user_task_id").on("click", function() {

                    $('.choise-manager').text($('#user_task_id option:selected').text())
                });

                $(document).on('click', '.choise-phone', function(e) {
                    e.preventDefault();
                    var se = $("#task_type");
                    se.removeClass('d-none');
                    se[0].size = 2;
                })

                $("#task_type").on("click", function() {
                    var se = $(this);
                    se.addClass('d-none');
                    $('.choise-phone').text($('#task_type option:selected').text())
                });

                /* ADDING EVENTS */
                var currColor = '#3c8dbc' //Red by default
                // Color chooser button
                $('#color-chooser > li > a').click(function (e) {
                    e.preventDefault()
                    // Save color
                    currColor = $(this).css('color')
                    // Add color effect to button
                    $('#add-new-event').css({
                        'background-color': currColor,
                        'border-color'    : currColor
                    })
                })

                $('#add-new-event').click(function (e) {
                    e.preventDefault()
                    // Get value and make sure it is not null
                    var val = $('#new-event').val()
                    if (val.length == 0) {
                        return
                    }

                    // Create events
                    var event = $('<div />')
                    event.css({
                        'background-color': currColor,
                        'border-color'    : currColor,
                        'color'           : '#fff'
                    }).addClass('external-event')
                    event.text(val)
                    $('#external-events').prepend(event)

                    // Add draggable funtionality
                    ini_events(event)

                    // Remove event from text input
                    $('#new-event').val('')
                })
            })

        });
    </script>







