<?php $__env->startSection('title'); ?>
    <?php echo e(__('locale.apartment_sale')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <h2 class="panelUprText"><?php echo e(translate('Users')); ?></h2>
                    <a href="<?php echo e(route('forthebuilder.user.create')); ?>" class="plus2">+</a>
                </div>
                <div class="miniSearchDiv7Polzovatel">
                    <ion-icon class="miniSearchIconInput" name="search-outline"></ion-icon>
                    <input placeholder="<?php echo e(translate('Search by users')); ?>" class="miniInputSdelka6 searchTable"
                        type="text">
                </div>
            </div>

            <div class="polzovatelData">
                <div style="width: auto;" class="jkMiniData2">
                    <div class="checkboxDivInput">
                        <input class="checkBoxInput" type="checkbox" id="master">
                    </div>
                    <div class="checkboxDivInput">
                        №
                    </div>
                    <div class="polzovatelFioElectronieAddres">
                        <?php echo e(translate('Full name')); ?>

                    </div>
                    <div class="polzovatelFioElectronieAddres">
                        <?php echo e(translate('Email address')); ?>

                    </div>
                    <div class="pozovatelFoto">
                        <?php echo e(translate('Photo')); ?>

                    </div>
                    <div class="checkboxDivTextInput4 polzovatelDeystvieMax">
                        <?php echo e(translate('Action')); ?>

                    </div>
                </div>
                <?php if(!empty($models)): ?>
                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div style="width: auto;" class="polzovatelMiniData hideData">
                            <input type="hidden" class="hiddenData"
                                value="<?php echo e($model->first_name . ' '); ?> <?php echo e($model->last_name); ?> <br> <?php echo e($model->middle_name); ?> <?php echo e($model->email); ?>">
                            <div class="d-flex">
                                <a href="<?php echo e(route('forthebuilder.user.show', $model->id)); ?>" class="polzovatelNumber">
                                    <input class="checkBoxInput sub_chk" type="checkbox" data-id="<?php echo e($model->id); ?>">
                                </a>
                                <a href="<?php echo e(route('forthebuilder.user.show', $model->id)); ?>" class="polzovatelNumber">
                                    <?php echo e($models->firstItem() + $key); ?>

                                </a>
                                <a href="<?php echo e(route('forthebuilder.user.show', $model->id)); ?>" class="polzovatelFioElectronieAddres2">
                                    <?php echo e($model->first_name . ' '); ?> <?php echo e($model->last_name); ?> <br> <?php echo e($model->middle_name); ?>

                                </a>
                                <a href="<?php echo e(route('forthebuilder.user.show', $model->id)); ?>" class="polzovatelFioElectronieAddres2">
                                    <?php echo e($model->email); ?>

                                </a>
                                <a href="<?php echo e(route('forthebuilder.user.show', $model->id)); ?>" class="pozovatelFoto2">
                                    <?php
                                        if(!empty($model->avatar)){
                                            $file_url = public_path('/uploads/user/' . $model->id . '/s_' . $model->avatar);
                                        }else{
                                            $file_url = "";
                                        }
                                    ?>
                                    <?php if(file_exists($file_url)): ?>
                                        <img src="<?php echo e(asset('/uploads/user/' . $model->id . '/s_' . $model->avatar)); ?>"
                                            alt="HUman">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('/backend-assets/forthebuilders/images/X.png')); ?>"
                                            alt="HUman">
                                    <?php endif; ?>
                                </a>
                                <div class="polzovatelEditImg">
                                    <a href="<?php echo e(route('forthebuilder.user.show', $model->id)); ?>" class="seaDiv" title="show"
                                        style="margin-right: 10px;">
                                        <img style="margin-top: 4px;" width="25" height="25"
                                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/eye.png')); ?>" alt="Eye">
                                    </a>
                                    <a href="<?php echo e(route('forthebuilder.user.edit', $model->id)); ?>" class="seaDiv" title="update"
                                        style="margin-right: 10px;">
                                        <img class="mt-1" width="20" height="20"
                                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/edit.png')); ?>" alt="Edit">
                                    </a>
                                    <form style="display: inline-block;"
                                        action="<?php echo e(route('forthebuilder.user.destroy', $model->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <div style="margin-right: 10px;" type="submit" class="seaDiv" title="delete"><img
                                                class="mt-1" width="20" height="20"
                                                src="<?php echo e(asset('/backend-assets/forthebuilders/images/trash.png')); ?>"
                                                alt="Trash"></div>
                                    </form>
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
    <script>
        let page_name = 'user';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/user/index.blade.php ENDPATH**/ ?>