@extends('forthebuilder::layouts.forthebuilder')

@section('content')
<style>
   /* rect,text {
    display: none;
   }  */
</style>
    <div class="d-flex aad">
        
   {{-- @dd($data['date_today']) --}}
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')

            <div>
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="panelUprText">{{translate('Control Panel')}}</h2>        
                    </div>
                    <div class="col-md-6">
                        <div class="ml-auto" id="CurrentDayToday">
                            {{translate('Date')}}: 
                            <input type="text" class="ml-2 form-control daterange2" value="{{ date('d.m.Y', strtotime($data['start'])).' - '.date('d.m.Y', strtotime($data['end'])) }}">
                        </div>        
                    </div>
                </div>
                
                
            </div>
            <br>
            <div style="max-width: 1420px !important;" class="d-flex growLidiHome row">
                <div class="novieLidi col lidiMarginRight2">
                    <h3>{{translate('New Clients')}}</h3>
                    <h2 class="lidi25">{{$data['new_clients']}}</h2>
                </div>

                <div class="novieLidi col lidiMarginRight2">
                    <h3>{{translate('For a negotiation')}}</h3>
                    <h2>{{$data['in_negotiations']}}</h2>
                </div>

                <div class="novieLidi col lidiMarginRight2">
                    <h3>{{translate('Making a deal')}}</h3>
                    <h2>{{$data['make_deal']}}</h2>
                </div>

                <div class="zadachiLidi col lidiMarginRight2">
                    <h3>{{translate('Tasks')}}</h3>
                    <h2>{{$data['full_task']}}</h2>
                    <hr>
                    <p>{{translate('For today')}} : {{$data['today']}}<br>
                       {{translate('For tomorrow')}} : {{$data['tomorrow']}}<br>
                       {{translate('For a week')}} : {{$data['week']}}</p>
                </div>

                <div class="novieLidi col">
                    <h3>{{translate('Overdue tasks')}}</h3>
                    <h2>{{$data['overdue_tasks']}}</h2>
                </div>
            </div>
            
            
            
            
            <div class="d-flex bigHomeIndex">
                <div class="divColumnChart">
                    <div class="chartDiv bigProdajZaMesyach lidiMarginRight2">
                        <h2>{{translate('Sales per month')}}</h2>
                        <div>
                            <canvas id="myChart" width="400" height="150">
                                <p>Hello Fallback World</p>
                            </canvas>
                          </div>
                    </div>

                    <div class="chartDiv lidiMarginRight2" >
                        <h2 class="chart1Individual ">{{translate('Individual sales managers')}}</h2>
                        <div>
                            {{-- <div class="mt-4" id="barchart_material" style="width: 550px; height: 240px;"></div> --}}

                            <canvas id="myChart_2" width="400" height="150">
                                <p>Hello Fallback World</p>
                            </canvas>
                        </div>
                    </div>
                </div>

                <div class="ovalChart">
                    <h2>{{translate('Individual sales')}}</h2>

                    <div id="piechart" style="width: 430px; height: 400px;"></div>

                    {{-- <div style="width: 284px; margin-top: 60px;" class="d-flex ovalNameRadius">
                        <p class="ovalChartName">{{translate('Managers Manager')}}</p>
                        <div class="ovalChartRadiusRed"></div>
                    </div> --}}
                    {{-- <div class="editDiv">
                        <button class="editButton2"><img src="{{asset('/backend-assets/forthebuilders/images/icons/edit.png')}}" alt="Edit"></button>
                    </div> --}}
                </div>
            </div>
            





            <div style="max-width: 1420px !important;" class="d-flex growLidiHome">
                <div class="novieLidi col lidiMarginRight2">
                    <h3>{{translate('Count of house')}}</h3>
                    <h2 class="lidi25">{{$data['house_count']}}</h2>
                </div>

                <div class="novieLidi col lidiMarginRight2">
                    <h3>{{translate('Free house')}}</h3>
                    <h2>{{$data['house_flat_status_free']}}</h2>
                </div>

                <div class="novieLidi col lidiMarginRight2">
                    <h3>{{translate('On armor')}}</h3>
                    <h2>{{$data['house_flat_status_booking']}}</h2>
                </div>

                <div class="novieLidi col lidiMarginRight2">
                    <h3>{{translate('On installments')}}</h3>
                    <h2>{{$data['installment_count']}}</h2>
                </div>

                <div class="zadachiLidi col mb-3">
                    <h3>{{translate('Successful transactions')}}</h3>
                    <h2>{{$data['house_flat_status_sold']}}</h2>
                    <hr>
                    <p>{{ number_format($data['price'],0,'.',' ')}}</p>
                    {{-- <input id="input" type="text" value="{{$data['month_sales_price']}}"> --}}
                </div>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
        let page_name = 'index';
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
          <?php echo $data['core_chart']; ?>
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

      $(document).ready(function(){
        $('.daterange2').daterangepicker({
            // autoApply: true,
            locale: {
              format: 'DD.MM.YYYY'
            }
        });

      })

      $(document).on('click','.applyBtn',function(){
        var date = $('.daterange2').val()

        location.href = `/forthebuilder/filtr/${date}`;
        // $.ajax({
        //     url: `/forthebuilder/filtr-date/${date}`,
        //     type: 'GET',
        //     success: function(data) {
                
        //     }
        // });
      })

      </script>
@endsection
