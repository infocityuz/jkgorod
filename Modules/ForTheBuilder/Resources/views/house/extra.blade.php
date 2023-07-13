@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css') }}">
@endsection



<style>
    .display-none {
        display: none;
    }

    .modal-body {
        padding: 20px 44px 44px 44px;
    }

    .house-status {
        display: flex;
        flex-direction: column;
        border: solid 1px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        width: 100%;
        padding: 14px 6px;
    }

    .house_status_value {
        color: black !important;
        transition: 1s;
        padding: 7px 24px;
        border: solid 1px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        width: 100%;
    }

    .house_status_value:hover {
        transform: scale(1.04);
    }

    .house-status a {
        color: black !important;
        transition: 1s;
        border-radius: 4px;
        padding: 0px 18px;
    }

    #busy:hover,
    #sales:hover,
    #free:hover {
        transform: scale(1.04);
        background-color: rgba(0, 0, 0, 0.2);
    }

    .select2-results__option:hover {
        background-color: rgba(0, 0, 0, 0.2);
    }
</style>
    <script defer src="{{ asset('/backend-assets/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
    <script defer src="{{ asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script defer src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>

    <script defer src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js') }}"></script>
{{--    <script defer src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/filetype.min.js') }}">--}}
    </script>
    <script defer src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/buffer.min.js') }}">
    </script>
    <script defer src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js') }}">
    </script>
    <script defer src="{{ asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/locales/ru.js') }}"></script>
    <script src="{{ asset('/backend-assets/forthebuilders/javascript/jquery.min.js') }}"></script>
    <script defer>
        $(document).ready(function() {
            function flatstatus() {
                if ($('#flatItemStatus').hasClass('display-none')) {
                    $('#flatItemStatus').removeClass('display-none')
                } else {
                    $('#flatItemStatus').addClass('display-none')
                }
            }
            $('#house-status-value').on('click', function() {
                flatstatus()
            });

            function flat_status_click() {
                $('#busy').on('click', function() {
                    flatstatus()
                    select_status($(this).attr('value'))
                    $('#house-status-value').text($(this).text())
                    $('#flat_status_value').val(1)
                });
                $('#sales').on('click', function() {
                    flatstatus()
                    select_status($(this).attr('value'))
                    $('#house-status-value').text($(this).text())
                    $('#flat_status_value').val(2)
                });
                $('#free').on('click', function() {
                    flatstatus()
                    select_status($(this).attr('value'))
                    $('#house-status-value').text($(this).text())
                    $('#flat_status_value').val(0)
                });
            }

            let sessionSuccess = "{{ session('success') }}";
            if (sessionSuccess) {
                toastr.success(sessionSuccess)
            }
            let sessionWarning = "{{ session('warning') }}";
            if (sessionWarning) {
                toastr.warning(sessionWarning)
            }
            let sessionError = "{{ session('error') }}";
            if (sessionError) {
                toastr.warning(sessionError)
            }

            //checkbox orqali modal oknadagi submit knopkani va avans to'lov polyasini yaratish
            if ($('#prepayment').is(':checked')) {
                if ($('#prepayment_summa').hasClass('display-none')) {
                    $('#prepayment_summa').removeClass('display-none')
                }
            } else {
                if (!$('#prepayment_summa').hasClass('display-none')) {
                    $('#prepayment_summa').addClass('display-none')
                }
            }
            $('#prepayment').change(function() {
                if ($(this).is(':checked')) {
                    if ($('#prepayment_summa').hasClass('display-none')) {
                        $('#prepayment_summa').removeClass('display-none')
                    }
                } else {
                    if (!$('#prepayment_summa').hasClass('display-none')) {
                        $('#prepayment_summa').addClass('display-none')
                    }
                }
            });

            //house-box
            var gId = '';
            var number_of_flat = '';
            var contract_number = '';
            let house_id;

            $('.house-box').on('click', function(e) {
                var id = $(this).data('id');
                house_id = $(this).data('id')
                number_of_flat = $(this).data('name');
                contract_number = $(this).data('contractnumber');
                gId = id;
                e.preventDefault();
                $('.forthebuilder').addClass('active');
                $('.right__sidebar').addClass('active');
                $('#flatItemDetailShow').empty();
                $('#flatItemDetailImg').empty();

                $.ajaxSetup({
                    beforeSend: function() {
                        // TODO: show your spinner
                        $("#for-preloader").addClass('spinner-border');
                        $('#flatItemDetailTable').hide();
                        $('#flatItemStatusSelect').hide();
                        $('#change-status').hide();
                    },
                    complete: function() {
                        // TODO: hide your spinner
                        $("#for-preloader").removeClass('spinner-border');
                        $('#flatItemDetailTable').show();
                        $('#flatItemStatusSelect').show();
                        $('#change-status').show();
                    }
                });

                //            kvartiragani avans orqali band qilish modal oynasi
                $.get('/forthebuilder/house/show-more-item-detail/' + id, function(data) {
                    if (data['flatItemDetailImg'] != null) {
                        let imgurl = 'm_' + data['flatItemDetailImg']['guid']
                        $('#flatItemDetailImg').append(
                            `<img src='/uploads/house-flat/${id}/${imgurl}' class='img-fluid mb-2'alt='white sample'/>`
                        );
                    } else {
                        $('#flatItemDetailImg').append(
                            "<img src='/backend-assets/img/no-photo.png' class='img-fluid mb-2'alt='white sample'/>"
                        );
                    }
                    if (data['flatItemDetail']['status'] == 0) {
                        $('#house-status-value').text(' Свободно')
                        $('#flat_status_value').val(0)
                    }
                    if (data['flatItemDetail']['status'] == 1) {
                        $('#house-status-value').text(' Занят')
                        $('#flat_status_value').val(1)
                    }
                    if (data['flatItemDetail']['status'] == 2) {
                        $('#house-status-value').text(' Продано')
                        $('#flat_status_value').val(2)
                    }
                    flat_status_click()
                    $('#info1_flat div').remove()
                    $('#house_flat_id').val(`${data.flatItemDetail.id}`);
                    $('#info1_flat').append(
                        `<div><span>{{ __('locale.Number of flat') }}: </span><b>${data.flatItemDetail.number_of_flat}</b></div>`
                    )
                    $('#info1_flat').append(`<div><span>{{ __('locale.Flat price') }}: </span><b>${(Math.round(data.flatItemDetail.total_area) * data.flatItemDetail.price).toLocaleString('en-US', {
                        style: "currency",
                        currency: "USD" ,
                    })}</b> $</div>`)
                    $('#info2_flat div').remove()
                    $('#info2_flat').append(
                        `<div><span>{{ __('locale.Total area') }}: </span><b>${data.flatItemDetail.total_area}</b> m<sup>2</sup></div>`
                    )
                    $('#info2_flat').append(
                        `<div><span>{{ __('locale.Room of flat') }}: </span><b>${data.flatItemDetail.room_count}</b></div>`
                    )

                    $('#flatItemDetailPrice').text(data['flatItemDetail']['price']);
                    $('#flatItemDetailRoomCount').text(data['flatItemDetail']['room_count']);
                    $('#flatItemDetailClientTable').hide();
                    $('#flatItemDetailNoClientTable').hide();
                    $('#flatItemDetailClientName').text('');
                    $('#flatItemDetailClientSurename').text('');
                    $('#flatItemDetailClientPhone').text('');
                    $('#flatItemDetailClientPrepayment').text('');
                    if (data['flatItemDetailClient'] != null) {
                        $('#flatItemDetailClientTable').show();
                        $('#flatItemDetailNoClientTable').hide();
                        $('#flatItemDetailClientName').text(data['flatItemDetailClient']['name']);
                        $('#flatItemDetailClientSurename').text(data['flatItemDetailClient'][
                            'surname'
                            ]);
                        $('#flatItemDetailClientPhone').text(data['flatItemDetailClient']['phone']);
                        $('#flatItemDetailClientPrepayment').text(data['flatItemDetailClient'][
                            'prepayment'
                            ]);
                    } else {
                        $('#flatItemDetailNoClientTable').show();
                        $('#flatItemDetailClientTable').hide();
                    }

                    $('#flatItemDetailShow').empty();
                    $('#flatItemDetailShow').append(
                        `<a href='/forthebuilder/house-flat/show/${id}' class='style-add btn btn-primary' style='color:#fff'>{{ __('locale.show') }}</a>`
                    );
                    $('#flatItemStatusSelect').attr("data-id", `${id}`);

                })
            });

            // $('#renew_flat').on('click', function() {
            //     $.get('/forthebuilder/house/show-more-item-detail/' + gId, function(data) {
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
            //                     // $('.house-box').data('id');
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

            function select_status(val) {
                $.get('/forthebuilder/house/show-more-item-detail/' + gId, function(data) {
                    if (data['flatItemDetail']['status'] == 0) {
                        // e.preventDefault();
                        switch (val) {
                            case '2':
                                // location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + '&name=' + number_of_flat + '&house_id=' + '{{ $model->id }}' + '&house_name=' +'{{ $model->house_number }}'  + '&contract_number=' + contract_number);
                                location.replace("/forthebuilder/deal/create?house_flat_id=" + gId +
                                    "&house_flat_number=" + data.flatItemDetail.number_of_flat +
                                    "&house_id=" + '{{ $model->id }}' + '&house_name=' +
                                    '{{ $model->house_number }}' + '&contract_number=' + data
                                        .flatItemDetail.contract_number);
                        }
                    } else if (data['flatItemDetail']['status'] == 1) {
                        switch (val) {

                            case '1':
                                toastr.warning("{{ __('locale.the apartment is already booked') }}");
                                break;
                            case '2':
                                // location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + '&name=' + number_of_flat + '&house_id=' + '{{ $model->id }}' + '&house_name=' +'{{ $model->house_number }}'  + '&contract_number=' + contract_number);
                                location.replace("/forthebuilder/deal/create?house_flat_id=" + gId +
                                    "&house_flat_number=" + data.flatItemDetail.number_of_flat +
                                    "&house_id=" + '{{ $model->id }}' + '&house_name=' +
                                    '{{ $model->house_number }}' + '&contract_number=' + data
                                        .flatItemDetail.contract_number);
                        }
                    } else {
                        switch (val) {
                            case '1':
                                toastr.warning("{{ __('locale.the apartment is already sold') }}");
                                break;
                            case '2':
                                // location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + '&name=' + number_of_flat + '&house_id=' + '{{ $model->id }}' + '&house_name=' +'{{ $model->house_number }}'  + '&contract_number=' + contract_number);
                                location.replace("/forthebuilder/deal/create?house_flat_id=" + gId +
                                    "&house_flat_number=" + data.flatItemDetail.number_of_flat +
                                    "&house_id=" + '{{ $model->id }}' + '&house_name=' +
                                    '{{ $model->house_number }}' + '&contract_number=' + data
                                        .flatItemDetail.contract_number);
                        }
                    }
                });
            }

            $('.close_sidebar span').on('click', function(e) {
                e.preventDefault();
                $('.forthebuilder').removeClass('active');
                $('.right__sidebar').removeClass('active');
            });
            //house-box

            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
                let filter = $(this).data('filter');

                $('.btn-flat').addClass('d-none');
                if (filter == 0) {
                    console.log($('.btn-flat[data-category=0]'));
                    $('.btn-flat[data-category=0]').removeClass('d-none');
                } else if (filter == 1) {
                    $('.btn-flat[data-category=1]').removeClass('d-none');
                } else if (filter == 2) {
                    $('.btn-flat[data-category=2]').removeClass('d-none');
                } else {
                    $('.btn-flat').removeClass('d-none');
                }
            });

            // kvartiragani avans orqali band qilishda ism maydoniga keyUp qilinganda bazadan like orqali qidirib kelish
            $('.keyUpName').on('keyup', function(e) {
                e.preventDefault();
                var name = $(this).val();
                $('.select2-dropdown--below').hide();

                // kvartiragani avans orqali band qilishda ism maydoniga keyUp qilinganda bazadan like orqali qidirib kelish AJAX SEND
                $.get('/forthebuilder/house/search-by-name/' + name, function(data) {
                    if (data['searchedLeadList'].length != 0) {
                        $('.select2-dropdown--below').show();
                        // } else {
                        var listData = '';
                        $.each(data['searchedLeadList'], function(index, value) {
                            listData +=
                                `<li style="list-style: none; padding: 10px;" class="select2-results__option" surname="` +
                                value['surname'] + `" phone="` + value['phone'] +
                                `" patronymic="` + value['patronymic'] +
                                `" series_number="` + value['series_number'] + `">` + value[
                                    'name'] + `</li>`;
                        });

                        $('#select2-0obe-results').html(listData);
                    }

                })
            });
        });

        $(document).on('click', '.select2-results__option', function(e) {
            e.preventDefault()
            var name = $(this).text()
            var surname = $(this).attr('surname')
            var phone = $(this).attr('phone')
            var patronymic = $(this).attr('patronymic')
            var series_number = $(this).attr('series_number')
            if (!surname) {
                surname = '';
            }

            $('#name').val(name)
            $('#surname').val(surname)
            $('#phone').val(phone)
            $('#patronymic').val(patronymic)
            $('#series_number').val(series_number)

            $('.select2-dropdown--below').hide();
        })

        $(document).on('click', 'body', function() {
            $('.select2-dropdown--below').hide();
        })

        // $(document).ready(function() {
        //     $('input[type=tel]').mask("(99) 999-99-99");
        // });

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

        // $(document).on('click', '.show-hidden-input', function() {
        //     $(this).hide()
        //     $(this).siblings('input').attr('type', 'number')
        // })
        $(document).on('mouseenter', '.hover-remove-add', function() {
            $(this).find('.floor-action').removeClass('d-none')
        })

        $(document).on('mouseleave', '.hover-remove-add', function() {
            $(this).find('.floor-action').addClass('d-none')
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
                    console.log(data)
                    if (data == true) {
                        location.reload()
                    }
                },
                // error: function(data) {
                //     console.log(data);
                // }
            });
        })

        $(document).on('click', '.attach-order', function() {
            $('#modal-default-free .modal-title').text('')
            $('#modal-default-free .modal-body').html(`
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
                <button class="btn btn-primary basket-to-house float-right">{{ translate('Next') }}</button>
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

        $(document).on('click', '.bascket-float-remove', function() {
            var house_id = $(this).attr('data-house-id')
            var entrance = $(this).attr('data-entrance')
            var floor = $(this).attr('data-floor')
            var _token = $('input[name=_token]').val();

            $.ajax({
                url: `/forthebuilder/house/remove-bascket-float`,
                data: {
                    house_id: house_id,
                    entrance: entrance,
                    floor: floor,
                    _token: _token
                },
                type: 'POST',
                success: function(data) {
                    if (data.status == 'success') {
                        $(".apartments-button[data-id=" + data.id + "]").parent().remove()
                        // location.reload();
                    }
                }
            })
        })

        $(document).on('click', '.bascket-float-add', function() {
            var house_id = $(this).attr('data-house-id')
            var entrance = $(this).attr('data-entrance')
            var floor = $(this).attr('data-floor')
            var _token = $('input[name=_token]').val();

            $.ajax({
                url: `/forthebuilder/house/add-bascket-float`,
                data: {
                    house_id: house_id,
                    entrance: entrance,
                    floor: floor,
                    _token: _token
                },
                type: 'POST',
                success: function(data) {
                    if (data == 'success') {
                        location.reload();
                    }
                }
            })
        })

        $(document).on('click', '.flat-button', function() {
            var rooms = $(this).find('.flat-room-count').text()
            var area = $(this).find('.flat-total-area').text()
            var price = $(this).find('.flat-price').text()
            var client = $(this).siblings('.hidden-client').val()
            var fId = $(this).attr('data-id')
            var number_of_flat = $(this).siblings('.detail_number_of_flat').val()
            var house_id = $(this).siblings('.detail_house_id').val()
            var house_name = $(this).siblings('.detail_house_name').val()
            var contract_number = $(this).siblings('.detail_contract_number').val()
            var entrance = $(this).siblings('.detail_entrance').val()
            var floor = $(this).siblings('.detail_floor').val()

            var part_html_client = '';
            if (client != '') {
                var part_html_client = `
                    <div class="form-control">
                        {{ translate('F.I.O') }}
                <span>
${client}
                        </span>
                    </div>
                `;
            }

            $('#modal-for-flat').find('.modal-body').html(`
                <div class="row flat-detail-modal">
                    <div class="col-md-5">
                        <img width="100%" src="/schema.jpg" alt="JkDom">
                    </div>
                    <div class="col-md-7">
                        <div class="form-control" style="border: 1px solid grey;">
                            {{ translate('price') }}
            <span>
${price} у.е.
                            </span>
                        </div>
                        <br>
                        <div class="form-control" style="border: 1px solid grey;">
                            {{ translate('Number of rooms') }}
            <span>
${rooms}
                            </span>
                        </div>
                        <br>
                        <button class="form-control open-statuses">{{ translate('Status') }}</button>
                        <div class="house-status d-none" id="flatItemStatus">
                            <a type="button" class="hide-modal" id="free" value="0" data-toggle="modal" data-target="#modal-default-free"> Свободно </a>
                            <a type="button" class="hide-modal" id="busy" value="1" data-toggle="modal" data-target="#modal-default"> Занято </a>
                            <a type="button" class="hide-modal" id="sales" value="2"> Продано </a>
                        </div>

                        <br>
                        <a href="/forthebuilder/house-flat/show/${fId}" type="button" class="modalPodrobnoButton btn btn-primary">{{ translate('Detail') }}</a>
                        <input type="hidden" class="house_flat_id" value="${fId}">
                        <input type="hidden" class="house_number_of_flat" value="${number_of_flat}">
                        <input type="hidden" class="house_house_id" value="${house_id}">
                        <input type="hidden" class="house_house_name" value="${house_name}">
                        <input type="hidden" class="house_contract_number" value="${contract_number}">
                        <input type="hidden" class="house_entrance" value="${entrance}">
                        <input type="hidden" class="house_floor" value="${floor}">
                        <br>
                        <br>
                        ${part_html_client}
                    </div>
                </div>
            `)
        })

        $(document).on('click', '.open-statuses', function() {
            $('.house-status').toggleClass('d-none')
        })

        $(document).on('change', '.change_status', function() {
            var fId = $(this).attr('data-fId')
            var thisVal = $(this).val()

            if (thisVal == 0) {
                $('#modal-default-free').addClass('show')
            }

            select_status(thisVal, fId)
        });

        $(document).on('click', '.hide-modal', function() {
            $(this).parent().parent().parent().parent().parent().find('.close').trigger('click')
        })

        function select_status(val, fId) {
            $.get('/forthebuilder/house/show-more-item-detail/' + fId, function(data) {
                if (data['flatItemDetail']['status'] == 0) {
                    switch (val) {
                        case '2':
                            location.replace("/forthebuilder/deal/create?house_flat_id=" + fId +
                                "&house_flat_number=" + data.flatItemDetail.number_of_flat +
                                "&house_id=" + '{{ $model->id }}' + '&house_name=' +
                                '{{ $model->house_number }}' + '&contract_number=' + data
                                    .flatItemDetail.contract_number);
                    }
                } else if (data['flatItemDetail']['status'] == 1) {
                    switch (val) {
                        case '1':
                            toastr.warning("{{ __('locale.the apartment is already booked') }}");
                            break;
                        case '2':
                            location.replace("/forthebuilder/deal/create?house_flat_id=" + fId +
                                "&house_flat_number=" + data.flatItemDetail.number_of_flat +
                                "&house_id=" + '{{ $model->id }}' + '&house_name=' +
                                '{{ $model->house_number }}' + '&contract_number=' + data
                                    .flatItemDetail.contract_number);
                    }
                } else {
                    switch (val) {
                        case '1':
                            toastr.warning("{{ __('locale.the apartment is already sold') }}");
                            break;
                        case '2':
                            location.replace("/forthebuilder/deal/create?house_flat_id=" + fId +
                                "&house_flat_number=" + data.flatItemDetail.number_of_flat +
                                "&house_id=" + '{{ $model->id }}' + '&house_name=' +
                                '{{ $model->house_number }}' + '&contract_number=' + data
                                    .flatItemDetail.contract_number);
                    }
                }
            });
        }

        $(document).on('click', '#renew_flat', function() {
            var gId = $(this).attr('data-id')
            $.get('/forthebuilder/house/show-more-item-detail/' + gId, function(data) {
                console.log(data);
                if (data['flatItemDetail']['status'] == 2) {
                    $.ajax({
                        url: `/forthebuilder/house-flat/update-status/${gId}`,
                        data: {
                            status: 0
                        },
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
                } else if (data['flatItemDetail']['status'] == 1) {
                    toastr.warning("{{ __('locale.impossible the apartment is booked') }}");
                } else {
                    toastr.warning("{{ __('locale.the apartment is already new') }}");
                }
            });
        });

        $(document).on('click', '#busy', function() {
            var id = $(this).parent().parent().find('.house_flat_id').val()
            $('#modal-default').find('#house_flat_id').val(id)
        })

        $(document).on('click', '#free', function() {
            var id = $(this).parent().parent().find('.house_flat_id').val()
            $('#renew_flat').attr('data-id', id)
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

        $(document).on('click', '.bascket-float-marge', function(e) {
            $(this).parent().parent().find('td button').attr('disabled', false)
            $(this).parent().parent().find('td button').addClass('unite')
            $(this).parent().siblings('.floor-marge-action').removeClass('d-none')
            $(this).parent().remove()
        })

        $(document).on('click', '.unite', function(e) {
            $('.apartments-button').attr('disabled', true)
            $(this).parent().next().find('button').attr('disabled', false)
            $(this).parent().prev().find('button').attr('disabled', false)
        })

        $(document).on('click', '.save-bascket-float-marge', function(e) {
            var _token = $('input[name=_token]').val();

            $.ajax({
                url: "/forthebuilder/house/marge-flats",
                data: {
                    data: arr,
                    _token: _token
                },
                type: 'POST',
                success: function(data) {
                    console.log(data)
                    if (data['status'] == true) {
                        location.reload()
                    } else {
                        alert(data['msg'])
                    }
                }
            })
            console.log(arr)
        })

        // $(document).on('click', '.save-flats', function(e) {
        //     $('#modal-for-flat .modal-body').html(`
        //         <form action="" method="post">
        //             <label for="living_space">{{ translate('Living space') }}</label>
        //             <input type="number" name="living_space" id="living_space" class="form-control">

        //             <label for="total_area">{{ translate('Total area') }}</label>
        //             <input type="number" name="total_area" id="total_area" class="form-control">

        //             <label for="kitchen_area">{{ translate('Kitchen area') }}</label>
        //             <input type="number" name="kitchen_area" id="kitchen_area" class="form-control">

        //             <br>
        //             <div class="row">
        //                 <div class="col-md-2" style="padding-top: 5px;">
        //                     <label for="terassa">{{ translate('Terrace') }}</label>
        //                     <input type="checkbox" name="" id="terassa">
        //                 </div>
        //                 <div class="col-md-6">
        //                     <input type="number" name="terassa" id="terassa" class="form-control">
        //                 </div>
        //             </div>

        //             <br>
        //             <div class="row">
        //                 <div class="col-md-2" style="padding-top: 5px;">
        //                     <label for="balcony">{{ translate('Balcony') }}</label>
        //                     <input type="checkbox" name="" id="balcony">
        //                 </div>
        //                 <div class="col-md-6">
        //                     <input type="number" name="balcony" id="balcony" class="form-control">
        //                 </div>
        //             </div>
        //             <div class="row">
        //                 <div class="col-lg-12">
        //                     <div class="card">
        //                         <div class="card-body">
        //                             <div class="form-group">
        //                                 <label for="files">{{ __('locale.file__upload') }}</label>
        //                                 <input type="file" name="files[]"  id="files" multiple>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //             </div>

        //         </form>
        //     `)

        // })

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
    </script>