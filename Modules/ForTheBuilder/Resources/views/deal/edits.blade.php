@extends('forthebuilder::layouts.forthebuilder')
@php
    use Modules\ForTheBuilder\Entities\House;
    use Modules\ForTheBuilder\Entities\HouseFlat;
@endphp
@section('title')
    {{ translate('JK') }}
@endsection
<style>
    .sozdatJkData {
        height: auto !important;
    }
</style>
@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{ route('forthebuilder.deal.index') }}" class="plus2 profileMaxNazadInformatsiyaKlient">
                        <img src="{{ asset('backend-assets/forthebuilders/images/icons/arrow-left.png') }}" alt="">
                    </a>
                    <h2 class="panelUprText">{{ translate('Sale') }}</h2>
                </div>
            </div>

            <div class="page-header card"></div>
                <div class="card">
                    <div class="content-header">
                        <div class="container-fluid card-block">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0"> {{__('locale.update')}}</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__('locale.home')}}</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('forthebuilder.deal.index')}}">{{__('locale.deal')}}</a></li>
                                        <li class="breadcrumb-item active">{{__('locale.update')}}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{route('forthebuilder.deal.update',$model->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="house_id">{{__('locale.house')}}</label>
                                        <select required name="house_id" id="house_id"
                                            data-placeholder="{{__('locale.select')}}"
                                            class="form-control select2 @error('house_id') is-invalid error-data-input @enderror">
                                            @if(!empty($houses) && !empty($model->house_flat->house_id))
                                                <option value="">-----------------</option>
                                                @foreach($houses as $house)
                                                    <option value="{{$house->id}}" @if($house->id == $model->house_flat->house_id) {{"selected"}} @endif>
                                                        {{$house->house_number}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="error-data">@error('house_id'){{$message}}@enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="house_flat_number">{{__('locale.house_flat_number')}}</label>
                                        <input type="text" name="house_flat_number" id="house_flat_number" class="form-control @error('house_flat_number') error-data-input is-invalid @enderror"
                                        value="{{ $model->house_flat_number}}" >
                                        <span class="error-data">@error('house_flat_number'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{__('locale.description')}}</label>
                                        <input type="text" name="description" id="description"
                                               class="form-control @error('description') error-data-input is-invalid @enderror"
                                               value="{{ $model->description}}">
                                        <span class="error-data">@error('description'){{$message}}@enderror</span>
                                    </div>
                                    <br>
                                    <h3 class="card-title" style="font-weight: 700">{{__('locale.personal_informations')}}</h3>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label for="full_name">{{__('locale.full_name')}}</label>
                                        <input type="text" name="full_name" id="full_name"
                                               class="form-control @error('full_name') error-data-input is-invalid @enderror"
                                               value="@if(!empty($model->personal_informations->full_name)) {{$model->personal_informations->full_name}} @endif"
                                               placeholder="Ali Valiyev G'ani o'g'li" required>
                                        <span class="error-data">@error('full_name'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">{{__('locale.Gender')}}</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="0">{{__('locale.Man')}}</option>
                                            <option value="1">{{__('locale.Woman')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="series_number">{{__('locale.series_number')}}</label>
                                        <input type="text" name="series_number" id="series_number"
                                               class="form-control @error('series_number') error-data-input is-invalid @enderror"
                                               value="@if(!empty($model->personal_informations->series_number)) {{$model->personal_informations->series_number}} @endif"
                                               placeholder="AA 1234567" required>
                                        <span class="error-data">@error('series_number'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="given_date">{{__('locale.given_date')}}</label>
                                        <input type="text" name="given_date" id="given_date"
                                               class="form-control @error('given_date') error-data-input is-invalid @enderror"
                                               value="@if(!empty($model->personal_informations->given_date)) {{$model->personal_informations->given_date}} @endif" required>
                                        <span class="error-data">@error('given_date'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="live_address">{{__('locale.live_address')}}</label>
                                        <input type="text" name="live_address" id="live_address"
                                               class="form-control @error('live_address') error-data-input is-invalid @enderror"
                                               value="@if(!empty($model->personal_informations->live_address)) {{$model->personal_informations->live_address}} @endif" required>
                                        <span class="error-data">@error('live_address'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inn">{{__('locale.inn')}}</label>
                                        <input type="text" name="inn" id="inn"
                                               class="form-control @error('inn') error-data-input is-invalid @enderror"
                                               value="@if(!empty($model->personal_informations->inn)) {{$model->personal_informations->inn}} @endif" required>
                                        <span class="error-data">@error('inn'){{$message}}@enderror</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="house_flat_id">{{__('locale.contract_number')}}</label>
                                        <select name="house_flat_id" id="house_flat_id"
                                                data-placeholder="{{__('locale.select')}}"
                                                class="form-control select2 @error('house_flat_id') is-invalid error-data-input @enderror" required>
                                                @if(!empty($houseFlats))
                                                    <option value="">-----------------</option>
                                                    @foreach($houseFlats as $houseFlat)
                                                        <option value="{{$houseFlat->id}}" @if($houseFlat->id == $model->house_flat_id) {{ 'selected'}} @endif>
                                                            {{$houseFlat->contract_number}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                        </select>
                                        <span class="error-data">@error('house_flat_id'){{$message}}@enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="price_bought">{{__('locale.price')}}</label>
                                        <input type="number" name="price_bought" id="price_bought"
                                               class="form-control @error('price_bought') error-data-input is-invalid @enderror"
                                               value="{{ $model->price_bought }}" >
                                        <span class="error-data">@error('price_bought'){{$message}}@enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="agreement_number">{{__('locale.agreement_number')}}</label>
                                        <input type="text" name="agreement_number" id="agreement_number"
                                               class="form-control @error('agreement_number') error-data-input is-invalid @enderror"
                                               value="{{ $model->agreement_number }}">
                                        <span class="error-data">@error('agreement_number'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="dateDl">{{__('locale.date')}}</label>
                                        <input type="text" name="dateDl" id="dateDl"
                                               class="form-control @error('dateDl') error-data-input is-invalid @enderror"
                                               value="{{ $model->dateDl}}">
                                        <span class="error-data">@error('dateDl'){{$message}}@enderror</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-default collapsed-card">
                                <div class="card-header" data-card-widget="collapse">
                                    <h2 class="card-title">
                                        <b>
                                            {{__('locale.contacts')}}
                                        </b>
                                    </h2>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <section class="content">
                                        <div class="container-fluid">
                                            <div class="form-group">
                                                <label for="phone">{{__('locale.phone_number')}}</label>
                                                <div class="number_block">
                                                    <input type="text" name="phone_code" value=" + 9 9 8" readonly>
                                                    <input type="tel" name="phone" id="phone"
                                                           class="form-control @error('phone') error-data-input is-invalid @enderror"
                                                           value="{{ trim($model->phone, '+ 9 9 8') }}" >
                                                </div>
                                                <span class="error-data">@error('phone'){{$message}}@enderror</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="additional_phone">{{translate('additional phone number')}}</label>
                                                <div class="number_block">
                                                    <input type="text" name="phone_code" value=" + 9 9 8" readonly>
                                                    <input type="tel" name="additional_phone" id="additional_phone"
                                                           class="form-control @error('additional_phone') error-data-input is-invalid @enderror"
                                                           value="{{ trim($model->additional_phone, '+ 9 9 8') }}" >
                                                </div>
                                                <span class="error-data">@error('additional_phone'){{$message}}@enderror</span>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">{{__('locale.email')}}</label>
                                                <input type="text" name="email" id="email"
                                                       class="form-control @error('email') error-data-input is-invalid @enderror"
                                                       value="{{ $model->email }}" >
                                                <span class="error-data">@error('email'){{$message}}@enderror</span>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h4 class="card-title">{{__('locale.file__upload')}}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($model->files as $item_img)
                                                            <div class="col-lg-4" id="img_item_{{$item_img->id}}">
                                                                @if($item_img->ext == 'jpg' || $item_img->ext == 'jpeg' || $item_img->ext == 'png')
                                                                <div class="card" >
                                                                    <a href="{{ asset('/uploads/deal/'.$model->id.'/l_'.$item_img->guid)}}" data-toggle="lightbox" data-title="{{$item_img->name}}">
                                                                        <img src="{{ asset('/uploads/deal/'.$model->id.'/m_'.$item_img->guid)}}" class="img-fluid mb-2" alt="red sample"/>
                                                                    </a>
                                                                    <div class="card-body" style="padding:5px">
                                                                        <button style="border: none" data-id="{{ $item_img->id }}" class=" delete-file-item card-text badge badge-pill badge-danger ">{{__('locale.delete')}}</button>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                    <div class="card" >
                                                                        <a href="{{ asset('/uploads/deal/'.$model->id.'/'.$item_img->guid)}}" target="_blank" data-title="{{$item_img->name}}">
                                                                            {{$item_img->name}}
                                                                        </a>
                                                                        <div class="card-body" style="padding:5px">
                                                                            <button style="border: none" data-id="{{ $item_img->id }}" class=" delete-file-item1 card-text badge badge-pill badge-danger ">{{__('locale.delete')}}</button>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.container-fluid -->
                            </section>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label  for="files">{{__('locale.file__upload')}}</label>
                                        <input type="file" name="files[]"  id="files" multiple="multiple">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-footer justify-content-end" style="">
                                <button type="submit" class="btn btn-success">{{__('locale.update')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
@endsection
<script>
    let page_name = 'deal';
</script>

@section('scripts')
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script><script src="{{asset('/backend-assets/plugins/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>

    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/sortable.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/filetype.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/buffer.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/js/locales/ru.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/jquery.maskedinput.min.js')}}"></script>
    <script>
        let page_name = 'deal';
        $(document).ready(function() {
            $('#sent').datetimepicker({
                format: 'Y-M-D',
            });
            $('input[type=tel]').mask("(99) 999-99-99");
            $('#house_id').find('option[value=default]').attr('selected', 'selected')
            //kvartira ro'yhatga olish raqami orqali narxini avtomatik chiqarish
            $('#house_flat_id').on('change', function(){
                if (this.value) {
                    $.ajax({
                        type: "GET",
                        datatype:"json",
                        url: "/forthebuilder/deal/get-flat-price?id=" + this.value,
                        success: function(data) {
                            if (data) {
                                $("#price_bought").val(Math.round(data.price*data.total_area))
                                let price = parseInt($('#price_bought').val());
                            } else {

                            }
                        }
                    });
                } else {
                    $("#house_flat_id").empty();
                }
            });
            $('form .select2').select2();
            $('#deal-create-form #dateDl').datetimepicker({
                format: 'Y-M-D',
            });

            $('#deal-create-form #start_date').datetimepicker({
                format: 'Y-M-D',
            });

            // Rasrochka hisob kitoblari amalga oshirilmoqda

            let price1 = parseInt($('#price_bought').val());


            $('#price_bought').on('input',function (e) {

            })


            // Rasrochka hisob kitoblari amalga oshirilmoqda

            $('#deal-create-form #house_id').on('change',function() {
                var houseID = $(this).val();
                // console.log(houseID)
                $("#house_flat_id").prop('disabled', true);
                if (houseID) {
                    $.ajax({
                        type: "GET",
                        datatype:"json",
                        url: "/forthebuilder/deal/get-flat?house_id=" + houseID,
                        success: function(data) {
                            if (data) {
                                $("#house_flat_id").empty();
                                $("#house_flat_id").append("<option val=''>-------------</option>");
                                data.forEach(function(item){
                                    $("#house_flat_id").append('<option value="' + item.id + '">' + item.contract_number + '</option>');
                                })
                                $("#house_flat_id").prop('disabled', false); //disable
                                // $("#inputID").prop('disabled', false); //enable
                            } else {
                                $("#house_flat_id").empty();
                                $("#house_flat_id").prop('disabled', false); //disable
                            }
                        }
                    });
                } else {
                    $("#house_flat_id").empty();
                }
            });

            // kartik fileinput upload files
            var $el1 = $("#files");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#files").fileinput({
                language:'ru',
                uploadUrl: "/forthebuilder/deal/file-upload",
                // deleteUrl: '/forthebuilder/deal/file-delete-all',
                allowedFileExtensions: ['pdf', 'doc', 'docx', 'xls', 'xlsx','png','jpg','jpeg','svg'],
                uploadAsync: false,
                maxFileSize: 150000,
                maxFilesNum: 25,
                showUpload: false,
                showCaption: true,
                showRemove: false,
                removeClass: "btn btn-danger",
                removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
                overwriteInitial: false,
                // removeLabel: "Delete",
                // minFileCount: 1,
                // maxFileCount: 5,
                // hideThumbnailContent:false,
                // preferIconicPreview: true,
                browseOnZoneClick: true,
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreview: [
                    @if(!empty($dealFiles))
                            @foreach($dealFiles as $dealItemFile)
                        "{{asset('/uploads/tmp_files/' . Auth::user()->id.'/deal/'.$dealItemFile->getFilename())}}",
                    @endforeach
                    @endif
                ],
                initialPreviewConfig: [
                        @if(!empty($dealFiles))
                        @foreach($dealFiles as $dealItemFile)
                        @if($dealItemFile->getExtension() == 'jpg' || $dealItemFile->getExtension() == 'jpeg' || $dealItemFile->getExtension() == 'png')
                    {caption: "{{$dealItemFile->getFilename()}}", size: "{{$dealItemFile->getSize()}}", width: "120px", url: '/forthebuilder/deal/file-delete/'+'{{$dealItemFile->getFilename()}}', key: "{{$dealItemFile->getFilename()}}"},
                        @else
                    {type: "{{$dealItemFile->getExtension()}}",caption: "{{$dealItemFile->getFilename()}}", size: "{{$dealItemFile->getSize()}}", width: "120px", url: '/forthebuilder/deal/file-delete/'+'{{$dealItemFile->getFilename()}}', key: "{{$dealItemFile->getFilename()}}"},
                    @endif
                    @endforeach
                    @endif
                ]
            }).on("filebatchselected", function(event, files) {
                $el1.fileinput("upload");
            }).on('filesorted', function(e, params) {
                console.log('file sorted', e, params);
            }).on('fileuploaded', function(e, params) {
                console.log('file uploaded', e, params);
            }).on('filesuccessremove', function(e, id) {
                console.log('file success remove', e, id);
            });
            // kartik fileinput upload files

        });
    </script>
@endsection

