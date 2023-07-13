<script>
    let page_name = 'house-flat';
    $(document).ready(function() {
        alert('11111')
    })
    $(document).on('click', '#delete-data-item', function(e) {
        if (!confirm('Вы уверены, что удалите этот элемент?')) {
            e.preventDefault();
        }
    })
    $(function() {
        // $('#datePicker').datetimepicker({
        //     format: 'Y-M-D',
        // });
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
        var gId = '';
        var number_of_flat = '';
        var contract_number = '';
        let house_id;
        var id = {{ $model->id }};
        house_id = {{ $model->id }};
        number_of_flat = {{ $model->number_of_flat }};
        contract_number = {{ $model->contract_number }};
        gId = id;
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
            $('#info1_flat div').remove()
            $('#house_flat_id').val(`${data.flatItemDetail.id}`);
            $('#info1_flat').append(
                `<div><span>{{ __('locale.Number of flat') }}: </span><b>${data.flatItemDetail.number_of_flat}</b></div>`
            )
            $('#info1_flat').append(
                `<div><span>{{ __('locale.Flat price') }}: </span><b>${Math.round(data.flatItemDetail.total_area) * data.flatItemDetail.price}</b> $</div>`
            )
            $('#info2_flat').append(
                `<div><span>{{ __('locale.Total area') }}: </span><b>${data.flatItemDetail.total_area}</b> m<sup>2</sup></div>`
            )
            $('#info2_flat').append(
                `<div><span>{{ __('locale.Room of flat') }}: </span><b>${data.flatItemDetail.room_count}</b></div>`
            )
            $('#flatItemDetailPrice').text(data['flatItemDetail']['price']);
            $('#flatItemDetailRoomCount').text(data['flatItemDetail']['room_count']);
            $('#flatItemDetailShow').empty();
            $('#flatItemDetailShow').append(
                `<a href='/forthebuilder/house-flat/show/${id}' class='style-add btn btn-primary' style='color:#fff'>{{ __('locale.show') }}</a>`
            );
            $('#flatItemStatusSelect').attr("data-id", `${id}`);
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
                    var selectedstatuses = val;
                    switch (selectedstatuses) {
                        case '2':
                            // location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + '&name=' + number_of_flat + '&house_id=' + '{{ $model->id }}' + '&house_name=' +'{{ $model->house_number }}'  + '&contract_number=' + contract_number);
                            location.replace("/forthebuilder/deal/create?house_flat_id=" + gId +
                                "&house_flat_number=" + data.flatItemDetail.number_of_flat +
                                "&house_id=" + '{{ $model->id }}' + '&house_name=' +
                                '{{ $model->house_number }}' + '&contract_number=' + data
                                .flatItemDetail.contract_number);
                    }
                } else if (data['flatItemDetail']['status'] == 1) {
                    var selectedstatuses = val;
                    switch (selectedstatuses) {
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
                    var selectedstatuses = val;
                    switch (selectedstatuses) {
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
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true,
            });
        });
        $('.house__slider').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
        //status updated
        $('#flatItemStatusSelect').on('change', function(e) {
            // console.log(gId)
            e.preventDefault();
            var selectedstatuses = $('#flatItemStatusSelect').val();
            var gId = $('#flatItemStatusSelect').data('id');
            $.ajax({
                url: `/forthebuilder/house-flat/update-status/${gId}`,
                data: {
                    status: selectedstatuses
                },
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
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
            if (selectedstatuses == 0) {
                $('#flatItemStatusSelect').css('backgroundColor', 'rgb(25,132,86)');
                $('#flatItemStatusSelect').css('color', '#fff');
            }
            if (selectedstatuses == 1) {
                $('#flatItemStatusSelect').css('backgroundColor', 'rgb(245,187,12)');
            }
            if (selectedstatuses == 2) {
                $('#flatItemStatusSelect').css('backgroundColor', 'rgb(105,116,126)');
                $('#flatItemStatusSelect').css('color', '#fff')
            }
        })
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
</script>
