<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Currency')); ?>

<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/datatables/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet"
    href="<?php echo e(asset('/backend-assets/forthebuilders/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css')); ?>">

<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.settings.index')); ?>"
                        class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>"
                            alt=""></a>
                    <h2 class="panelUprText"><?php echo e(translate('Language')); ?></h2>
                </div>
            </div>

            <div class="nastroykiData">
                <form class="form-horizontal" action="<?php echo e(route('env_key_update.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>


                    <div class="d-flex">
                        <h2 class="panelUprText yazik_poUmolchaniya yazikPo_umolchaniya"><?php echo e(translate('Default language')); ?>

                        </h2>
                        <input type="hidden" name="types[]" value="DEFAULT_LANGUAGE">
                        <select class="yazikHeader demo-select2-placeholder" id="country" name="DEFAULT_LANGUAGE">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($language->code); ?>" <?php if (env('DEFAULT_LANGUAGE') == $language->code) {
                                    echo 'selected';
                                } ?>>
                                    <?php echo e($language->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>


                        

                        <button class="yazik_soxranitBtn"><?php echo e(translate('Save')); ?></button>
                    </div>



                </form>

                <div class="sozdatRassrochkaDataUae">
                    <div class="checkboxDivInput">
                        №
                    </div>
                    <div class="checkboxDivTextInput3565">
                        <?php echo e(translate('Language')); ?>

                    </div>
                    <div class="checkboxDivTextInput3565">
                        <?php echo e(translate('Code')); ?>

                    </div>
                    <div class="checkboxDivTextInput35652">
                        <?php echo e(translate('Action')); ?>

                    </div>
                </div>

                <?php if(empty(!$languages)): ?>
                    <?php
                        $i = 1;
                    ?>
                    
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="sozdatRassrochkaDataUae2">
                            <div class="checkboxDivInput">
                                <?php echo e($i++); ?>

                            </div>
                            <div class="checkboxDivTextInput3565">
                                <?php echo e($value->name); ?>

                            </div>
                            <div class="checkboxDivTextInput3565">
                                <?php echo e($value->code); ?>

                            </div>
                            <div class="checkboxDivTextInput35652">
                                <div class="seaDiv">
                                    <a href="<?php echo e(route('forthebuilder.language.show', encrypt($value->id))); ?>"
                                        title="<?php echo e(translate('Translation')); ?>">
                                        <img class="mt-1" width="20" height="20"
                                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/translate.png')); ?>"
                                            alt="Trash">
                                    </a>
                                </div>
                                <div class="seaDiv">

                                    <a href="<?php echo e(route('forthebuilder.language.edit', encrypt($value->id))); ?>">
                                        <img class="mt-1" width="20" height="20"
                                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/edit.png')); ?>">
                                    </a>
                                </div>


                                <?php if($value->code != 'en'): ?>
                                    <div class="seaDiv">
                                        

                                        <a href="<?php echo e(route('forthebuilder.language.destroy', encrypt($value->id))); ?>"
                                            @disabled(true)>
                                            <img class="mt-1" width="20" height="20"
                                                src="<?php echo e(asset('/backend-assets/forthebuilders/images/trash.png')); ?>"
                                                alt="Trash">
                                        </a>

                                    </div>
                                <?php endif; ?>


                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <a href="<?php echo e(route('languages.create')); ?>" class="yazik_soxranitBtn2">
                    <img src="<?php echo e(asset('/backend-assets/forthebuilders/images/plus-circle.png')); ?>"
                        alt="Plus"><?php echo e(translate('Add language')); ?>

                </a>
            </div>
        </div>
    </div>
    <script>
        // function edit_tranlate(language) {
        //    console.log(language);
        //     document.getElementsByClassName('sozdatRassrochkaDataUae2').innerHTML ='';
        //     // location.reload();
        //     // document.getElementById('close_chat_group').style.backgroundColor="#17a2b8";
        //     // document.getElementById('close_chat').style.backgroundColor="#92b0e8";











        // //    console.log(language_name);

        // }
    </script>
    <script>
        let page_name = 'currency';
    </script>
<?php $__env->stopSection(); ?>
















<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/language/index.blade.php ENDPATH**/ ?>