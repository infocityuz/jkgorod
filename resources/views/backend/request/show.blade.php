@extends('layouts.backend')
@section('title')  {{__('locale.apartment_sale')}}  {{__('locale.view')}} @endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.css')}}">

@endsection
<style>
    .justify_content_center{
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .contact-header{
        display:flex;
        justify-content: space-around;
    }
</style>
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('locale.Request')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('backend.index', app()->getLocale())}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('request.index', app()->getLocale())}}">{{__('locale.Request')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.view')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="row">
            <div class="col-lg-6">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{__('locale.type')}}</td>
                            @if($model->type == null && !is_array($model->type))
                                <td>{{implode(', ', json_decode($model->type))}}</td>
                            @elseif(is_array($model->type))
                                <td>{{implode(', ', $model->type)}}</td>
                            @endif
                        </tr>
                        <tr>
                            <td>{{__('locale.title')}}</td>
                            <td>{{$model->title}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.description')}}</td>
                            <td>{{$model->description}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.address')}}</td>
                            <td>{{$model->address}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.total_area')}}</td>
                            <td>{{$model->total_area}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.living_space')}}</td>
                            <td>{{$model->living_space}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.floor')}}</td>
                            <td>{{$model->floor}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.floors_of_house')}}</td>
                            <td>{{$model->floors_of_house}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.number_of_rooms')}}</td>
                            <td>{{$model->number_of_rooms}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.ceiling_height')}}</td>
                            <td>{{$model->ceiling_height}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.year_construction')}}</td>
                            <td>{{$model->year_construction}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead >
                        <tr>
                            <th>#</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{__('locale.price')}} </td>
                            <td>{{number_format(round($model->price_from, 2)) .' - '.number_format(round($model->price_to, 2))}} {{ ($model->currency == 1) ? ' Сум' : ' Доллар'}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.is_exchange')}}</td>
                            <td>{{ ($model->is_exchange == 1) ? ' Да' : ' Нет'}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.is_furnished')}}</td>
                            <td>{{ ($model->is_furnished == 1) ? ' Да' : ' Нет'}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.is_commission')}}</td>
                            <td>{{ ($model->is_commission == 1) ? ' Да' : ' Нет'}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.creator')}}</td>
                            <td>{{ $model->user->first_name?? __('locale.Cron job')}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.repair')}}</td>
                            <td>{{ $model->repair}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.layout')}}</td>
                            <td>{{ $model->layout}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.bathroom')}}</td>
                            <td>{{ $model->bathroom}}</td>
                        </tr>

                        <tr>
                            <td>{{__('locale.building_type')}}</td>
                            <td>{{ $model->building_type}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.house_type')}}</td>
                            <td>{{ $model->housing_type}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.Metro')}}</td>
                            <td>{{ $model->metro}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.Distance to metro')}}</td>
                            <td>{{ $model->distance_to_metro}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.apartment_has')}}</td>
                            <td>
                                @if(!empty($model->apartment_has))
                                    @foreach($model->apartment_has as $apartment_has_item)
                                        <span class="badge-primary" style="padding: 5px;border-radius: 6px">{{ $apartment_has_item->name}}</span>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('locale.there_is_nearby')}}</td>
                            <td>
                                @if(!empty($model->there_is_nearby))
                                    @foreach($model->there_is_nearby as $there_is_nearby_item)
                                        <span class="badge-primary" style="padding: 5px;border-radius: 6px"> {{ $there_is_nearby_item->name}}</span>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{__('locale.first_name')}}</th>
                                    <th>{{__('locale.last_name')}}</th>
                                    <th>{{__('locale.surname')}}</th>
                                    <th>{{__('locale.phone_number')}}</th>
                                    <th>{{translate('additional phone number')}}</th>
                                    <th>{{__('locale.email')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @if(!empty($model->contacts))
                                        <td>{{$model->contacts->first_name}}</td>
                                        <td>{{$model->contacts->last_name}}</td>
                                        <td>{{$model->contacts->surname}}</td>
                                        <td>{{$model->contacts->phone_number}}</td>
                                        <td>{{$model->contacts->additional_phone_number}}</td>
                                        <td>{{$model->contacts->email}}</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.js')}}"></script>


@endsection







