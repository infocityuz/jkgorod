<?php
    $pathInfo = explode('/', $_SERVER['REQUEST_URI']);
    $path = end($pathInfo);
    $indexCheck = 'checked';
    $indexFilterCheck = '';
    if ($path == 'filter-index') {
        $indexCheck = '';
        $indexFilterCheck = 'checked';
    }
    use Modules\ForTheBuilder\Entities\Constants;
?>




<?php $__env->startSection('content'); ?>

    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <h2 class="panelUprText"><?php echo e(translate('Tasks')); ?></h2>
                    
                    <a href="<?php echo e(route('forthebuilder.clients.calendar')); ?>"
                        class="kalendarButton"><?php echo e(translate('Calendar')); ?></a>
                </div>
            </div>

            <?php if(Auth::user()->role_id != Constants::MANAGER): ?>
                <div class="zadachiFlexCenter">
                    <div class="d-flex">
                        <button class="zadachiFlexVse">
                            <input class="zadachiFlexInputCheck" id="filter_all" <?php echo e($indexCheck); ?> type="radio"
                                name="filter" value='0'>
                            <label for="filter_all" style="margin-bottom: 0;"><?php echo e(translate('All')); ?></label>
                            
                        </button>
                        <button class="zadachiFlexMoiZadachi">
                            <input class="zadachiFlexInputCheck" id="filter_my_tasks" <?php echo e($indexFilterCheck); ?> type="radio"
                                name="filter" value='1'>
                            <label for="filter_my_tasks" style="margin-bottom: 0;"><?php echo e(translate('My tasks')); ?></label>
                            
                        </button>
                    </div>
                </div>
            <?php endif; ?>
           

            <div class="zadachiData">
                <div class="zadachiJustify" style="width: 100%; display: flex; justify-content: space-around; ">
                    <?php if(empty(!$arr)): ?>
                        <?php
                            $i = true;
                            $zadachi = 'zadachiRed';
                            $zadachiH3 = 'zadachiRedH3';
                            $zadachiP = 'zadachiRedP';
                            $style = 'margin-left: 2%';
                        ?>
                        <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="<?php echo e($style); ?>">
                                <div class="<?php echo e($zadachi); ?> zadachiMarginRight">
                                    <h3 class="<?php echo e($zadachiH3); ?>"><?php echo e($key); ?></h3>
                                    <p class="<?php echo e($zadachiP); ?>"><?php echo e(translate('All tasks')); ?>: <?php echo e(count($value)); ?></p>
                                </div>
                                <?php
                                    $zadachiH3 = 'zadachiBlueH3';
                                    $zadachi = 'zadachiBlue';
                                    $zadachiP = 'zadachiBlueP';
                                ?>
                                <div style="height: 550px; overflow-y: auto; overflow-x: hidden;">
                                    <?php if(isset($value) && !empty($value)): ?>
                                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('forthebuilder.clients.show', [$val['client_id'], '0', '0'])); ?>"
                                                class="zadachiBlueName zadachiMarginRight">
                                                <p class="zadachiSenderName"><?php echo e(translate('Responsible')); ?> :
                                                    <b><?php echo e($val['responsible']); ?></b>
                                                </p>
                                                <h3 class="zadachiBlueNameZ"><?php echo e($val['client']); ?> <br>
                                                    <?php echo e($val['client_middle_name']); ?></h3>
                                                <p class="zadachiBlueTime">
                                                    <?php echo e(translate('Date') . ': ' . date('d.m.Y', strtotime($val['day']))); ?><br>
                                                    <?php echo e(translate('Time') . ': ' . date('H:i:s', strtotime($val['time']))); ?></p>
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                                if ($i) {
                                    $i = false;
                                    $style = '';
                                }
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

                <div class="zadachiBorder1221">

                </div>
            </div>

            

            
        </div>
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border: none;">
                    <div class="modal-body">
                        <h2 class="modalVideystvitelno">Вы действительно хотите удалить</h2>
                        <div class="d-flex justify-content-center mt-5">
                            <button class="modalVideystvitelnoDa" data-dismiss="modal">Да</button>
                            <button class="modalVideystvitelnoNet" data-dismiss="modal">Нет</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let page_name = 'tasks';
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/task/index.blade.php ENDPATH**/ ?>