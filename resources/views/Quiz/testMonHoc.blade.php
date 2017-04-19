@extends('layout.master')

@section('title', 'Quiz TEST')

@section('content')

    <div class="page-header text-center">
      <h3>Danh sách thi thử</h3>
    </div>

    @if ($check == 1)
        @foreach ($monhoc as $mh)
        <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{$mh->ten_mon_hoc}}</h3>
            </div>
            <div class="panel-body">
              <p>Tổng số câu: 3 câu</p>
              <p>Thời gian: 5 phút</p>
              <br/>
              <a href="{{URL::route('test.quiz', $mh->id)}}">
              <button class="btn btn-success">Vào làm bài &raquo;</button>
              </a>
            </div>
        </div>
        @endforeach
    @else
    <div class="alert alert-danger" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      Đã quá số lần thi thử
    </div>
    @endif

@endsection