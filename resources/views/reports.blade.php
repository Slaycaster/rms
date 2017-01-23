@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        Reports<small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Reports</li>
      </ol>
    </section>
    <!-- Lodash JS -->
    {{ Html::script('js/lodash/lodash.js', array('type' => 'text/javascript')) }}
    
@endsection

@section('content')
	<div class="row">
		<!-- ============================= SALES FOR TODAY ==================================-->
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					
				</div>

				<div class="panel-body">
					<div class="pull-right">
						<h4>
							<?php
		                        $timestamp = time()+date("Z");
		                        $today = gmdate("Y/m/d",$timestamp);
		                        echo $today;
		                    ?>
						</h4>
					</div>
					<h4><span class = "fa fa-clock-o"></span> Sales for Today</h4>
					<hr>
					<form method="get" action="{{url('reports/sales/today')}}" target="_blank">
						<input type="hidden" name="date" value="<?=$today; ?>">
						<input type="hidden" name="branch_id" value="<?= Auth::user()->branch->id; ?>">
						<button type="submit" class="btn btn-primary btn-block">View</a>
					</form>
				</div>
			</div>
		</div>
		<!-- ============================= /SALES FOR TODAY ==================================-->

		<!-- ============================= SALES BY BRANCH ==================================-->
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					
				</div>

				<div class="panel-body">
					<h4><span class = "fa fa-clock-o"></span> Sales by Branch</h4>
					<hr>
					<form method="get" action="{{url('reports/sales/branch')}}" target="_blank">
						<div class="form-group">
			                <label>Date:</label>

			                <div class="input-group date">
			                  <div class="input-group-addon">
			                    <i class="fa fa-calendar"></i>
			                  </div>
			                  <input type="text" class="form-control pull-right" data-date-format="yyyy/mm/dd" id="datepicker" name="date">
			                </div>
			                <!-- /.input group -->
			            </div>

						{{ Form::select('branch_id', $branches, null, array('class' => 'form-control'))}}
						<br>
						<button type="submit" class="btn btn-primary btn-block">View</a>
					</form>
				</div>
			</div>
		</div>
		<!-- ============================= /SALES BY BRANCH ==================================-->		

		<!-- ============================= SALES BY BRANCH ==================================-->
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					
				</div>

				<div class="panel-body">
					<h4><span class = "fa fa-clock-o"></span> Sales by Customer</h4>
					<hr>
					<form method="get" action="{{url('reports/sales/customer')}}" target="_blank">
						<div class="form-group">
			                <label>Customer Name:</label>

			                <div class="input-group date">
			                  <div class="input-group-addon">
			                    <i class="fa fa-search"></i>
			                  </div>
			                  <input type="text" class="form-control pull-right" name="customer_name">
			                </div>
			            </div>
						<br>
						<button type="submit" class="btn btn-primary btn-block">View</a>
					</form>
				</div>
			</div>
		</div>
		<!-- ============================= /SALES BY BRANCH ==================================-->		


	</div>

	
@endsection