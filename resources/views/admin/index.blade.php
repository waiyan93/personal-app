@extends('admin.layouts.master')
@section('title', ' | Admin Dashboard')
@section('content')
@include('admin.partials.nav-bar')
@include('admin.partials.side-bar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        You are logged in as <strong>ADMIN</strong>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Level</a></li>
        <li class="active">Here</li>
    </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    @component('components.who')
    @endcomponent

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.partials.footer')
@endsection