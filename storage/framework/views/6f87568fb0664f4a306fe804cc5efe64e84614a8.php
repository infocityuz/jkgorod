<?php
    use Modules\ForTheBuilder\Entities\House;
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(translate('JK')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.house.index')); ?>" class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="<?php echo e(asset('backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>" alt=""></a>
                    <h2 class="panelUprText"><?php echo e($model->name); ?></h2>
                    
                </div>
            </div>

            <div class="d-flex justify-content-center" style="margin-bottom: 15px; margin-left: 130px;">
                <button class="vseButton btn-filter btn" data-filter="all">
                    <?php echo e(translate('All')); ?> ( <?php echo e($arr['count_all']); ?> )
                </button>
                
                <button class="svobodnoButton btn-filter btn" style="background: <?php echo e($colors[0] ?? ''); ?>;" data-filter="0">
                    <?php echo e(translate('Free')); ?> ( <?php echo e($arr['count_free']); ?> )
                </button>
                
                <button class="zanyatoButton btn-filter btn" style="background: <?php echo e($colors[1] ?? ''); ?>;" data-filter="1">
                    <?php echo e(translate('Busy')); ?> ( <?php echo e($arr['count_bookings']); ?> )
                </button>
                
                <button class="prodnoButton btn-filter btn" style="background: <?php echo e($colors[2] ?? ''); ?>;" data-filter="2">
                    <?php echo e(translate('Sold')); ?> ( <?php echo e($arr['count_solds']); ?> )
                </button>
                
            </div>

            <div class="sozdatJkDaleData">
                <div class="d-flex">
                    <div class="dalePodyedzEtaj" style="margin: 55px 20px 0 0;">
                        <?php if(empty(!$arr['entrance_count'])): ?>
                            <?php $__currentLoopData = $arr['entrance_count']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val_entrance_count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex" style="overflow: scroll">
                        <?php if(empty(!$arr['list'])): ?>
                            <?php
                                $n = 0;
                                $first = true;
                            ?>
                            <?php $__currentLoopData = $arr['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $n++;
                                    if ($status == 'client') {
                                        $house_details_url = e(url('forthebuilder/clients/client-show-details')) . '/' . $model->id . '/' . ($val['entrance'] ?? 0) . '/' . 0 . '/' . $client_id;
                                    } else {
                                        $house_details_url = e(url('forthebuilder/house/show-details')) . '/' . $model->id . '/' . ($val['entrance'] ?? 0) . '/' . 0;
                                    }
                                ?>
                                <a href="<?php echo e($house_details_url); ?>" style="display: inline; margin-bottom: 10px;">
                                    
                                    <div class="dalePodyedzBig">
                                        <h2 class="podyedzNameDale">
                                            <?php echo e(translate('Entrance') . ' ' . ($val['entrance'] ?? '')); ?>

                                        </h2>
                                        
                                        <?php if(empty(!$arr['list'])): ?>
                                            <?php $__currentLoopData = $val['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="d-flex">
                                                    <?php if($first): ?>
                                                        <h2 class="etajNameNomerDale" style="width: 120px; margin-top: 10px;"><?php echo e($key2); ?></h2>
                                                    <?php endif; ?>
                                                    <?php $__currentLoopData = $val2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div style="min-width: 60px; height: 60px;">
                                                            <div class="podyedzNameDaleNol padyedzNameJkSeeaGreen btn-filter-flat flat-button"
                                                                style="background-color: <?php echo e($colors[$val3['color_status']]); ?>;"
                                                                data-category="<?php echo e($val3['color_status']); ?>">
                                                                <?php echo e($val3['room_count'] ?? 0); ?>

                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </a>
                                <?php
                                    $first = false;
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('forthebuilder::house.extra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/house/show-more.blade.php ENDPATH**/ ?>