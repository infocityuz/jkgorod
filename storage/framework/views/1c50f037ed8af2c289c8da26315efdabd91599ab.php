<style>
    .display-none{
        display: none;
    }
    .notification_content{
        position: absolute;
        z-index: 1;
    }
    .language_flag{
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
        <div class="inputCustomDiv" style="width: 100%;margin-top: -16px;">
            <input class="searchInput" type="text">
        </div>
    </div>

    <div style="max-width: 169px; display: flex; margin-right: 80px;">
        <div class="dropdown">




            <button class="d-flex buttonUzbDropDownHeader"  type="button" id="dropdownMenuButton2" src="<?php echo e(asset('/backend-assets/forthebuilders/images/notification.png')); ?>" alt="Notification">
                <img class="notifRegion" src="<?php echo e(asset('/backend-assets/forthebuilders/images/notification.png')); ?>" alt="Notification">
                <div class="notifRegionNumber"><?php echo e(Auth::user()->unreadNotifications()->count()); ?></div>
            </button>

            <div id="notificate_" class="notification_content display-none" style="border: none; background-color: transparent;" aria-labelledby="dropdownMenuButton2">
                <div class="up-arrow2"></div>
                <div class="dropdownMenyApplyNotification">
                    <?php
                        $notifications = Auth::user()
                            ->unreadNotifications()
                            ->orderBy('created_at', 'desc')
                            ->get();
                        $nowDate = time();
                    ?>

                    <?php if(!empty($notifications)): ?>

                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php switch($notification->type):
                                case ('Modules\ForTheBuilder\Notifications\BookingNotification'): ?>
                                <a href="<?php echo e(route('forthebuilder.booking.show', $notification->data['id'])); ?>">
                                    <div class="d-flex">
                                        <?php if(!empty($notification->data['avatar'])): ?>
                                            <img class="dropdownHumanImage" src="<?php echo e(asset('/uploads/user/'.$notification->data['id'].'/s_' . $notification->data['avatar'])); ?>" alt="HUman">
                                        <?php else: ?>
                                            <img class="dropdownHumanImage" src="<?php echo e(asset('/backend-assets/forthebuilders/images/X.png')); ?>" alt="HUman">
                                        <?php endif; ?>
                                        <h4 class="dropDownHumanIamgeName"><?php echo e($notification->data['first_name'].' '.$notification->data['last_name']); ?></h4>
                                    </div>
                                    <span class="humoanSmsDropdownYellow"><?php echo e(translate('booking period is expired')); ?></span>
                                    <p class="humoanSmsDropdown">
                                        <span class="humoanSmsDropdownSpan float-right text-sm">
                                                <?php echo e(date('m/d h:i', strtotime($notification->data['updated_at']))); ?>

                                        </span>
                                    </p>
                                </a>
                                <hr style="margin: 0px 12px; margin-top: 44px;">
                                <?php break; ?>
                                <?php case ('Modules\ForTheBuilder\Notifications\BeforePrepayment'): ?>
                                <a href="<?php echo e(route('forthebuilder.booking.show', $notification->data['id'])); ?>">
                                    <div class="d-flex">
                                        <?php if(!empty($notification->data['avatar'])): ?>
                                            <img class="dropdownHumanImage" src="<?php echo e(asset('/uploads/user/'.$notification->data['id'].'/s_' . $notification->data['avatar'])); ?>" alt="HUman">
                                        <?php else: ?>
                                            <img class="dropdownHumanImage" src="<?php echo e(asset('/backend-assets/forthebuilders/images/X.png')); ?>" alt="HUman">
                                        <?php endif; ?>
                                        <h4 class="dropDownHumanIamgeName"><?php echo e($notification->data['first_name'].' '.$notification->data['last_name']); ?></h4>
                                    </div>
                                    <span class="humoanSmsDropdownYellow"><?php echo e(translate('1 day left until the booking period ends')); ?></span>
                                    <p class="humoanSmsDropdown">
                                        <span class="humoanSmsDropdownSpan float-right text-sm">
                                                <?php echo e(date('m/d h:i', strtotime($notification->data['updated_at']))); ?>

                                        </span>
                                    </p>
                                </a>
                                <hr style="margin: 0px 12px; margin-top: 44px;">
                                <?php break; ?>
                                <?php case ('Modules\ForTheBuilder\Notifications\TaskNotification'): ?>
                                <a href="<?php echo e(route('forthebuilder.clients.show', $notification->data['id'])); ?>">
                                    <div class="d-flex">
                                        <?php if(!empty($notification->data['performer_avatar'])): ?>
                                            <img class="dropdownHumanImage" src="<?php echo e(asset('/uploads/user/'.$notification->data['performer_id'].'/s_' . $notification->data['performer_avatar'])); ?>" alt="Human">
                                        <?php else: ?>
                                            <img class="dropdownHumanImage" src="<?php echo e(asset('/backend-assets/forthebuilders/images/X.png')); ?>" alt="Human">
                                        <?php endif; ?>
                                        <h4 class="dropDownHumanIamgeName"><?php echo e($notification->data['user_fio']); ?></h4>
                                    </div>
                                    <span class="humoanSmsDropdown"><?php echo e($notification->data['title']); ?></span>
                                    <p class="humoanSmsDropdown"><?php echo e(translate('Task')); ?>:&nbsp;
                                        <?php if($notification->data['type'] == 'Связаться'): ?>
                                            <img src="<?php echo e(asset('/backend-assets/forthebuilders/images/Call.png')); ?>" alt="Call icon"><b>&nbsp;<?php echo e(translate('call')); ?> <br></b>
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('/backend-assets/forthebuilders/images/meeting.png')); ?>" alt="Call icon" height="18px"><b>&nbsp;<?php echo e(translate('meeting')); ?> <br></b>
                                        <?php endif; ?>
                                        <span class="humoanSmsDropdownSpan"> <?php echo e($notification->data['task_date']); ?></span>
                                    </p>
                                    <hr style="margin: 0px 12px; margin-top: -8px;">
                                </a>
                                <?php break; ?>
                            <?php endswitch; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div>
                            <div class="d-flex">
                                <h4 class="dropDownHumanIamgeName"><?php echo e(translate("No notification")); ?></h4>
                            </div>
                            <span class="humoanSmsDropdown"></span>
                            <p class="humoanSmsDropdown"></p>
                        </div>
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
            <div class="align-items-stretch d-flex dropdown" id="lang-change" >
                <a class="buttonUzbDropDownHeader dropdown-toggle" type="button" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" href="javascript:void(0);">
                <?php switch($locale):
                    case ('uz'): ?>
                    <img class="notifRegion2" id="selected_language" src="<?php echo e(asset('/backend-assets/forthebuilders/images/region.png')); ?>" alt="region">
                        <?php break; ?>
                    <?php case ('en'): ?>
                    <img class="notifRegion2" id="selected_language" src="<?php echo e(asset('/backend-assets/forthebuilders/images/GB.png')); ?>" alt="region">
                        <?php break; ?>
                    <?php case ('ru'): ?>
                    <img class="notifRegion2" id="selected_language" src="<?php echo e(asset('/backend-assets/forthebuilders/images/RU.png')); ?>" alt="region">
                        <?php break; ?>
                <?php endswitch; ?>
                </a>
                <div id="language_flag" class="language_flag display-none" style="border: none; background-color: transparent;" aria-labelledby="dropdownMenuButton">
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
                                    <img class="dropdownRegionBayroq" id="lang_ru" style="margin-right: 8px;" src="<?php echo e(asset('/backend-assets/forthebuilders/images/RU.png')); ?>" alt="region">
                                    <?php echo e($language->name); ?>

                                    <?php break; ?>
                                <?php case ('en'): ?>
                                    <img class="dropdownRegionBayroq" id="lang_en" style="margin-right: 8px;" src="<?php echo e(asset('/backend-assets/forthebuilders/images/GB.png')); ?>" alt="region">
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
    $(document).ready(function(){
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
                    switch (locale){
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
    dropdownMenuButton2.addEventListener('click', function(){
        if(notificate_.classList.contains('display-none')){
            notificate_.classList.remove('display-none')
        }else{
            notificate_.classList.add('display-none')
        }
    });
    dropdownMenuButton.addEventListener('click', function(){
        if(language_flag.classList.contains('display-none')){
            language_flag.classList.remove('display-none')
        }else{
            language_flag.classList.add('display-none')
        }
    });
</script><?php /**PATH C:\OSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/layouts/content/header.blade.php ENDPATH**/ ?>