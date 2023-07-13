@extends('forthebuilder::layouts.forthebuilder')

@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')

            <div style="max-width: 1394px;" class="d-flex justify-content-between">
                <div class="d-flex">
                    <h2 class="panelUprText">{{ translate('Clients') }}</h2>
                    {{-- <button class="prikrepitFayl">{{ translate('Attach file') }}</button> --}}
                </div>
                <div class="miniSearchDiv">
                    <ion-icon class="miniSearchIconInput" name="search-outline"></ion-icon>
                    <input placeholder="{{ translate('Client search') }}" class="miniInputSdelka searchTable" type="text">
                </div>
            </div>

            <div>
                <a href="{{ route('forthebuilder.clients.index') }}" class="cdelki_c_klientamiBlue2">
                    {{ translate('Deals with clients') }}
                </a>
                <a href="{{ route('forthebuilder.clients.all-clients') }}" class="cdelki_c_klientami2">
                    {{ translate('All clients') }}
                </a>
            </div>

            <div class="sdelkaData">
                <div class="jkMiniData2">
                    <div class="checkboxDivInput">
                        <input class="checkBoxInput" type="checkbox">
                    </div>
                    <div class="checkboxDivInput spisokMarginRight7">
                        №
                    </div>
                    <div class="checkboxDivTextInput vseClientiVaqtinchaWith  spisokMarginRight7">
                        {{ translate('F.I.O. Clients') }}
                    </div>
                    <div class="vseClientiStatus spisokMarginRight7">
                        {{ translate('Status') }}
                    </div>
                    <div class="spisokCheckImia spisokMarginRight7">
                        {{ translate('Last Activity') }}
                    </div>
                    <div class="checkboxDivTextInput4">
                        {{ translate('Action') }}
                    </div>
                </div>

                @empty(!$models)
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($models as $key => $value)
                        <div class="jkMiniData mb-1 hideData">
                            <input type="hidden" class="hiddenData"
                                value="{{ $value->last_name . ' ' . $value->first_name . ' ' . $value->middle_name }} {{ $value->status == $active ? translate('Active') : translate('Not active') }} {{ date('d.m.Y', strtotime($value->created_at)) }}">
                            <div class="jkMiniData mb-1">
                                <a href="{{ route('forthebuilder.clients.show', [$value->id, '0', '0']) }}" class="checkboxDivInput">
                                    <input class="checkBoxInput" type="checkbox">
                                </a>
                                <a href="{{ route('forthebuilder.clients.show', [$value->id, '0', '0']) }}" class="checkboxDivInput spisokMarginRight7">
                                    {{-- {{ $n++ }} --}}
                                    {{ $models->firstItem() + $key }}
                                </a>
                                <a href="{{ route('forthebuilder.clients.show', [$value->id, '0', '0']) }}" class="checkboxDivTextInput vseClientiVaqtinchaWith  spisokMarginRight7">
                                    {{ $value->last_name . ' ' . $value->first_name . ' ' . $value->middle_name }}
                                </a>
                                @php
                                    $class = 'vseClientiStatus dataSdelkaJkPinkNthChild dataSdelkaJkPinkNthChild spisokMarginRight7';
                                    if ($value->status == $active) {
                                        $class = 'vseClientiStatus dataSdelkaJkGreenNthChild dataSdelkaJkPinkNthChild spisokMarginRight7';
                                    }
                                @endphp
                                <a href="{{ route('forthebuilder.clients.show', [$value->id, '0', '0']) }}" class="{{ $class }}">
                                    {{ $value->status == $active ? translate('Active') : translate('Not active') }}
                                </a>
                                <a href="{{ route('forthebuilder.clients.show', [$value->id, '0', '0']) }}" class="spisokCheckImia spisokMarginRight7">
                                    {{ date('d.m.Y', strtotime($value->created_at)) }}
                                </a>
                                <div class="checkboxDivTextInput4">
                                    <!-- style="margin-right: 20px;" -->
                                        <a href="tel: {{ $value->phone }}" class="seaDiv">
                                            <img class="mt-1" width="20" height="20"
                                                src="{{ asset('backend-assets/forthebuilders/images/Call.png') }}"
                                                alt="Trash">
                                        </a>
                                        <a href="{{ $value->email }}" class="seaDiv">
                                            <img class="mt-1" width="20" height="20"
                                                src="{{ asset('backend-assets/forthebuilders/images/Mail.png') }}"
                                                alt="Trash">
                                        </a>
                                        <div class="seaDiv clientDelete"
                                            data-url="{{ route('forthebuilder.clients.destroy', $value->id) }}">
                                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1"
                                                width="20" height="20"
                                                src="{{ asset('backend-assets/forthebuilders/images/trash.png') }}"
                                                alt="Trash">
                                        </div>
                                    </div>
                                {{-- <div class="checkboxDivTextInput4 vseClientLinkRight" style="margin-right: 20px;">
                                    <a href="tel: {{ $value->phone }}" class="seaDiv">
                                        <img class="mt-1" width="20" height="20"
                                            src="{{ asset('backend-assets/forthebuilders/images/Call.png') }}" alt="Trash">
                                    </a>
                                    <a href="{{ $value->email }}" class="seaDiv">
                                        <img class="mt-1" width="20" height="20"
                                            src="{{ asset('backend-assets/forthebuilders/images/Mail.png') }}" alt="Trash">
                                    </a>
                                    <div class="seaDiv clientDelete"
                                        data-url="{{ route('forthebuilder.clients.destroy', $value->id) }}">
                                        <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20"
                                            height="20" src="{{ asset('backend-assets/forthebuilders/images/trash.png') }}"
                                            alt="Trash">
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    @endforeach
                    <div class="aiz-pagination mt-4">
                        {{ $models->links() }}
                    </div>
                @endempty

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
                        <form style="display: inline-block;" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="modalVideystvitelnoDa">Да</button>
                        </form>
                        <button class="modalVideystvitelnoNet" data-dismiss="modal">Нет</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    let page_name = 'clients';
</script>
