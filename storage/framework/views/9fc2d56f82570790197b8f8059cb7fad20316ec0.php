
<?php
    use Modules\ForTheBuilder\Entities\House;
    use Modules\ForTheBuilder\Entities\Constants; 

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
                    <h2 class="panelUprText"><?php echo e(translate('JK')); ?></h2>
                    <?php if(Auth::user()->role_id == Constants::SUPERADMIN): ?>
                        <a href="<?php echo e(route('forthebuilder.house.create')); ?>" class="plus2">+</a>
                    <?php endif; ?>
                </div>
                <div class="miniSearchDiv5">
                    <ion-icon class="miniSearchIconInput md hydrated" name="search-outline" role="img"
                        aria-label="search outline"></ion-icon>
                    <input placeholder="<?php echo e(translate('Search by objects')); ?>" class="miniInputSdelka5 searchTable"
                        type="text">
                </div>
            </div>
            <div class="jkData">
                <div class="jkMiniData2" >
                    <div class="checkboxDivInput jkNumberInputChick">
                        <input class="checkBoxInput" type="checkbox">
                    </div>
                    <div class="checkboxDivInput jkNumberInputChick">
                        №
                    </div>
                    <div class="checkboxDivTextInput">
                        <?php echo e(translate('house_name')); ?>

                    </div>
                    <div class="checkboxDivTextInput2">
                        <?php echo e(translate('corpas')); ?>

                    </div>
                    <div class="checkboxDivTextInput">
                        <?php echo e(translate('info')); ?>

                    </div>
                    <div class="checkboxDivTextInput4 deystvieJkHome">
                        <?php echo e(translate('actions')); ?>

                    </div>
                </div>

                <?php if(!empty($models)): ?>
                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="jkMiniData mt-1 hideData" >
                            <input type="hidden" class="hiddenData"
                                value="<?php echo e($model->name); ?> <?php echo e($model->corpus); ?> <?php echo e($model->description); ?>">
                            <?php
                                if ($status == 'client') {
                                    $house_url = route('forthebuilder.client.houseFlat', [$model->id, $client_id]);
                                } else {
                                    $house_url = route('forthebuilder.house.show-more', $model->id);
                                }
                            ?>
                            <div class="jkMiniData" >
                                <a href="<?php echo e($house_url); ?>" class="checkboxDivInput jkNumberInputChick">
                                    <input class="checkBoxInput" type="checkbox">
                                </a>
                                <a href="<?php echo e($house_url); ?>" class="checkboxDivInput jkNumberInputChick">
                                    <?php echo e($models->firstItem() + $key); ?>

                                </a>
                                <a href="<?php echo e($house_url); ?>" class="checkboxDivTextInput">
                                    <?php echo e($model->name); ?>

                                </a>
                                <a href="<?php echo e($house_url); ?>" class="checkboxDivTextInput2">
                                    <?php if(!empty($model->corpus)): ?>
                                        <?php echo e($model->corpus); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </a>
                                <a href="<?php echo e($house_url); ?>" class="checkboxDivTextInput48">
                                    <?php echo e($model->description); ?>

                                </a>
                                <div class="checkboxDivTextInput4 deystvieJkHome">
                                    <a href="<?php echo e(route('forthebuilder.house.show-more', $model->id)); ?>"
                                        class="seaDiv">
                                            <img style="margin-top: 4px;" width="25" height="25"
                                                src="<?php echo e(asset('backend-assets/forthebuilders/images/eye.png')); ?>"
                                                alt="Eye">
                                    </a>
                                    <a href="#" class="seaDiv deleteHouses" data-delete_url="<?php echo e(route('forthebuilder.house.destroy', $model->id ?? 0)); ?>">
                                        <img class="mt-1" width="20" height="20" data-toggle="modal"
                                            data-target="#exampleModalLong"
                                            src="<?php echo e(asset('backend-assets/forthebuilders/images/trash.png')); ?>"
                                            alt="Trash">
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="aiz-pagination mt-4">
                    <?php echo e($models->links()); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;">
                <div class="modal-body">
                    <h2 class="modalVideystvitelno"><?php echo e(translate('Do you really want to delete')); ?></h2>
                    <div class="d-flex justify-content-center mt-5">
                        <form style="display: inline-block;"
                            action="<?php echo e(route('forthebuilder.house.destroy', $model->id ?? 0)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="modalVideystvitelnoDa"><?php echo e(translate('Yes')); ?></button>
                        </form>
                        <button class="modalVideystvitelnoNet" data-dismiss="modal"><?php echo e(translate('No')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let page_name = 'house';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\NewOSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/house/index.blade.php ENDPATH**/ ?>