@extends('layout.master')

@section('title', 'Quiz TEST')

@section('content')
<?php
$check = 0;
?>

    <div class="page-header text-center">
      <h3>Danh sách bài thi</h3>
    </div>

    @foreach ($bai_thi as $bt)
    @foreach ($bai_thi_da_thi as $btdt)
    @if ($bt->id == $btdt->bai_thi_id)
    <?php $check = 1; ?>
    <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">{{$bt->ten_bai_thi}}</h3>
        </div>
        <div class="panel-body">
            @foreach ($mon_hoc as $mh)
            @if ($mh->id == $bt->mon_hoc_id)
            <p>Môn học: {{$mh->ten_mon_hoc}}</p>
            @endif
            @endforeach
          <p>Ngày thi: {{$bt->ngay_thi}}</p>
          <p>Thời gian: {{$bt->thoi_gian}} phút</p>
          <a href="{{URL::route('past.detail', $bt->id)}}">
          <button class="btn btn-danger">Xem kết quả &raquo;</button>
          </a>
        </div>
    </div>
    @endif
    @endforeach
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