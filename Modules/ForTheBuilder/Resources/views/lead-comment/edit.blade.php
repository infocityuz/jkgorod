@extends('forthebuilder::layouts.forthebuilder')
@section('title')
    {{__('locale.update')}}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/toastr/toastr.min.css')}}">
@endsection
@section('content')
    <div class="page-header card">
    </div>
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
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.leads.index')}}">{{__('locale.lead')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.update')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('forthebuilder.lead-comment.update',$model->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="comment">{{__('locale.comment')}}</label>
                            <input type="text" name="comment" id="comment"
                                   class="form-control @error('comment') error-data-input is-invalid @enderror"
                                   value="{{ $model->comment}}">
                            <span class="error-data">@error('comment'){{$message}}@enderror</span>
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

@endsection


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

    <script>
        $(document).ready(function () {
            let page_name = 'lead-comment';
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
            $('form .select2').select2();
            $('#dateDl').datetimepicker({
                format: 'Y-M-D',
            });


            $('#house_id').on('change',function() {
                var houseID = $(this).val();
                $("#house_flat_id").prop('disabled', true);
                // console.log(houseID)
                if (houseID) {
                    $.ajax({
                        type: "GET",
                        datatype:"json",
                        url: "/forthebuilder/deal/get-flat?house_id=" + houseID,
                        success: function(data) {
                            // console.log(data)
                            if (data) {
                                $("#house_flat_id").empty();
                                // $("#house_flat_id").append('<option>Select State</option>');
                                data.forEach(function(item){
                                    $("#house_flat_id").append('<option value="' + item.id + '">' + item.number_of_flat + ' кв ' + '</option>');
                                })
                                $("#house_flat_id").prop('disabled', false); //disable
                            } else {
                                $("#house_flat_id").empty();
                                // $("#house_flat_id").prop('disabled', false); //disable
                            }
                        }
                    });
                } else {
                    $("#house_flat_id").empty();
                }
            });
            $(".delete-file-item").click(function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                if (confirm("Ты уверен")){
                    var id = $(this).data("id");
                    $.ajax(
                        {
                            url: "/forthebuilder/deal/destroy-file-item/"+id,
                            type: 'DELETE',
                            dataType: "json",
                            data: {
                                "id": id,
                            },
                            success: function (data){
                                toastr.success(data.success)
                                $("#img_item_"+id).remove();
                            }
                        });
                }

            });
            $(".delete-file-item1").click(function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                if (confirm("Ты уверен")){
                    var id = $(this).data("id");
                    $.ajax(
                        {
                            url: "/forthebuilder/deal/destroy-file-item/"+id,
                            type: 'DELETE',
                            dataType: "json",
                            data: {
                                "id": id,
                            },
                            success: function (data){
                                toastr.success(data.success)
                                $("#img_item_"+id).remove();
                            }
                        });
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

