@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        Sales<small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Sales</li>
      </ol>
    </section>
    <!-- Lodash JS -->
    {{ Html::script('js/lodash/lodash.js', array('type' => 'text/javascript')) }}
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
                            <h5>Search by Category...</h5>
                            <!-- Service type -->
                            <a class="btn btn-warning btn-sm btn-block" href="#" ng-click="getServicesByType(0)">All</a>
                            <a class="btn btn-danger btn-sm btn-block" ng-repeat="servicetype in servicetypes" href="#" ng-click="getServicesByType(servicetype.id)"><% servicetype.service_type_name %></a>

                            <hr>
                            <h3>List of Services</h3>
            				<input type="text" class="form-control" ng-model="searchKeyword" placeholder="Search for items...">

            				<table class="table table-hover">
            					<thead>
                                    <td>Category</td>
            						<td>Service</td>
            						<td>Price</td>
            					</thead>

                                <tr ng-repeat="service in services | filter: searchKeyword">
                                    <td><% service.service_type.service_type_name %></td>
                                    <td><% service.service_name %></td>
                                    <td>₱<% service.price %></td>
                                    <td><a href="#" class="btn btn-success btn-xs" ng-click="addServiceItem(service.id)">+ add</a></td>
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
                                            <% transaction_id | numberFixedLen:6 %>
                                        </div>
                                    </div>
                                    <br>

                                    <!-- Employee Form Group -->
                                    <div class="form-group">
                                        <label for="employee" class="col-sm-3 control-label">
                                            Employee
                                        </label>
                                        <div class = "col-sm-9">
                                            <b>{{ Auth::user()->name }}</b>, {{ Auth::user()->branch->branch_name }}
                                            <!-- Hidden Input for AngularJS data retrieval purposes. -->
                                            <input type="hidden" name="user_id" id="user_id" value="<?=Auth::user()->id?>">
                                            <input type="hidden" name="branch_id" id="branch_id" value="<?=Auth::user()->branch->id; ?>">
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
                                            <input type="text" class="form-control" name="customer" id="customer"/>
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
                            <hr>

                            <!-- Sales Table -->
                            <div class="row">
                                <div class="col-md-12">
                                    <table class ="table table-hover table-bordered">
                                        <thead>
                                            <td>Service</td>
                                            <td>Price</td>
                                            <td>Actions</td>
                                        </thead>

                                        <tr ng-repeat = "st in saletemp">
                                            <td><% st.service_name %></td>
                                            <td><b>₱<% st.price %></b></td>
                                            <td><a href="#" class="btn btn-danger btn-xs" ng-click="removeServiceItem(st.id)">- remove</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <hr>
                            <!-- Sales Payment -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class = "form-group">
                                        <label for="amount_tendered" class="col-sm-4 control-label">Amount Tendered</label>
                                        <div class = "col-sm-8">
                                            <div class = "input-group">
                                                <div class ="input-group-addon">₱</div>
                                                <input type="text" class="form-control" value="0" id="amount_tendered" ng-model="amount_tendered" ng-change="getChange(amount_tendered)">
                                            </div>
                                        </div>
                                        <div>&nbsp;</div>
                                        <div class="form-group">
                                            <label for="comments" class="col-sm-4 control-label">Comments</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="comments" id="comments" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total" class="col-sm-4 control-label">Total</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><b>₱ <%temptotal%></b></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="change" class="col-sm-4 control-label">Change</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">₱ <%change%></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stylist" class="col-sm-4 control-label">Stylist</label>
                                        <div class="col-sm-8">
                                            {{ Form::select('stylist_id', $stylists, null, ['class' => 'form-control', 'id' => 'stylist_id']) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stylist" class="col-sm-4 control-label">Promo</label>
                                        <div class="col-sm-8">
                                            {{ Form::select('promo_id', $promos, null, ['class' => 'form-control', 'id' => 'promo_id']) }}
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /sales payment -->

                            <hr>
                            <!-- Big checkout button -->
                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-success btn-block btn-sm" href="#" ng-click="proceedToCheckout()">Proceed to checkout</a>
                                </div>
                            </div><!-- /checkout -->
            			</div><!--/col-md-9-->
            		</div>
            	</div>
            </div>
        </div>
    </div>
@endsection