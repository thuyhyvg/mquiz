@extends('layout.master')

@section('title', 'Quiz TEST')

@section('css')
    <!-- Quiz css -->
    <link href="{{asset('fontend/css/quiz.css')}}" rel="stylesheet">
@endsection

@section('content')

<?php
session_start();
$num = 0;
$zzz = -1;
$xxx = 0;
?>

    <div class="container-fluid bg-info">
        <div class = "row">
            <div class="btn btn-danger col-md-4 col-md-offset-4" style="margin-top: 20px;">Thời gian còn <span id="time">00: 00: 00</span> giây</div>
        </div>

        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['name' => 'questionForm', 'role' => 'form',
                'method' => 'post', 'action' => ['BaiThiController@finish', $id]]) !!}
                @foreach ($bai_thi as $bt)
                    @foreach($cau_hoi as $key => $val)
                        @if ($bt->cau_hoi_id == $key)
                        <?php $zzz++ ?>
                <div class="modal-header">
                    <h3>
                        <span class="label label-warning" id="qid">
                            {{++$num}}
                        </span>  {{$val}}
                     </h3>
                </div>
                        @endif
                    @endforeach

                <div class="modal-body">

                    <div class="quiz" id="quiz" data-toggle="buttons">
                        @foreach($dap_an as $da)
                            @if ($bt->cau_hoi_id == $da->cau_hoi_id)
                        <label class="element-animation1 btn btn-lg btn-primary btn-block">
                            <span class="btn-label">
                            <i class="glyphicon glyphicon-chevron-right"></i>
                            </span>

                            <input type="checkbox" name="{{$zzz}}[]" value="{{$xxx++}}">
                             {{$da->noi_dung_dap_an}}

                        </label>
                            @endif
                        @endforeach
                        <?php $xxx = 0; ?>
                    </div>
                </div>

                <div class="modal-footer text-muted">
                </div>
                @endforeach
                <div class="row">
                    <input class="btn btn-success col-md-2 col-md-offset-5" style="margin-bottom: 20px;"
                    type="submit" value="Finish">
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script>
        $(document).ready(function(){
            if ($('input#key1').is(':checked')) {
            	$('input#key1').attr('id')
                <?php session(['key1' => 'xxx']); ?>
            }
        });
    </script>

    <script>
    function startTimer(duration, display) {
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
                document.questionForm.submit();
            }
        }, 1000);
    }

    jQuery(function ($) {
        <?php

            if ($thoi_gian > 0){
        ?>
        display = $('#time');
        startTimer(<?php echo $thoi_gian ?>, display);
        <?php
            }
        ?>
    });
    </script>

@endsection