@php
    $pathInfo = explode('/', $_SERVER['REQUEST_URI']);
    $path = end($pathInfo);
    $indexCheck = 'checked';
    $indexFilterCheck = '';
    if ($path == 'filter-index') {
        $indexCheck = '';
        $indexFilterCheck = 'checked';
    }
    use Modules\ForTheBuilder\Entities\Constants;
@endphp

{{-- @extends('forthebuilder::task.extra') --}}
@extends('forthebuilder::layouts.forthebuilder')

@section('content')

    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <h2 class="panelUprText">{{ translate('Tasks') }}</h2>
                    {{-- <button data-toggle="modal" data-target="#exampleModal" type="button" href="./sozdatZadachi.html"
                        class="plus2">+</button> --}}
                    <a href="{{ route('forthebuilder.clients.calendar') }}"
                        class="kalendarButton">{{ translate('Calendar') }}</a>
                </div>
            </div>

            @if (Auth::user()->role_id != Constants::MANAGER)
                <div class="zadachiFlexCenter">
                    <div class="d-flex">
                        <button class="zadachiFlexVse">
                            <input class="zadachiFlexInputCheck" id="filter_all" {{ $indexCheck }} type="radio"
                                name="filter" value='0'>
                            <label for="filter_all" style="margin-bottom: 0;">{{ translate('All') }}</label>
                            {{-- Все --}}
                        </button>
                        <button class="zadachiFlexMoiZadachi">
                            <input class="zadachiFlexInputCheck" id="filter_my_tasks" {{ $indexFilterCheck }} type="radio"
                                name="filter" value='1'>
                            <label for="filter_my_tasks" style="margin-bottom: 0;">{{ translate('My tasks') }}</label>
                            {{-- Мои задачи --}}
                        </button>
                    </div>
                </div>
            @endif
           

            <div class="zadachiData">
                <div class="zadachiJustify" style="width: 100%; display: flex; justify-content: space-around; ">
                    @empty(!$arr)
                        @php
                            $i = true;
                            $zadachi = 'zadachiRed';
                            $zadachiH3 = 'zadachiRedH3';
                            $zadachiP = 'zadachiRedP';
                            $style = 'margin-left: 2%';
                        @endphp
                        @foreach ($arr as $key => $value)
                            <div style="{{ $style }}">
                                <div class="{{ $zadachi }} zadachiMarginRight">
                                    <h3 class="{{ $zadachiH3 }}">{{ $key }}</h3>
                                    <p class="{{ $zadachiP }}">{{ translate('All tasks') }}: {{ count($value) }}</p>
                                </div>
                                @php
                                    $zadachiH3 = 'zadachiBlueH3';
                                    $zadachi = 'zadachiBlue';
                                    $zadachiP = 'zadachiBlueP';
                                @endphp
                                <div style="height: 550px; overflow-y: auto; overflow-x: hidden;">
                                    @if (isset($value) && !empty($value))
                                        @foreach ($value as $val)
                                            <a href="{{ route('forthebuilder.clients.show', [$val['client_id'], '0', '0']) }}"
                                                class="zadachiBlueName zadachiMarginRight">
                                                <p class="zadachiSenderName">{{ translate('Responsible') }} :
                                                    <b>{{ $val['responsible'] }}</b>
                                                </p>
                                                <h3 class="zadachiBlueNameZ">{{ $val['client'] }} <br>
                                                    {{ $val['client_middle_name'] }}</h3>
                                                <p class="zadachiBlueTime">
                                                    {{ translate('Date') . ': ' . date('d.m.Y', strtotime($val['day'])) }}<br>
                                                    {{ translate('Time') . ': ' . date('H:i:s', strtotime($val['time'])) }}</p>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @php
                                if ($i) {
                                    $i = false;
                                    $style = '';
                                }
                            @endphp
                        @endforeach
                    @endempty
                </div>

                <div class="zadachiBorder1221">

                </div>
            </div>

            {{-- <div class="zadachiData">
                <div class="row">
                    @empty(!$arr)
                        @php
                            $i = true;
                            $zadachi = 'zadachiRed';
                        @endphp
                        @foreach ($arr as $key => $value)
                            <div class="col-md-3">
                                <div class="{{ $zadachi }} zadachiMarginRight">
                                    <h3 class="zadachiRedH3">{{ $key }}</h3>
                                    <p class="zadachiRedP">{{ translate('All tasks') }}: {{ count($value) }}</p>
                                </div>
                                @php
                                    $zadachi = 'zadachiBlue';
                                @endphp

                                @if (isset($value) && !empty($value))
                                    @foreach ($value as $val)
                                        <div class="zadachiJustify mt-3">
                                            <a href="{{ route('forthebuilder.clients.show', $val['client_id']) }}"
                                                class="zadachiBlueName zadachiMarginRight">
                                                <p class="zadachiSenderName">{{ translate('Responsible') }} :
                                                    <b>{{ $val['responsible'] }}</b>
                                                </p>
                                                <h3 class="zadachiBlueNameZ">{{ $val['client'] }}</h3>
                                                <p class="zadachiBlueTime">
                                                    {{ translate('Date') . ': ' . date('d.m.Y', strtotime($val['day'])) }}<br>
                                                    {{ translate('Time') . ': ' . date('H:i:s', strtotime($val['time'])) }}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        @endforeach
                    @endempty
                </div>

            </div> --}}

            {{-- <div class="zadachiBorder1221">

            </div> --}}
        </div>
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border: none;">
                    <div class="modal-body">
                        <h2 class="modalVideystvitelno">Вы действительно хотите удалить</h2>
                        <div class="d-flex justify-content-center mt-5">
                            <button class="modalVideystvitelnoDa" data-dismiss="modal">Да</button>
                            <button class="modalVideystvitelnoNet" data-dismiss="modal">Нет</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let page_name = 'tasks';
        </script>
    @endsection
