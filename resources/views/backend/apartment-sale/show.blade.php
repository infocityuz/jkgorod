@extends('layouts.backend')
@section('title')  {{__('locale.apartment_sale')}}  {{__('locale.view')}} @endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=50c2cf4e-d595-4d18-a363-b7aa10d3569c&lang=ru_RU" type="text/javascript">
    </script>
@endsection
<style>
    .justify_content_center{
        width: 100%;
        display: flex;
        justify-content: space-around;
    }
    .wrap-map{
          width: 1200px;
          margin:30px auto;
          display: grid;
          grid-gap: 50px;
          grid-template-columns: 300px auto;
    }

    #map{
        width: 100%;
        height: 500px;
        border-radius: 10px;
    }
    .yandex-map-lat-lng{
        display: flex;
        justify-content: space-around;
    }
    .map__balloon{
        padding: 5px;
        display: flex;
    }
    .map_flat_address{
        padding: 6px;
        text-align: center;
    }
    .display-none{
        display: none;
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
                        <h1 class="m-0">{{__('locale.apartment_sale')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('backend.index', app()->getLocale())}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('apartment-sale.index', app()->getLocale())}}">{{__('locale.apartment_sale')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.view')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-block table-border-style">
            <div class="row">
                <div class="col-12">

                    <div class="card-header">
                        <h4 class="card-title">{{__('locale.image')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(!empty($model->Flatimages))
                                @if(count($model->Flatimages)>4)
                                    <div class="house__slider owl-carousel owl-theme">
                                        @foreach($model->Flatimages as $img)
                                            <div class="item">
                                                <a href="{{ asset('/uploads/apartment-sale/'.$img->apartment_sale_id.'/l_'.$img->guid)}}"
                                                   data-gallery="example-gallery"
                                                   data-toggle="lightbox" data-title="{{$img->name}}"
                                                   data-gallery="gallery" class="mp-images">
                                                    <img src="{{ asset('/uploads/apartment-sale/'.$img->apartment_sale_id.'/m_'.$img->guid)}}"  class="img-fluid mb-2" alt="white sample"/>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="justify_content_center">
                                        @foreach($model->Flatimages as $img)
                                            <div class="item">
                                                <a href="{{ asset('/uploads/apartment-sale/'.$img->apartment_sale_id.'/l_'.$img->guid)}}"
                                                   data-gallery="example-gallery"
                                                   data-toggle="lightbox" data-title="{{$img->name}}"
                                                   data-gallery="gallery" class="mp-images">
                                                    <img src="{{ asset('/uploads/apartment-sale/'.$img->apartment_sale_id.'/m_'.$img->guid)}}"  class="img-fluid mb-2" alt="white sample"/>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                            @if($model->images)
                                @if(is_array($model->images))
                                    @php($model_images = $model->images)
                                @else
                                    @php($model_images = json_decode($model->images))
                                @endif
                                @if(count($model_images)>4)
                                    <div class="house__slider owl-carousel owl-theme">
                                        @foreach($model_images as $fimg)
                                            <div class="item">
                                                <a href="{{$fimg}}"
                                                   data-gallery="example-gallery"
                                                   data-toggle="lightbox" data-title="olx"
                                                   data-gallery="gallery" class="mp-images">
                                                    <img src="{{$fimg}}"  class="img-fluid mb-2" alt="white sample"/>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="justify_content_center">
                                        @foreach($model_images as $fimg)
                                            <div class="item">
                                                <a href="{{$fimg}}"
                                                   data-gallery="example-gallery"
                                                   data-toggle="lightbox" data-title="olx"
                                                   data-gallery="gallery" class="mp-images">
                                                    <img src="{{$fimg}}"  class="img-fluid mb-2" alt="white sample"/>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
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
                            <td>{{__('locale.type')}}</td>
                            @if($model->type && !is_array($model->type))
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
                            <td>{{__('locale.region_id')}}</td>
                            <td>{{$model->region->name??''}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.Town')}}</td>
                            <td>{{$model->town->name??''}}</td>
                        </tr>
                        <tr>
                            <td>{{__('locale.Area')}}</td>
                            <td>{{$model->area->name??''}}</td>
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
                            <td>{{$model->price}} {{ ($model->currency == 1) ? ' Сум' : ' Доллар'}}</td>
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
    <div class="card map-content">
        <div class="card-body">
            <div class="form-group yandex-map-lat-lng">
                <div>
                    <span>Lat: <b id="label_latitude">{{$model->latitude}}</b></span>&nbsp;&nbsp;
                    <span>Lng: <b id="label_longitude">{{$model->longitude}}</b></span>
                </div>
            </div>
            <div class="form-group">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                    @if($model->images)
                        <div class="card-header contact-header">
                            <h4 class="card-title">{{__('locale.contact')}}</h4>
                            <a class="badge-primary" style="padding: 5px;border-radius: 6px" href="{{$model->olx_url}}">{{__('locale.contact')}}</a>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-bordered" >
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

    {{--    <div class="action-content-view container" style="padding-bottom: 25px">--}}

    {{--        <a href="{{route('apartment-sale.index')}}" class="btn btn-primary" title="cancel">--}}
    {{--            cancel--}}
    {{--        </a>--}}
    {{--        <a href="{{route('apartment-sale.edit',$model->id)}}" class="btn btn-success" title="update">--}}
    {{--            update--}}
    {{--        </a>--}}
    {{--        <form style="display: inline-block;" action="{{route('apartment-sale.destroy',$model->id)}}" method="POST">--}}
    {{--            @csrf--}}
    {{--            @method('DELETE')--}}
    {{--            <button type="submit" id="delete-data-item" class="btn btn-danger" title="delete">--}}
    {{--                <i class="ti-trash"></i> delete--}}
    {{--            </button>--}}
    {{--        </form>--}}

    {{--    </div>--}}
    <style>
        .contact-header{
            display:flex;
            justify-content: space-around;
        }
    </style>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.js')}}"></script>

    <script>

        $(document).ready(function() {
            $('.mp-images').magnificPopup({
                type:'image',
                gallery: {
                    enabled: true
                },
            });

            $('.house__slider').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:4
                    },
                    1000:{
                        items:5
                    }
                }
            })

            let latitude = '{{$model->latitude}}';
            let longitude = '{{$model->longitude}}';
            let flat_address = '{{$model->address}}';
            let flat_title = '{{$model->title}}';
            if(latitude){
                if($('.map-content').hasClass('display-none')) {
                    $('.map-content').removeClass('display-none')
                }
                let mapOptions = {
                    center:[latitude, longitude],
                    zoom:14
                }
                ymaps.ready(init);
                function init(){
                    mapOptions = new ymaps.Map("map", {
                        center: [latitude, longitude],
                        zoom: 14
                    });
                    let placemark = new ymaps.Placemark([latitude, longitude], {
                            hintContent:`<div class="map__hint">${flat_address}</div>`,
                            balloonContent: [
                                '<div class="map__balloon">',
                                '<div><img class="map__burger-img" src="/uploads/house/apartment.webp" width="64px" height="64px" alt="burger"></div>',
                                `<div class="map_flat_address"><span>${flat_title}</span></div>`,
                                '</div>'
                            ].join('')
                        },
                        {
                            iconLayout: 'default#image',
                            iconImageHref: '/uploads/house/selected_geolocation.png',
                            iconImageSize: [40, 40]
                        });
                    mapOptions.geoObjects.add(placemark);

                }

                let map = new L.map('map' , mapOptions);
                let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
                map.addLayer(layer);
            }else{
                if(!$('.map-content').hasClass('display-none')) {
                    $('.map-content').addClass('display-none')
                }
            }

        });

    </script>
@endsection







