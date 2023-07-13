@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/toastr/toastr.min.css') }}">
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
    <script src="{{ asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/jquery.maskedinput.min.js') }}"></script>
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

            $('#renew_flat').on('click', function() {
                $.get('/forthebuilder/house/show-more-item-detail/' + gId, function(data) {
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
                                // $('.house-box').data('id');
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

        $(document).ready(function() {
            $('input[type=tel]').mask("(99) 999-99-99");
        });

        var arr = []
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

            arr[0].flats.push(thisId)
            console.log(arr)
        })

        $(document).on('click', '.show-hidden-input', function() {
            $(this).hide()
            $(this).siblings('input').attr('type', 'number')
        })

        $(document).on('mouseenter', '.hover-remove-add', function() {
            $(this).find('.floor-action').removeClass('d-none')
        })

        $(document).on('mouseleave', '.hover-remove-add', function() {
            $(this).find('.floor-action').addClass('d-none')
        })

        // $(document).on('keyup', '.kv-m', function() {
        //     var this_val = $(this).val()
        //     // alert(this_val)
        //     console.log(arr)
        // })

        $(document).on('click', '.save-flats', function() {
            var kv_m = $('.kv-m').val();
            var _token = $('input[name=_token]').val();

            $.ajax({
                url: `/forthebuilder/house/update-flats-data`,
                data: {
                    data: arr,
                    kv_m: kv_m,
                    _token: _token
                },
                type: 'PUT',
                success: function(data) {
                    if (data == true) {
                        location.reload();
                    }
                },
                // error: function(data) {
                //     console.log(data);
                // }
            });
        })

        $(document).on('click', '.basket-to-house', function() {
            var id = $('#basket-id').val();
            var _token = $('input[name=_token]').val();
            $.ajax({
                url: `/forthebuilder/house/basket-to-house`,
                data: {
                    id: id,
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
                    if (data == 'success') {
                        location.reload();
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

            var part_html_client = '';
            if (client != '') {
                var part_html_client = `
                    <div class="form-control">
                        {{ translate('F.I.O') }}
                        <span>
                            ` + client + `
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
                                ` + price + ` у.е.
                            </span>
                        </div>
                        <br>
                        <div class="form-control" style="border: 1px solid grey;">
                            {{ translate('Number of rooms') }}
                            <span>
                                ` + rooms + `
                            </span>
                        </div>
                        <br>
                        <select class="form-control change_status">
                            <option value="">{{ translate('Status') }}</option>
                            <option value="0" class="free">{{ translate('Free') }}</option>
                            <option value="1" class="busy">{{ translate('Busy') }}</option>
                            <option value="2" class="sales">{{ translate('Sales') }}</option>
                        </select>
                        <br>
                        <a href="./jkEdit.html" type="button" class="modalPodrobnoButton btn btn-primary">{{ translate('Detail') }}</a>
                        <br>
                        <br>
                        ` + part_html_client + `
                    </div>
                </div>                
            `)
        })

        $(document).on('change', '.change_status', function() {
            // alert($(this).val())
            // flatstatus()
            select_status($(this).val())
            // $('#house-status-value').text($(this).text())
            // $('#flat_status_value').val(1)
        });
    </script>
