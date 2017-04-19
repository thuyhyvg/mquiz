@extends('layout.master')

@section('title', 'Quiz TEST')

@section('content')

    <div class="page-header text-center">
      <h3>Thống kê điểm số của <?php echo $user ?></h3>
    </div>
    @if ($kt == 1)
    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    <br/>
    <br/>
    <br/>
    <br/>

    <div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    <br/>
    <br/>
    <br/>
    <br/>

    <div id="container3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    @else
    <div class="alert alert-danger" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      Không có bài thi
    </div>
    @endif

@endsection

@section('script')
<script src="{{asset('fontend/chart/js/highcharts.js')}}"></script>
<script src="{{asset('fontend/chart/js/modules/exporting.js')}}"></script>
<script>
$(function () {
    $('#container3').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Phần trăm câu đúng'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Tổng số câu đúng',
                y: <?php echo $tong_cau_dung ?>,
                sliced: true,
                selected: true
            }, {
                name: 'Tổng số câu sai',
                y: <?php echo $tong_cau_hoi-$tong_cau_dung ?>
            }]
        }]
    });
});
</script>
<script>
$(function () {
    $('#container2').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Số câu đúng trên số câu hỏi'
        },
        subtitle: {
            text: 'Source: Database'
        },
        xAxis: {
            categories: [<?php
                foreach ($ten_bai_thi as $k1 => $val1){
                    foreach ($cau_dung as $k2 => $val2){
                        if ($k1 == $k2) echo "'".$val1."', ";
                    }
                }
            ?>]
        },
        yAxis: {
            title: {
                text: 'Số câu hỏi'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Số câu hỏi',
            data: [<?php
                foreach ($cau_hoi as $k1 => $val1){
                    foreach ($cau_dung as $k2 => $val2){
                        if ($k1 == $k2) echo $val1.", ";
                    }
                }
            ?>]
        }, {
            name: 'Số câu đúng',
            data: [<?php
                foreach ($cau_hoi as $k1 => $val1){
                    foreach ($cau_dung as $k2 => $val2){
                        if ($k1 == $k2) echo $val2.", ";
                    }
                }
            ?>]
        }]
    });
});
</script>
<script>
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 20,
                beta: 45,
                depth: 70
            }
        },
        title: {
            text: 'Thống kê số câu đúng'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
        	categories: [<?php
                foreach ($ten_bai_thi as $k1 => $val1){
                    foreach ($cau_dung as $k2 => $val2){
                        if ($k1 == $k2) echo "'".$val1."', ";
                    }
                }
            ?>]
        },
        yAxis: {
        	title: {
                text: 'Số câu hỏi'
            }
        },
        series: [{
            name: 'Số câu đúng',
            data: [<?php
                foreach ($cau_hoi as $k1 => $val1){
                    foreach ($cau_dung as $k2 => $val2){
                        if ($k1 == $k2) echo $val2.", ";
                    }
                }
            ?>]
        }]
    });
});
</script>
@endsection