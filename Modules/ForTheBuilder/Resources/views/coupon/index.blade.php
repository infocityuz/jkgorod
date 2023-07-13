@extends('forthebuilder::layouts.forthebuilder')

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
                    <a href="{{ route('forthebuilder.settings.index') }}"
                        class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="{{ asset('/backend-assets/forthebuilders/images/icons/arrow-left.png') }}"
                            alt=""></a>
                    <h2 class="panelUprText">{{ translate('Coupon') }}</h2>
                    <a href="#" class="plus2 addNewCoupon">+</a>
                </div>
            </div>

            <div class="kuponData">
                <div class="sozdatKupon">
                    <div class="checkboxDivInput">
                        №
                    </div>
                    <div class="checkboxDivTextInput3565">
                        {{ translate('Coupon name') }}
                    </div>
                    <div class="checkboxDivTextInput3565">
                        {{ translate('Percentage discount %') }}
                    </div>
                    <div class="checkboxDivTextInput3565">
                        {{ translate('Date of creation') }}
                    </div>
                    <div class="checkboxDivTextInput35652">
                        {{ translate('Action') }}
                    </div>
                </div>

                @if (!empty($model))
                    @foreach ($model as $key => $value)
                        <div class="sozdatKupon2">
                            <div class="checkboxDivInput">
                                {{ $model->firstItem() + $key }}
                                <input type="hidden" class="checkboxDivTextInput3565 couponId"
                                    value="{{ $value->id }}">
                            </div>
                            <div class="checkboxDivTextInput3565">
                                <span>{{ $value->name }}</span>
                                <input type="hidden" class="checkboxDivTextInput3565 couponName"
                                    value="{{ $value->name }}">
                            </div>
                            <div class="checkboxDivTextInput3565">
                                <span>{{ $value->percent }}</span>
                                <input type="hidden" class="checkboxDivTextInput3565 couponPercent"
                                    value="{{ $value->percent }}">
                            </div>
                            <div class="checkboxDivTextInput3565">
                                {{ date('d.m.Y', strtotime($value->created_at)) }}
                            </div>
                            <div class="checkboxDivTextInput35652">
                                <div class="seaDiv couponUpdate d-none" style="cursor: pointer;">
                                    <img class="mt-1" width="20" height="20"
                                        src="{{ asset('/backend-assets/forthebuilders/images/verifed.png') }}"
                                        alt="Trash">
                                </div>
                                <div class="seaDiv couponEdit" style="cursor: pointer;">
                                    <img class="mt-1" width="20" height="20"
                                        src="{{ asset('/backend-assets/forthebuilders/images/edit.png') }}" alt="Trash">
                                </div>
                                {{-- <div class="seaDiv couponDelete" style="cursor: pointer;">
                                    <img class="mt-1" width="20" height="20"
                                        src="{{ asset('/backend-assets/forthebuilders/images/trash.png') }}"
                                        alt="Trash">
                                </div> --}}
                                <button type="button" style="border: none; cursor: pointer;"
                                    class="seaDiv clientDelete model_delete"
                                    data-url="{{ route('forthebuilder.coupon.destroy', $value->id) }}">
                                    <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1" width="20"
                                        height="20" src="{{ asset('backend-assets/forthebuilders/images/trash.png') }}"
                                        alt="Trash">
                                </button>
                                {{-- <form style="display: none;"
                                    action="{{ route('forthebuilder.coupon.destroy', $value->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-data-item btn btn-danger" title="delete"><i
                                            class="fas fa-trash"></i></button>
                                </form> --}}
                            </div>
                        </div>
                    @endforeach
                @endempty

                <div class="sozdatKupon2 formNewCoupon d-none">
                    <div class="checkboxDivInput">
                        {{ $model->firstItem() + ($key ?? 0) + 1 }}
                    </div>
                    <input type="text" class="checkboxDivTextInput3565 couponCreateName">
                    <input type="text" class="checkboxDivTextInput3565 couponCreatePercent">
                    <div class="checkboxDivTextInput3565 checkboxDivTextInput3565none"></div>
                    <div class="checkboxDivTextInput35652">
                        <div class="seaDiv couponSave" style="cursor: pointer;">
                            <img class="mt-1" width="20" height="20"
                                src="{{ asset('/backend-assets/forthebuilders/images/Verifed.png') }}" alt="Trash">
                        </div>
                        <div class="seaDiv removeFormCoupon" style="cursor: pointer;">
                            <img class="mt-1" width="20" height="20"
                                src="{{ asset('/backend-assets/forthebuilders/images/trash.png') }}" alt="Trash">
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: none;">
            <div class="modal-body">
                <h2 class="modalVideystvitelno">{{ translate('Do you really want to delete') }}</h2>
                <div class="d-flex justify-content-center mt-5">
                    <form style="display: inline-block;" action="" method="POST" id="form_delete">
                        @csrf
                        @method('DELETE')
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
