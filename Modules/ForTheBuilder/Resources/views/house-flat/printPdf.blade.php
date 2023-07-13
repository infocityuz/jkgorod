<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<style type="text/css">
    * {
        /*font-family: Helvetica, sans-serif;*/
        font-family: "DejaVu Sans", sans-serif;
    }
</style>

<body>
    <div style=" border: 3px solid green;">
        <div style="margin: 2px; border: 1px solid green;">
            <table class="table" style="padding: 14px">
                <tbody>
                    <br>
                    <tr style="margin-top: 24px;">
                        <td style="height: 90px;">
                            <div style="text-align: center; width:330px; margin-top: 30px">
                                <i style="margin-top: 50px; font-size: 11px;">Дата составления прайса: </i>
                                <p style="font-size: 11px;">{{ date('d-m-Y') }}</p>
                            </div>
                        </td>
                        <td style="text-align: left; width:160px">
                            <img style="margin-left:-44px; height: 90px; box-shadow: 3px 3px 3px silver"
                                src="{{ 'uploads/word/strong.jpg' }}" alt="">
                        </td>
                        <td style="height: 90px;">
                            <div style="text-align: left; width:300px; margin-top: 30px">
                                <i style="margin-left:-44px;margin-top: 50px; font-size: 11px; opacity: 0.5">Прайс
                                    актуален до:</i>
                                <p style="font-size: 11px;">{{ date('d-m-Y', strtotime($date)) }}</p>
                            </div>
                        </td>
                    </tr>
                    <br>
                    <br>
                </tbody>
            </table>
            <table class="table" style="padding: 14px">
                <tbody>
                    <tr style="margin-top: 34px; width: 900px">
                        <td style="font-size: 11px;">
                            <div style="margin-right: 44px; width:330px">
                                <div style="height:12px">
                                    <b>Блок</b>
                                    <b><a style="margin-left: 164px; text-decoration: none"
                                            href="{{ route('forthebuilder.house.show', $model->house_id) }}">{{ $model->house->house_number ?? '' }}</a></b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px">
                                    <b>Этаж</b>
                                    <b style="margin-left: 250px;">{{ $model->floor }}</b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px">
                                    <b>Площадь квартиры</b>
                                    <b style="margin-left: 120px;">{{ $model->total_area }} </b> m<sup>2</sup>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px">
                                    <b>Количество комнат</b>
                                    <b style="margin-left: 130px;">{{ $model->room_count }}</b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <br>
                                @php
                                    $terrace_price = 0;
                                    $mansard_price = 0;
                                    $basement_price = 0;
                                    
                                    $terrace_price_30 = 0;
                                    $mansard_price_30 = 0;
                                    $basement_price_30 = 0;
                                    
                                    $terrace_price_50 = 0;
                                    $mansard_price_50 = 0;
                                    $basement_price_50 = 0;
                                    if (isset($model->terrace_area)) {
                                        $terrace_price = $model->terrace_area * $model->price;
                                        if (isset($model->price_pay_30)) {
                                            $terrace_price_30 = $model->terrace_area * $model->price_pay_30;
                                        }
                                        if (isset($model->price_pay_50)) {
                                            $terrace_price_50 = $model->terrace_area * $model->price_pay_50;
                                        }
                                    }
                                    $basement_price = $model->basement_area * $model->basement_price;
                                    if (isset($model->basement_price_pay_30)) {
                                        $basement_price_30 = $model->basement_area * $model->basement_price_pay_30;
                                    }
                                    if (isset($model->basement_price_pay_50)) {
                                        $basement_price_50 = $model->basement_area * $model->basement_price_pay_50;
                                    }
                                    if (isset($model->mansard_area) ?? isset($model->mansard)) {
                                        $mansard_price = $model->mansard_area * $model->mansard;
                                    }
                                    if (isset($model->basement_area) ?? isset($model->basement)) {
                                        $basement_price = $model->basement_area * $model->basement;
                                    }
                                @endphp
                                <b>Базовая цена квартиры </b>
                                @if ($currency)
                                    <b style="margin-left: 30px">
                                        @php
                                            $price = ($model->price * $model->total_area + $terrace_price + $mansard_price + $basement_price) * ($currency['SUM'] / $currency['USD']);
                                        @endphp
                                        {{ number_format($price - ($price / 100) * $coupon_percent, 0, ',', ' ') }}
                                    </b>
                                    {{ __('locale.sum_') }}
                                @else
                                    <b
                                        style="margin-left: 70px">{{ number_format($model->price * $model->total_area + $terrace_price + $mansard_price + $basement_price, 2) }}</b>
                                    $
                                @endif
                            </div>
                            <br>
                            <div style="height:12px"><b>Базовая стоимость квартиры</b></div>
                        </td>
                        <td style="font-size: 11px; width: 150px">
                            <div style="margin-top: 40px; width: 150px;">
                                <img style="height: 94px; margin-left: 14px" src="{{ 'uploads/word/plans.jpg' }}"
                                    alt="">
                                <div style="width: 150px; text-align: center"><b>Большой выбор планировок</b></div>
                            </div>
                        </td>
                        <td style="font-size: 11px; width: 150px;">
                            <div style="margin-top: 30px; width: 150px;">
                                <img style="height: 94px; margin-left: 14px" src="{{ 'uploads/word/video.jpg' }}"
                                    alt="">
                                <div style="width: 150px; text-align: center"><b>Круглосуточная охрана и
                                        видеонаблюдение</b></div>
                            </div>
                        </td>
                    </tr>
                    <tr style="width: 900px;">
                        <td style="font-size: 11px;">
                            <div style="margin-top: 64px; margin-right: 44px; width:330px">
                                <div style="height:12px; text-align: center">
                                    <b>100% Оплата &nbsp;&nbsp;&nbsp;
                                        @if ($coupon_percent > 0)
                                            ( cкидка ({{ $coupon_percent }}%))
                                        @endif
                                    </b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px; margin: -7px 0px 15px 0px">
                                    <b>Цена за 1 м2 </b>
                                    @if (!$currency)
                                        <b style="margin-left: 90px">
                                            <{{ number_format($model->price, 2) }}< /b> $
                                            @else
                                                <b
                                                    style="margin-left: 60px">{{ number_format($model->price * ($currency['SUM'] / $currency['USD']), 0, ',', ' ') }}</b>
                                                {{ __('locale.sum_') }}
                                    @endif
                                </div>
                                <div style="height:12px">
                                    <b>Общая стоимость </b>
                                    @if (!$currency)
                                        <b style="margin-left: 100px">
                                            @php
                                                $price2 = $model->price * $model->total_area + $terrace_price + $mansard_price + $basement_price;
                                            @endphp
                                            {{ number_format($price2 - ($price2 / 100) * $coupon_percent, 2) }}
                                        </b>
                                        $
                                    @else
                                        <b style="margin-left: 80px">
                                            @php
                                                $price3 = ($model->price * $model->total_area + $terrace_price + $mansard_price + $basement_price) * ($currency['SUM'] / $currency['USD']);
                                            @endphp
                                            {{ number_format($price3 - ($price3 / 100) * $coupon_percent, 0, ',', ' ') }}
                                        </b>
                                        {{ __('locale.sum_') }}
                                    @endif

                                    </b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 11px; width: 150px">
                            <div style="width: 150px; margin-top: 50px;">
                                <img style="height: 94px; margin: -24px 0px 14px -30px"
                                    src="{{ 'uploads/word/green_zone.jpg' }}" alt="">
                                <div style="width: 150px"><b>Зеленая зона</b></div>
                            </div>
                        </td>
                        <td style="font-size: 11px; width: 150px;">
                            <div style="width: 150px; margin-top: 50px;">
                                <img style="height: 94px; margin: -24px 0px 14px 14px"
                                    src="{{ 'uploads/word/comfort.jpg' }}" alt="">
                                <div style="width: 150px"><b>Удобная локация</b></div>
                            </div>
                        </td>
                    </tr>
                    <br>
                    <tr style="width: 900px">
                        <td style="font-size: 11px; margin-bottom: 44px">
                            <div style="text-align: center; width:330px; margin-bottom: 10px">
                                <div><b>Условия по рассрочке </b></div>
                            </div>
                            <div style="width:330px">
                                <div style="height:12px">
                                    <b>Первоначальный взнос 30%</b>
                                    @if (!$currency)
                                        <b
                                            style="margin-left: 14px">{{ number_format(($model->price_pay_30 * $model->total_area + $terrace_price_30 + $mansard_price + $basement_price_30) * 0.3, 2) }}</b>
                                        $
                                    @else
                                        <b style="margin-left: 4px">{{ number_format(($model->price_pay_30 * $model->total_area + $terrace_price_30 + $mansard_price + $basement_price_30) * 0.3 * ($currency['SUM'] / $currency['USD']), 0, ',', ' ') }}
                                        </b> {{ __('locale.sum_') }}
                                    @endif
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px">
                                    <b>Цена за 1 м<sup>2</sup></b>
                                    @if (!$currency)
                                        <b style="margin-left: 120px">{{ number_format($model->price_pay_30, 2) }}</b>
                                        $
                                    @else
                                        <b
                                            style="margin-left: 90px">{{ number_format($model->price_pay_30 * ($currency['SUM'] / $currency['USD']), 0, ',', ' ') }}</b>
                                        {{ __('locale.sum_') }}
                                    @endif
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px">
                                    <b>Общая стоимость</b>
                                    @if (!$currency)
                                        <b
                                            style="margin-left: 60px">{{ number_format($model->price_pay_30 * $model->total_area + $terrace_price_30 + $mansard_price + $basement_price_30), 2 }}</b>
                                        $
                                    @else
                                        <b
                                            style="margin-left: 40px">{{ number_format(($model->price_pay_30 * $model->total_area + $terrace_price_30 + $mansard_price + $basement_price_30) * ($currency['SUM'] / $currency['USD']), 0, ',', ' ') }}</b>
                                        {{ __('locale.sum_') }}
                                    @endif
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                            </div>
                            <div style="width:330px; margin-top: 24px">
                                <div style="height:12px">
                                    <b>Первоначальный взнос 50% </b>
                                    @if (!$currency)
                                        <b
                                            style="margin-left: 14px">{{ number_format(($model->price_pay_50 * $model->total_area + $terrace_price_50 + $mansard_price + $basement_price_50) * 0.5, 2) }}</b>
                                        $
                                    @else
                                        <b
                                            style="margin-left: 4px">{{ number_format(($model->price_pay_50 * $model->total_area + $terrace_price_50 + $mansard_price + $basement_price_50) * 0.5 * ($currency['SUM'] / $currency['USD']), 0, ',', ' ') }}</b>
                                        {{ __('locale.sum_') }}
                                    @endif
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px">
                                    <b>Цена за 1 м<sup>2</sup></b>
                                    @if (!$currency)
                                        <b style="margin-left: 120px">{{ number_format($model->price_pay_50, 2) }}</b>
                                        $
                                    @else
                                        <b
                                            style="margin-left: 90px">{{ number_format($model->price_pay_50 * ($currency['SUM'] / $currency['USD']), 0, ',', ' ') }}</b>
                                        {{ __('locale.sum_') }}
                                    @endif
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px">
                                    <b>Общая стоимость</b>
                                    @if (!$currency)
                                        <b
                                            style="margin-left: 90px">{{ number_format($model->price_pay_50 * $model->total_area + $terrace_price_50 + $mansard_price + $basement_price_50, 2) }}</b>
                                        $
                                    @else
                                        <b
                                            style="margin-left: 70px">{{ number_format(($model->price_pay_50 * $model->total_area + $terrace_price_50 + $mansard_price + $basement_price_50) * ($currency['SUM'] / $currency['USD']), 0, ',', ' ') }}</b>
                                        {{ __('locale.sum_') }}
                                    @endif
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 11px; width: 150px">
                            <div style="margin-top: 40px; width: 150px;">
                                <img style="height: 94px; margin-left: 14px" src="{{ 'uploads/word/lift.jpg' }}"
                                    alt="">
                                <div style="width: 150px; text-align: center; margin-top: 40px"><b>Финские автономные
                                        лифты</b></div>
                            </div>
                        </td>
                        <td style="font-size: 11px; width: 150px">
                            <div style="margin-top: 40px; width: 150px;">
                                <img style="height: 94px; margin-left: 14px;" src="{{ 'uploads/word/menedjer.jpg' }}"
                                    alt="">
                                <div style="width: 150px; text-align: center; margin-top: 40px">
                                    <b>Надежный ЖК</b>
                                </div>
                            </div>
                        </td>
                        {{-- <td style="font-size: 11px; width: 150px;">
                            <div style="margin-top: 40px; width: 150px;">
                                <img style="height: 94px; margin-left: 14px" src="{{ 'uploads/word/terrace.jpg' }}"
                                    alt="">
                                <div style="width: 150px; text-align: center; margin-top: 40px"><b>Уютные террасы</b>
                                </div>
                            </div>
                        </td> --}}
                    </tr>

                </tbody>
            </table>
            <table class="table">
                <tbody>
                    <tr>
                        <td style="font-size: 11px;">
                            <div style="margin:24px 0px 24px 14px"><b>Актуальный курс валют:
                                    &nbsp;&nbsp;{{ $currency['SUM'] / $currency['USD'] }}</b> {{ __('locale.sum_') }}
                            </div>
                            <div style="margin-left: 14px; width: 200px">
                                <h2><b>Менеджер:</b></h2>
                            </div>
                            <div style="margin-left: 14px; width: 200px">
                                <h2><b>+998 97 3359999</b></h2>
                            </div>
                            <div style="margin-left: 14px; width: 200px">
                                <h2><b>+998 98 3359999</b></h2>
                            </div>
                        </td>
                        {{-- <td style="width:340px; font-size: 11px;">
                            <div style="margin-top: -24px">
                                <div style="text-align: center">
                                    <img style="height: 80px" src="{{ 'uploads/word/menedjer.jpg' }}"
                                        alt="">
                                </div>
                                <div style="text-align: center; margin-top: 14px"><b>Надежная управляющая компания,
                                        обеспечивающая порядок в ЖК</b></div>
                            </div>
                        </td> --}}
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
