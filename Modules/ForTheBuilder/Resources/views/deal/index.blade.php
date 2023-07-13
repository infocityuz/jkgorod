@extends('forthebuilder::layouts.forthebuilder')

@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between" style="z-index: 108;">
                <div class="d-flex">
                    <div class="d-flex">
                        <h2 class="panelUprText" title="Сделки">Сделки</h2>
                        {{-- <button class="plus2">+</button> --}}
                        {{-- <a href="{{ route('forthebuilder.deal.create') }}" class="plus2">+</a> --}}
                    </div>
                </div>
            </div>
            {{-- <div class="d-flex justify-content-center" style="z-index: 110;margin-top: -70px; margin-bottom: 20px;">
                <div class="d-flex">
                    <div class="userXOval">
                        <img src="{{ asset('backend-assets/forthebuilders/images/user-x.png') }}" alt="user-x">
                    </div>
                    <div class="userXText">{{ translate('Not implemented') }}</div>
                </div>

                <div class="d-flex">
                    <div class="VerifedOval">
                        <img src="{{ asset('backend-assets/forthebuilders/images/Verifed.png') }}" alt="user-x">
                    </div>
                    <div class="VerifedText">{{ translate('Complete') }}</div>
                </div>
            </div> --}}

            <div class="row">
                <div class="sdelkaData">
                    <div class="d-flex" style="width: 100%; justify-content: center;">
                        @empty(!$arr)
                            @foreach ($arr as $key => $value)
                                <div class="col-md-4" style="height: 660px; overflow-y: scroll; overflow-x: hidden;">
                                    <div class="{{ $value['class'] ?? 'lidiRed' }}" style="width: 100%;">
                                        {{ $key }}
                                    </div>
                                    <div>
                                        @if (isset($value['list']) && !empty($value['list']))
                                            @foreach ($value['list'] as $key2 => $val)
                                                <div class="d-flex" style="margin-top: 20px; width: 100%;">
                                                    <a href="{{ route('forthebuilder.clients.show', [$val['client_id'], '0', '0']) }}"
                                                       class="lidiOfficial w-100">
                                                        {{-- lidiMarginRight --}}
                                                        <p class="zadachiSenderName">{{ translate('Responsible') }}:
                                                            <b>{{ $val['responsible'] }}</b>
                                                        </p>
                                                        <h3 class="lidiClientov">{{ $val['client'] }}</h3>
                                                        <p class="zadachiBlueTime">{{ translate('day') }}: {{ $val['day'] }}
                                                            <br>
                                                            {{ translate('time') }}: {{ $val['time'] }}
                                                        </p>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                        @endempty
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
                            <button class="modalVideystvitelnoDa" data-dismiss="modal">Да</button>
                            <button class="modalVideystvitelnoNet" data-dismiss="modal">Нет</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let page_name = 'deal';
        </script>
    @endsection
