@extends('forthebuilder::layouts.forthebuilder')
@php
    use Modules\ForTheBuilder\Entities\Constants; 

@endphp
@section('title')
    {{ translate('Currency') }}
@endsection
<link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/datatables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('/backend-assets/forthebuilders/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css') }}">

@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <h2 class="panelUprText">{{ translate('Settings') }}</h2>
                    {{-- <button class="plus2">+</button> --}}
                </div>
            </div>
            <div class="nastroykiData">
                @if (Auth::user()->role_id==Constants::MANAGER)
                    <a class="nastroykiCont" data-toggle="modal" data-target="#logout" href="#">{{ translate('Logout') }}</a>

                @elseif (Auth::user()->role_id==Constants::ADMIN)
                    <a href="{{ route('forthebuilder.currency.index') }}"
                    class="nastroykiCont">{{ translate('Currencies') }}</a>
                    <a href="{{ route('forthebuilder.coupon.index') }}" class="nastroykiCont">{{ translate('Coupons') }}</a>
                    <a class="nastroykiCont" data-toggle="modal" data-target="#logout" href="#">{{ translate('Logout') }}</a>
                @else
                    <a href="{{ route('forthebuilder.currency.index') }}"
                    class="nastroykiCont">{{ translate('Currencies') }}</a>
                    <a href="{{ route('forthebuilder.language.index') }}" class="nastroykiCont">{{ translate('Language') }}</a>
                    <a href="{{ route('forthebuilder.coupon.index') }}" class="nastroykiCont">{{ translate('Coupons') }}</a>
                    <a href="{{ route('forthebuilder.house.price-formation') }}"
                        class="nastroykiCont">{{ translate('Price formation') }}</a>
                    <a class="nastroykiCont" data-toggle="modal" data-target="#logout" href="#">{{ translate('Logout') }}</a>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content"
                style="border-radius: 20px !important; border: 2px solid #94B2EB; background: #F9FBFF;">
                <div class="modal-header d-flex justify-content-center">
                    <div class="modalKalendarDate">28 Декабря 2022</div>
                </div>
                <div class="modal-body d-flex justify-content-center flex-column align-items-center">
                    <div class="d-flex justify-content-between kalendarModalBody">
                        <div class="modalImyaKalendar">Клиентов Клиент Клиентович <br> 28.12.2022 12:12:12 Встреча</div>
                        <div class="modalDataKalendar">Ответственный: <br> <b>Менеджеров Менеджеров</b></div>
                    </div>

                    <div class="d-flex justify-content-between kalendarModalBodyBlue">
                        <div class="modalImyaKalendar">Клиентов Клиент Клиентович <br> 28.12.2022 12:12:12 Встреча</div>
                        <div class="modalDataKalendar">Ответственный: <br> <b>Менеджеров Менеджеров</b></div>
                    </div>

                    <div class="d-flex justify-content-between kalendarModalBodyBlue">
                        <div class="modalImyaKalendar">Клиентов Клиент Клиентович <br> 28.12.2022 12:12:12 Встреча</div>
                        <div class="modalDataKalendar">Ответственный: <br> <b>Менеджеров Менеджеров</b></div>
                    </div>

                    <div class="d-flex justify-content-between kalendarModalBody">
                        <div class="modalImyaKalendar">Клиентов Клиент Клиентович <br> 28.12.2022 12:12:12 Встреча</div>
                        <div class="modalDataKalendar">Ответственный: <br> <b>Менеджеров Менеджеров</b></div>
                    </div>

                    <div class="d-flex justify-content-between kalendarModalBody">
                        <div class="modalImyaKalendar">Клиентов Клиент Клиентович <br> 28.12.2022 12:12:12 Встреча</div>
                        <div class="modalDataKalendar">Ответственный: <br> <b>Менеджеров Менеджеров</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content"
                style="border-radius: 20px !important; border: 2px solid #94B2EB; background: #F9FBFF;">
                <div class="modal-header d-flex justify-content-center">
                    <div class="modalKalendarDateBlue">20 Декабря 2022</div>
                </div>
                <div class="modal-body d-flex justify-content-center flex-column align-items-center">
                    <div class="d-flex justify-content-between kalendarModalBody">
                        <div class="modalImyaKalendar">Клиентов Клиент Клиентович <br> 28.12.2022 12:12:12 Встреча</div>
                        <div class="modalDataKalendar">Ответственный: <br> <b>Менеджеров Менеджеров</b></div>
                    </div>

                    <div class="d-flex justify-content-between kalendarModalBodyBlue">
                        <div class="modalImyaKalendar">Клиентов Клиент Клиентович <br> 28.12.2022 12:12:12 Встреча</div>
                        <div class="modalDataKalendar">Ответственный: <br> <b>Менеджеров Менеджеров</b></div>
                    </div>

                    <div class="d-flex justify-content-between kalendarModalBodyBlue">
                        <div class="modalImyaKalendar">Клиентов Клиент Клиентович <br> 28.12.2022 12:12:12 Встреча</div>
                        <div class="modalDataKalendar">Ответственный: <br> <b>Менеджеров Менеджеров</b></div>
                    </div>

                    <div class="d-flex justify-content-between kalendarModalBody">
                        <div class="modalImyaKalendar">Клиентов Клиент Клиентович <br> 28.12.2022 12:12:12 Встреча</div>
                        <div class="modalDataKalendar">Ответственный: <br> <b>Менеджеров Менеджеров</b></div>
                    </div>

                    <div class="d-flex justify-content-between kalendarModalBody">
                        <div class="modalImyaKalendar">Клиентов Клиент Клиентович <br> 28.12.2022 12:12:12 Встреча</div>
                        <div class="modalDataKalendar">Ответственный: <br> <b>Менеджеров Менеджеров</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content"
                style="border-radius: 20px !important; border: 2px solid #94B2EB; background: #F9FBFF;">
                <div class="modal-header d-flex justify-content-center">
                    <div class="modalKalendarDateBlue">20 Декабря 2022</div>
                </div>
                <div style="height: 340px;" class="modal-body d-flex justify-content-center flex-column align-items-center">
                    <h3 class="modalContentCalendarNet">На сегодня задач нет</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content"
                style="border-radius: 20px !important; border: 2px solid #94B2EB; background: #F9FBFF;">
                <div style="border-top-left-radius: 20px; border-top-right-radius: 20px;"
                    class="modal-body d-flex justify-content-center flex-column align-items-center">
                    <div class="d-flex">
                        <div class="d-flex flex-column">
                            <button class="modalMonth">Январь</button>
                            <button class="modalMonth">Февраль</button>
                            <button class="modalMonth">Март</button>
                            <button class="modalMonth">Апрель</button>
                            <button class="modalMonth">Май</button>
                            <button class="modalMonth">Июнь</button>
                        </div>
                        <div class="d-flex flex-column">
                            <button class="modalMonth">Июль</button>
                            <button class="modalMonth">Август</button>
                            <button class="modalMonth">Сентябрь</button>
                            <button class="modalMonth">Октябрь</button>
                            <button class="modalMonth">Ноябрь</button>
                            <button class="modalMonth">Декабрь</button>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <div class="modalYearSelect">2022</div>
                            <div>
                                <div class="yearNameKalendar">2021</div>
                                <div class="yearNameKalendar">2020</div>
                                <div class="yearNameKalendar">2019</div>
                                <div class="yearNameKalendar">2018</div>
                                <div class="yearNameKalendar">2017</div>
                                <div class="yearNameKalendar">2016</div>
                                <div class="yearNameKalendar">2015</div>
                                <div class="yearNameKalendar">2014</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logout"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;">
                <div class="modal-body">
                    <h2 class="modalVideystvitelno">{{ translate('Do you really want to logout') }}</h2>
                    <div class="d-flex justify-content-center mt-5">
                        <form style=""
                              action="{{ route('logout') }}"
                              method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="modalVideystvitelnoDa">{{ translate('Yes') }}</button>
                        </form>
                        <button class="modalVideystvitelnoNet" data-dismiss="modal">{{ translate('No') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let page_name = 'settings';
    </script>
@endsection
