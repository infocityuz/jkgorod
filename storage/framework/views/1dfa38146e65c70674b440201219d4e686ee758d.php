

<?php
    use Modules\ForTheBuilder\Entities\Constants;
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <div style="max-width: 1394px;">
                <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <h2 class="panelUprText"><?php echo e(translate('Clients')); ?></h2>
                        <a href="<?php echo e(route('forthebuilder.clients.create')); ?>" class="plus2">+</a>
                    </div>
                    <div class="miniSearchDiv">
                        <ion-icon class="miniSearchIconInput" name="search-outline"></ion-icon>
                        <input placeholder="<?php echo e(translate('Deal search')); ?>" class="miniInputSdelka searchTable"
                            type="text">
                    </div>
                </div>
            </div>

            <div>
                <a href="<?php echo e(route('forthebuilder.clients.index')); ?>" class="cdelki_c_klientami">
                    <?php echo e(translate('Deals with clients')); ?>

                </a>
                <a href="<?php echo e(route('forthebuilder.clients.all-clients')); ?>" class="cdelki_c_klientamiBlue">
                    <?php echo e(translate('All clients')); ?>

                </a>
            </div>

            <div class="sdelkaData">
                <div class="jkMiniData2">
                    <div class="checkboxDivInput">
                        №
                    </div>
                    <div class="checkboxDivTextInput">
                        <?php echo e(translate('F.I.O. Clients')); ?>

                    </div>
                    <div class="ObjextSdelki">
                        <?php echo e(translate('Deal object')); ?>

                    </div>
                    <div class="ObjextSdelki">
                        <?php echo e(translate('Sum')); ?>

                    </div>
                    <div class="dataSdelkaJk">
                        <?php echo e(translate('Last action')); ?>

                    </div>
                    <div class="deystvieSdelka">
                        <?php echo e(translate('Action')); ?>

                    </div>
                </div>

                <?php if(empty(!$models)): ?>
                
                    
                    <?php
                        $n = 1;
                    ?>
                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <?php if(isset($value)): ?>
                            <div class="jkMiniData mb-1 hideData">
                                <input type="hidden" class="hiddenData"
                                    value="<?php echo e($value->client_id ? $value->client_first_name . ' ' . $value->client_last_name . ' ' . $value->client_middle_name : ''); ?> <?php echo e($value->house_name ?? ''); ?> <?php echo e($value->price_sell ?? ''); ?> <?php echo e($value->task_id ? $value->task_title : $defaultAction[$value->deal_type]); ?>">
                                <div class="d-flex lidiHrefBigLidiData">
                                    <a href="<?php echo e(route('forthebuilder.clients.show', [$value->client_id, '0', '0'])); ?>" class="checkboxDivInput">
                                        
                                        <?php echo e($models->firstItem() + $key); ?>

                                    </a>
                                    <a href="<?php echo e(route('forthebuilder.clients.show', [$value->client_id, '0', '0'])); ?>" class="checkboxDivTextInput">
                                        <?php echo e($value->client_id ? $value->client_first_name . ' ' . $value->client_last_name . ' ' . $value->client_middle_name : ''); ?>

                                    </a>
                                    <a href="<?php echo e(route('forthebuilder.clients.show', [$value->client_id, '0', '0'])); ?>" class="ObjextSdelki">
                                        <?php echo e($value->house_name ?? ''); ?>

                                    </a>
                                    <a href="<?php echo e(route('forthebuilder.clients.show', [$value->client_id, '0', '0'])); ?>" class="ObjextSdelki">
                                        <?php echo e($value->price_sell ?? ''); ?>

                                    </a>
                                    <?php
                                        $sdelkaClass = '';
                                        if ($value->deal_type == Constants::FIRST_CONTACT) {
                                            $sdelkaClass = 'dataSdelkaJkPinkNthChild';
                                        } elseif ($value->deal_type == Constants::NEGOTIATION) {
                                            $sdelkaClass = 'dataSdelkaJkYellowNthChild';
                                        } else {
                                            $sdelkaClass = 'dataSdelkaJkGreenNthChild';
                                        }
                                    ?>
                                    <a href="<?php echo e(route('forthebuilder.clients.show', [$value->client_id, '0', '0'])); ?>" class="dataSdelkaJk <?php echo e($sdelkaClass); ?>">
                                        
                                        <?php echo e($value->task_id ? $value->task_title : $defaultAction[$value->deal_type]); ?>

                                    </a>
                                </div>

                                <div class="deystvieSdelka">
                                    <a style='margin-right: 10px;' href="<?php echo e(route('forthebuilder.clients.edit', $value->client_id)); ?>" class="seaDiv">
                                        <img class="mt-1" width="20" height="20"
                                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/edit.png')); ?>" alt="Edit">
                                    </a>
                                    <button type="button" style="border: none; cursor: pointer;"
                                        class="seaDiv clientDelete model_delete"
                                        data-url="<?php echo e(route('forthebuilder.clients.destroy', $value->client_id)); ?>">
                                        <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20"
                                            height="20" src="<?php echo e(asset('backend-assets/forthebuilders/images/trash.png')); ?>"
                                            alt="Trash">
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
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
                    <h2 class="modalVideystvitelno">Вы действительно хотите удалить</h2>
                    <div class="d-flex justify-content-center mt-5">
                        <form style="display: inline-block;" action="" method="POST" id="form_delete">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="modalVideystvitelnoDa">Да</button>
                        </form>
                        <button class="modalVideystvitelnoNet" data-dismiss="modal">Нет</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/javascript/jquery.min.js')); ?>"></script>
    <script>
        let page_name = 'clients';
        $(document).ready(function() {
            $('.model_delete').on('click', function() {
                
                $('#form_delete').attr('action', $(this).attr('data-url'))
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\NewOSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/clients/index.blade.php ENDPATH**/ ?>