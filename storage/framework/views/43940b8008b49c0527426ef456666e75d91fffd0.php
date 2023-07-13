<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex justify-content-between" style="z-index: 108;">
                <div class="d-flex">
                    <div class="d-flex">
                        <h2 class="panelUprText" title="Сделки">Сделки</h2>
                        
                        
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="sdelkaData">
                    <div class="d-flex" style="width: 100%; justify-content: center;">
                        <?php if(empty(!$arr)): ?>
                            <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4" style="height: 660px; overflow-y: scroll; overflow-x: hidden;">
                                    <div class="<?php echo e($value['class'] ?? 'lidiRed'); ?>" style="width: 100%;">
                                        <?php echo e($key); ?>

                                    </div>
                                    <div>
                                        <?php if(isset($value['list']) && !empty($value['list'])): ?>
                                            <?php $__currentLoopData = $value['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="d-flex" style="margin-top: 20px; width: 100%;">
                                                    <a href="<?php echo e(route('forthebuilder.clients.show', [$val['client_id'], '0', '0'])); ?>"
                                                       class="lidiOfficial w-100">
                                                        
                                                        <p class="zadachiSenderName"><?php echo e(translate('Responsible')); ?>:
                                                            <b><?php echo e($val['responsible']); ?></b>
                                                        </p>
                                                        <h3 class="lidiClientov"><?php echo e($val['client']); ?></h3>
                                                        <p class="zadachiBlueTime"><?php echo e(translate('day')); ?>: <?php echo e($val['day']); ?>

                                                            <br>
                                                            <?php echo e(translate('time')); ?>: <?php echo e($val['time']); ?>

                                                        </p>
                                                    </a>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
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
            let page_name = 'deal';
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/deal/index.blade.php ENDPATH**/ ?>