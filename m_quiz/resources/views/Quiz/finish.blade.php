@extends('layout.master')

@section('title', 'Quiz TEST')

@section('content')

<div class="page-header text-center">
  <h3>Kết quả của bạn</h3>
</div>

    <table class="table" style="border-collapse: separate; border-spacing: 5px 25px;">
        <thead>
            <tr>
                <th class="text-center col-md-2 col-md-offset-5 alert
                alert-default" style="border: 1px solid black;">Câu hỏi</th>
                <th class="text-center col-md-2 col-md-offset-5 alert
                alert-default" style="border: 1px solid black;">Trả lời</th>
                <th class="text-center col-md-2 col-md-offset-5 alert
                alert-default" style="border: 1px solid black;">Đáp Án</th>
                <th class="text-center col-md-2 col-md-offset-5 alert
                alert-default" style="border: 1px solid black;">Đúng Sai</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($tra_loi as $k1 => $arr)
            <tr>
                <td class="text-center col-md-2 col-md-offset-5 alert
                alert-<?php echo ($dung_sai[$k1] == 1) ? 'info': 'danger';?>">{{$k1+1}}</td>
                <?php
                $check = 1;
                $check_dap_an = 1;
                ?>
                <td class="text-center col-md-2 col-md-offset-5 alert
                alert-<?php echo ($dung_sai[$k1] == 1) ? 'info': 'danger';?>">
                @foreach ($arr as $k2 => $val)
                    @if ($val == 1)
                    <?php
                    $check = 0;
                    switch ($k2){
                        case '0':
                            echo 'A';
                            break;
                        case '1':
                            echo 'B';
                            break;
                        case '2':
                            echo 'C';
                            break;
                        case '3':
                            echo 'D';
                            break;
                        case '4':
                            echo 'E';
                            break;
                        case '5':
                            echo 'F';
                            break;
                        case '6':
                            echo 'G';
                            break;
                        default:
                            echo 'G';
                            break;
                    }
                    ?>
                    @endif
                @endforeach
                @if ($check == 1)
                    Không chọn gì
                @endif
                </td>
                <td class="text-center col-md-2 col-md-offset-5 alert
                alert-<?php echo ($dung_sai[$k1] == 1) ? 'info': 'danger';?>">
                @foreach ($arr as $k3 => $val)
                    @if ($dap_an[$k1][$k3] == 1)
                    <?php
                    $check_dap_an = 0;
                    switch ($k3){
                        case '0':
                            echo 'A';
                            break;
                        case '1':
                            echo 'B';
                            break;
                        case '2':
                            echo 'C';
                            break;
                        case '3':
                            echo 'D';
                            break;
                        case '4':
                            echo 'E';
                            break;
                        case '5':
                            echo 'F';
                            break;
                        case '6':
                            echo 'G';
                            break;
                        default:
                            echo 'G';
                            break;
                    }
                    ?>
                    @endif
                @endforeach
                @if ($check_dap_an == 1)
                    Không có đáp án đúng
                @endif
                </td>
                <td class="text-center col-md-2 col-md-offset-5 alert
                alert-<?php echo ($dung_sai[$k1] == 1) ? 'info': 'danger';?>">
                <span class="glyphicon glyphicon-<?php echo ($dung_sai[$k1] == 1) ? 'ok': 'remove';?>"></span>
                    <?php echo ($dung_sai[$k1] == 1) ? 'Đúng': 'Sai';?>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

<div class="row">
    <div class="col-md-8 col-md-offset-2 text-center btn btn-default">
    Số câu đúng: {{$so_cau_dung}} câu
    </div>
</div>


<div class="row" style="margin-top:50px;">


    <a href="
    <?php

        if (Route::getCurrentRoute()->getPath() == 'bai-thi/{id}') echo URL::route('bai_thi.list');
        elseif (Route::getCurrentRoute()->getPath() == 'past/{id}') echo URL::route('past.list');
        else echo URL::route('test.list');
    ?>
    "><button class="btn btn-info col-md-1" style="margin-top:5px;">Quay về</button></a>


</div>

@endsection