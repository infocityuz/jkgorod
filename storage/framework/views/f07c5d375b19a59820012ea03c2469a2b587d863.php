

<?php $__env->startSection('content'); ?>
<style>
   /* rect,text {
    display: none;
   }  */
</style>
    <div class="d-flex aad">
        
   
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div style="max-width: 1420px !important;" class="index_panel_i_data">
                <h2 class="panelUprText"><?php echo e(translate('Control Panel')); ?></h2>
                <div id="CurrentDayToday"><?php echo e(translate('Date')); ?>: <?php echo e($data['date_today']); ?></div>
            </div>
            <div style="max-width: 1420px !important;" class="d-flex growLidiHome row">
                <div class="novieLidi col lidiMarginRight2">
                    <h3><?php echo e(translate('New Clients')); ?></h3>
                    <h2 class="lidi25"><?php echo e($data['new_clients']); ?></h2>
                </div>

                <div class="novieLidi col lidiMarginRight2">
                    <h3><?php echo e(translate('For a negotiation')); ?></h3>
                    <h2><?php echo e($data['in_negotiations']); ?></h2>
                </div>

                <div class="novieLidi col lidiMarginRight2">
                    <h3><?php echo e(translate('Making a deal')); ?></h3>
                    <h2><?php echo e($data['make_deal']); ?></h2>
                </div>

                <div class="zadachiLidi col lidiMarginRight2">
                    <h3><?php echo e(translate('Tasks')); ?></h3>
                    <h2><?php echo e($data['full_task']); ?></h2>
                    <hr>
                    <p><?php echo e(translate('For today')); ?> : <?php echo e($data['today']); ?><br>
                       <?php echo e(translate('For tomorrow')); ?> : <?php echo e($data['tomorrow']); ?><br>
                       <?php echo e(translate('For a week')); ?> : <?php echo e($data['week']); ?></p>
                </div>

                <div class="novieLidi col">
                    <h3><?php echo e(translate('Overdue tasks')); ?></h3>
                    <h2><?php echo e($data['overdue_tasks']); ?></h2>
                </div>
            </div>
            
            
            
            
            <div class="d-flex bigHomeIndex">
                <div class="divColumnChart">
                    <div class="chartDiv bigProdajZaMesyach lidiMarginRight2">
                        <h2><?php echo e(translate('Sales per month')); ?></h2>
                        <div>
                            <canvas id="myChart" width="400" height="150">
                                <p>Hello Fallback World</p>
                            </canvas>
                          </div>
                    </div>

                    <div class="chartDiv lidiMarginRight2" >
                        <h2 class="chart1Individual "><?php echo e(translate('Individual sales managers')); ?></h2>
                        <div>
                            

                            <canvas id="myChart_2" width="400" height="150">
                                <p>Hello Fallback World</p>
                            </canvas>
                        </div>
                    </div>
                </div>

                <div class="ovalChart">
                    <h2><?php echo e(translate('Individual sales')); ?></h2>

                    <div id="piechart" style="width: 430px; height: 400px;"></div>

                    
                    <div class="editDiv">
                        <button class="editButton2"><img src="<?php echo e(asset('/backend-assets/forthebuilders/images/icons/edit.png')); ?>" alt="Edit"></button>
                    </div>
                </div>
            </div>
            





            <div style="max-width: 1420px !important;" class="d-flex growLidiHome">
                <div class="novieLidi lidiMarginRight2">
                    <h3><?php echo e(translate('Count of house')); ?></h3>
                    <h2 class="lidi25"><?php echo e($data['house_count']); ?></h2>
                </div>

                <div class="novieLidi lidiMarginRight2">
                    <h3><?php echo e(translate('Free house')); ?></h3>
                    <h2><?php echo e($data['house_flat_status_free']); ?></h2>
                </div>

                <div class="novieLidi lidiMarginRight2">
                    <h3><?php echo e(translate('On armor')); ?></h3>
                    <h2><?php echo e($data['house_flat_status_booking']); ?></h2>
                </div>

                <div class="novieLidi lidiMarginRight2">
                    <h3><?php echo e(translate('On installments')); ?></h3>
                    <h2><?php echo e($data['installment_count']); ?></h2>
                </div>

                <div class="zadachiLidi mb-3">
                    <h3><?php echo e(translate('Successful transactions')); ?></h3>
                    <h2><?php echo e($data['house_flat_status_sold']); ?></h2>
                    <hr>
                    <p><?php echo e($data['price']); ?></p>
                    
                </div>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script>
        page_name = 'index';
// chart1

            const ctx = document.getElementById('myChart');
            var month_day = <?php echo json_encode($data['month_day']); ?>;
            var price_day_array = <?php echo json_encode($data['price_day_array']); ?>;

            new Chart(ctx, {
            type: 'line',
            data: {
                labels:month_day,
                datasets: [{
                label: '# of Votes',
                data:price_day_array,
                borderWidth: 2,
                barPercentage:0.1
                }]
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
        });






            


    // chart2

    //
            const ctx_2 = document.getElementById('myChart_2');
            var users = <?php echo json_encode($data['month_sales_price']); ?>;

            new Chart(ctx_2, {
            type: 'line',
            data: {
                labels: ['January ', 'February ', 'March ', 'April', 'May', 'june','july','August','September','October','November','December'],
                datasets: [{
                label: '# of Votes',
                data:users,
                borderWidth: 2,
                barPercentage:0.1
                }]
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
            });



    // bar chart

    //   google.charts.load('current', {'packages':['bar']});
    //   google.charts.setOnLoadCallback(drawChart);

    //   function drawChart() {
    //     var data = google.visualization.arrayToDataTable([
    //       ['', 'alijon', 'bbb', 'dd',],
    //       ['1-week', 2000, 400,11],
    //       ['2-week', 1170, 460,11],
    //       ['3-week', 660, 1120,11],
    //       ['4-week', 1030, 540,11]
    //     ]);

    //     var options = {
    //       title: 'Chess opening moves',
    //       width: 500,
    //       height: 200,
    //       legend: { position: 'none' },

    //       bars: 'vertical', // Required for Material Bar Charts.
    //       axes: {
    //         x: {
    //           0: { side: 'button'} // Top x-axis.
    //         }
    //       },
    //       bar: { groupWidth: "90%" }
    //     };

    //     var chart = new google.charts.Bar(document.getElementById('barchart_material'));
    //     chart.draw(data, options);
    //   }
    
//  chart3
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart_1);

      function drawChart_1() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['sfjsdgfgbsdg',     11],
          ['Egdfgdsfgat',      2],
          ['Cofgsdgfmmute',  2],
          ['Wafdgftch TV', 2],
          ['Slfdgeep',    7]
        ]);

        var options = {
            title: 'Chess opening moves',
          width: 400,
          height: 400,
          legend: { position: 'bottom'},

          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'button', label: 'Percentage'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

      </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/index.blade.php ENDPATH**/ ?>