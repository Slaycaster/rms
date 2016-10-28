@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
    <!-- AngularJS~ -->
    {{ Html::script('js/angular/angular.min.js', array('type' => 'text/javascript')) }}
    {{ Html::script('js/angular/app.js', array('type' => 'text/javascript')) }}
    {{ Html::script('js/angular/sale.js', array('type' => 'text/javascript')) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class = "panel panel-default">
            	<div class = "panel-heading">
            		<i class = "fa fa-money"></i> <span>Sales Register</span>
            	</div>

            	<div class ="panel panel-body">

                    <!-- AngularJS Part -->
            		<div class="row" ng-app="rms" ng-controller="SaleCtrl">
            			<div class ="col-md-3">
            				<input type="text" class="form-control" ng-model="searchKeyword" placeholder="Search for items...">
            				<hr>
            				<h3>List of Services</h3>
            				<table class="table table-hover">
            					<thead>
                                    <td>Type</td>
            						<td>Service</td>
            						<td>Price</td>
            					</thead>

                                <tr ng-repeat="service in services | filter: searchKeyword | limitTo:10">
                                    <td><% service.service_type.service_type_name %></td>
                                    <td><% service.service_name %></td>
                                    <td><% service.price %></td>
                                </tr>
            				</table>
            			</div>

            			<div class="col-md-9">
            				<div class="row">
                                <!-- Invoice and Customer -->
            					<div class="col-md-5">
                                    <!-- Invoice Form Group -->
            						<div class="form-group">
                                        <label for="invoice" class="col-sm-3 control-label">
                                            Invoice
                                        </label>
                                        <div class ="col-sm-9">
                                            <input type="text" class="form-control" name="invoice" readonly/>
                                        </div>
                                    </div>
                                    
                                    <!-- Employee Form Group -->
                                    <div class="form-group">
                                        <label for="employee" class="col-sm-3 control-label">
                                            Employee
                                        </label>
                                        <div class = "col-sm-9">
                                            <input type="text" class="form-control" name="employee" readonly />
                                        </div>
                                    </div>
            					</div> <!--/col-md-5-->
                                
                                <div class = "col-md-7">

                                    <!-- Customer Form Group -->
                                    <div class="form-group">
                                        <label for="customer_id" class="col-sm-4 control-label">
                                            Customer
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="customer" readonly/>
                                        </div>
                                    </div>

                                    <!-- Date & Time Form Group -->
                                    <div class="form-group">
                                        <label for="time_date" class="col-sm-4 control-label">
                                            Date & Time
                                        </label>
                                        <div class="col-sm-8">
                                            <?php
                                                $timestamp = time()+date("Z");
                                                echo gmdate("Y/m/d H:i:s",$timestamp);
                                            ?>
                                        </div>
                                    </div>
                                </div>
            				</div><!--/row-->
            			</div><!--/col-md-9-->
            		</div>
            	</div>
            </div>
        </div>
    </div>
@endsection