<style>
    .display-none {
        display: none;
    }

    .notification_content {
        position: absolute;
        z-index: 100;
    }

    .language_flag {
        position: absolute;
        z-index: 1;
        margin-top: 70px;
    }
</style>
<div class="d-flex ajaxCliDiv">
    <div class="inputDiv">
        <div class="affflo">
            <ion-icon class="searchIconInput" name="search-outline"></ion-icon>
        </div>
        @php
            $arrSearch = [
                route('forthebuilder.index') => translate('Home'),
                route('forthebuilder.task.index') => translate('Task list'),
                route('forthebuilder.deal.index') => translate('Deal list'),
                route('forthebuilder.clients.index') => translate('Deals with clients'),
                route('forthebuilder.clients.all-clients') => translate('All clients'),
                route('forthebuilder.clients.create', '0') => translate('Creating a new client'),
                route('forthebuilder.house.index') => translate('JK list'),
                route('forthebuilder.house.create') => translate('Create a new JK'),
                route('forthebuilder.clients.calendar') => translate('Task calendar'),
                route('forthebuilder.booking.index') => translate('Booking list'),
                route('forthebuilder.installment-plan.index') => translate('Installment plan list'),
                route('forthebuilder.user.index') => translate('User list'),
                route('forthebuilder.user.create') => translate('Create a new user'),
                route('forthebuilder.settings.index') => translate('Settings list'),
                route('forthebuilder.currency.index') => translate('Currencies list'),
            ];
        @endphp
        <div class="inputCustomDiv" style="width: 100%; margin-top: -16px;">
            <input class="searchInput" type="text" value="">
        </div>
        <div style="background-color: white; border-radius: 20px; position: absolute; width: 54%; top: 70px; z-index: 9999;"
            class="searchMainDiv d-none">
            <ul style="list-style: none;">
                @foreach ($arrSearch as $key => $value)
                    <a href="{{ $key }}">
                        <li style="margin: 15px; border-bottom: 1px solid black;" class="searchLi d-none">
                            {{ $value }}
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
    <div style="max-width: 169px; display: flex; margin-right: 80px;">
        <div class="dropdown">
            @php
                if(isset($all_notifications['all_task']) && isset($all_notifications['all_booking']) && isset($all_notifications['all_installment_plan'])){
                   $all_count = count($all_notifications['all_task']) + count($all_notifications['all_booking']) + count($all_notifications['all_installment_plan']);
               }else{
                   $all_count = 0;
               }
            @endphp
            <button class="d-flex buttonUzbDropDownHeader" type="button" id="dropdownMenuButton2"
                src="{{ asset('/backend-assets/forthebuilders/images/notification.png') }}" alt="Notification">
                <img class="notifRegion" src="{{ asset('/backend-assets/forthebuilders/images/notification.png') }}"
                    alt="Notification">
                <div class="notifRegionNumber">{{ $all_count }}</div>
            </button>
            <div id="notificate_" class="notification_content display-none"
                style="border: none; background-color: transparent;" aria-labelledby="dropdownMenuButton2">
                <div class="up-arrow2"></div>
                <div class="dropdownMenyApplyNotification">
                    @if ($all_count > 0)
                        @foreach ($all_notifications['all_booking'] as $booking_notification)
                            @php
                              $notification_data = json_decode($booking_notification->data);
                            @endphp
                            @switch($booking_notification->type)
                                @case('Booking')
                                    <a href="{{ route('forthebuilder.booking.show', $notification_data->id) }}">
                                        <div class="d-flex">
                                            <img class="dropdownHumanImage"
                                                 src="{{ asset('/uploads/flat/booking.png') }}"
                                                 alt="HUman">
                                            <h4 class="dropDownHumanIamgeName">
                                                {{ $notification_data->first_name . ' ' . $notification_data->last_name }}
                                            </h4>
                                        </div>
                                        <span
                                                class="humoanSmsDropdownYellow">{{ translate('booking period is expired') }}</span>
                                        <p class="humoanSmsDropdown">
                                                <span class="humoanSmsDropdownSpan float-right text-sm">
                                                    {{ date('m/d h:i', strtotime($notification_data->updated_at)) }}
                                                </span>
                                        </p>
                                    </a>
                                    <hr style="margin: 0px 12px; margin-top: 44px;">
                                @break
                                @case('BookingPrepayment')
                                    <a href="{{ route('forthebuilder.booking.show', $notification_data->id) }}">
                                        <div class="d-flex">
                                            <img class="dropdownHumanImage"
                                                 src="{{ asset('/uploads/flat/booking.png') }}"
                                                 alt="HUman">
                                            <h4 class="dropDownHumanIamgeName">
                                                {{ $notification_data->first_name . ' ' . $notification_data->last_name }}
                                            </h4>
                                        </div>
                                        <span
                                                class="humoanSmsDropdownYellow">{{ translate('1 day left until the booking period ends') }}</span>
                                        <p class="humoanSmsDropdown">
                                                <span class="humoanSmsDropdownSpan float-right text-sm">
                                                    {{ date('m/d h:i', strtotime($notification_data->updated_at)) }}
                                                </span>
                                        </p>
                                    </a>
                                    <hr style="margin: 0px 12px; margin-top: 44px;">
                                @break
                            @endswitch
                        @endforeach
                        @foreach ($all_notifications['all_installment_plan'] as $installment_notification)
                            @php
                                $installment_data = json_decode($installment_notification->data);
                            @endphp
                            <a href="{{ route('forthebuilder.installment-plan.show', $installment_data->id) }}">
                                <div class="d-flex">
                                    <img class="dropdownHumanImage"
                                         src="{{ asset('/uploads/flat/installment_plan.avif') }}"
                                         alt="HUman">
                                    <h4 class="dropDownHumanIamgeName">
                                        {{ $installment_data->first_name . ' ' . $installment_data->last_name }}
                                    </h4>
                                </div>
                                <span class="humoanSmsDropdownYellow">{{ translate('Installment plan period is expired') }}</span>
                                <p class="humoanSmsDropdown">
                                    <span class="humoanSmsDropdownSpan float-right text-sm">
                                        {{ date('m/d h:i', $installment_data->expire_dates) }}
                                    </span>
                                </p>
                            </a>
                            <hr style="margin: 0px 12px; margin-top: 44px;">
                        @endforeach
                        @foreach($all_notifications['all_task'] as $task_notification)
                            @php
                                $notification_data = json_decode($task_notification->data);
                            @endphp
                            <a href="{{ route('forthebuilder.clients.show', [$notification_data->client_id, '0', $notification_data->id]) }}">
                                <div class="d-flex">
                                    @php
                                        $sms_avatar = public_path('/uploads/user/' . $notification_data->performer_id . '/s_' . $notification_data->performer_avatar);
                                    @endphp
                                    @if(file_exists($sms_avatar))
                                        <img class="dropdownHumanImage"
                                             src="{{ asset('/uploads/user/' . $notification_data->performer_id . '/s_' . $notification_data->performer_avatar) }}"
                                             alt="Human">
                                    @else
                                        <img class="dropdownHumanImage"
                                             src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}"
                                             alt="Human">
                                    @endif
                                    <h4 class="dropDownHumanIamgeName">{{ $notification_data->performer_fio }}</h4>
                                </div>
                                <span class="humoanSmsDropdown">{{ $notification_data->title }}
                                    <span class="humoanSmsDropdownSpan">{{ $notification_data->user_fio }}</span>
                                </span>
                                <p class="humoanSmsDropdown">{{ translate('Task') }}:&nbsp;
                                    @if ($notification_data->type == 'Связаться')
                                        <img src="{{ asset('/backend-assets/forthebuilders/images/Call.png') }}"
                                            alt="Call icon"><b>&nbsp;{{ translate('call') }}</b>
                                        {{ translate('with') . ' ' }}
                                        <span>{{ $notification_data->client_fio }}</span><br>
                                    @else
                                        <img src="{{ asset('/backend-assets/forthebuilders/images/meeting.png') }}"
                                            alt="Call icon" height="18px"><b>&nbsp;{{ translate('meeting') }}</b>
                                        {{ translate('with' . ' ') }}
                                        <span class="humoanSmsDropdownSpan">{{ $notification_data->client_fio }}</span><br>
                                    @endif
                                    <span class="humoanSmsDropdownSpan"> {{ $notification_data->task_date }}</span>
                                </p>
                                <hr style="margin: 0px 12px; margin-top: -8px;">
                            </a>
                        @endforeach
                    @else
                        <h4 class="netNovixUvidomleniy">{{ translate('No new notifications') }}</h4>
                    @endif
                </div>
            </div>
        </div>

        <div>
            @php
                if (session()->has('locale')) {
                    $locale = session('locale');
                } else {
                    $locale = env('DEFAULT_LANGUAGE', 'ru');
                }
                // $locale=app()->getLocale()?? env('DEFAULT_LANGUAGE');
            @endphp
            <div class="align-items-stretch d-flex dropdown" id="lang-change">
                <a class="buttonUzbDropDownHeader dropdown-toggle" type="button" id="dropdownMenuButton" role="button"
                    data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" href="javascript:void(0);">
                    @switch($locale)
                        @case('uz')
                            <img class="notifRegion2" id="selected_language"
                                src="{{ asset('/backend-assets/forthebuilders/images/region.png') }}" alt="region">
                        @break

                        @case('en')
                            <img class="notifRegion2" id="selected_language"
                                src="{{ asset('/backend-assets/forthebuilders/images/GB.png') }}" alt="region">
                        @break

                        @case('ru')
                            <img class="notifRegion2" id="selected_language"
                                src="{{ asset('/backend-assets/forthebuilders/images/RU.png') }}" alt="region">
                        @break
                    @endswitch
                </a>
                <div id="language_flag" class="language_flag display-none"
                    style="border: none; background-color: transparent;" aria-labelledby="dropdownMenuButton">
                    <div class="up-arrow"></div>
                    <div class="dropdownMenyApplyUzbFlag">
                        @foreach (\Modules\ForTheBuilder\Entities\Language::all() as $key => $language)
                        <a href="javascript:void(0)" data-flag="{{ $language->code }}"
                           class="dropdown-item dropdown-item dropdownLanguageItem @if ($locale == $language->code) active @endif" >
                            @switch($language->code)
                                @case('uz')
                                    <img class="dropdownRegionBayroq" id="lang_uz" style="margin-right: 8px;" src="{{asset('/backend-assets/forthebuilders/images/region.png')}}" alt="region">
                                    {{ $language->name }}
                                    @break

                                    @case('ru')
                                        <img class="dropdownRegionBayroq" id="lang_ru" style="margin-right: 8px;"
                                            src="{{ asset('/backend-assets/forthebuilders/images/RU.png') }}" alt="region">
                                        {{ $language->name }}
                                    @break

                                    @case('en')
                                        <img class="dropdownRegionBayroq" id="lang_en" style="margin-right: 8px;"
                                            src="{{ asset('/backend-assets/forthebuilders/images/GB.png') }}" alt="region">
                                        {{ $language->name }}
                                    @break
                                @endswitch
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/backend-assets/forthebuilders/javascript/jquery-3.6.1.js') }}"></script>
<script src="{{ asset('/backend-assets/js/custom.js') }}"></script>
<script defer>
    $(document).ready(function() {
        let language = '{{ $locale }}'
        let uz = `{{ asset('/backend-assets/forthebuilders/images/region.png') }}`
        let ru = `{{ asset('/backend-assets/forthebuilders/images/RU.png') }}`
        let en = `{{ asset('/backend-assets/forthebuilders/images/GB.png') }}`

        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdownMenyApplyUzbFlag a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    switch (locale) {
                        case 'uz':
                            $('#selected_language').attr('src', uz)
                            break;
                        case 'en':
                            $('#selected_language').attr('src', en)
                            break;
                        case 'ru':
                            $('#selected_language').attr('src', ru)
                            break;
                    }
                    $.post('{{ route('language.change') }}', {
                        _token: '{{ csrf_token() }}',
                        locale: locale
                    }, function(data) {
                        location.reload();
                    });

                });
            });
        }
    })
</script>
<script>
    let dropdownMenuButton2 = document.getElementById('dropdownMenuButton2')
    let dropdownMenuButton = document.getElementById('dropdownMenuButton')
    let language_flag = document.getElementById('language_flag')
    let notificate_ = document.getElementById('notificate_')
    dropdownMenuButton2.addEventListener('click', function() {
        if (notificate_.classList.contains('display-none')) {
            notificate_.classList.remove('display-none')
        } else {
            notificate_.classList.add('display-none')
        }
    });
    dropdownMenuButton.addEventListener('click', function() {
        if (language_flag.classList.contains('display-none')) {
            language_flag.classList.remove('display-none')
        } else {
            language_flag.classList.add('display-none')
        }
    });
</script>
