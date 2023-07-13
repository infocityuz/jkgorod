@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{__('locale.update')}}
@endsection

@section('styles')

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
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}"> {{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.house.index')}}">{{__('locale.house')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.update')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <form action="{{route('forthebuilder.house.update',$model->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="house_number">{{__('locale.house_name')}}</label>
                            <input type="text" name="house_number" id="house_number"
                                   class="form-control @error('house_number') error-data-input is-invalid @enderror"
                                   value="{{ $model->house_number, old('house_number') }}" required>
                            <span class="error-data">@error('house_number'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="corpas">{{__('locale.corpas')}}</label>
                            <input type="text" name="corpas" id="corpas"
                                   class="form-control @error('corpas') error-data-input is-invalid @enderror"
                                   value="{{ $model->corpas, old('corpas') }}" >
                            <span class="error-data">@error('corpas'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="house_number">{{__('locale.info')}}</label>
                            <input type="text" name="house_info" id="house_info"
                                   class="form-control @error('house_info') error-data-input is-invalid @enderror"
                                   value="{{  $model->house_info,  old('house_info') }}" >
                            <span class="error-data">@error('house_info'){{$message}}@enderror</span>
                        </div>


                    </div>
                </div>


            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="enterance_count">{{__('locale.enterance_count')}}</label>
                            <input type="number" name="enterance_count" id="enterance_count"
                                   class="form-control @error('enterance_count') error-data-input is-invalid @enderror"
                                   value="{{ $model->enterance_count, old('enterance_count') }}" required>
                            <span class="error-data">@error('enterance_count'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="floor_count">{{__('locale.floor_count')}}</label>
                            <input type="number" name="floor_count" id="floor_count"
                                   class="form-control @error('floor_count') error-data-input is-invalid @enderror"
                                   value="{{ $model->floor_count, old('floor_count') }}" required>
                            <span class="error-data">@error('floor_count'){{$message}}@enderror</span>
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
    <script>
        let page_name = 'house';
    </script>

@endsection


