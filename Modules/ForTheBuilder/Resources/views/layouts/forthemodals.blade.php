<div class="calendar_modal_background display-none"></div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog" style="max-width: 700px">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h4 class="modal-title">Default Modal</h4> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="modal-form" action="{{ route('forthebuilder.booking.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6" id="info1_flat">

                        </div>
                        <div class="col-6" id="info2_flat">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">{{ translate('name') }}</label>
                                <input type="text" name="name" id="name" list="browsers"
                                    class="form-control @error('name') error-data-input is-invalid @enderror keyUpName"
                                    value="{{ old('name') }}" autocomplete="off">
                                <span class="select2-dropdown select2-dropdown--below"
                                    style="width: 610px; position: absolute; background: lightgrey; display: none; max-height: 177px; overflow: scroll;">
                                    <span class="select2-results">
                                        <ul class="select2-results__options" role="tree" aria-multiselectable="true"
                                            id="select2-0obe-results" aria-expanded="true" aria-hidden="false"
                                            style="padding: 0;">
                                        </ul>
                                    </span>
                                </span>

                                <span class="error-data">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="surname">{{ translate('surname') }}</label>
                                <input type="text" name="surname" id="surname"
                                    class="form-control @error('surname') error-data-input is-invalid @enderror"
                                    value="{{ old('surname') }}">
                                <span class="error-data">
                                    @error('surname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="patronymic">{{ translate('patronymic') }}</label>
                                <input type="text" name="patronymic" id="patronymic"
                                    class="form-control @error('patronymic') error-data-input is-invalid @enderror"
                                    value="{{ old('patronymic') }}">
                                <span class="error-data">
                                    @error('patronymic')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ translate('phone') }}</label>
                                <div class="number_block">
                                    <input type="text" name="phone_code" class="additional_phone_code"
                                        value=" + 9 9 8" readonly>

                                    <input type="tel" name="phone" id="phone"
                                        class="form-control @error('phone') error-data-input is-invalid @enderror"
                                        value="{{ old('phone') }}">
                                </div>

                                <span class="error-data">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="additional_phone">{{ translate('additional_phone_number') }}</label>
                                <div class="number_block">
                                    <input type="text" name="phone_code" class="additional_phone_code"
                                        value=" + 9 9 8" readonly>

                                    <input type="tel" name="additional_phone" id="additional_phone"
                                        class="form-control @error('additional_phone') error-data-input is-invalid @enderror"
                                        value="{{ old('additional_phone') }}">
                                </div>

                                <span class="error-data">
                                    @error('additional_phone')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="series_number">{{ translate('series_number') }}</label>
                                <input type="text" name="series_number" id="series_number"
                                    class="form-control @error('series_number') error-data-input is-invalid @enderror"
                                    value="{{ old('series_number') }}">
                                <span class="error-data">
                                    @error('series_number')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group display-none" id="prepayment_summa">
                                <label for="prepayment_summa">{{ translate('prepayment summa') }}</label>
                                <input type="text" name="prepayment_summa"
                                    class="form-control @error('prepayment_summa') error-data-input is-invalid @enderror"
                                    value="{{ old('prepayment_summa') }}">
                                <span class="error-data">
                                    @error('prepayment_summa')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <input type="hidden" id="house_flat_id" name="house_flat_id">
                            <div class="form-group">
                                <label for="prepayment">{{ translate('prepayment') }}</label>
                                <input type="checkbox" name="prepayment" id="prepayment"
                                    class="@error('prepayment') error-data-input is-invalid @enderror">
                                <span class="error-data">
                                    @error('prepayment')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-footer justify-content-end" style="">
                                <button type="submit" class="btn btn-success"
                                    id="prepayment_submit">{{ translate('create') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{--                <div class="modal-footer justify-content-between"> --}}
            {{--                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
            {{--                    <button type="button" class="btn btn-primary">Save changes</button> --}}
            {{--                </div> --}}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
                            <a type="submit" class="btn btn-success" id="renew_flat">{{ translate('Release') }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<aside class="main-sidebar sidebar-dark-primary elevation-4 right__sidebar ">
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">

            <div class="close_sidebar">
                <span>×</span>
            </div>
            <div id="flatItemDetailImg">

            </div>
            <table class="table table-bordered" id="flatItemDetailTable">
                <tr>
                    <td>{{ translate('price') }}</td>
                    <td id="flatItemDetailPrice"></td>
                </tr>
                <tr>
                    <td>{{ translate('room_count') }}</td>
                    <td id="flatItemDetailRoomCount"></td>
                </tr>
            </table>
            <div class="flatItemStatus form-group">
                <a type="button" class="house_status_value fa fa-angle-down" id="house-status-value"></a>
                <input type="hidden" id="flat_status_value">
                <div class="house-status display-none" id="flatItemStatus">
                    <a type="button" id="free" value="0" data-toggle="modal"
                        data-target="#modal-default-free"> {{ translate('Free') }} </a>
                    <a type="button" id="busy" value="1" data-toggle="modal"
                        data-target="#modal-default"> {{ translate('Busy') }} </a>
                    <a type="button" id="sales" value="2"> {{ translate('Sales') }} </a>
                </div>
            </div>
            <table class="table table-bordered" id="flatItemDetailClientTable">
                <tr>
                    <td>{{ translate('client_name') }}</td>
                    <td id="flatItemDetailClientName"></td>
                </tr>
                <tr>
                    <td>{{ translate('client_surename') }}</td>
                    <td id="flatItemDetailClientSurename"></td>
                </tr>
                <tr>
                    <td>{{ translate('client_phone') }}</td>
                    <td id="flatItemDetailClientPhone"></td>
                </tr>
                <tr>
                    <td>{{ translate('client_prepayment') }}</td>
                    <td id="flatItemDetailClientPrepayment"></td>
                </tr>
            </table>
            <table class="table table-bordered" id="flatItemDetailNoClientTable">
                <tr>
                    <td class="text-center">{{ translate('no_client') }}</td>
                </tr>
            </table>
            <div id="flatItemDetailShow" style="display: flex;justify-content: space-between"></div>
            <div class="text-center" style="display: flex;justify-content: center;align-items: center">
                <div id="for-preloader" role="status">
                </div>
            </div>

        </nav>
    </div>
    <!-- /.sidebar -->
</aside>


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
                    enctype="multipart/form-data" id="chees-modal">
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
                                <label for="files">{{ translate('file__upload') }}</label>
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

<div class="modal fade" id="modal-for-calendar">
    <div class="modal-dialog" style="max-width: 700px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('forthebuilder.task.store') }}" method="POST" enctype="multipart/form-data"
                    id="chees-modal">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="add-task">
                            {{ translate('Task on') }}
                            {{-- <input type="text" name="" id="datepicker"> --}}

                            <a href="#" class="choise-date">&nbsp;{{ translate('Tomorrow') }} &nbsp;</a>
                            {{ translate('for') }} &nbsp;
                            <a href="#" class="choise-manager"> .......... &nbsp; </a> <i
                                class="fa fa-phone"></i>
                            <a href="#" class="choise-phone">&nbsp; {{ translate('Call') }} </a>
                        </div>

                        <select name="user_task_id" id="user_task_id" data-placeholder="{{ translate('select') }}"
                            class="form-control select2 d-none @error('user_task_id') is-invalid error-data-input @enderror">
                            <option value="">------------</option>
                            @if (isset($users) && !empty($users))
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ Auth::user()->id == $user->id ? 'selected' : '' }}>
                                        {{ $user->first_name }}</option>
                                @endforeach
                            @endif
                        </select>

                        <select name="task_type" id="task_type" data-placeholder="{{ translate('select') }}"
                            class="form-control select2 d-none @error('task_type') is-invalid error-data-input @enderror">
                            <option value="Связаться"> {{ translate('Call') }}</option>
                            <option value="Встреча"> {{ translate('Meeting') }}</option>
                            {{-- <option value="Внедрение">Внедрение</option> --}}
                        </select>

                        <input type="hidden" name="task_date" id="task_date"
                            class="form-control @error('task_date') error-data-input is-invalid @enderror"
                            value="{{ old('task_date') }}">
                    </div>
                    <div class="modal-calendar-buttons">
                        <input type="submit" value="{{ translate('Put') }}"
                            class="btn btn-success float-right save-flats-form">
                        <a class="btn btn-danger close float-right save-flats-form" data-dismiss="modal"
                            aria-label="Close">{{ translate('Cancell') }}</a>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button class="btn btn-primary">{{ translate('Save') }}</button>
            </div> --}}
        </div>
    </div>
</div>
