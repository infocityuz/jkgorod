<style type="text/css">
    * {
        /*font-family: Helvetica, sans-serif;*/
        font-family: "DejaVu Sans", sans-serif;
        
    }
</style>


<div id="DivIdToPrint">
    <div style="height: 100%; border: 3px solid green;">
        <div style="height: 99.4%; margin: 2px; border: 1px solid green; ">
            <table class="table" style="padding: 14px" >
                <tbody>
                    <tr style="margin-top: 24px;">
                        <td style="height: 90px;">
                            <div style="width:330px;">
                                <i style="margin-top: 50px; font-size: 14px;">Дата составления : </i>
                                <p style="font-size: 14px;"><?php echo e(date('d-m-Y')); ?></p>
                            </div>
                        </td>
                        <td style="text-align: left;">
                            <div style="padding-top: 40px">
                                <img style="margin-left:-44px; height: 90px; box-shadow: 3px 3px 3px silver"
                                src="<?php echo e('/uploads/word/home.jpg'); ?>" alt="">
                            </div>
                            
                        </td>
                        <td style="height: 90px;">
                            <div style="text-align: right; width:300px; ">
                                <i style="margin-left:-44px;margin-top: 50px; font-size: 14px; opacity: 0.5">Прайс
                                    актуален до:</i>
                                <p style="font-size: 14px;">
                                      
                                    <?php echo e($date); ?>

                                </p>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
            <table class="table" style="padding: 14px">
                <tbody>
                    <tr style="margin-top: 34px; width: 900px">
                        <td style="font-size: 14px;">
                            <div style="margin-right: 44px; width:330px">
                                <div style="height:12px">
                                    <b >Блок</b>
                                    <b><a style="margin-left: 164px; color:#0F120F;"
                                            href="<?php echo e(route('forthebuilder.house.show', $model->house_id)); ?>"><b>Блок</b> <?php echo e($house->corpus ?? ''); ?></a></b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px; margin-top:10px;" >
                                    <b>Этаж</b>
                                    <b style="margin-left: 250px;"><?php echo e($model->floor); ?></b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                
                                <?php
                                    $areas=json_decode($model->areas);
                                    $ares_prices=json_decode($model->ares_price);
                                    
                                    $price_100 = $ares_prices->hundred->total ?? 0 ;
                                    $price_50 = $ares_prices->fifty->total ?? 0;
                                    $price_30 = $ares_prices->thirty->total ?? 0;
                                    $price_70 = $ares_prices->seventy->total ?? 0;

                                    // dd(number_format($areas->total));
                                    $full_price_100=($areas->total)*($price_100); //382 536 000
                                    $full_price_50=($areas->total)*($price_50); // 418 968 000
                                    $full_price_30=($areas->total)*($price_30); // 455 400 000    
                                    $full_price_70=($areas->total)*($price_70); // 455 400 000    
                                    $sale_100=(($areas->total)*($price_30))-(($areas->total)*($price_100)); // 72864000
                                    $sale_50=(($areas->total)*($price_30))-(($areas->total)*($price_50));  // 36432000
                                    $sale_70=(($areas->total)*($price_70))-(($areas->total)*($price_70));  // 36432000
                                    

                                    if ($price_30 == 0 || $price_50 == 0 || $price_70 == 0) {
                                        $sele_100=0;
                                        $sale_50=0;
                                        $sale_70=0;
                                        $price_50=0;
                                        $price_30=0;
                                        $price_70=0;
                                        $full_price_50=0;
                                        $full_price_30=0;
                                        $full_price_70=0;
                                    }
                                    
                                    // dd($areas);
                                ?>
                                <div style="height:12px; margin-top:10px;">
                                    <b>Площадь квартиры</b>
                                    <b style="margin-left: 120px;"><?php echo e($areas->total); ?> </b> m<sup>2</sup>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px; margin-top:10px;" >
                                    <b>Количество комнат</b>
                                    <b style="margin-left: 130px;"><?php echo e($model->room_count); ?></b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <br>
                                <?php
                                    
                                    // dd($sale_50);
                                ?>
                            </div>
                            <br>
                            
                        </td>
                        <td style="font-size: 14px; width: 150px">
                            <div style="margin-top: 40px; width: 150px;">
                                <img style="height: 94px; margin-left: 14px" src="<?php echo e('/uploads/word/plans.jpg'); ?>"
                                    alt="">
                                <div style="width: 150px; text-align: center"><b>Большой выбор планировок</b></div>
                            </div>
                        </td>
                        <td style="font-size: 14px; width: 150px;">
                            <div style="margin-top: 30px; width: 150px;">
                                <img style="height: 94px; margin-left: 14px" src="<?php echo e('/uploads/word/video.jpg'); ?>"
                                    alt="">
                                <div style="width: 150px; text-align: center"><b>Круглосуточная охрана и
                                        видеонаблюдение</b></div>
                            </div>
                        </td>
                    </tr>
                    <tr style="width: 900px;">
                        <td style="font-size: 14px;">
                            <div style="margin-top: 64px; margin-right: 44px; width:330px">
                                <div style="height:12px; text-align: center; margin: -7px 0px 15px 0px;">
                                    <b>100% Оплата </b> <b style="padding-left: 20px; color:green">(cкидка 16%)</b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px; margin: -7px 0px 15px 0px">
                                    <b>Цена за 1 м2 </b> <b style="padding-left: 30px;">  <?php echo e(number_format($price_100)); ?> сум  </b>
                                                    

                                </div>
                                <div style="height:12px">
                                    <b>Общая стоимость </b>
                                    <b><?php echo e(number_format($full_price_100)); ?></b><br>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px ; margin-top:10px">
                                    <b style="color:green">Сумма скидки</b>
                                    <b><?php echo e(number_format($sale_100)); ?></b><br>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 14px; width: 150px">
                            <div style="width: 150px; margin-top: 50px;">
                                <img style="height: 94px; margin: -24px 0px 14px -30px"
                                    src="<?php echo e('/uploads/word/green_zone.jpg'); ?>" alt="">
                                <div style="width: 150px"><b>Зеленая зона</b></div>
                            </div>
                        </td>
                        <td style="font-size: 14px; width: 150px;">
                            <div style="width: 150px; margin-top: 50px;">
                                <img style="height: 94px; margin: -24px 0px 14px 14px"
                                    src="<?php echo e('/uploads/word/comfort.jpg'); ?>" alt="">
                                <div style="width: 150px"><b>Удобная локация</b></div>
                            </div>
                        </td>
                    </tr>
                    <br>
                    <tr style="width: 900px ">
                        <td style="font-size: 14px; margin-bottom: 44px;">
                            <div style="text-align: center; width:330px; margin-bottom: 10px">
                                <div><b>Условия по рассрочке </b><b style="padding-left: 20px; color:green">(cкидка 8%)</b></div>
                            </div>
                            <div style="width:330px; ">
                                <div style="height:12px">
                                    <b>Первоначальный взнос 50%</b>

                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px; margin-top:10px">
                                    <b>Цена за 1 м<sup>2</sup></b> <b style="padding-left: 30px;">  <?php echo e(number_format($price_50)); ?> сум  </b>

                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px; margin-top:10px">
                                    <b>Общая стоимость</b>
                                    <b><?php echo e(number_format($full_price_50)); ?></b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px;  margin-top:10px">
                                    <?php if($price_30 != 0 || $price_50 != 0): ?>
                                        
                                        <b style="color:green">Сумма скидки</b>
                                        <b><?php echo e(number_format($sale_50)); ?></b><br>
                                    <?php endif; ?>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                            </div>

                            <div style="width:330px; margin-top: 24px">
                                <div style="height:12px ; margin-top:10px">
                                    <b>Первоначальный взнос 70% </b>

                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px ; margin-top:10px">
                                    <b>Цена за 1 м<sup>2</sup></b> <b style="padding-left: 30px;">  <?php echo e(number_format($price_70)); ?> сум  </b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px ; margin-top:10px">
                                    <b>Общая стоимость</b>
                                    <b><?php echo e(number_format($full_price_70)); ?></b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                            </div>

                            <div style="width:330px; margin-top: 24px">
                                <div style="height:12px ; margin-top:10px">
                                    <b>Первоначальный взнос 30% </b>

                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px ; margin-top:10px">
                                    <b>Цена за 1 м<sup>2</sup></b> <b style="padding-left: 30px;">  <?php echo e(number_format($price_30)); ?> сум  </b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                                <div style="height:12px ; margin-top:10px">
                                    <b>Общая стоимость</b>
                                    <b><?php echo e(number_format($full_price_30)); ?></b>
                                    <hr style="color: #0F120F; margin-top:1px">
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 14px; width: 150px">
                            <div style="margin-top: 40px; width: 150px;">
                                <img style="height: 94px; margin-left: 14px" src="<?php echo e('/uploads/word/lift.jpg'); ?>"
                                    alt="">
                                <div style="width: 150px; text-align: center; margin-top: 40px"><b>Финские автономные
                                        лифты</b></div>
                            </div>
                        </td>
                        <td style="font-size: 14px; width: 150px">
                            <div style="margin-top: 40px; width: 150px;">
                                <img style="height: 94px; margin-left: 14px;"
                                    src="<?php echo e('/uploads/word/menedjer.jpg'); ?>" alt="">
                                <div style="width: 150px; text-align: center; margin-top: 40px">
                                    <b>Надежный ЖК</b>
                                </div>
                            </div>
                        </td>
                        
                    </tr>

                </tbody>
            </table>
            <table class="table">
                <tbody>
                    <tr>
                        <td style="font-size: 14px;">
                            
                            <div style="margin:24px 0px 24px 14px">
                                <b>Менеджер:</b>
                                <b style="padding-left: 30px">
                                    <?php echo e($user_name); ?>   
                                </b>
                            </div>
                            <div style="margin:24px 0px 24px 14px">
                                <b>+998 78 7776666</b>
                            </div>
                            <div style="margin:24px 0px 24px 14px">
                                <b>+998 98 3359999</b>
                            </div>
                            <div style="margin:24px 0px 24px 14px">
                                <b>+998 97 3359999</b>
                            </div>
                        </td>
                        <td style="font-size: 14px; width: 150px; padding-left:280px;">
                            <div style=" width: 150px;">
                                <img style="height: 94px; margin-left: 25px;"
                                    src="<?php echo e('/uploads/word/parkovka.jpg'); ?>" alt="">
                                <div style="width: 150px; text-align: center; margin-top:20px; ">
                                    <b>Подземная парковка</b>
                                </div>
                            </div>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($guid): ?>
        <div style="">

            <img style="width:100%; height: 600px"  class="homeSozdatImage1272" src="<?php echo e(asset('/uploads/house-flat/' . $house->id . '/l_' . $guid)); ?>" alt="Home">

        </div>
    <?php endif; ?>
    <input type="hidden" id="showId" value="<?php echo e($model->id); ?>">
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('/backend-assets/forthebuilders/javascript/jquery-3.6.1.js')); ?>"></script>

<script>
    $(document).ready(function() {
        var divToPrint = document.getElementById('DivIdToPrint');
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML +
            '</body></html>');
        newWin.document.close();
        newWin.onafterprint = window.close;

        setTimeout(function() {
            var showId = $('#showId').val();
            location.href = "/forthebuilder/house-flat/show/" + showId;
        }, 10);
        // setTimeout(function() {
        //     newWin.close();
        // }, 50);
    })

    // $(document).ready(function() {
    //     window.print();
    // })
</script>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/house-flat/print.blade.php ENDPATH**/ ?>