<div class="navigation active">
    <ul>
        <a href="./pages/profile.html" class="d-flex">
            <img class="profile" src="<?php echo e(asset('/backend-assets/forthebuilders/images/Ellipse 1.png')); ?>" alt="">
            <h4 class="userName">Magomed <span class="userSurname">Tailov</span></h4>
        </a>
        <li class="list" id="page-index">
            <b></b>
            <b></b>
            <a href="<?php echo e(route('forthebuilder.index')); ?>" class="hrefDrop">
                <div class="icon"><ion-icon name="home-outline"></ion-icon></div>
                <span class="title"><?php echo e(translate('Home')); ?></span>
            </a>
        </li>
        <li class="list" id="page-task">
            <b></b>
            <b></b>
            <a href="<?php echo e(route('forthebuilder.task.index')); ?>" class="hrefDrop">
                <div class="icon"><ion-icon name="receipt-outline"></ion-icon></div>
                <span class="title"><?php echo e(translate('task')); ?></span>
            </a>
        </li>
        <li class="list" id="page-deal">
            <b></b>
            <b></b>
            <a href="<?php echo e(route('forthebuilder.deal.index')); ?>" class="hrefDrop">
                <div class="icon"><ion-icon name="wallet-outline"></ion-icon></div>
                <span class="title"><?php echo e(translate('deal')); ?></span>
            </a>
        </li>
        <li class="list" id="page-clients">
            <b></b>
            <b></b>
            <a href="<?php echo e(route('forthebuilder.clients.index')); ?>" class="hrefDrop">
                <div class="icon">
                    <ion-icon name="people-outline"></ion-icon>
                </div>
                <span class="title"><?php echo e(translate('Clients')); ?></span>
            </a>
        </li>
        <li class="list" id="page-house">
            <b></b>
            <b></b>
            <a href="<?php echo e(route('forthebuilder.house.index')); ?>" class="hrefDrop">
                <div class="icon"><ion-icon name="business-outline"></ion-icon></div>
                <span class="title"><?php echo e(translate('JK')); ?></span>
            </a>
        </li>
        <li class="list" id="page-calendar">
            <b></b>
            <b></b>
            <a href="<?php echo e(route('forthebuilder.clients.calendar')); ?>" class="hrefDrop">
                <div class="icon">
                    <ion-icon name="calendar-outline"></ion-icon>
                </div>
                <span class="title"><?php echo e(translate('Calendar')); ?></span>
            </a>
        </li>
        <li class="list" id="page-index">
            <b></b>
            <b></b>
            <a href="<?php echo e(route('forthebuilder.booking.index')); ?>" class="hrefDrop">
                <div class="icon"><ion-icon name="calendar-clear-outline"></ion-icon></div>
                <span class="title"><?php echo e(translate('Booking')); ?></span>
            </a>
        </li>
        <li class="list" id="page-installment-plan">
            <b></b>
            <b></b>
            <a href="<?php echo e(route('forthebuilder.installment-plan.index')); ?>" class="hrefDrop">
                <div class="icon"><ion-icon name="card-outline"></ion-icon></div>
                <span class="title"><?php echo e(translate('Installment plan')); ?></span>
            </a>
        </li>
        <li class="list" id="page-user">
            <b></b>
            <b></b>
            <a href="<?php echo e(route('forthebuilder.user.index')); ?>" class="hrefDrop">
                <div class="icon"><ion-icon name="people-circle-outline"></ion-icon></div>
                <span class="title"><?php echo e(translate('User')); ?></span>
            </a>
        </li>
        <li class="list" id="page-settings">
            <b></b>
            <b></b>
            <a href="<?php echo e(route('forthebuilder.settings.index')); ?>" class="hrefDrop">
                <div class="icon"><ion-icon name="settings-outline"></ion-icon></div>
                <span class="title"><?php echo e(translate('Settings')); ?></span>
            </a>
        </li>
    </ul>
</div>
<?php /**PATH C:\OSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/layouts/content/navigation.blade.php ENDPATH**/ ?>