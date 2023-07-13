<?php
    use Modules\ForTheBuilder\Entities\Constants;
?>

<?php $__env->startSection('title'); ?> <?php echo e(translate('calendar')); ?> <?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/datatables/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/select/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/fullcalendar/main.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/bootstrap-datetimepicker.min.css')); ?>">
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
        height: auto;
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
    #deal_id{
        z-index: 101;
    }
    .search_deal{
        border: 1px solid silver;
    }
    .opacity_button{
        opacity: 0.6;
    }
</style>
<?php $__env->startSection('content'); ?>
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
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.clients.index')); ?>" class="plus2 profileMaxNazadInformatsiyaKlient"><img src="<?php echo e(asset('backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>" alt=""></a>
                    <h2 class="panelUprText"><?php echo e(translate('Task calendar')); ?></h2>
                    <button class="plus2" data-toggle="modal" data-target="#exampleModal5">+</button>
                </div>
            </div>


            <?php if(Auth::user()->role_id != Constants::MANAGER): ?>

                <div class="zadachiFlexCenter">
                    <div class="d-flex">
                        <button class="zadachiFlexVse">
                            <input class="zadachiFlexInputCheck" type="checkbox" name="tasks" id="all">
                            <?php echo e(translate('All')); ?>

                        </button>
                        <button class="zadachiFlexMoiZadachi">
                            <input class="zadachiFlexInputCheck" type="checkbox" name="tasks" id="my_tasks">
                            <?php echo e(translate('My tasks')); ?>

                        </button>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-3"  style="display: none">
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo e(translate('Draggable Events')); ?></h4>
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
                                <h3 class="card-title"><?php echo e(translate('Create Event')); ?></h3>
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
                                        <button id="add-new-event" type="button" class="btn btn-primary"><?php echo e(translate('Add')); ?></button>
                                    </div>
                                    <!-- /btn-group -->
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper">
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
                    <form action="<?php echo e(route('forthebuilder.task.calendar_store')); ?>" method="POST"
                          enctype="multipart/form-data" id="chees-modal">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>
                        <div class="inputCustomDiv" style="width: 100%; margin-top: -16px;">
                            <input type="hidden" name="deal_id" id="selected_deal_id">
                            <input class="select_deal form-control" type="text" >
                        </div>
                        <div style="background-color: white; border-radius: 20px; position: absolute; z-index: 9999; width: 93%"
                             class="selectMainDeal d-none">
                            <ul style="list-style: none" >
                                <?php if(empty(!$deals)): ?>
                                    <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($deal->client)): ?>
                                            <li class="search_deal d-none" value="<?php echo e($deal->id); ?>"><?php echo e($deal->client->first_name.' '.$deal->client->last_name.' '.$deal->client->middle_name); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="zadachiBigClientInformation">
                            <div class="row">
                                <div class="add-task">
                                    <?php echo e(translate('Task on')); ?>&nbsp;
                                    <input name="task_date" id="task_date" type="date"
                                           class="choise-date <?php $__errorArgs = ['task_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e(old('task_date')); ?>">&nbsp; <?php echo e(translate('for')); ?> &nbsp;
                                    <a href="#" class="choise-manager"> .......... </a>
                                    <img src="<?php echo e(asset('/backend-assets/forthebuilders/images/Call.png')); ?>" alt="Phone Calling"  id="calling_or_meeting" width="18px">
                                    <span>&nbsp; </span><a href="#" class="choise-phone"><?php echo e(translate('Call')); ?> </a>
                                </div>
                                <select name="performer_id" id="performer_id"
                                        data-placeholder="<?php echo e(__('locale.select')); ?>"
                                        class="form-control select2 d-none <?php $__errorArgs = ['performer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid error-data-input <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">------------</option>
                                    <?php if(empty(!$users)): ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>"
                                                    <?php echo e(Auth::user()->id == $user->id ? 'selected' : ''); ?>>
                                                <?php echo e($user->first_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <select name="type" id="type"
                                        data-placeholder="<?php echo e(__('locale.select')); ?>"
                                        class="form-control select2 d-none <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid error-data-input <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="Связаться"><?php echo e(translate('Call')); ?></option>
                                    <option value="Встреча"><?php echo e(translate('Meeting')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-calendar-buttons d-flex textareaButttonSend">
                            <button type="submit" class="opacity_button PostavitButton"><?php echo e(translate('Put')); ?></button>
                            <button class="OtmenitButton" data-dismiss="modal" aria-label="Close"><?php echo e(translate('Cancell')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<script src="<?php echo e(asset('/backend-assets/forthebuilders/javascript/jquery-3.6.1.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/backend-assets/forthebuilders/select/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('/backend-assets/forthebuilders/toastr/js/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('/backend-assets/forthebuilders/moment/js/moment.min.js')); ?>"></script>
<script defer src="<?php echo e(asset('/backend-assets/forthebuilders/fullcalendar/main.js')); ?>"></script>
<script src='<?php echo e(asset('/backend-assets/plugins/fullcalendar/locales/ru.js')); ?>'></script>
<script defer>
    let page_name = 'calendar';
    let calling_or_meeting = document.getElementById('calling_or_meeting')
    $(document).ready(function () {
        let sessionWarning = "<?php echo e(session('warning')); ?>";
        if(sessionWarning){
            toastr.success(sessionWarning)
        }
        let sessionError = "<?php echo e(session('error')); ?>";
        if(sessionError){
            toastr.success(sessionError)
        }
        $(document).on('click', '.choise-manager', function(e) {
            e.preventDefault();
            // $('select[name="performer_id"]').chosen();
            // $('#performer_id').show();
            var se = $("#performer_id");
            se.removeClass('d-none');
            se[0].size = 10;
        })
        $('.PostavitButton').on('click', function (e){
            if($('#selected_deal_id').val() == ""){
                e.preventDefault()
            }
        });
        if($('#selected_deal_id').val() != ""){
            if($('.PostavitButton').hasClass('opacity_button')){
                $('.PostavitButton').removeClass('opacity_button')
            }
        }
        $(document).on('keyup', '.select_deal', function(e) {
            var keyupText = $(this).val()
            $('#selected_deal_id').val("")
            $('.search_deal').each(function() {
                if (keyupText == '') {
                    if(!$('.PostavitButton').hasClass('opacity_button')){
                        $('.PostavitButton').addClass('opacity_button')
                    }
                    $(this).addClass('d-none')
                    $('.selectMainDeal').addClass('d-none')
                } else {
                    if($('.PostavitButton').hasClass('opacity_button')){
                        $('.PostavitButton').removeClass('opacity_button')
                    }
                    var myText = $(this).text();
                    if (myText.toLowerCase().includes(keyupText.toLowerCase())) {
                        $('.selectMainDeal').removeClass('d-none')
                        $(this).removeClass('d-none')
                    } else {
                        $(this).addClass('d-none')
                    }
                }
            });
        })
        $('#selected_deal_id').on('change', function (e) {
            if($(this).val == '') {
                if (!$('.PostavitButton').hasClass('opacity_button')) {
                    $('.PostavitButton').addClass('opacity_button')
                }
            }else{
                if($('.PostavitButton').hasClass('opacity_button')){
                    $('.PostavitButton').removeClass('opacity_button')
                }
            }
        })
        $('.search_deal').on('click', function () {
            // console.log()
            $('#selected_deal_id').val($(this).val())
            $('.select_deal').val($(this).text())
            if(!$('.selectMainDeal').hasClass('d-none')){
                $('.selectMainDeal').addClass('d-none')
            }
            if($('.PostavitButton').hasClass('d-none')){
                $('.PostavitButton').removeClass('d-none')
            }
        })
        $("#performer_id").on("click", function() {
            var se = $(this);
            se.addClass('d-none');
            $('.choise-manager').text($('#performer_id option:selected').text())
        });
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
                    // $(this).draggable({
                    //     zIndex        : 1070,
                    //     revert        : true, // will cause the event to go back to its
                    //     revertDuration: 0  //  original position after the drag
                    // })
                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var full_date = new Date()
            var d    = full_date.getDate(),
                m    = full_date.getMonth()+1,
                y    = full_date.getFullYear()
            var date = y+'-'+m+'-'+d;
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------
            let modal_content = false;
            let day_calendar_body = false
            let models = {'id':[], 'href':[], 'name':[], 'surname':[], 'email':[], 'task_date':[], 'type':[], 'user_name':[], 'user_surname':[], 'created_at':[], 'middlename':[]};
            let my_models = {'id':[], 'href':[], 'name':[], 'surname':[], 'email':[], 'task_date':[], 'type':[], 'user_name':[], 'user_surname':[], 'created_at':[], 'middlename':[]};
            let responsible = '<?php echo e(translate('Responsible')); ?>'
            <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            models.id.push("<?php echo e($model_->id); ?>")
            models.href.push("<?php echo e(route('forthebuilder.clients.show', [$model_->deal->client->id??'0', '0', '0'])); ?>")
            models.name.push("<?php echo e((($model_->performer) ? $model_->performer->first_name : '')); ?>")
            models.surname.push("<?php echo e((($model_->performer) ? $model_->performer->last_name : '')); ?>")
            models.middlename.push("<?php echo e((($model_->performer) ? $model_->performer->middle_name : '')); ?>")
            models.created_at.push("<?php echo e($model_->created_at); ?>")
            models.email.push("<?php echo e((($model_->performer) ? $model_->performer->email : '')); ?>")
            models.task_date.push("<?php echo e($model_->task_date); ?>")
            models.type.push("<?php echo e($model_->type); ?>")
            models.user_name.push("<?php echo e($model_->user->first_name??''); ?>")
            models.user_surname.push("<?php echo e($model_->user->last_name??''); ?>")
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $my_models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_model_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            my_models.id.push("<?php echo e($my_model_->id); ?>")
            models.href.push("<?php echo e(route('forthebuilder.clients.show', [$my_model_->deal->client->id??'0', '0', '0'])); ?>")
            my_models.name.push("<?php echo e($my_model_->performer->first_name); ?>")
            my_models.surname.push("<?php echo e($my_model_->performer->last_name); ?>")
            my_models.middlename.push("<?php echo e($my_model_->performer->middle_name); ?>")
            my_models.created_at.push("<?php echo e($my_model_->created_at); ?>")
            my_models.email.push("<?php echo e($my_model_->performer->email); ?>")
            my_models.task_date.push("<?php echo e($my_model_->task_date); ?>")
            my_models.type.push("<?php echo e($my_model_->type); ?>")
            my_models.user_name.push("<?php echo e($my_model_->user->first_name??''); ?>")
            my_models.user_surname.push("<?php echo e($my_model_->user->lastname??''); ?>")
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    $('.fc-daygrid-day').attr('id', 'day_calendar_modal')
                    $('#calendar_task_date').text(start.startStr)
                    if(parseInt(Date.parse(date)) >= parseInt(Date.parse(start.startStr))+86400){
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
                            if(parseInt(Date.parse(date)) >= parseInt(Date.parse(start.startStr))+86400){
                                $('#day_calendar_body').append(`
                                    <a class='d-flex justify-content-between modalKalendarDate kalendarModalBody' href='${models.href[index]}'>
                                        <div class="modalImyaKalendar">
                                            ${models.name[index]}&nbsp;${models.surname[index]}&nbsp;${models.middlename[index]}<br>
                                            ${models.created_at[index]}&nbsp;${models.type[index]}
                                        </div>
                                        <div class="modalDataKalendar">
                                            ${responsible}:<br>
                                            <b>${models.user_name[index]}&nbsp;${models.user_surname[index]}</b>
                                        </div>
                                    </a><br>`)
                            }else{
                                $('#day_calendar_body').append(`
                                    <a class='d-flex justify-content-between modalKalendarDateBlue kalendarModalBodyBlue' href='${models.href[index]}'>
                                        <div class="modalImyaKalendar">
                                            ${models.name[index]}&nbsp;${models.surname[index]}&nbsp;${models.middlename[index]}<br>
                                            ${models.created_at[index]}&nbsp;${models.type[index]}
                                        </div>
                                        <div class="modalDataKalendar">
                                            ${responsible}:<br>
                                            <b>${models.user_name[index]}&nbsp;${models.user_surname[index]}</b>
                                        </div>
                                    </a><br>`)
                            }
                        }
                    }
                    if(day_calendar_body == false){
                        $('#day_calendar_body').append(`
                            <div class="d-flex justify-content-center">
                                <h3 class="modalContentCalendarNet"><?php echo e(translate('No task for today')); ?></h3>
                            </div>`)
                    }
                },
                events: [
                        <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $status = '';
                            if(strtotime("now") >= strtotime($model->task_date)+86400){
                                $back_color = '#FF9D9D';
                            }else{
                                $back_color = '#94B2EB';
                            }
                        ?>
                    {
                        
                        url: '#',
                        title : "<?php echo e((($model->performer) ? $model->performer->first_name : '')); ?> <br> <?php echo e($model->status); ?> <?php echo e($model->type); ?>",
                        customHtml : "<span><?php echo e((($model->performer) ? $model->performer->first_name : '').' '); ?><?php echo e((($model->performer) ? $model->performer->last_name : '')); ?> <br> <?php echo e((($model->user) ? $model->user->first_name : '')); ?></span>",
                        start          : '<?php echo e($model->task_date); ?>',
                        backgroundColor: '<?php echo e($back_color); ?>',
                        borderColor    : '<?php echo e($back_color); ?>', //red
                        padding: '8px',
                        allDay         : true,
                        textEscape: true
                    },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            $('.fc-daygrid-day').attr('id', 'day_calendar_modal')

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
                    my_models.task_date.forEach(myFunction);
                    $('.fc-daygrid-day').attr('data-toggle', 'modal')
                    $('.fc-daygrid-day').attr('data-target', '#day_calendar')
                    $('.fc-daygrid-day').attr('id', 'day_calendar_modal')
                    $('#calendar_task_date').text(start.startStr)
                    if(parseInt(Date.parse(date)) >= parseInt(Date.parse(start.startStr))+86400){
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
                            if(parseInt(Date.parse(date)) >= parseInt(Date.parse(start.startStr))+86400){
                                $('#day_calendar_body').append(`
                                    <a class='d-flex justify-content-between modalKalendarDate kalendarModalBody' href='${my_models.href[index]}'>
                                        <div class="modalImyaKalendar">
                                            ${my_models.name[index]}&nbsp;${my_models.surname[index]}&nbsp;${my_models.middlename[index]}<br>
                                            ${my_models.created_at[index]}&nbsp;${my_models.type[index]}
                                        </div>
                                        <div class="modalDataKalendar">
                                            Ответственный:<br>
                                            <b>${my_models.user_name[index]}&nbsp;${my_models.user_surname[index]}</b>
                                        </div>
                                    </a><br>`)
                            }else{
                                $('#day_calendar_body').append(`
                                    <a class='d-flex justify-content-between modalKalendarDateBlue kalendarModalBodyBlue' href='${my_models.href[index]}'>
                                        <div class="modalImyaKalendar">
                                            ${my_models.name[index]}&nbsp;${my_models.surname[index]}&nbsp;${my_models.middlename[index]}<br>
                                            ${my_models.created_at[index]}&nbsp;${my_models.type[index]}
                                        </div>
                                        <div class="modalDataKalendar">
                                            Ответственный:<br>
                                            <b>${my_models.user_name[index]}&nbsp;${my_models.user_surname[index]}</b>
                                        </div>
                                    </a><br>`)
                            }
                        }
                    }
                    if(day_calendar_body == false){
                        $('#day_calendar_body').append(`
                                <div class="d-flex justify-content-center">
                                    <h3 class="modalContentCalendarNet"><?php echo e(translate('No task for today')); ?></h3>
                                </div>`)
                    }
                },

                events: [
                        <?php $__currentLoopData = $my_models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $status = '';
                                if(strtotime("now") >= strtotime($my_model->task_date)+86400){
                                    $back_color = '#FF9D9D';
                                }else{
                                    $back_color = '#94B2EB';
                                }
                        ?>
                    {
                        
                        url: '#',
                        title : "<?php echo e($my_model->performer->first_name); ?> <br> <?php echo e($my_model->status); ?> <?php echo e($my_model->type); ?>",
                        customHtml : "<span><?php echo e($my_model->performer->first_name.' '); ?><?php echo e($my_model->performer->last_name); ?> <br> <?php echo e($my_model->user->first_name); ?></span>",
                        start          : '<?php echo e($my_model->task_date); ?>',
                        backgroundColor: '<?php echo e($back_color); ?>',
                        borderColor    : '<?php echo e($back_color); ?>', //red
                        padding: '8px',
                        allDay         : true,
                        textEscape: true
                    },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

            // $("#deal_id").on("click", function() {
            //
            //     $('.choise-manager').text($('#deal_id option:selected').text())
            // });

            let call_png = '<?php echo e(asset('/backend-assets/forthebuilders/images/Call.png')); ?>'
            let meeting_png = '<?php echo e(asset('/backend-assets/forthebuilders/images/meeting.png')); ?>'
            let calling_or_meeting = document.getElementById('calling_or_meeting')
            $(document).on('click', '.choise-phone', function(e) {
                e.preventDefault();
                var se = $("#type");
                se.removeClass('d-none');
                se[0].size = 2;
            })

            $("#type").on("click", function() {
                var se = $(this);
                se.addClass('d-none');
                console.log($('#type option:selected').text())
                if($('#type option:selected').text() == 'Meeting'){
                    calling_or_meeting.setAttribute('src', meeting_png)
                }
                if($('#type option:selected').text() == 'Call'){
                    calling_or_meeting.setAttribute('src', call_png)
                }
                $('.choise-phone').text($('#type option:selected').text())
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
        $('#day_calendar_modal').on('click', function (){

        });
    });
</script>








<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/clients/calendar.blade.php ENDPATH**/ ?>