<style>
    .display-none {
        display: none;
    }

    .notification_content {
        position: absolute;
        z-index: 100;
    }

    .language_flag {
        position: absolute;
        z-index: 1;
        margin-top: 70px;
    }
</style>
<div class="d-flex ajaxCliDiv">
    <div class="inputDiv">
        <div class="affflo">
            <ion-icon class="searchIconInput" name="search-outline"></ion-icon>
        </div>
        <?php
            $arrSearch = [
                route('forthebuilder.index') => translate('Home'),
                route('forthebuilder.task.index') => translate('Task list'),
                route('forthebuilder.deal.index') => translate('Deal list'),
                route('forthebuilder.clients.index') => translate('Deals with clients'),
                route('forthebuilder.clients.all-clients') => translate('All clients'),
                route('forthebuilder.clients.create', '0') => translate('Creating a new client'),
                route('forthebuilder.house.index') => translate('JK list'),
                route('forthebuilder.house.create') => translate('Create a new JK'),
                route('forthebuilder.clients.calendar') => translate('Task calendar'),
                route('forthebuilder.booking.index') => translate('Booking list'),
                route('forthebuilder.installment-plan.index') => translate('Installment plan list'),
                route('forthebuilder.user.index') => translate('User list'),
                route('forthebuilder.user.create') => translate('Create a new user'),
                route('forthebuilder.settings.index') => translate('Settings list'),
                route('forthebuilder.currency.index') => translate('Currencies list'),
            ];
        ?>
        <div class="inputCustomDiv" style="width: 100%; margin-top: -16px;">
            <input class="searchInput" type="text" value="">
        </div>
        <div style="background-color: white; border-radius: 20px; position: absolute; width: 54%; top: 70px; z-index: 9999;"
            class="searchMainDiv d-none">
            <ul style="list-style: none;">
                <?php $__currentLoopData = $arrSearch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($key); ?>">
                        <li style="margin: 15px; border-bottom: 1px solid black;" class="searchLi d-none">
                            <?php echo e($value); ?>

                        </li>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <div style="max-width: 169px; display: flex; margin-right: 80px;">
        <div class="dropdown">
            <?php
                if(isset($all_notifications['all_task']) && isset($all_notifications['all_booking']) && isset($all_notifications['all_installment_plan'])){
                   $all_count = count($all_notifications['all_task']) + count($all_notifications['all_booking']) + count($all_notifications['all_installment_plan']);
               }else{
                   $all_count = 0;
               }
            ?>
            <button class="d-flex buttonUzbDropDownHeader" type="button" id="dropdownMenuButton2"
                src="<?php echo e(asset('/backend-assets/forthebuilders/images/notification.png')); ?>" alt="Notification">
                <img class="notifRegion" src="<?php echo e(asset('/backend-assets/forthebuilders/images/notification.png')); ?>"
                    alt="Notification">
                <div class="notifRegionNumber"><?php echo e($all_count); ?></div>
            </button>
            <div id="notificate_" class="notification_content display-none"
                style="border: none; background-color: transparent;" aria-labelledby="dropdownMenuButton2">
                <div class="up-arrow2"></div>
                <div class="dropdownMenyApplyNotification">
                    <?php if($all_count > 0): ?>
                        <?php $__currentLoopData = $all_notifications['all_booking']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking_notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                              $notification_data = json_decode($booking_notification->data);
                            ?>
                            <?php switch($booking_notification->type):
                                case ('Booking'): ?>
                                    <a href="<?php echo e(route('forthebuilder.booking.show', $notification_data->id)); ?>">
                                        <div class="d-flex">
                                            <img class="dropdownHumanImage"
                                                 src="<?php echo e(asset('/uploads/flat/booking.png')); ?>"
                                                 alt="HUman">
                                            <h4 class="dropDownHumanIamgeName">
                                                <?php echo e($notification_data->first_name . ' ' . $notification_data->last_name); ?>

                                            </h4>
                                        </div>
                                        <span
                                                class="humoanSmsDropdownYellow"><?php echo e(translate('booking period is expired')); ?></span>
                                        <p class="humoanSmsDropdown">
                                                <span class="humoanSmsDropdownSpan float-right text-sm">
                                                    <?php echo e(date('m/d h:i', strtotime($notification_data->updated_at))); ?>

                                                </span>
                                        </p>
                                    </a>
                                    <hr style="margin: 0px 12px; margin-top: 44px;">
                                <?php break; ?>
                                <?php case ('BookingPrepayment'): ?>
                                    <a href="<?php echo e(route('forthebuilder.booking.show', $notification_data->id)); ?>">
                                        <div class="d-flex">
                                            <img class="dropdownHumanImage"
                                                 src="<?php echo e(asset('/uploads/flat/booking.png')); ?>"
                                                 alt="HUman">
                                            <h4 class="dropDownHumanIamgeName">
                                                <?php echo e($notification_data->first_name . ' ' . $notification_data->last_name); ?>

                                            </h4>
                                        </div>
                                        <span
                                                class="humoanSmsDropdownYellow"><?php echo e(translate('1 day left until the booking period ends')); ?></span>
                                        <p class="humoanSmsDropdown">
                                                <span class="humoanSmsDropdownSpan float-right text-sm">
                                                    <?php echo e(date('m/d h:i', strtotime($notification_data->updated_at))); ?>

                                                </span>
                                        </p>
                                    </a>
                                    <hr style="margin: 0px 12px; margin-top: 44px;">
                                <?php break; ?>
                            <?php endswitch; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $all_notifications['all_installment_plan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $installment_notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $installment_data = json_decode($installment_notification->data);
                            ?>
                            <a href="<?php echo e(route('forthebuilder.installment-plan.show', $installment_data->id)); ?>">
                                <div class="d-flex">
                                    <img class="dropdownHumanImage"
                                         src="<?php echo e(asset('/uploads/flat/installment_plan.avif')); ?>"
                                         alt="HUman">
                                    <h4 class="dropDownHumanIamgeName">
                                        <?php echo e($installment_data->first_name . ' ' . $installment_data->last_name); ?>

                                    </h4>
                                </div>
                                <span class="humoanSmsDropdownYellow"><?php echo e(translate('Installment plan period is expired')); ?></span>
                                <p class="humoanSmsDropdown">
                                    <span class="humoanSmsDropdownSpan float-right text-sm">
                                        <?php echo e(date('m/d h:i', $installment_data->expire_dates)); ?>

                                    </span>
                                </p>
                            </a>
                            <hr style="margin: 0px 12px; margin-top: 44px;">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $all_notifications['all_task']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task_notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $notification_data = json_decode($task_notification->data);
                            ?>
                            <a href="<?php echo e(route('forthebuilder.clients.show', [$notification_data->client_id, '0', $notification_data->id])); ?>">
                                <div class="d-flex">
                                    <?php
                                        $sms_avatar = public_path('/uploads/user/' . $notification_data->performer_id . '/s_' . $notification_data->performer_avatar);
                                    ?>
                                    <?php if(file_exists($sms_avatar)): ?>
                                        <img class="dropdownHumanImage"
                                             src="<?php echo e(asset('/uploads/user/' . $notification_data->performer_id . '/s_' . $notification_data->performer_avatar)); ?>"
                                             alt="Human">
                                    <?php else: ?>
                                        <img class="dropdownHumanImage"
                                             src="<?php echo e(asset('/backend-assets/forthebuilders/images/X.png')); ?>"
                                             alt="Human">
                                    <?php endif; ?>
                                    <h4 class="dropDownHumanIamgeName"><?php echo e($notification_data->performer_fio); ?></h4>
                                </div>
                                <span class="humoanSmsDropdown"><?php echo e($notification_data->title); ?>

                                    <span class="humoanSmsDropdownSpan"><?php echo e($notification_data->user_fio); ?></span>
                                </span>
                                <p class="humoanSmsDropdown"><?php echo e(translate('Task')); ?>:&nbsp;
                                    <?php if($notification_data->type == 'Связаться'): ?>
                                        <img src="<?php echo e(asset('/backend-assets/forthebuilders/images/Call.png')); ?>"
                                            alt="Call icon"><b>&nbsp;<?php echo e(translate('call')); ?></b>
                                        <?php echo e(translate('with') . ' '); ?>

                                        <span><?php echo e($notification_data->client_fio); ?></span><br>
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('/backend-assets/forthebuilders/images/meeting.png')); ?>"
                                            alt="Call icon" height="18px"><b>&nbsp;<?php echo e(translate('meeting')); ?></b>
                                        <?php echo e(translate('with' . ' ')); ?>

                                        <span class="humoanSmsDropdownSpan"><?php echo e($notification_data->client_fio); ?></span><br>
                                    <?php endif; ?>
                                    <span class="humoanSmsDropdownSpan"> <?php echo e($notification_data->task_date); ?></span>
                                </p>
                                <hr style="margin: 0px 12px; margin-top: -8px;">
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <h4 class="netNovixUvidomleniy"><?php echo e(translate('No new notifications')); ?></h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div>
            <?php
                if (session()->has('locale')) {
                    $locale = session('locale');
                } else {
                    $locale = env('DEFAULT_LANGUAGE', 'ru');
                }
                // $locale=app()->getLocale()?? env('DEFAULT_LANGUAGE');
            ?>
            <div class="align-items-stretch d-flex dropdown" id="lang-change">
                <a class="buttonUzbDropDownHeader dropdown-toggle" type="button" id="dropdownMenuButton" role="button"
                    data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" href="javascript:void(0);">
                    <?php switch($locale):
                        case ('uz'): ?>
                            <img class="notifRegion2" id="selected_language"
                                src="<?php echo e(asset('/backend-assets/forthebuilders/images/region.png')); ?>" alt="region">
                        <?php break; ?>

                        <?php case ('en'): ?>
                            <img class="notifRegion2" id="selected_language"
                                src="<?php echo e(asset('/backend-assets/forthebuilders/images/GB.png')); ?>" alt="region">
                        <?php break; ?>

                        <?php case ('ru'): ?>
                            <img class="notifRegion2" id="selected_language"
                                src="<?php echo e(asset('/backend-assets/forthebuilders/images/RU.png')); ?>" alt="region">
                        <?php break; ?>
                    <?php endswitch; ?>
                </a>
                <div id="language_flag" class="language_flag display-none"
                    style="border: none; background-color: transparent;" aria-labelledby="dropdownMenuButton">
                    <div class="up-arrow"></div>
                    <div class="dropdownMenyApplyUzbFlag">
                        <?php $__currentLoopData = \Modules\ForTheBuilder\Entities\Language::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="javascript:void(0)" data-flag="<?php echo e($language->code); ?>"
                           class="dropdown-item dropdown-item dropdownLanguageItem <?php if($locale == $language->code): ?> active <?php endif; ?>" >
                            <?php switch($language->code):
                                case ('uz'): ?>
                                    <img class="dropdownRegionBayroq" id="lang_uz" style="margin-right: 8px;" src="<?php echo e(asset('/backend-assets/forthebuilders/images/region.png')); ?>" alt="region">
                                    <?php echo e($language->name); ?>

                                    <?php break; ?>

                                    <?php case ('ru'): ?>
                                        <img class="dropdownRegionBayroq" id="lang_ru" style="margin-right: 8px;"
                                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/RU.png')); ?>" alt="region">
                                        <?php echo e($language->name); ?>

                                    <?php break; ?>

                                    <?php case ('en'): ?>
                                        <img class="dropdownRegionBayroq" id="lang_en" style="margin-right: 8px;"
                                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/GB.png')); ?>" alt="region">
                                        <?php echo e($language->name); ?>

                                    <?php break; ?>
                                <?php endswitch; ?>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('/backend-assets/forthebuilders/javascript/jquery-3.6.1.js')); ?>"></script>
<script src="<?php echo e(asset('/backend-assets/js/custom.js')); ?>"></script>
<script defer>
    $(document).ready(function() {
        let language = '<?php echo e($locale); ?>'
        let uz = `<?php echo e(asset('/backend-assets/forthebuilders/images/region.png')); ?>`
        let ru = `<?php echo e(asset('/backend-assets/forthebuilders/images/RU.png')); ?>`
        let en = `<?php echo e(asset('/backend-assets/forthebuilders/images/GB.png')); ?>`

        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdownMenyApplyUzbFlag a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    switch (locale) {
                        case 'uz':
                            $('#selected_language').attr('src', uz)
                            break;
                        case 'en':
                            $('#selected_language').attr('src', en)
                            break;
                        case 'ru':
                            $('#selected_language').attr('src', ru)
                            break;
                    }
                    $.post('<?php echo e(route('language.change')); ?>', {
                        _token: '<?php echo e(csrf_token()); ?>',
                        locale: locale
                    }, function(data) {
                        location.reload();
                    });

                });
            });
        }
    })
</script>
<script>
    let dropdownMenuButton2 = document.getElementById('dropdownMenuButton2')
    let dropdownMenuButton = document.getElementById('dropdownMenuButton')
    let language_flag = document.getElementById('language_flag')
    let notificate_ = document.getElementById('notificate_')
    dropdownMenuButton2.addEventListener('click', function() {
        if (notificate_.classList.contains('display-none')) {
            notificate_.classList.remove('display-none')
        } else {
            notificate_.classList.add('display-none')
        }
    });
    dropdownMenuButton.addEventListener('click', function() {
        if (language_flag.classList.contains('display-none')) {
            language_flag.classList.remove('display-none')
        } else {
            language_flag.classList.add('display-none')
        }
    });
</script>
<?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/layouts/content/header.blade.php ENDPATH**/ ?>