@extends('backend::layouts.master')
@section('title', 'Bảng điểm bài thi')
@section('type', 'Môn học')
@section('title1')
    Bảng điểm - {{ $baithi->monhocs->ten_mon_hoc }} - {{ $baithi['ten_bai_thi'] }}
@stop
@section('content')
    <div class="page-header text-center">
      <h3>Kết quả của: {{ $hocvien_baithi->users->name }}</h3>
    </div>


    @foreach ($ket_qua as $k1 => $arr)
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center glyphicon alert alert-<?php echo ($dung_sai[$k1] == 1) ? 'info glyphicon-ok': 'danger  glyphicon-remove';?> ">
        Câu {{$k1+1}}:
        <?php $check = 1; ?>
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
        </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center btn btn-default">
        Số câu đúng: {{$hocvien_baithi['so_cau_dung']}} câu
        </div>
    </div>
@stop
