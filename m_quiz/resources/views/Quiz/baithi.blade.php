@extends('layout.master')

@section('title', 'Quiz TEST')

@section('content')
<?php
$check = 0;
?>

    <div class="page-header text-center">
      <h3>Danh sách bài thi</h3>
    </div>

    @foreach ($baithi as $bt)
        @if ((strtotime($bt->ngay_thi) + ($bt->thoi_gian)*60) > time())
        <?php $check = 1; ?>
    <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">{{$bt->ten_bai_thi}} -
          @foreach ($mon_hoc as $mh)
              @if ($bt->mon_hoc_id == $mh->id)
                  {{$mh->ten_mon_hoc}}
              @endif
          @endforeach
          </h3>
        </div>
        <div class="panel-body">
          @if (strtotime($bt->ngay_thi) > time())
          <div id="timer{{$bt->id }}">Thời gian mở đề còn <span id="time{{$bt->id }}">00: 00: 00</span> giây</div>
          @else
          <div id="timer{{$bt->id }}">Đang thi</div>
          @endif
          <br/>
          <a href="{{URL::route('bai_thi.quiz', $bt->id)}}">
          <button class="@if (strtotime($bt->ngay_thi) < time()) btn btn-success @else btn btn-danger @endif"
          id="butt{{$bt->id }}">Vào làm bài &raquo;</button>
          </a>
        </div>
    </div>
        @endif
    @endforeach

    <?php
        if ($check == 0){
            ?>
    <div class="alert alert-danger" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      Không có bài thi
    </div>
            <?php
        }
    ?>


@endsection

@section('script')

    <script>
        $(document).ready(function(){
            setInterval(function(){
               window.location.reload(true);
            }, 5000);
        });
    </script>
    <script>
    function startTimer(duration, display, id) {
    	document.getElementById("butt" + id).disabled = true;
        var timer = duration, days, hours, minutes, seconds;
        var setTime = setInterval(function () {
            seconds = parseInt(timer % 60, 10);
           	minutes = parseInt((timer/60)%60, 10);
           	days = parseInt(((timer/60)/60)/24, 10);
           	hours = parseInt(((timer/60)/60)%24, 10);

           	seconds = seconds < 10 ? "0" + seconds : seconds;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            hours = hours < 10 ? "0" + hours : hours;

            display.text(hours + ": " + minutes +
                    ": " + seconds)
                    ;

            if (--timer < 0) {
                document.getElementById("butt" + id).className = "btn btn-success";
                document.getElementById("timer" + id).innerHTML = "Đang thi";
                document.getElementById("butt" + id).disabled = false;
                clearInterval(setTime);
            }
        }, 1000);
    }

    jQuery(function ($) {
        <?php
        foreach ($baithi as $bs){
            $date = strtotime("$bs->ngay_thi");
            $remaining = $date - time();
            if ($remaining > 0){
        ?>
        display = $('#time{{$bs->id }}');
        startTimer(<?php echo $remaining ?>, display, <?php echo $bs->id ?>);
        <?php
            }
        }
        ?>
    });
    </script>

@endsection