<!DOCTYPE html>
<html lang="en">
<?php
    use Modules\ForTheBuilder\Entities\HouseFlat;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" id="token">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo e(asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/fontawesome-free/css/all.min.css')); ?>">
    <title><?php echo e(translate('ItKey CRM')); ?></title>
</head>

<body>
    <style>
        .keyUpNameResultLi:hover {
            background: grey;
        }

        .keyUpNameResultLi {
            cursor: pointer;
        }
    </style>

    <?php echo $__env->yieldContent('content'); ?>


    <div class="modal fade" id="modal-for-flat">
        <div class="modal-dialog" style="max-width: 700px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('forthebuilder.house.update-flats-data')); ?>" method="POST"
                        enctype="multipart/form-data" id="chees-modal">
                        
                        
                        <div class="row">
                            <div class="col-md-4">
                                <label for="total_area"><?php echo e(translate('Total area')); ?></label>
                                <input type="number" name="total_area" id="total_area" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="living_space"><?php echo e(translate('Living space')); ?></label>
                                <input type="number" name="living_space" id="living_space" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="kitchen_area"><?php echo e(translate('Kitchen area')); ?></label>
                                <input type="number" name="kitchen_area" id="kitchen_area" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <br>
                                <div class="row">
                                    <div class="col-md-4" style="padding-top: 5px;">
                                        <label for="terassa"><?php echo e(translate('Terrace')); ?></label>
                                        <input type="checkbox" name="" id="terassa">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" name="terassa" id="terassa_input" class="form-control"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <div class="row">
                                    <div class="col-md-4" style="padding-top: 5px;">
                                        <label for="balcony"><?php echo e(translate('Balcony')); ?></label>
                                        <input type="checkbox" name="" id="balcony">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" name="balcony" id="balcony_input" class="form-control"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <br>
                                <div class="form-group">
                                    <label for="files"><?php echo e(__('locale.file__upload')); ?></label>
                                    <input type="file" name="files[]" id="files" multiple>
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="<?php echo e(translate('Save')); ?>"
                            class="btn btn-primary float-right save-flats-form">
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default-free">
        <div class="modal-dialog" style="max-width: 500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo e(translate('Vacate the apartment again')); ?> ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="justify-content-center">
                                <a type="submit" class="btn btn-success"
                                    id="renew_flat"><?php echo e(translate('Release')); ?></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/javascript/bootstrap.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/javascript/bootstrap.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/javascript/main.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/javascript/todayDate.js')); ?>"></script>
    <script type="module" src="<?php echo e(asset('https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/datatables-responsive/js/dataTables.responsive.min.js')); ?>">
    </script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>">
    </script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/toastr/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/select2/js/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/bootstrap-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>

    <script defer src="<?php echo e(asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
    <script defer src="<?php echo e(asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/filetype.min.js')); ?>">
    </script>
    <script defer src="<?php echo e(asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/buffer.min.js')); ?>">
    </script>
    <script defer src="<?php echo e(asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js')); ?>">
    </script>
    <script defer src="<?php echo e(asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/locales/ru.js')); ?>"></script>

    <script type="module" src="<?php echo e(asset('https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js')); ?>"></script>
    <script>
        let page_name = 'index';
        //avansni muddati tugaganda notificationga chiqarish
        function bookingtoast() {
            let today = new Date();
            // fetch('/forthebuilder/bookingapi')
            $.ajax({
                url: '/forthebuilder/bookingapi',
                type: 'GET',
                success: function(data) {
                    $(data).each(function(index) {
                        var booker_name = this.first_name;
                        var booker_surname = this.last_name;

                        //    avans muddati 1 kun tugashidan oldin chiqarish
                        if (today.getTime() / 1000 > this.notification_date && this.is_notify_before ==
                            null) {
                            $.ajax({
                                url: `/forthebuilder/thedaybeforenotification/${this.id}`,
                                type: 'GET',
                                success: function() {
                                    toastr.warning(
                                        `${booker_name} ${booker_surname}  <?php echo e(translate('one day left until the deadline')); ?>`
                                    );
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                }
                            });
                        }

                        //avansni muddati tugaganda notificationga chiqarish
                        if (today.getTime() / 1000 > this.expire_dates && this.is_notify == null) {
                            $.ajax({
                                url: `/forthebuilder/bookingnotification/${this.id}`,
                                type: 'GET',
                                success: function() {
                                    toastr.warning(
                                        `${booker_name} ${booker_surname}  <?php echo e(translate('advance period expired')); ?>`
                                    );
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                }
                            });
                        }
                    });
                }
            });
        }
        setInterval(bookingtoast, 30000)
    </script>
    <script>
        $('.btn-filter[data-filter]').on('click', function() {
            $('.btn-filter[data-filter]').removeClass('active');
            $(this).addClass('active');
            let filter = $(this).data('filter');

            $('.btn-filter-flat').addClass('d-none');
            if (filter == 0) {
                console.log($('.btn-filter-flat[data-category=0]'));
                $('.btn-filter-flat[data-category=0]').removeClass('d-none');
            } else if (filter == 1) {
                $('.btn-filter-flat[data-category=1]').removeClass('d-none');
            } else if (filter == 2) {
                $('.btn-filter-flat[data-category=2]').removeClass('d-none');
            } else {
                $('.btn-filter-flat').removeClass('d-none');
            }
        });



        var arr = []
        arr.push({
            'flats': [],
        })
        $(document).on('click', '.room-count-button', function() {
            $('.room-count-button').attr('disabled', true)
            var room_count_button = $(this).attr('data-number')
            $(this).removeClass('btn-primary').addClass('btn-success')
            $('.apartments-button[data-disabled=0]').removeAttr('disabled')
            $(this).attr('is-selected', true)
            var roomCount = $(this).attr('data-number')
            arr.push({
                'room_count': roomCount,
                'flats': [],
            })
        })

        $(document).on('click', '.apartments-button', function() {
            $(this).removeClass('btn-primary').addClass('btn-success')
            $('.count-rooms').text(parseInt($('.count-rooms').text()) + 1)
            $(this).attr('disabled', true)
            $(this).attr('is-selected', true)
            var thisId = $(this).attr('data-id')
            var roomCount = $('.room-count-button[is-selected=true]').attr('data-number')
            $('.save-flats').attr('disabled', false)

            if (arr[0].flats.indexOf(thisId) === -1) arr[0].flats.push(thisId)
            console.log(arr)
        })

        $(document).on('click', '.flat-button-open-modal', function() {
            var price = $(this).attr('data-price');
            var room_count = $(this).attr('data-room_count');
            var areas = $(this).attr('data-areas');
            var client = $(this).attr('data-client');
            var number_of_flat = $(this).attr('data-number_of_flat');
            var status = $(this).attr('data-status');

            $('#exampleModal .modal-body').find('.flat_price').text(price)
            $('#exampleModal .modal-body').find('.flat_room_count').text(room_count)
            $('#exampleModal .modal-header').find('.flat_area').text(areas)
            $('#exampleModal .modal-header').find('.number_of_flat').text(number_of_flat)
            if (client != '') {
                $('#exampleModal .modal-body').find('.flat_client_fio').show()
                $('#exampleModal .modal-body').find('.flat_client_fio .modalJkFioM').text(client)
            } else {
                $('#exampleModal .modal-body').find('.flat_client_fio').hide()
            }


            var house_flat_id = $(this).attr('data-house_flat_id');
            var house_house_id = $(this).attr('data-house_house_id');
            var house_house_name = $(this).attr('data-house_house_name');
            var house_contract_number = $(this).attr('data-house_contract_number');
            var house_entrance = $(this).attr('data-house_entrance');
            var house_floor = $(this).attr('data-house_floor');
            $('#exampleModal .modal-body').find('.house_flat_id').val(house_flat_id)
            $('#exampleModal .modal-body').find('.house_number_of_flat').val(number_of_flat)
            $('#exampleModal .modal-body').find('.house_house_id').val(house_house_id)
            $('#exampleModal .modal-body').find('.house_house_name').val(house_house_name)
            $('#exampleModal .modal-body').find('.house_contract_number').val(house_contract_number)
            $('#exampleModal .modal-body').find('.house_entrance').val(house_entrance)
            $('#exampleModal .modal-body').find('.house_floor').val(house_floor)

            $('#exampleModal .modal-body .selectModal option').attr('selected', false)
            $('#exampleModal .modal-body .selectModal option[data-select=' + status + ']').attr('selected',
                'selected')

            $('#exampleModal .modal-body').find('.modalPodrobnoButton').attr('href',
                '/forthebuilder/house-flat/show/' + house_flat_id)
        })

        $(document).on('click', '.save-flats-form', function(e) {
            e.preventDefault()
            var kv_m = $('.kv-m').val()
            var _token = $('input[name=_token]').val()
            var _form = $('#chees-modal').serializeArray()
            const data = {};
            $.each(_form, function() {
                data[this.name] = this.value
            })
            console.log(data)
            // alert('12312')
            $.ajax({
                url: `/forthebuilder/house/update-flats-data`,
                data: {
                    form: data,
                    flats: arr,
                    kv_m: kv_m,
                    _token: _token
                },
                type: 'PUT',
                success: function(data) {
                    if (data == true) {
                        location.reload()
                    }
                },
                // error: function(data) {
                //     console.log(data);
                // }
            });
        })

        $(document).on('change', '#terassa', function() {
            if ($(this).prop("checked") == true) {
                $('#terassa_input').attr('disabled', false)
            } else {
                $('#terassa_input').attr('disabled', true)
                $('#terassa_input').val('')
            }
        })

        $(document).on('change', '#balcony', function() {
            if ($(this).prop("checked") == true) {
                $('#balcony_input').attr('disabled', false)
            } else {
                $('#balcony_input').attr('disabled', true)
                $('#balcony_input').val('')
            }
        })

        $(document).ready(function() {
            var $el1 = $("#files");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#files").fileinput({
                language: 'ru',
                uploadUrl: "/forthebuilder/house-flat/file-upload",
                // deleteUrl: '/forthebuilder/deal/file-delete-all',
                allowedFileExtensions: ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'png', 'jpg', 'jpeg', 'svg'],
                uploadAsync: false,
                maxFileSize: 150000,
                maxFilesNum: 25,
                showUpload: false,
                showCaption: true,
                showRemove: false,
                removeClass: "btn btn-danger",
                removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
                overwriteInitial: false,
                // removeLabel: "Delete",
                // minFileCount: 1,
                // maxFileCount: 5,
                // hideThumbnailContent:false,
                // preferIconicPreview: true,
                browseOnZoneClick: true,
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreview: [
                    <?php if(!empty($dealFiles)): ?>
                        <?php $__currentLoopData = $dealFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dealItemFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            "<?php echo e(asset('/uploads/tmp_files/' . Auth::user()->id . '/house-flat/' . $dealItemFile->getFilename())); ?>",
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                ],
                initialPreviewConfig: [
                    <?php if(!empty($dealFiles)): ?>
                        <?php $__currentLoopData = $dealFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dealItemFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(
                                $dealItemFile->getExtension() == 'jpg' ||
                                    $dealItemFile->getExtension() == 'jpeg' ||
                                    $dealItemFile->getExtension() == 'png' ||
                                    $dealItemFile->getExtension() == 'pdf' ||
                                    $dealItemFile->getExtension() == 'doc' ||
                                    $dealItemFile->getExtension() == 'docx' ||
                                    $dealItemFile->getExtension() == 'xls' ||
                                    $dealItemFile->getExtension() == 'xlsx' ||
                                    $dealItemFile->getExtension() == 'svg'): ?>
                                {
                                    caption: "<?php echo e($dealItemFile->getFilename()); ?>",
                                    size: "<?php echo e($dealItemFile->getSize()); ?>",
                                    width: "120px",
                                    url: '/forthebuilder/house-flat/file-delete/' +
                                        '<?php echo e($dealItemFile->getFilename()); ?>',
                                    key: "<?php echo e($dealItemFile->getFilename()); ?>"
                                },
                            <?php else: ?>
                                {
                                    type: "<?php echo e($dealItemFile->getExtension()); ?>",
                                    caption: "<?php echo e($dealItemFile->getFilename()); ?>",
                                    size: "<?php echo e($dealItemFile->getSize()); ?>",
                                    width: "120px",
                                    url: '/forthebuilder/house-flat/file-delete/' +
                                        '<?php echo e($dealItemFile->getFilename()); ?>',
                                    key: "<?php echo e($dealItemFile->getFilename()); ?>"
                                },
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                ]
            }).on("filebatchselected", function(event, files) {
                $el1.fileinput("upload");
            }).on('filesorted', function(e, params) {
                console.log('file sorted', e, params);
            }).on('fileuploaded', function(e, params) {
                console.log('file uploaded', e, params);
            }).on('filesuccessremove', function(e, id) {
                console.log('file success remove', e, id);
            });
        })

        $(document).on('click', '.attach-order', function() {
            $('#modal-default-free .modal-title').text('')
            $('#modal-default-free .modal-body').html(`
                <label for=""><?php echo e(translate('Oder from which side')); ?></label>
                <br>
                <input type="radio" name="order" id="desc" value="1">
                <label for="desc"><?php echo e(translate('desc')); ?></label>
                <br>
                <input type="radio" name="order" id="asc" value="2">
                <label for="asc"><?php echo e(translate('asc')); ?></label>
                <hr>
                <label for="from"><?php echo e(translate('What number to start with')); ?></label>
                <input type="number" name="from" class="form-control" id="from">
                <br>
                <button class="btn btn-primary basket-to-house float-right"><?php echo e(translate('Next')); ?></button>
            `)
        })

        $(document).on('click', '.basket-to-house', function() {
            var id = $('#basket-id').val();
            var order = $('input[name=order]:checked').val();
            var from = $('#from').val();
            var _token = $('input[name=_token]').val();
            $.ajax({
                url: `/forthebuilder/house/basket-to-house`,
                data: {
                    id: id,
                    order: order,
                    from: from,
                    _token: _token
                },
                type: 'POST',
                success: function(data) {
                    location.replace("/forthebuilder/house/show-more/" + data)
                }
            })
        })

        $(document).on('click', '.selectModalDiv', function() {
            var thisVal = $('.selectModal').val();

            var house_flat_id = $('#exampleModal').find('.house_flat_id').val();
            var house_number_of_flat = $('#exampleModal').find('.house_number_of_flat').val();
            var house_house_id = $('#exampleModal').find('.house_house_id').val();
            var house_house_name = $('#exampleModal').find('.house_house_name').val();
            var house_contract_number = $('#exampleModal').find('.house_contract_number').val();
            var house_entrance = $('#exampleModal').find('.house_entrance').val();
            var house_floor = $('#exampleModal').find('.house_floor').val();

            if (thisVal == <?php echo e(HouseFlat::STATUS_SOLD); ?>) {
                location.replace("/forthebuilder/deal/create?house_flat_id=" + house_flat_id +
                    "&house_flat_number=" +
                    house_number_of_flat + "&house_id=" + house_house_id + '&house_name=' + house_house_name +
                    '&contract_number=' +
                    house_contract_number);
            } else if (thisVal == <?php echo e(HouseFlat::STATUS_BOOKING); ?>) {
                $('#exampleModal').addClass('d-none')
                $('#exampleModal2').addClass('show')

                $('#exampleModal2').find('.booking-house_flat_id').val(house_flat_id)
                $('#exampleModal2').find('.booking-house_number_of_flat').val(house_number_of_flat)
                $('#exampleModal2').find('.booking-house_house_id').val(house_house_id)
                $('#exampleModal2').find('.booking-house_house_name').val(house_house_name)
                $('#exampleModal2').find('.booking-house_contract_number').val(house_contract_number)
                $('#exampleModal2').find('.booking-house_entrance').val(house_entrance)
                $('#exampleModal2').find('.booking-house_floor').val(house_floor)
            } else {
                var gId = $('#exampleModal').find('.house_flat_id').val();
                $.get('/forthebuilder/house/show-more-item-detail/' + gId, function(data) {
                    console.log(data);
                    $.ajax({
                        url: `/forthebuilder/house-flat/update-status/${gId}`,
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            location.reload();
                            if (data['warning']) {
                                toastr.warning(data['warning']);
                            }
                            if (data['success']) {
                                toastr.success(data['success']);
                            }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                });
            }
        })

        $(document).on('click', '#sales', function() {
            var gId = $(this).parent().parent().find('.house_flat_id').val()
            var number_of_flat = $(this).parent().parent().find('.house_number_of_flat').val()
            var house_id = $(this).parent().parent().find('.house_house_id').val()
            var house_name = $(this).parent().parent().find('.house_house_name').val()
            var contract_number = $(this).parent().parent().find('.house_contract_number').val()
            var entrance = $(this).parent().parent().find('.house_entrance').val()
            var floor = $(this).parent().parent().find('.house_floor').val()
            var _token = $('input[name=_token]').val();

            location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + "&house_flat_number=" +
                number_of_flat + "&house_id=" + house_id + '&house_name=' + house_name + '&contract_number=' +
                contract_number);

            // $.ajax({
            //     url: "/forthebuilder/deal/create?house_flat_id=" + gId + "&house_flat_number=" +
            //         number_of_flat + "&house_id=" + house_id + '&house_name=' + house_name +
            //         '&contract_number=' + contract_number,
            //     data: {
            //         house_id: house_id,
            //         entrance: entrance,
            //         floor: floor,
            //         _token: _token
            //     },
            //     type: 'POST',
            //     success: function(data) {
            //         if (data == 'success') {
            //             location.reload();
            //         }
            //     }
            // })
        })

        // kvartiragani avans orqali band qilishda ism maydoniga keyUp qilinganda bazadan like orqali qidirib kelish
        $(document).on('keyup', '.keyUpName', function(e) {
            e.preventDefault();
            var name = $(this).val();
            var _this = $(this)
            _this.siblings('.keyUpNameResult').addClass('d-none');

            // kvartiragani avans orqali band qilishda ism maydoniga keyUp qilinganda bazadan like orqali qidirib kelish AJAX SEND
            $.get('/forthebuilder/house/search-by-name/' + name, function(data) {
                if (data['searchedLeadList'].length != 0) {
                    _this.siblings('.keyUpNameResult').removeClass('d-none');
                    // } else {
                    var listData = '';
                    $.each(data['searchedLeadList'], function(index, value) {
                        var series = '';
                        if (value['series_number']) {
                            var series = '[' + value['series_number'] + ']';
                        }
                        listData +=
                            `<li
                                style="list-style: none; padding: 10px;" class="select2-results__option keyUpNameResultLi"
                                first_name="` + value['first_name'] + `"
                                last_name="` + value['last_name'] + `"
                                phone="` + value['phone'] + `"
                                additional_phone="` + value['additional_phone'] + `"
                                middle_name="` + value['middle_name'] + `"
                                series_number="` + value['series_number'] + `"
                                client_id="` + value['id'] + `"
                                email="` + value['email'] + `"
                                inn="` + value['inn'] + `"
                                issued_by="` + value['issued_by'] + `"
                                given_date="` + value['given_date'] + `"
                            >
                                ` + value['first_name'] + `
                                ` + value['last_name'] + `
                                ` + value['middle_name'] + `
                                ( ` + value['phone'] + ` )
                                ` + series + `
                                </li>`;
                    });

                    _this.siblings('.keyUpNameResult').html(listData);
                }

            })
        });

        $(document).on('click', '.keyUpNameResultLi', function() {
            var first_name = $(this).attr('first_name')
            var last_name = $(this).attr('last_name')
            var phone = $(this).attr('phone')
            var additional_phone = $(this).attr('additional_phone')
            var middle_name = $(this).attr('middle_name')
            var series_number = $(this).attr('series_number')
            var client_id = $(this).attr('client_id')
            var email = $(this).attr('email')
            var inn = $(this).attr('inn')
            var issued_by = $(this).attr('issued_by')
            var given_date = $(this).attr('given_date')

            if (client_id == 'null') {
                client_id = ''
            }
            $('.booking-client_id').val(client_id)

            if (first_name == 'null') {
                first_name = ''
            }
            $('.booking-first_name').val(first_name)

            if (last_name == 'null') {
                last_name = ''
            }
            $('.booking-last_name').val(last_name)

            if (phone == 'null') {
                phone = ''
            }
            $('.booking-phone').val(phone)

            if (additional_phone == 'null') {
                additional_phone = ''
            }
            $('.booking-additional_phone').val(additional_phone)

            if (middle_name == 'null') {
                middle_name = ''
            }
            $('.booking-middle_name').val(middle_name)

            if (series_number == 'null') {
                series_number = ''
            }
            $('.booking-series_number').val(series_number)

            if (email == 'null') {
                email = ''
            }
            $('.booking-email').val(email)

            if (inn == 'null') {
                inn = ''
            }
            $('.booking-inn').val(inn)

            if (issued_by == 'null') {
                issued_by = ''
            }
            $('.booking-issued_by').val(issued_by)

            if (given_date == 'null') {
                given_date = ''
            }
            $('.booking-given_date').val(given_date)

            $('.keyUpNameResult').addClass('d-none');
        })

        $(document).on('change', '#prepayment', function() {
            if ($(this).is(':checked')) {
                $('.booking-prepayment_summa').attr('disabled', false)
            } else {
                $('.booking-prepayment_summa').attr('disabled', true)
            }
        });

        $(document).on('click', 'body', function() {
            $('.keyUpNameResult').addClass('d-none')
        })

        // $(document).on('click', '#free', function() {
        //     var id = $(this).parent().parent().find('.house_flat_id').val()
        //     $('#renew_flat').attr('data-id', id)
        // })

        // $(document).on('click', '#renew_flat', function() {
        //     var gId = $(this).attr('data-id')
        //     $.get('/forthebuilder/house/show-more-item-detail/' + gId, function(data) {
        //         console.log(data);
        //         if (data['flatItemDetail']['status'] == 2) {
        //             $.ajax({
        //                 url: `/forthebuilder/house-flat/update-status/${gId}`,
        //                 data: {
        //                     status: 0
        //                 },
        //                 type: 'PUT',
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 },
        //                 success: function(data) {
        //                     location.reload();
        //                     if (data['warning']) {
        //                         toastr.warning(data['warning']);
        //                     }
        //                     if (data['success']) {
        //                         toastr.success(data['success']);
        //                     }
        //                 },
        //                 error: function(data) {
        //                     console.log(data);
        //                 }
        //             });
        //         } else if (data['flatItemDetail']['status'] == 1) {
        //             toastr.warning("<?php echo e(__('locale.impossible the apartment is booked')); ?>");
        //         } else {
        //             toastr.warning("<?php echo e(__('locale.the apartment is already new')); ?>");
        //         }
        //     });
        // });

        $(document).on('click', '#sales', function() {
            var gId = $(this).parent().parent().find('.house_flat_id').val()
            var number_of_flat = $(this).parent().parent().find('.house_number_of_flat').val()
            var house_id = $(this).parent().parent().find('.house_house_id').val()
            var house_name = $(this).parent().parent().find('.house_house_name').val()
            var contract_number = $(this).parent().parent().find('.house_contract_number').val()
            var entrance = $(this).parent().parent().find('.house_entrance').val()
            var floor = $(this).parent().parent().find('.house_floor').val()
            var _token = $('input[name=_token]').val();

            location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + "&house_flat_number=" +
                number_of_flat + "&house_id=" + house_id + '&house_name=' + house_name + '&contract_number=' +
                contract_number);

            // $.ajax({
            //     url: "/forthebuilder/deal/create?house_flat_id=" + gId + "&house_flat_number=" +
            //         number_of_flat + "&house_id=" + house_id + '&house_name=' + house_name +
            //         '&contract_number=' + contract_number,
            //     data: {
            //         house_id: house_id,
            //         entrance: entrance,
            //         floor: floor,
            //         _token: _token
            //     },
            //     type: 'POST',
            //     success: function(data) {
            //         if (data == 'success') {
            //             location.reload();
            //         }
            //     }
            // })
        })

        $(document).on('click', '#delete-data-item', function(e) {
            if (!confirm('Вы уверены, что удалите этот элемент?')) {
                e.preventDefault();
            }
        })

        $(document).on('change', '.deal_create_house_id', function() {
            var houseID = $(this).val();
            console.log(houseID)
            $(".deal_create_registry_number").prop('disabled', true);
            if (houseID) {
                $.ajax({
                    type: "GET",
                    datatype: "json",
                    url: "/forthebuilder/deal/get-flat?house_id=" + houseID,
                    success: function(data) {
                        // console.log(data)
                        if (data) {
                            $(".deal_create_registry_number").empty();
                            $(".deal_create_registry_number").append(
                                "<option val=''>-------------</option>");
                            data.forEach(function(item) {
                                console.log(item)
                                $(".deal_create_registry_number").append('<option value="' +
                                    item
                                    .id + '">' + item.number_of_flat +
                                    '</option>');
                            })
                            $(".deal_create_registry_number").prop('disabled', false); //disable
                            // $("#inputID").prop('disabled', false); //enable
                        } else {
                            $(".deal_create_registry_number").empty();
                            $(".deal_create_registry_number").prop('disabled', false); //disable
                        }
                    }
                });
            } else {
                $(".deal_create_registry_number").empty();
            }
            // deal();
        });

        $(document).on('click', '.clientDelete', function() {
            var url = $(this).attr('data-url')
            $('#exampleModalLong .modal-body').find('form').attr('action', url)
        })

        $(document).on('click', '.clientInfoClick', function() {
            var id = $(this).attr('data-id')
            $('.clientInfoDiv').addClass('d-none')
            $('#' + id).removeClass('d-none')

            $('.clientInfoClick').removeClass('smsOneNumberBlue').addClass('smsOneNumber')
            $(this).addClass('smsOneNumberBlue')
        })

        $(document).on('change', ':radio[name="filter"]', function() {
            var url = '/forthebuilder/task/';
            if ($(this).val() == '1') {
                var url = '/forthebuilder/task/filter-index';
            }

            window.location.replace(url)
        })

        $(document).on('keyup', '.searchTable', function() {
            var _searchVal = $(this).val()
            $('.hideData').removeClass('d-none')
            $(".hiddenData").each(function(index) {
                var thisVal = $(this).val()

                if (thisVal.toLowerCase().search(_searchVal.toLowerCase()) < 0) {
                    $(this).parent('.hideData').addClass('d-none')
                }
            });
        })
    </script>
</body>

</html>
<?php /**PATH C:\OSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/layouts/forthebuilder.blade.php ENDPATH**/ ?>