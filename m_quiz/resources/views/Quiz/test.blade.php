@extends('layout.master')

@section('title', 'Quiz TEST')

@section('css')
    <!-- Quiz css -->
    <link href="{{asset('fontend/css/quiz.css')}}" rel="stylesheet">
@endsection

@section('content')

	@if ($kt == 1)

    <?php
    $num = 0;
    $zzz = -1;
    $xxx = 0;
    ?>

    <div class="container-fluid bg-info">
        <div class = "row">
            <div class="btn btn-danger col-md-4 col-md-offset-4" style="margin-top: 20px;">
            Thời gian còn <span id="time">00: 00: 00</span> giây
            </div>
        </div>

        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['name' => 'questionForm', 'role' => 'form',
                'method' => 'post', 'action' => ['TestController@finishTest', $id]]) !!}
                @foreach ($cau_hoi as $key => $val)
                    <?php $zzz++ ?>
                <div class="modal-header">
                    <h3>
                        <span class="label label-warning" id="qid">
                            {{++$num}}
                        </span>  {{$val}}
                     </h3>
                </div>

                <div class="modal-body">

                    <div class="quiz" id="quiz" data-toggle="buttons">
                        @foreach($dap_an as $da)
                            @if($key == $da->cau_hoi_id)
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
                @endforeach

                <div class="modal-footer text-muted">
                </div>
                <div class="row">
                    <input class="btn btn-success col-md-2 col-md-offset-5" style="margin-bottom: 20px;"
                    type="submit" value="Finish">
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          Môn thi này không có câu hỏi
        </div>
        <a href="{{URL::route('test.list')}}"><button class="btn btn-info col-md-1" style="margin-top:5px;">Quay về</button></a>
    @endif

@endsection

@section('script')

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
        display = $('#time');
        startTimer(300, display);
    });
    </script>

@endsection