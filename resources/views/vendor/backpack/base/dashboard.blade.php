<?php
/*------------------------------------
    Transactional Models
------------------------------------*/
use App\Transaction;
use App\Item;

use App\OTCTransaction;
use App\OTCItem;

  $timestamp = time()+date("Z");
  $today = gmdate("Y/m/d",$timestamp);

  $transactions = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->where('branch_id', '=', Auth::user()->branch->id)
            ->count();

  $sales = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
          ->where('branch_id', '=', Auth::user()->branch->id)
          ->get();

  $items = Item::where('branch_id', '=', Auth::user()->branch->id)->count();

  $items_near_out_of_stock = Item::where('branch_id', '=', Auth::user()->branch->id)->where('item_stock', '<=', 10)->count();

  $items_out_of_stock = Item::where('branch_id', '=', Auth::user()->branch->id)->where('item_stock', '=', 0)->count();  
  $total_sales = 0;

  foreach ($sales as $sale)
  {
    $total_sales += $sale->price;
  }

  $otc_transactions = OTCTransaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->where('branch_id', '=', Auth::user()->branch->id)
            ->count();

  $otc_sales = OTCTransaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
          ->where('branch_id', '=', Auth::user()->branch->id)
          ->get();

  $otc_items = OTCItem::where('branch_id', '=', Auth::user()->branch->id)->count();

  $otc_total_sales = 0;

  foreach ($otc_sales as $otc_sale)
  {
    $otc_total_sales += $otc_sale->price;
  }

  $otc_items_near_out_of_stock = OTCItem::where('branch_id', '=', Auth::user()->branch->id)->where('otc_item_stock', '<=', 10)->count();

  $otc_items_out_of_stock = OTCItem::where('branch_id', '=', Auth::user()->branch->id)->where('otc_item_stock', '=', 0)->count();  

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
    <h3>Maria & Jose - {{ Auth::user()->branch->branch_name }}</h3><hr>
    <p>Transactions and Sales for Today</p>
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
            <a href="{{ url('reports') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="{{ url('reports') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
    </div>

    <div class="row">
      <div class="col-md-4">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$otc_transactions}}</h3>
              <p>Over-the-counter <br> Transactions for the Day</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('reports/otc') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>₱ {{$otc_total_sales}}</h3>
              <p>Over-the-counter <br> Sales for the Day</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="{{ url('reports/otc') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>

    <hr>
    <p>Stock Items as for Today</p>
    <div class="row">
      <div class="col-md-4">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$items}}</h3>
              <p>Items on your branch</p>
            </div>
            <div class="icon">
              <i class="ion ion-wineglass"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $items_near_out_of_stock }}</h3>
              <p>Items near out of stock</p>
            </div>
            <div class="icon">
              <i class="ion ion-battery-low"></i>
            </div>
            <a href="{{ url('items') }}" class="small-box-footer">Go ahead and replenish your stocks! <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $items_out_of_stock }}</h3>
              <p>Items out of stock</p>
            </div>
            <div class="icon">
              <i class="ion ion-battery-empty"></i>
            </div>
            <a href="{{ url('items') }}" class="small-box-footer">Note: You won't see the item on sale if it's out of stock <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        
        
    </div>

    <div class="row">
      <div class="col-md-4">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$otc_items}}</h3>
              <p>Over-the-counter <br> Items on your branch</p>
            </div>
            <div class="icon">
              <i class="ion ion-wineglass"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $otc_items_near_out_of_stock }}</h3>
              <p>Over-the-counter <br> Items near out of stock</p>
            </div>
            <div class="icon">
              <i class="ion ion-battery-low"></i>
            </div>
            <a href="{{ url('otc_items') }}" class="small-box-footer">Go ahead and replenish your stocks! <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $otc_items_out_of_stock }}</h3>
              <p>Over-the-counter <br> Items out of stock</p>
            </div>
            <div class="icon">
              <i class="ion ion-battery-empty"></i>
            </div>
            <a href="{{ url('otc_items') }}" class="small-box-footer">Note: You won't see the item on sale if it's out of stock <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
@endsection
