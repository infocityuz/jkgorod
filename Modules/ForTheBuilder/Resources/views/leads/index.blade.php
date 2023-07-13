@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{__('locale.leads')}} @endsection

@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            <div style="max-width: 1394px;">
                @include('forthebuilder::layouts.content.header')
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <h2 class="panelUprText">{{translate('Clients')}}</h2>
                    <a href="./sozdatLidi.html" class="plus2">+</a>
                </div>
                <div class="miniSearchDiv">
                    <ion-icon class="miniSearchIconInput" name="search-outline"></ion-icon>
                    <input placeholder="Поиск по сделкам" class="miniInputSdelka" type="text">
                </div>
            </div>
            <div>
                <a href="./lidi.html" class="cdelki_c_klientami">Сделки c клиентами</a>
                <a href="./vseKlienti.html" class="cdelki_c_klientamiBlue">Bce клиенты</a>
            </div>

            <div class="sdelkaData">
                <div class="jkMiniData2">
                    <div class="checkboxDivInput">
                        №
                    </div>
                    <div class="checkboxDivTextInput">
                        Ф.И.О. Клиентов
                    </div>
                    <div class="ObjextSdelki">
                        Объект сделки
                    </div>
                    <div class="ObjextSdelki">
                        Сумма
                    </div>
                    <div class="dataSdelkaJk">
                        Последнее действие
                    </div>
                    <div class="deystvieSdelka">
                        Действиe
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            1
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk dataSdelkaJkYellowNthChild">
                            Последнее действие
                        </div>
                    </a>

                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            2
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk dataSdelkaJkOrangeNthChild">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            3
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk dataSdelkaJkBlueNthChild">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            4
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk dataSdelkaJkPinkNthChild">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            5
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk dataSdelkaJkGrayNthChild">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            6
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk dataSdelkaJkGreenNthChild">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            7
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            8
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            9
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            10
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            11
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            12
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>

                <div class="jkMiniData mb-1">
                    <a href="./informatsiyaKlinetov.html" class="d-flex lidiHrefBigLidiData">
                        <div class="checkboxDivInput">
                            13
                        </div>
                        <div class="checkboxDivTextInput">
                            Клиентов Клиент Клиентович
                        </div>
                        <div class="ObjextSdelki">
                            ЖК ITKey
                        </div>
                        <div class="ObjextSdelki">
                            1000 у.е.
                        </div>
                        <div class="dataSdelkaJk">
                            Последнее действие
                        </div>
                    </a>
                    <div class="lidiDivInput48">
                        <button type="button" style="border: none;" class="seaDiv">
                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20" height="20" src="{{asset('/backend-assets/forthebuilders/images/trash.png')}}" alt="Trash">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
        let page_name = 'leads';
    </script>
@endsection







