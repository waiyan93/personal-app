@extends('admin.layouts.master')
@section('title', ' | Admin Dashboard')
@section('css')
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="row">
        <div class="col-md-6">
            <h4>Dashboard</h4>
        </div>
        <div class="col-md-3">
            
        </div>
        <div class="col-md-3">
         
        </div>
    </div>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Level</a></li>
        <li class="active">Here</li>
    </ol> -->
    </section>
   
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-box-icon bg-green">
                        <img src="http://openweathermap.org/img/w/{{ $weather->weather[0]->icon }}.png" alt="weather-icon">
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-number">Tempature</span>
                        <span class="info-box-text">{{ $weather->main->temp }} &#8451;</span>
                        <span class="info-box-text">Condition: {{ $weather->weather[0]->main }} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-clock-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-number">Date & Time</span>
                        <span class="info-box-text">Date: {{ $date }}</span>
                        <span class="info-box-text" id="txt"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-number">Exchange Rates</span>
                        <span class="info-box-text">USD: {{ $exchangeRates['USD'] }} Ks</span>
                        <span class="info-box-text">EURO: {{ $exchangeRates['EURO'] }} Ks</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('js')
<script>
    $(document).ready(function(){
        startTime();
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML =
            "Time: " + h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
    });
</script>
@endsection