<!DOCTYPE html>
<html lang="en">
@php
    use Modules\ForTheBuilder\Entities\HouseFlat;
    use Modules\ForTheBuilder\Entities\Constants;
@endphp

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend-assets/forthebuilders/images/fav.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend-assets/forthebuilders/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/fontawesome-free/css/all.min.css') }}">
    
    <title>{{ translate('ICStroy') }}</title>
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

    @yield('content')


    <div class="modal fade" id="modal-for-flat">
        <div class="modal-dialog" style="max-width: 700px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('forthebuilder.house.update-flats-data') }}" method="POST"
                        enctype="multipart/form-data" id="chees-modal2">
                        {{-- @csrf --}}
                        {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="total_area">{{ translate('Total area') }}</label>
                                <input type="number" name="total_area" id="total_area" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="living_space">{{ translate('Living space') }}</label>
                                <input type="number" name="living_space" id="living_space" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="kitchen_area">{{ translate('Kitchen area') }}</label>
                                <input type="number" name="kitchen_area" id="kitchen_area" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <br>
                                <div class="row">
                                    <div class="col-md-4" style="padding-top: 5px;">
                                        <label for="terassa">{{ translate('Terrace') }}</label>
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
                                        <label for="balcony">{{ translate('Balcony') }}</label>
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
                                    <label for="files">{{ __('locale.file__upload') }}</label>
                                    <input type="file" name="files[]" id="files" multiple>
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="{{ translate('Save') }}"
                            class="btn btn-primary float-right save-flats-form">
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button class="btn btn-primary">{{ translate('Save') }}</button>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default-free">
        <div class="modal-dialog" style="max-width: 500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ translate('Vacate the apartment again') }} ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="justify-content-center">
                                <a type="submit" class="btn btn-success"
                                    id="renew_flat">{{ translate('Release') }}</a>
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
    <script defer src="{{ asset('/backend-assets/forthebuilders/javascript/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/backend-assets/forthebuilders/javascript/main.js') }}"></script>
    <script src="{{ asset('/backend-assets/forthebuilders/javascript/todayDate.js') }}"></script>
    <script type="module" src="{{ asset('https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js')}}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/forthebuilders/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('/backend-assets/forthebuilders/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('/backend-assets/forthebuilders/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/forthebuilders/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>
     <script src="{{ asset('/backend-assets/forthebuilders/javascript/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script defer src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script defer src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/filetype.min.js') }}">
    </script>
    <script defer src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/buffer.min.js') }}">
    </script>
    <script defer src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js') }}">
    </script>
    <script defer src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/locales/ru.js') }}"></script>

    <script type="module" src="{{ asset('https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js')}}"></script>
    <script>
        //avansni muddati tugaganda notificationga chiqarish
        function bookingtoast() {
            let today = new Date();
            $.ajax({
                url: '/forthebuilder/paystatus-api',
                type: 'GET',
                success: function(data) {
                    $(data).each(function(index) {
                        var booker_name = this.first_name;
                        var booker_surname = this.last_name;
                        //    avans muddati 1 kun tugashidan oldin chiqarish
                        if (today.getTime() / 1000 > this.expire_dates && this.is_notify ==
                            null) {
                            $.ajax({
                                url: `/forthebuilder/paystatus-notification/${this.id}`,
                                type: 'GET',
                                success: function(data) {
                                    if(data != "no"){
                                        toastr.warning(
                                            `${booker_name} ${booker_surname}  {{ translate('one day left until the deadline') }}`
                                        );
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    }
                                }
                            });
                        }
                    });
                }
            });
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
                                success: function(data) {
                                    if(data != "no"){
                                        toastr.warning(
                                            `${booker_name} ${booker_surname}  {{ translate('one day left until the deadline') }}`
                                        );
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    }
                                }
                            });
                        }

                        //avansni muddati tugaganda notificationga chiqarish
                        if (today.getTime() / 1000 > this.expire_dates && this.is_notify == null) {
                            $.ajax({
                                url: `/forthebuilder/bookingnotification/${this.id}`,
                                type: 'GET',
                                success: function(data) {
                                    if(data != "no"){
                                        toastr.warning(
                                            `${booker_name} ${booker_surname}  {{ translate('advance period expired') }}`
                                        );
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    }
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

            // $('.btn-filter-flat').addClass('d-none');
            $('.btn-filter-flat').attr('disabled', true)
            $('.btn-filter-flat').css('opacity', 0.3)
            if (filter == 0) {
                $('.btn-filter-flat[data-category=0]').attr('disabled', false);
                $('.btn-filter-flat[data-category=0]').css('opacity', 1);
            } else if (filter == 1) {
                $('.btn-filter-flat[data-category=1]').attr('disabled', false);
                $('.btn-filter-flat[data-category=1]').css('opacity', 1);
            } else if (filter == 2) {
                $('.btn-filter-flat[data-category=2]').attr('disabled', false);
                $('.btn-filter-flat[data-category=2]').css('opacity', 1);
            } else {
                $('.btn-filter-flat').attr('disabled', false);
                $('.btn-filter-flat').css('opacity', 1)
            }
        });


        var arr = []
        arr.push({
            'flats': [],
        })
        $(document).on('click', '.room-count-button', function() {
            var def = $(this).attr('data-def')
            $('.room-count-button').attr('disabled', true)
            var room_count_button = $(this).attr('data-number')
            var roomCount = $(this).attr('data-number')

            if (def == 0) {
                $(this).attr('disabled', false)
                $(this).attr('data-def', 1)
                $(this).removeClass('btn-primary').addClass('btn-success')
                $(this).css('background', '#28a745')
                $('.apartments-button').css('background', '#D9D9D9')
                $('.apartments-button[data-disabled=0]').removeAttr('disabled')
                $(this).attr('is-selected', true)
                arr.push({
                    'room_count': roomCount,
                    'flats': [],
                })
            } else {
                $('.room-count-button').attr('disabled', false)
                $('.apartments-button[data-def=1]').trigger('click')
                $('.apartments-button').css('background', '#6c757d')
                $('.apartments-button[data-def=1]').attr('data-def', 0)

                $(this).attr('data-def', 0)
                $(this).removeClass('btn-primary').removeClass('btn-success')
                $(this).css('background', '#94B2EB')
                $('.apartments-button[data-disabled=0]').attr('disabled', true)
                $(this).attr('is-selected', false)
            }
        })

        $(document).on('click', '.apartments-button', function() {
            var isSelected = $(this).attr('is-selected', true)
            var thisId = $(this).attr('data-id')
            var def = $(this).attr('data-def')
            var roomCount = $('.room-count-button[is-selected=true]').attr('data-number')
            $('.save-flats').attr('disabled', false)

            if (def == 0) {
                $(this).removeClass('btn-primary').removeClass('btn-secondary')
                $(this).removeClass('btn-primary').addClass('btn-success')
                $(this).removeClass('btn-primary').css('background', '#28a745')
                $(this).attr('data-def', 1)
                arr[0].flats.push(thisId)
                $('.count-rooms').text(parseInt($('.count-rooms').text()) + 1)
            } else {
                $(this).removeClass('btn-primary').removeClass('btn-success')
                $(this).removeClass('btn-primary').addClass('btn-secondary')
                $(this).removeClass('btn-primary').css('background', '#D9D9D9')
                $(this).attr('data-def', 0)
                arr[0].flats.splice(arr[0].flats.indexOf(thisId), 1)
                $('.count-rooms').text(parseInt($('.count-rooms').text()) - 1)
            }

            console.log(arr[0])
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
                // $('#exampleModal .modal-body').find('.flat_client_fio').show()
                $('#exampleModal .modal-body').find('.flat_client_fio .modalJkFioM').text(client)
            } else {
                $('#exampleModal .modal-body').find('.flat_client_fio .modalJkFioM').text(
                    `{{ translate('No data') }}`)
                // $('#exampleModal .modal-body').find('.flat_client_fio').hide()
            }

            if (status == {{ Constants::STATUS_SOLD }}) {
                $('#exampleModal .modal-body').find('.modalSelect').addClass('d-none')
                $('#exampleModal .modal-body').find('.showDetailsStatus').removeClass('d-none')
            } else {
                $('#exampleModal .modal-body').find('.modalSelect').removeClass('d-none')
                $('#exampleModal .modal-body').find('.showDetailsStatus').addClass('d-none')
            }

            var house_flat_id = $(this).attr('data-house_flat_id');
            var house_house_id = $(this).attr('data-house_house_id');
            var house_house_name = $(this).attr('data-house_house_name');
            var house_contract_number = $(this).attr('data-house_contract_number');
            var house_entrance = $(this).attr('data-house_entrance');
            var house_floor = $(this).attr('data-house_floor');
            var data_doc = $(this).attr('data-doc');
            var price_m2 = $(this).attr('data-price_m2');
            // alert(price_m2)
            $('#exampleModal .modal-body').find('.house_flat_id').val(house_flat_id)
            $('#exampleModal .modal-body').find('.house_number_of_flat').val(number_of_flat)
            $('#exampleModal .modal-body').find('.house_house_id').val(house_house_id)
            $('#exampleModal .modal-body').find('.house_house_name').val(house_house_name)
            $('#exampleModal .modal-body').find('.house_contract_number').val(house_contract_number)
            $('#exampleModal .modal-body').find('.house_entrance').val(house_entrance)
            $('#exampleModal .modal-body').find('.house_floor').val(house_floor)
            $('#exampleModal .modal-body').find('.house_price_m2').val(price_m2)
            $('#exampleModal .modal-body').find('img').attr('src', data_doc)

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
            var _form = $('#exampleModal #chees-modal').serializeArray()
            const data = {};
            $.each(_form, function() {
                data[this.name] = this.value
            })
            console.log(data)
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
                    @if (!empty($dealFiles))
                        @foreach ($dealFiles as $dealItemFile)
                            "{{ asset('/uploads/tmp_files/' . Auth::user()->id . '/house-flat/' . $dealItemFile->getFilename()) }}",
                        @endforeach
                    @endif
                ],
                initialPreviewConfig: [
                    @if (!empty($dealFiles))
                        @foreach ($dealFiles as $dealItemFile)
                            @if (
                                $dealItemFile->getExtension() == 'jpg' ||
                                    $dealItemFile->getExtension() == 'jpeg' ||
                                    $dealItemFile->getExtension() == 'png' ||
                                    $dealItemFile->getExtension() == 'pdf' ||
                                    $dealItemFile->getExtension() == 'doc' ||
                                    $dealItemFile->getExtension() == 'docx' ||
                                    $dealItemFile->getExtension() == 'xls' ||
                                    $dealItemFile->getExtension() == 'xlsx' ||
                                    $dealItemFile->getExtension() == 'svg')
                                {
                                    caption: "{{ $dealItemFile->getFilename() }}",
                                    size: "{{ $dealItemFile->getSize() }}",
                                    width: "120px",
                                    url: '/forthebuilder/house-flat/file-delete/' +
                                        '{{ $dealItemFile->getFilename() }}',
                                    key: "{{ $dealItemFile->getFilename() }}"
                                },
                            @else
                                {
                                    type: "{{ $dealItemFile->getExtension() }}",
                                    caption: "{{ $dealItemFile->getFilename() }}",
                                    size: "{{ $dealItemFile->getSize() }}",
                                    width: "120px",
                                    url: '/forthebuilder/house-flat/file-delete/' +
                                        '{{ $dealItemFile->getFilename() }}',
                                    key: "{{ $dealItemFile->getFilename() }}"
                                },
                            @endif
                        @endforeach
                    @endif
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
            $('#exampleModalNext .modal-title').text('')
            $('#exampleModalNext .modal-body').html(`
            <label for="">{{ translate('Oder from which side') }}</label>
            <br>
            <input type="radio" name="order" id="desc" value="1">
            <label for="desc">{{ translate('desc') }}</label>
            <br>
            <input type="radio" name="order" id="asc" value="2">
            <label for="asc">{{ translate('asc') }}</label>
            <hr>
            <label for="from">{{ translate('What number to start with') }}</label>
            <input type="number" name="from" class="form-control" id="from">
            <br>
            <button class="btn sozdatImyaSpisokSozdatButtonSave basket-to-house float-right mt-0">{{ translate('Next') }}</button>
            `)
        })

        $(".basket-to-house").unbind('click').bind('click', function () {

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
            var flat_price = $('#exampleModal').find('.flat_price').text();
            var price_m2 = $('#exampleModal').find('.house_price_m2').val();
            var data_areas = $('#exampleModal').find('.flat_area').text();

            if (thisVal == {{ HouseFlat::STATUS_SOLD }}) {
                location.replace("/forthebuilder/deal/create?house_flat_id=" + house_flat_id +
                    "&house_flat_number=" +
                    house_number_of_flat + "&house_id=" + house_house_id + '&house_name=' + house_house_name +
                    '&contract_number=' + house_contract_number + '&flat_price=' + flat_price + '&price_m2=' + price_m2);
            } else if (thisVal == {{ HouseFlat::STATUS_BOOKING }}) {
                $('#exampleModal2').removeClass('d-none')
                $('#exampleModal').addClass('d-none')
                $('#exampleModal2').addClass('show')

                $('#exampleModal2').find('.booking-house_flat_id').val(house_flat_id)
                $('#exampleModal2').find('.booking-house_number_of_flat').val(house_number_of_flat)
                $('#exampleModal2').find('.booking-house_house_id').val(house_house_id)
                $('#exampleModal2').find('.booking-house_house_name').val(house_house_name)
                $('#exampleModal2').find('.booking-house_contract_number').val(house_contract_number)
                $('#exampleModal2').find('.booking-house_entrance').val(house_entrance)
                $('#exampleModal2').find('.booking-house_floor').val(house_floor)

                $('#exampleModal2').find('.apartment_number').text(house_number_of_flat)
                $('#exampleModal2').find('.apartment_price_m2').text(price_m2)
                $('#exampleModal2').find('.apartment_area').text(data_areas)
                $('#exampleModal2').find('.apartment_price').text(flat_price)
            } else {
                var gId = $('#exampleModal').find('.house_flat_id').val();
                console.log(gId)
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
        //             toastr.warning("{{ __('locale.impossible the apartment is booked') }}");
        //         } else {
        //             toastr.warning("{{ __('locale.the apartment is already new') }}");
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

        $(document).on('click', '.client-show-change-status', function() {
            var series = $(this).attr('data-series_number')
            var inn = $(this).attr('data-inn')
            var issued_by = $(this).attr('data-issued_by')
            var budget_ = $(this).attr('budget')
            var looking_for_ = $(this).attr('looking_for')
            var deal_status = $(this).attr('deal_status')
            let password_checkbox_ = document.getElementById('password_checkbox')
            let password_input_ = document.getElementsByClassName('password_input')
            let first_contact = '{{ translate('First contact') }}'
            let negotiation = '{{ translate('Negotiation') }}'
            let make_deal = '{{ translate('Making a deal') }}'
            if (password_checkbox_.checked != true) {
                password_input_[0].setAttribute('disabled', true)
                password_input_[1].setAttribute('disabled', true)
                password_input_[2].setAttribute('disabled', true)
            }
            $('#selected_deal_status').text()

            function setValue() {
                if (series != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-series').val(series)
                }
                if (budget_ != "") {
                    $('#budget_input').val(budget_)
                    $('#budget_input_hidden').val(budget_)
                }
                if (looking_for_ != "") {
                    $('#looking_for_input').val(looking_for_)
                    $('#looking_for_hidden').val(looking_for_)
                }
                if (issued_by != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-issued').val(issued_by)
                }
                if (inn != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-inn').val(inn)
                }
                switch (deal_status) {
                    case '1':
                        $('#selected_deal_status').text(first_contact)
                        $('#selected_deal_status').addClass('status_first_contact')
                        if ($('#selected_deal_status').hasClass('status_negotiation')) {
                            $('#selected_deal_status').removeClass('status_negotiation')
                        }
                        if ($('#selected_deal_status').hasClass('status_making_a_deal')) {
                            $('#selected_deal_status').removeClass('status_making_a_deal')
                        }
                        break
                    case '2':
                        $('#selected_deal_status').text(negotiation)
                        $('#selected_deal_status').addClass('status_negotiation')
                        if ($('#selected_deal_status').hasClass('status_first_contact')) {
                            $('#selected_deal_status').removeClass('status_first_contact')
                        }
                        if ($('#selected_deal_status').hasClass('status_making_a_deal')) {
                            $('#selected_deal_status').removeClass('status_making_a_deal')
                        }
                        break
                    case '3':
                        $('#selected_deal_status').text(make_deal)
                        $('#selected_deal_status').addClass('status_making_a_deal')
                        if ($('#selected_deal_status').hasClass('status_negotiation')) {
                            $('#selected_deal_status').removeClass('status_negotiation')
                        }
                        if ($('#selected_deal_status').hasClass('status_first_contact')) {
                            $('#selected_deal_status').removeClass('status_first_contact')
                        }
                        break
                    default:
                }
            }
            setValue()
            password_checkbox_.addEventListener('change', function() {
                if (password_checkbox.checked != true) {
                    password_input_[0].setAttribute('disabled', true)
                    password_input_[1].setAttribute('disabled', true)
                    password_input_[2].setAttribute('disabled', true)
                    password_input_[0].value = ''
                    password_input_[1].value = ''
                    password_input_[2].value = ''
                } else {
                    password_input_[0].removeAttribute('disabled')
                    password_input_[1].removeAttribute('disabled')
                    password_input_[2].removeAttribute('disabled')
                    setValue()
                }
                if (series != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-series').attr("disabled",
                        true)
                }
                if (issued_by != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-issued').attr("disabled",
                        true)
                }
                if (inn != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-inn').attr("disabled",
                        true)
                }
            });

        })

        $(document).on('click', '.clientInfoClick', function() {
            var series = $(this).attr('data-series_number')
            var inn = $(this).attr('data-inn')
            var issued_by = $(this).attr('data-issued_by')
            var budget_ = $(this).attr('budget')
            var looking_for_ = $(this).attr('looking_for')
            var deal_status = $(this).attr('deal_status')
            let password_checkbox_ = document.getElementById('password_checkbox')
            let password_input_ = document.getElementsByClassName('password_input')
            let first_contact = '{{ translate('First contact') }}'
            let negotiation = '{{ translate('Negotiation') }}'
            let make_deal = '{{ translate('Making a deal') }}'
            if (password_checkbox_.checked != true) {
                password_input_[0].setAttribute('disabled', true)
                password_input_[1].setAttribute('disabled', true)
                password_input_[2].setAttribute('disabled', true)
            }
            $('#selected_deal_status').text()

            function setValue() {
                if (series != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-series').val(series)
                }
                if (budget_ != "") {
                    $('#budget_input').val(budget_)
                    $('#budget_input_hidden').val(budget_)
                }
                if (looking_for_ != "") {
                    $('#looking_for_input').val(looking_for_)
                    $('#looking_for_hidden').val(looking_for_)
                }
                if (issued_by != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-issued').val(issued_by)
                }
                if (inn != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-inn').val(inn)
                }
                switch (deal_status) {
                    case '1':
                        $('#selected_deal_status').text(first_contact)
                        $('#selected_deal_status').addClass('status_first_contact')
                        if ($('#selected_deal_status').hasClass('status_negotiation')) {
                            $('#selected_deal_status').removeClass('status_negotiation')
                        }
                        if ($('#selected_deal_status').hasClass('status_making_a_deal')) {
                            $('#selected_deal_status').removeClass('status_making_a_deal')
                        }
                        break
                    case '2':
                        $('#selected_deal_status').text(negotiation)
                        $('#selected_deal_status').addClass('status_negotiation')
                        if ($('#selected_deal_status').hasClass('status_first_contact')) {
                            $('#selected_deal_status').removeClass('status_first_contact')
                        }
                        if ($('#selected_deal_status').hasClass('status_making_a_deal')) {
                            $('#selected_deal_status').removeClass('status_making_a_deal')
                        }
                        break
                    case '3':
                        $('#selected_deal_status').text(make_deal)
                        $('#selected_deal_status').addClass('status_making_a_deal')
                        if ($('#selected_deal_status').hasClass('status_negotiation')) {
                            $('#selected_deal_status').removeClass('status_negotiation')
                        }
                        if ($('#selected_deal_status').hasClass('status_first_contact')) {
                            $('#selected_deal_status').removeClass('status_first_contact')
                        }
                        break
                    default:
                }
            }
            setValue()
            password_checkbox_.addEventListener('change', function() {
                if (password_checkbox.checked != true) {
                    password_input_[0].setAttribute('disabled', true)
                    password_input_[1].setAttribute('disabled', true)
                    password_input_[2].setAttribute('disabled', true)
                    password_input_[0].value = ''
                    password_input_[1].value = ''
                    password_input_[2].value = ''
                } else {
                    password_input_[0].removeAttribute('disabled')
                    password_input_[1].removeAttribute('disabled')
                    password_input_[2].removeAttribute('disabled')
                    setValue()
                }
                if (series != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-series').attr("disabled",
                        true)
                }
                if (issued_by != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-issued').attr("disabled",
                        true)
                }
                if (inn != "") {
                    $('#store_budget_modal .modal-body').find('.client-show-modal-inn').attr("disabled",
                        true)
                }
            });

        })

        $(document).on('click', '.client-show-buttons', function(e) {
            e.preventDefault()
            var status = $('.client-show-select').val()

            if (status == {{ Constants::FIRST_CONTACT }}) {

            } else if (status == {{ Constants::NEGOTIATION }}) {

            } else if (status == {{ Constants::MAKE_DEAL }}) {

            }
        })

        $(document).on('click', '.rassrochkaProdnoCheck', function(e) {
            if ($(this).prop("checked") == true) {
                $('#noneDownDrop').addClass('blockDropDown')
            } else {
                $('#noneDownDrop').removeClass('blockDropDown')
            }
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

        // $(document).on('change', '.selectPeriod', function() {
        //     var percent = $(this).find('option:selected').attr('data-percent')
        //     var thisVal = $(this).val()
        //     var dealCreatePrice = $('.dealCreatePrice').val()
        //     var setVal = parseInt(dealCreatePrice) - parseInt(parseInt(dealCreatePrice) / 100 * parseInt(percent))
        //     $('.selectPercent').find('option').attr('selected', false)
        //     $('.selectPercent').find('option[value=' + thisVal + ']').prop('selected', true);
        //     $('.initialFeeDeal').val(setVal)
        // })

        $(document).on('change', '.selectPercent', function() {
            var percent = $(this).find('option:selected').attr('data-percent')
            var thisVal = $(this).val()
            var dealCreatePrice = $('.dealCreatePrice').val()
            var setVal = parseInt(dealCreatePrice) - parseInt(parseInt(dealCreatePrice) / 100 * parseInt(percent))
            // $('.selectPeriod').find('option').attr('selected', false)
            // $('.selectPeriod').find('option[value=' + thisVal + ']').prop('selected', true);
            $('.initialFeeDeal').val(setVal)
        })

        $(document).on('keyup', '.searchInput', function(e) {
            var keyupText = $(this).val()
            $('.searchLi').each(function() {
                if (keyupText == '') {
                    $(this).addClass('d-none')
                    $('.searchMainDiv').addClass('d-none')
                } else {
                    var myText = $(this).text();
                    if (myText.toLowerCase().includes(keyupText.toLowerCase())) {
                        $('.searchMainDiv').removeClass('d-none')
                        $(this).removeClass('d-none')
                    } else {
                        $(this).addClass('d-none')
                    }
                }
            });
        })

        $(document).on('keyup', '.currencyUpdate', function(e) {
            if (e.which == 13) {
                var val = $(this).val()
                var attr = $(this).attr('data-status')
                var id = $(this).parent().parent().find('#currencyId').val()

                $.ajax({
                    url: `/forthebuilder/currency/update/` + id,
                    data: {
                        val: val,
                        attr: attr,
                    },
                    type: 'PUT',
                    success: function(data) {
                        if (data == true) {
                            location.reload()
                        }
                    },
                });
            }
        })

        $(document).on('click', '#currencyUpdateButton', function(e) {
            $('.currencyUpdate').prop('disabled', (i, v) => !v)
        })

        $(document).on('click', '.couponSave', function(e) {
            var name = $('.couponCreateName').val()
            var percent = $('.couponCreatePercent').val()

            if (name != '' && percent != '') {
                $.ajax({
                    url: `/forthebuilder/coupon/store`,
                    data: {
                        name: name,
                        percent: percent,
                    },
                    type: 'POST',
                    success: function(data) {
                        if (data == true) {
                            location.reload()
                        }
                    },
                });
            }
        })

        $(document).on('keyup', '#coupon', function(e) {
            e.preventDefault()
            var text = $(this).val()
            var _this = $(this)

            $('#coupon_percent').val('')
            $('#applied').text('')
            $.ajax({
                url: `/forthebuilder/house-flat/search-coupon/${text}`,
                // data: {status: 0},
                type: 'GET',
                success: function(data) {
                    if (!(data.length === 0)) {
                        $('#applied').text('Применён')
                        $('#coupon_percent').val(data.percent)
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        })

        $(document).on('click', '.couponEdit', function(e) {
            var typeName = $(this).parent().parent().find('.couponName').attr('type')
            var typePercent = $(this).parent().parent().find('.couponPercent').attr('type')
            $(this).siblings('.couponUpdate').toggleClass('d-none');
            // $(this).addClass('d-none');
            $(this).parent().parent().find('.couponName').siblings('span').toggle();
            $(this).parent().parent().find('.couponPercent').siblings('span').toggle();

            $(this).parent().parent().find('.couponName').attr('type', 'hidden');
            if (typeName == 'hidden')
                $(this).parent().parent().find('.couponName').attr('type', 'text');

            $(this).parent().parent().find('.couponPercent').attr('type', 'hidden');
            if (typePercent == 'hidden')
                $(this).parent().parent().find('.couponPercent').attr('type', 'text');

        })

        $(document).on('click', '.couponUpdate', function(e) {
            var id = $(this).parent().parent().find('.couponId').val();
            var name = $(this).parent().parent().find('.couponName').val();
            var percent = $(this).parent().parent().find('.couponPercent').val();

            $.ajax({
                url: `/forthebuilder/coupon/update/` + id,
                data: {
                    name: name,
                    percent: percent,
                },
                type: 'PUT',
                success: function(data) {
                    if (data == true) {
                        location.reload()
                    }
                },
            });
        })

        $(document).on('click', '.couponDelete', function(e) {
            $(this).siblings('form').find('button').trigger('click')
        })

        $(document).on('click', '.priceInformationSelectHouse', function(e) {
            $('.priceFormationOpenFlats').attr('data-toggle', 'modal').attr('data-target', '#exampleModal')
        })

        $(document).on('click', '.priceFormationOpenFlats', function(e) {
            $('#exampleModal .modal-body').html('')
            arrPriceFormation = new Array();

            var house_id = $('.priceInformationSelectHouse').val()
            $.ajax({
                url: `/forthebuilder/house/prices-house-flats`,
                data: {
                    house_id: house_id,
                },
                type: 'GET',
                success: function(data) {
                    $('#exampleModal .modal-body').html(data)
                },
            });
        })

        var arrPriceFormation = new Array();
        $(document).on('click', '.btnFilterFlat', function(e) {
            var def = $(this).attr('data-default')
            var id = $(this).attr('data-id')
            if (def == 0) {
                arrPriceFormation.push(id)

                $(this).attr('data-default', 1)
                $(this).css('background-color', 'lightgrey')
            } else {
                arrPriceFormation.splice(arrPriceFormation.indexOf(id), 1);

                $(this).attr('data-default', 0)
                $(this).css('background-color', ($(this).attr('datd-color')))
            }
        })

        $(document).on('click', '.savePriceFormation', function(e) {
            $('#price_formaition_id').val(arrPriceFormation)
            console.log(arrPriceFormation)
            $('.priceFormationOpenFlats').css('opacity', 1)
            $('.priceFormationOpenFlats').text("{{ translate('Flat choosen') }}")
        })

        $(document).on('change', '.obrazavaniyaSelect', function(e) {
            $(this).css('opacity', 1)
        })

        $(document).on('keyup', '.obrazavaniyaSelectInput', function(e) {
            var val = $(this).val()
            if (val != '') {
                $(this).css('opacity', 1)
            } else {
                $(this).css('opacity', 0.25)
            }
        })

        $(document).on('click', '.btnDealCreateFile', function(e) {
            $('.clickDealCreateFile').trigger('click')
        })

        $(document).on('click', '.addNewCoupon', function(e) {
            $('.formNewCoupon').removeClass('d-none')
        })

        $(document).on('click', '.removeFormCoupon', function(e) {
            $('.formNewCoupon').addClass('d-none')
        })

        $(document).on('click', '.addNewCurrency', function(e) {
            $('.formNewCurrency').removeClass('d-none')
        })

        $(document).on('click', '.removeFormCurrency', function(e) {
            $('.formNewCurrency').addClass('d-none')
        })

        $(document).on('click', '.currencySave', function(e) {
            var USD = $('.currencyUsd').val()
            var sum_uzb = $('.currencyUzs').val()

            if (USD != '' && sum_uzb != '') {
                $.ajax({
                    url: `/forthebuilder/currency/store`,
                    data: {
                        USD: USD,
                        sum_uzb: sum_uzb,
                    },
                    type: 'POST',
                    success: function(data) {
                        if (data == true) {
                            location.reload()
                        }
                    },
                });
            }
        })

        let sessionSuccess = "{{ session('deleted') }}";
        if (sessionSuccess) {
            toastr.success(sessionSuccess)
        }

        let sessionSuccess2 = "{{ session('success') }}";
        if (sessionSuccess2) {
            toastr.success(sessionSuccess2)
        }

        let sessionUpdated = "{{ session('updated') }}";
        if (sessionUpdated) {
            toastr.success(sessionUpdated)
        }

        let sessionDeleteWarning = "{{ session('delete_warning') }}";
        if (sessionDeleteWarning) {
            toastr.warning(sessionDeleteWarning)
        }

        $(document).on('keyup', '.houesCreateCalculateTotal', function(e) {
            var entrance_one_floor_count = parseInt($('#entrance_one_floor_count').val())
            var floor_count = parseInt($('#floor_count').val())
            var entrance_count = parseInt($('#entrance_count').val())

            $('#total_flat').val((entrance_one_floor_count * floor_count) * entrance_count)
        })

        $(document).on('click', '.deleteHouses', function() {
            var url = $(this).attr('data-delete_url');
            $('#exampleModalLong').find('form').attr('action', url);
        })

        $(document).on('click', '.save-flats', function(e) {
        // $(".save-flats").unbind('click').bind('click', function () {
            e.preventDefault()
            var number = $('.room-count-button[is-selected="true"]').attr('data-number')
            if (number == 'p') {
                $('#exampleModal .modal-body').find('form .change_content').html(`
                    <div class="mt-3">
                        <h3 class="sozdatJkSpisokH3722">{{ translate('Total area') }}</h3>
                        <input type="number" name="total_area" class="modalMiniCapsule4 text-left">
                    </div>
                `)
            } else if (number == 'c') {
                $('#exampleModal .modal-body').find('form .change_content').html(`
                    <div class="mt-3">
                        <h3 class="sozdatJkSpisokH3722">{{ translate('Total area') }}</h3>
                        <input type="number" name="total_area" class="modalMiniCapsule4 text-left">
                    </div>

                    <div class="mt-3">
                        <h3 class="sozdatJkSpisokH3722">{{ translate('Terrace') }} <input type="checkbox"
                                id="terassa"></h3>
                        <input type="number" placeholder="" name="terassa" class="modalMiniCapsule4 text-left"
                            id="terassa_input" disabled>
                    </div>

                    <div class="mt-3">
                        <h3 class="sozdatJkSpisokH3722">{{ translate('Balcony') }} <input type="checkbox"
                                id="balcony"></h3>
                        <input type="text" placeholder="" name="balcony" class="modalMiniCapsule4 text-left"
                            id="balcony_input" disabled>
                    </div>
                `)
            } else {
                $('#exampleModal .modal-body').find('form .change_content').html(`
                    <div class="mt-3">
                        <h3 class="sozdatJkSpisokH3722">{{ translate('Total area') }}</h3>
                        <input type="number" name="total_area" class="modalMiniCapsule4 text-left">
                    </div>

                    <div class="mt-3">
                        <h3 class="sozdatJkSpisokH3722">{{ translate('Hotel') }}</h3>
                        <input type="number" name="hotel" class="modalMiniCapsule4 text-left">
                    </div>

                    <div class="mt-3">
                        <h3 class="sozdatJkSpisokH3722">{{ translate('Bedroom') }}</h3>
                        <input type="number" name="bedroom" class="modalMiniCapsule4 text-left">
                    </div>

                    <div class="mt-3">
                        <h3 class="sozdatJkSpisokH3722">{{ translate('Kitchen area') }}</h3>
                        <input type="number" name="kitchen_area" class="modalMiniCapsule4 text-left">
                    </div>

                    <div class="mt-3">
                        <h3 class="sozdatJkSpisokH3722">{{ translate('Terrace') }} <input type="checkbox" id="terassa"></h3>
                        <input type="number" placeholder="" name="terassa" class="modalMiniCapsule4 text-left" id="terassa_input" disabled>
                    </div>

                    <div class="mt-3">
                        <h3 class="sozdatJkSpisokH3722">{{ translate('Balcony') }} <input type="checkbox" id="balcony"></h3>
                        <input type="text" placeholder="" name="balcony" class="modalMiniCapsule4 text-left" id="balcony_input" disabled>
                    </div>
                `)
            }
        })

        $(document).on('keyup', '#coupon-in-deal', function(e) {
            e.preventDefault()
            var text = $(this).val()
            var _this = $(this)

            $('#coupon_percent').val('')
            $('#applied').text('')
            $.ajax({
                url: `/forthebuilder/house-flat/search-coupon/${text}`,
                // data: {status: 0},
                type: 'GET',
                success: function(data) {
                    if (!(data.length === 0)) {
                        $('#applied').text('Применён')
                        _this.attr('percent', data.percent)
                    } else {
                        _this.attr('percent', 0)
                    }
                    $('.calculate_coupon_price').trigger('click')
                },
                error: function(data) {
                    console.log(data);
                }
            });
        })

        $(document).on('click', '.calculate_coupon_price', function(e) {
            e.preventDefault()
            var price = parseFloat($('.dealCreatePrice').attr('original-price'))
            var price_m2 = parseFloat($('.dealCreatePriceM2').attr('original-price'))
            var coupon = parseFloat($('#coupon-in-deal').attr('percent'))

            if (!(coupon > 0)) {
                coupon = 0
            }
            var answer = price - (price / 100 * coupon)
            $('.dealCreatePrice').val(answer)

            var answer_m2 = price_m2 - (price_m2 / 100 * coupon)
            $('.dealCreatePriceM2').val(answer_m2)
        })

        $(document).on('keyup', '.dealCreatePrice', function() {
            $(this).attr('original-price', $(this).val())
        })

        $(document).on('keyup', '.dealCreatePriceM2', function() {
            $(this).attr('original-price', $(this).val())
        })

        $(document).on('click', '.plusForSummPrice', function(e) {
            e.preventDefault()
            var data_count = $(this).attr('data-count')
            var count = parseInt(data_count) + 1
            $(this).attr('data-count', count)
            // var partHtml = $('.divForSummPrice').html()
            $('.divForSummPrice').parent().append(`
                <div class="d-flex">
                    <div style="width: 49%;">
                        <select class="obrazavaniyaSelect" name="payment[` + count + `][payment_type]"
                            style="opacity: {{ old('payment_type') ? 1 : 0.25 }};">
                            <option aria-placeholder="{{ translate('Payment %') }}" selected hidden disabled>
                                {{ translate('Payment %') }}
                            </option>
                            <option value="{{ Constants::PAYMENT_30 }}"
                                {{ old('payment_type') == Constants::PAYMENT_30 ? 'selected' : '' }}>
                                {{ translate('at 30% payment') }}</option>
                            <option value="{{ Constants::PAYMENT_50 }}"
                                {{ old('payment_type') == Constants::PAYMENT_50 ? 'selected' : '' }}>
                                {{ translate('at 50% payment') }}</option>
                            <option value="{{ Constants::PAYMENT_70 }}"
                                {{ old('payment_type') == Constants::PAYMENT_70 ? 'selected' : '' }}>
                                {{ translate('at 70% payment') }}</option>
                            <option value="{{ Constants::PAYMENT_100 }}"
                                {{ old('payment_type') == Constants::PAYMENT_100 ? 'selected' : '' }}>
                                {{ translate('at 100% payment') }}</option>
                        </select>
                        <span class="error-data">
                            @error('payment_type')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div style="width: 49%; margin-left: auto">
                        <input type="number" class="obrazavaniyaSelect obrazavaniyaSelectInput"
                            style="opacity: {{ old('amount') ? 1 : 0.25 }};"
                            placeholder="{{ translate('Enter amount') }}" name="payment[` + count + `][amount]" value="{{ old('amount') }}">
                        <span class="error-data">
                            @error('amount')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            `)
        })

        $(document).on('click', '.minusForSummPrice', function(e) {
            e.preventDefault()
            
            // var partHtml = $('.divForSummPrice').html()
            $(".divForSummPrice").parent().find("div[class=d-flex]:last").remove();
            // $('.divForSummPrice').parent().append(`<div class="d-flex">` + partHtml + `</div>`)
        })

        $(document).on('click', '.saveDealDogovor', function() {
            setTimeout(function() {
                var url = '/forthebuilder/deal'
                if ($('input[name=is_installment]').prop("checked") == true) {
                    var url = '/forthebuilder/installment-plan'
                }
                window.location.replace(url)
            }, 2000);
        })

        // $(document).on('mouseover', '.btnFilterFlat', function(e) {
        //     $(this).parent().parent().find('p').removeClass('d-none')
        // })

        // $(document).on('mouseout', '.btnFilterFlat', function(e) {
        //     $(this).parent().parent().find('p').addClass('d-none')
        // })
    </script>
</body>

</html>
