<?php
/*------------------------------------
    Transactional Models
------------------------------------*/
use App\Transaction;

  $timestamp = time()+date("Z");
  $today = gmdate("Y/m/d",$timestamp);

  $transactions = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->count();

  $sales = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
          ->get();

  $total_sales = 0;

  foreach ($sales as $sale)
  {
    $total_sales += $sale->price;
  }

?>

@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-4">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$transactions}}</h3>
              <p>Transactions for the Day</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>₱ {{$total_sales}}</h3>
              <p>Total Sales for the Day</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <!--
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('backpack::base.login_status') }}</div>
                </div>

                <div class="box-body">{{ trans('backpack::base.logged_in') }}</div>
            </div>
        </div>
        -->
    </div>
@endsection
