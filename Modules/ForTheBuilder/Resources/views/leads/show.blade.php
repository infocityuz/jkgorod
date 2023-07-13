@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{ __('locale.show') }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="/resources/demos/style.css">
@endsection
<style>
    .leads-menu {
        color: black;
        height: 54px;
        display: flex;
        align-items: center;
    }

    .leads-menu a {
        padding: 20px 24px;
        color: black;
    }

    .nav-tabs .active {
        height: 54px;
        display: flex;
        align-items: center;
        background-color: silver;
    }

    .deal-show {
        color: #212529;
    }
</style>
@section('content')
    <div class="page-header card">
    </div>
    <div class="container-fluid card-block">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('forthebuilder.index') }}">{{ __('locale.home') }}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('forthebuilder.leads.index') }}">{{ __('locale.leads') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('locale.show') }}</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card">
        <ul class="nav nav-tabs">
            <li class="leads-menu"><a class="active" data-toggle="tab" href="#info">{{ __('locale.info') }}</a></li>
            <li class="leads-menu"><a data-toggle="tab" href="#contract">{{ __('locale.contract') }}</a></li>
            <li class="leads-menu"><a data-toggle="tab" href="#installment_plan">{{ __('locale.installment plan') }}</a>
            </li>
            <li class="leads-menu"><a data-toggle="tab" href="#objects">{{ __('locale.objects') }}</a></li>
        </ul>

        <div class="tab-content">
            <div id="info" class="tab-pane fade active show">
                <div class="card-body">
                    <div class="card-block table-border-style">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Атрибут</th>
                                    <th>Данные</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><b>{{ __('locale.name') }}</b></td>
                                    <td>{{ $model->name }}</td>
                                </tr>
                                @if (isset($model->surname))
                                    <tr>
                                        <td><b>{{ __('locale.surname') }}</b></td>
                                        <td>{{ $model->surname }}</td>
                                    </tr>
                                @endif
                                @if (isset($model->patronymic))
                                    <tr>
                                        <td><b>{{ __('locale.patronymic') }}</b></td>
                                        <td>{{ $model->patronymic }}</td>
                                    </tr>
                                @endif
                                @if (isset($model->phone))
                                    <tr>
                                        <td><b>{{ __('locale.phone_number') }}</b></td>
                                        <td>{{ $model->phone }}</td>
                                    </tr>
                                @endif
                                @if (isset($model->additional_phone))
                                    <tr>
                                        <td><b>{{ __('locale.additional_phone_number') }}</b></td>
                                        <td>{{ $model->additional_phone }}</td>
                                    </tr>
                                @endif
                                @if (isset($model->email))
                                    <tr>
                                        <td><b>{{ __('locale.email') }}</b></td>
                                        <td>{{ $model->email }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><b>{{ __('locale.status') }}</b></td>
                                    <td>
                                        @foreach ($leadStatuses as $leadStatus)
                                            {{ $model->lead_status_id === $leadStatus->id ? $leadStatus->name : '' }}
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('locale.series_number') }}</b></td>
                                    <td>{{ $model->series_number }}</td>
                                </tr>
                                @if (isset($personalinfo))
                                    <tr>
                                        <td><b>{{ __('locale.given_date') }}</b></td>
                                        <td>{{ $personalinfo->given_date }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>{{ __('locale.live_address') }}</b></td>
                                        <td>{{ $personalinfo->live_address }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>{{ __('locale.inn') }}</b></td>
                                        <td>{{ $personalinfo->inn }}</td>
                                    </tr>
                                @endif
                                @if ($model->referer)
                                    <tr>
                                        <td><b>{{ __('locale.referer') }}</b></td>
                                        <td>{{ $model->referer }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><b>{{ __('locale.sent') }}</b></td>
                                    <td>{{ $model->updated_at }}</td>
                                </tr>
                                @if ($model->requestid)
                                    <tr>
                                        <td><b>{{ __('locale.requestid') }}</b></td>
                                        <td>{{ $model->requestid }}</td>
                                    </tr>
                                @endif
                                @if ($model->user_id)
                                    <tr>
                                        <td><b>{{ __('locale.creator') }}</b></td>
                                        <td>{{ $model->user_id }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <div class="comment">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-widget">
                                    <div class="card-footer card-comments">
                                        @if (!empty($comments))
                                            @foreach ($comments as $comment)
                                                <div class="card-comment">
                                                    @if (!empty($comment->user->avatar))
                                                        <img src="{{ asset('/uploads/user/' . $comment->user_id . '/s_' . $comment->user->avatar) }}"
                                                            class="img-circle img-sm" style="margin-bottom: 0"
                                                            alt="User Image">
                                                    @else
                                                        <img src="{{ asset('/backend-assets/img/custom/user-avatar-c.png') }}"
                                                            class="img-circle img-sm" style="margin-bottom: 0"
                                                            alt="User Image">
                                                    @endif
                                                    <div class="comment-text">
                                                        <span class="username">
                                                            {{ $comment->user->first_name }}
                                                            <span
                                                                class="text-muted float-right">{{ $comment->created_at }}</span>
                                                        </span>
                                                        <div class="infos">
                                                            <div class="comment_text">
                                                                {{ $comment->comment }}
                                                            </div>
                                                            <div class="comment_actions">
                                                                <a href="{{ route('forthebuilder.lead-comment.edit', $comment->id) }}"
                                                                    class="btn btn-success" title="update"
                                                                    style="margin-right: 5px;">
                                                                    {{ __('locale.update') }}
                                                                </a>
                                                                <form style=""
                                                                    action="{{ route('forthebuilder.lead-comment.destroy', $comment->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="delete-data-item btn btn-danger"
                                                                        title="delete">
                                                                        {{ __('locale.delete') }}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="card-footer">
                                        <form action="{{ route('forthebuilder.lead-comment.store') }}" method="post">
                                            @csrf

                                            <input type="hidden" name="lead_id" value="{{ $model->id }}">

                                            @if (!empty(Auth::user()->avatar))
                                                <img src="{{ asset('/uploads/user/' . Auth::user()->id . '/s_' . Auth::user()->avatar) }}"
                                                    class="img-fluid img-circle img-sm" style="margin-bottom: 0"
                                                    alt="User Image">
                                            @else
                                                <img src="{{ asset('/backend-assets/img/custom/user-avatar-c.png') }}"
                                                    class="img-circle img-sm" style="margin-bottom: 0" alt="User Image">
                                            @endif

                                            <div class="img-push d-flex">
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Комментарий..." name="comment">
                                                <button type="submit" class="btn btn-success mb-3"
                                                    style="height: 31px; display: flex; align-items: center">{{ __('locale.create') }}</button>
                                            </div>

                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="action-content-view">

                        <a href="#" onclick="goBack();" class="btn btn-primary" title="cancel"
                            style="margin-right: 15px;">
                            {{ __('locale.cancel') }}
                        </a>
                        <a href="{{ route('forthebuilder.leads.edit', $model->id) }}" class="btn btn-success"
                            title="update" style="margin-right: 15px;">
                            {{ __('locale.update') }}
                        </a>
                        <form style="display: inline-block; margin-right: 15px;"
                            action="{{ route('forthebuilder.leads.destroy', $model->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-data-item" class="btn btn-danger" title="delete">
                                {{ __('locale.delete') }}
                            </button>
                        </form>

                        {{-- <a href="" class="btn btn-info add_tasks" data-toggle="modal"
                            data-target="#modal-add-task" title="update" style="margin-right: 15px;">
                            {{ __('locale.Add Tasks') }}
                        </a> --}}
                        <br>
                        <br>
                    </div>

                    <div class="comment">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-widget">
                                    <div class="card-footer card-comments">
                                        @if (!empty($listTasks))
                                            @foreach ($listTasks as $task)
                                                <div class="card-comment">
                                                    @if (!empty($task->user->avatar))
                                                        <img src="{{ asset('/uploads/user/' . $task->user_id . '/s_' . $task->user->avatar) }}"
                                                            class="img-circle img-sm" style="margin-bottom: 0"
                                                            alt="User Image">
                                                    @else
                                                        <img src="{{ asset('/backend-assets/img/custom/user-avatar-c.png') }}"
                                                            class="img-circle img-sm" style="margin-bottom: 0"
                                                            alt="User Image">
                                                    @endif
                                                    <div class="comment-text">
                                                        <span class="username">
                                                            {{ $task->user->first_name }}
                                                            <span class="text-muted float-right">
                                                                {{ $task->task_date }}
                                                            </span>
                                                        </span>
                                                        <b>{{ $task->userTask->first_name . ' ' . $task->userTask->last_name }}</b>
                                                        <div class="infos">
                                                            <div class="comment_text">
                                                                {{ $task->title }}
                                                            </div>
                                                            {{-- <div class="comment_actions">
                                                                <a href="{{ route('forthebuilder.lead-comment.edit', $task->id) }}"
                                                                    class="btn btn-success" title="update"
                                                                    style="margin-right: 5px;">
                                                                    {{ __('locale.update') }}
                                                                </a>
                                                                <form style=""
                                                                    action="{{ route('forthebuilder.lead-comment.destroy', $task->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="delete-data-item btn btn-danger"
                                                                        title="delete">
                                                                        {{ __('locale.delete') }}
                                                                    </button>
                                                                </form>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="card-footer">
                                        {{-- <form action="{{ route('forthebuilder.lead-comment.store') }}" method="post"> --}}
                                        <form id="modal-form" action="{{ route('forthebuilder.leads.add-task') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf

                                            {{-- <input type="text" name="title" id="title"
                                                class="form-control @error('title') error-data-input is-invalid @enderror"
                                                value="{{ old('title') }}"> --}}
                                            <div class="img-push">
                                                <div class="chat">
                                                    <a href="#">Чат</a> для
                                                    <a href="#">всех</a>
                                                    <span class="btn btn-primary btn-xs float-right ml-3">Примечание</span>
                                                    <span class="btn btn-primary btn-xs float-right chat-btn">Задача</span>
                                                </div>
                                                <div class="add-task d-none">
                                                    Задача на
                                                    {{-- <input type="text" name="" id="datepicker"> --}}

                                                    <a href="#" class="choise-date">Завтра</a> для
                                                    <a href="#" class="choise-manager">..........</a> <i
                                                        class="fa fa-phone"></i>
                                                    <a href="#" class="choise-phone">Повонить</a>
                                                    <span class="btn btn-primary btn-xs float-right ml-3">Примечание</span>
                                                    <span class="btn btn-primary btn-xs float-right task-btn">Чат</span>
                                                </div>
                                                <br>
                                                {{-- <input type="text" class="form-control form-control-sm" --}}
                                                {{-- placeholder="Задачи..." name="task"> --}}
                                                {{-- <button type="submit" class="btn btn-success float-right"
                                                    style="height: 31px; display: flex; align-items: center">{{ __('locale.create') }}</button> --}}
                                            </div>

                                            <select name="user_task_id" id="user_task_id"
                                                data-placeholder="{{ __('locale.select') }}"
                                                class="form-control select2 d-none @error('user_task_id') is-invalid error-data-input @enderror">
                                                <option value="">------------</option>
                                                @empty(!$users)
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ Auth::user()->id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->first_name }}</option>
                                                    @endforeach
                                                @endempty
                                            </select>

                                            <select name="task_type" id="task_type"
                                                data-placeholder="{{ __('locale.select') }}"
                                                class="form-control select2 d-none @error('task_type') is-invalid error-data-input @enderror">
                                                <option value="Связаться">Повонить</option>
                                                <option value="Встреча">Встреча</option>
                                                {{-- <option value="Внедрение">Внедрение</option> --}}
                                            </select>

                                            <input type="hidden" name="lead_id" value="{{ $model->id }}">


                                            <select name="prioritet" id="prioritet"
                                                data-placeholder="{{ __('locale.select') }}"
                                                class="form-control select2 d-none @error('prioritet') is-invalid error-data-input @enderror">
                                                <option value="Срочно">Срочно </option>
                                                <option value="Очень срочно">Очень срочно </option>
                                            </select>

                                            <input type="hidden" name="task_date" id="task_date"
                                                class="form-control @error('task_date') error-data-input is-invalid @enderror"
                                                value="{{ old('task_date') }}">

                                            <textarea name="title" id="" cols="213" rows="5"></textarea>

                                            <button type="submit"
                                                class="btn btn-success float-right">{{ __('locale.create') }}</button>

                                            {{-- @if (!empty(Auth::user()->avatar))
                                                <img src="{{ asset('/uploads/user/' . Auth::user()->id . '/s_' . Auth::user()->avatar) }}"
                                                    class="img-fluid img-circle img-sm" style="margin-bottom: 0"
                                                    alt="User Image">
                                            @else
                                                <img src="{{ asset('/backend-assets/img/custom/user-avatar-c.png') }}"
                                                    class="img-circle img-sm" style="margin-bottom: 0" alt="User Image">
                                            @endif --}}

                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                {{-- <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <h4>{{ __('locale.Task List') }}</h4>
                        <table id="dashboard_datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <!-- <th ><input type="checkbox" id="master"></th> -->
                                    <th>#</th>
                                    <th>{{ __('locale.title') }}</th>
                                    <th>{{ __('locale.task_user_id') }}</th>
                                    <th>{{ __('locale.task_date') }}</th>
                                    <th>{{ __('locale.type') }}</th>
                                    <th>{{ __('locale.status') }}</th>
                                    <!-- <th>{{ __('locale.actions') }}</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($listTasks))
                                    @foreach ($listTasks as $key => $value)
                                        <tr>
                                            <!-- <td style="width: 50px"><input type="checkbox" class="sub_chk" data-id="{{ $value->id }}"></td> -->
                                            <td style="width: 50px">{{ $listTasks->firstItem() + $key }}</td>

                                            <td>{{ $value->title }}</td>
                                            <td>
                                                @if ($value->userTask->first_name)
                                                    {{ $value->userTask->first_name }}
                                                @endif
                                            </td>

                                            <td>{{ $value->task_date }}</td>
                                            <td>{{ $value->task_type }}</td>
                                            <td>{{ $value->status }}</td>

                                            <td>
                                                <div style="text-align: center;">
                                                    <!-- <a href="{{ route('forthebuilder.task.show', $value->id) }}" class="btn btn-primary" title="show"><i class="fas fa-eye"></i></a> -->
                                                    <a href="{{ route('forthebuilder.task.edit', $value->id) }}"
                                                        class="btn btn-primary" title="update"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <form style="display: inline-block;"
                                                        action="{{ route('forthebuilder.task.destroy', $value->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="delete-data-item btn btn-danger"
                                                            title="delete"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
                <div id="contract" class="tab-pane fade">
                    <div class="card-body">
                        <div class="card-block table-border-style">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Атрибут</th>
                                        <th>Данные</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($deals) > 0)
                                        @foreach ($deals as $deal)
                                            <tr>
                                                <td><b>{{ __('locale.house_flat_number') }}</b></td>
                                                <td>{{ $deal->house_flat_number }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.price_bought') }}</b></td>
                                                <td>{{ number_format($deal->price_bought, 2) }} $</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.agreement_number') }}</b></td>
                                                <td>{{ $deal->agreement_number }}</td>
                                            </tr>
                                            @if ($deal->dateDI)
                                                <tr>
                                                    <td><b>{{ __('locale.dateDI') }}</b></td>
                                                    <td>{{ $deal->dateDI }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td><b>{{ __('locale.description') }}</b></td>
                                                <td>{{ $deal->description }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.updated_at') }}</b></td>
                                                <td>{{ $deal->updated_at }}</td>
                                            </tr>
                                            <td><b>{{ __('locale.actions') }}</b></td>
                                            <td>
                                                <div class="">
                                                    <a href="{{ route('forthebuilder.deal.show', ['deal' => $deal->id]) }}"
                                                        class="btn btn-primary" title="show"><i
                                                            class="fas fa-eye"></i></a>
                                                    <a href="{{ route('forthebuilder.deal.edit', $deal->id) }}"
                                                        class="btn btn-primary" title="update"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                </div>
                                            </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="installment_plan" class="tab-pane fade">
                    <div class="card-body">
                        <div class="card-block table-border-style">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Атрибут</th>
                                        <th>Данные</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($installmentplans) > 0)
                                        @foreach ($installmentplans as $installmentplan)
                                            <tr>
                                                <td><b>{{ __('locale.period') }}</b></td>
                                                <td>{{ $installmentplan->period }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.percent') }}</b></td>
                                                <td>{{ $installmentplan->percent }} %</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.an_initial_fee') }}</b></td>
                                                <td>{{ number_format($installmentplan->an_initial_fee, 2) }} $</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.start_date') }}</b></td>
                                                <td>{{ $installmentplan->start_date }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.month_pay_first') }}</b></td>
                                                <td>{{ number_format($installmentplan->month_pay_first, 2) }} $</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.month_pay_second') }}</b></td>
                                                <td>{{ number_format($installmentplan->month_pay_second, 2) }} $</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.updated_at') }}</b></td>
                                                <td>{{ $installmentplan->updated_at }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.actions') }}</b></td>
                                                <td>
                                                    <div class="">
                                                        <a href="{{ route('forthebuilder.installment-plan.show', $installmentplan->id) }}"
                                                            class="btn btn-primary" title="show"><i
                                                                class="fas fa-eye"></i></a>
                                                        <a href="{{ route('forthebuilder.installment-plan.edit', $installmentplan->id) }}"
                                                            class="btn btn-primary" title="update"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="objects" class="tab-pane fade">
                    <div class="card-body">
                        <div class="card-block table-border-style">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Атрибут</th>
                                        <th>Данные</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($deals) > 0)
                                        @foreach ($deals as $deal)
                                            <tr>
                                                <td><b>{{ __('locale.flat') }}</b></td>
                                                <td>
                                                    @if (!empty($deal->house_flat->id))
                                                        <a
                                                            href="{{ route('forthebuilder.house-flat.show', $deal->house_flat->id) }}">
                                                            {{ $deal->house_flat->house->house_number ?? '' }}
                                                            дом, {{ $deal->house_flat->number_of_flat ?? '' }} квартира
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.number_of_rooms') }}</b></td>
                                                <td>{{ $deal->house_flat->room_count }} {{ __('locale.Room of flat') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.total_area') }}</b></td>
                                                <td>{{ __('locale.living_space') }} {{ $deal->house_flat->area }}
                                                    m<sup>2</sup> {{ __('locale.balcony') }}
                                                    {{ $deal->house_flat->balcony ?? '' }} m<sup>2</sup></td>
                                            </tr>
                                            <tr>
                                                <td><b>{{ __('locale.Flat price') }}</b></td>
                                                <td>{{ number_format($deal->house_flat->total_area * $deal->house_flat->price, 2) }}
                                                    $</td>
                                            </tr>
                                            @if ($deal->house_flat->house)
                                                <tr>
                                                    <td><b>{{ __('locale.house_info') }}</b></td>
                                                    <td>{{ $deal->house_flat->house->house_info }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное для добавления задачи -->
        {{-- <div class="modal fade" id="modal-add-task">
        <div class="modal-dialog" style="max-width: 700px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="modal-form" action="{{ route('forthebuilder.leads.add-task') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-primary" style="height: 95%">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="title">{{ __('locale.title') }}</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') error-data-input is-invalid @enderror"
                                                value="{{ old('title') }}">
                                            <span class="error-data">
                                                @error('title')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="user_task_id">{{ __('locale.task_user_id') }}</label>
                                            <select name="user_task_id" id="user_task_id"
                                                data-placeholder="{{ __('locale.select') }}"
                                                class="form-control select2 @error('user_task_id') is-invalid error-data-input @enderror">
                                                <option value="">------------</option>
                                                @empty(!$users)
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ Auth::user()->id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->first_name }}</option>
                                                    @endforeach
                                                @endempty
                                            </select>
                                            <span class="error-data">
                                                @error('user_task_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <input type="hidden" name="lead_id" value="{{ $model->id }}">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="task_type">{{ __('locale.task_type') }}</label>
                                            <select name="task_type" id="task_type"
                                                data-placeholder="{{ __('locale.select') }}"
                                                class="form-control select2 @error('task_type') is-invalid error-data-input @enderror">
                                                <option value="Связаться">Связаться</option>
                                                <option value="Встреча">Встреча</option>
                                                <option value="Внедрение">Внедрение</option>
                                            </select>
                                            <span class="error-data">
                                                @error('task_type')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="prioritet">{{ __('locale.prioritet') }}</label>
                                            <select name="prioritet" id="prioritet"
                                                data-placeholder="{{ __('locale.select') }}"
                                                class="form-control select2 @error('prioritet') is-invalid error-data-input @enderror">
                                                <option value="Срочно">Срочно </option>
                                                <option value="Очень срочно">Очень срочно </option>
                                            </select>
                                            <span class="error-data">
                                                @error('prioritet')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="task_date">{{ __('locale.task_date') }}</label>
                                            <input type="text" name="task_date" id="task_date"
                                                class="form-control @error('task_date') error-data-input is-invalid @enderror"
                                                value="{{ old('task_date') }}">
                                            <span class="error-data">
                                                @error('task_date')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-footer justify-content-end" style="">
                                    <button type="submit" class="btn btn-success">{{ __('locale.create') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}


    @endsection

    @section('scripts')
        <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('/backend-assets/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('/backend-assets/plugins/bootstrap-datetimepicker.js') }}"></script>

        <script>
            let page_name = 'leads';
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
                toastr.error(sessionError)
            }

            $(document).ready(function() {
                $('#task_date').datetimepicker({
                    format: 'Y-M-D',
                });
                $('#test_date').datetimepicker({
                    format: 'Y-M-D',
                });
            });

            $(document).on('click', '.chat-btn', function() {
                $('.chat').addClass('d-none')
                $('.add-task').removeClass('d-none')
            })

            $(document).on('click', '.task-btn', function() {
                $('.chat').removeClass('d-none')
                $('.add-task').addClass('d-none')
            })

            $(document).on('click', '.choise-date', function(e) {
                e.preventDefault();
                $("#task_date").datetimepicker("show");
            })

            // $(document).on('change', '#task_date', function() {
            //     var this_val = $(this).val();
            //     alert('12312312')
            //     $('.choise-date').text(this_val)
            // })

            $(document).on('click', '.choise-manager', function(e) {
                e.preventDefault();
                // $('select[name="user_task_id"]').chosen();
                // $('#user_task_id').show();
                var se = $("#user_task_id");
                se.removeClass('d-none');
                se[0].size = 10;
            })

            $("#user_task_id").on("click", function() {
                var se = $(this);
                se.addClass('d-none');
                $('.choise-manager').text($('#user_task_id option:selected').text())
            });

            $(document).on('click', '.choise-phone', function(e) {
                e.preventDefault();
                var se = $("#task_type");
                se.removeClass('d-none');
                se[0].size = 2;
            })

            $("#task_type").on("click", function() {
                var se = $(this);
                se.addClass('d-none');
                $('.choise-phone').text($('#task_type option:selected').text())
            });

            // $(".choise-manager").on("click", function() {
            //     var se = $("#user_task_id");
            //     se.show();
            //     // se[0].size = 2;
            // });
            // $("#user_task_id").on("click", function() {
            //     var se = $(this);
            //     se.hide();
            // });
        </script>
    @endsection
