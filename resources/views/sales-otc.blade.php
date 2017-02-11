@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        Over-the-counter Sales<small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Over-the-counter Sales</li>
      </ol>
    </section>
    <!-- Lodash JS -->
    {{ Html::script('js/lodash/lodash.js', array('type' => 'text/javascript')) }}
    <!-- AngularJS~ -->
    {{ Html::script('js/angular/angular.min.js', array('type' => 'text/javascript')) }}
    {{ Html::script('js/angular/app.js', array('type' => 'text/javascript')) }}
    {{ Html::script('js/angular/otc-sale.js', array('type' => 'text/javascript')) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class = "panel panel-default">
            	<div class = "panel-heading">
            		<i class = "fa fa-money"></i> <span>Over-the-counter Sales Register</span>
            	</div>

            	<div class ="panel panel-body">

                    <!-- AngularJS Part -->
            		<div class="row" ng-app="rms" ng-controller="SaleCtrl">
            			<div class ="col-md-3">
                            
                            <h3>List of Over-the-counter Items</h3>
                            <input type="text" class="form-control" ng-model="searchKeyword" placeholder="Search for items...">
            				
            				<table id="otcitems" class="table table-hover table-responsive">
            					<thead>
            						<td>Item</td>
            						<td>Price</td>
                                    <td>Add</td>
            					</thead>
                                <tbody>
                                    <tr ng-repeat="otc_item in otcitemsdata | filter: searchKeyword">
                                        <td><% otc_item.otc_item_name %></td>
                                        <td>₱<% otc_item.otc_item_price %></td>
                                        <td><a href="#" class="btn btn-success btn-xs" ng-click="addServiceItem(otc_item.id)">+ add</a></td>
                                    </tr>
                                </tbody>
                                
            				</table>
            			</div>
                <form name="frmSales" novalidate="">
            			<div class="col-md-8 col-md-offset-1">
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
                                            <input type="hidden" name="user_id" id="user_id" value="<?=Auth::user()->id; ?>">
                                            <input type="hidden" name="branch_id" id="branch_id" value="<?=Auth::user()->branch->id; ?>">
                                        </div>
                                    </div>
                                </div> <!--/col-md-5-->
                                
                                <div class = "col-md-7">

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

                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                            <a href="#" onclick="window.location.reload(true);" class="btn-sm btn-block btn-warning">VOID Current Transaction</a>
                                        </div>
                                    </div>
                                </div>
            				</div><!--/row-->
                            <hr>

                            <div class="row">
                                
                                <div class="col-md-12">
                                    <!-- Customer Form Group -->
                                    <div class="form-group">
                                        <label for="customer" class="col-sm-4 control-label">
                                            Customer
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="customer" id="customer" autocomplete="off" required ng-touched />
                                            <span class="help-inline" ng-show="frmSales.customer.$invalid && !frmSales.customer.$pristine">Customer Name is required.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <!-- Customer Contact No. Form Group -->
                                    <div class="form-group">
                                        <label for="customer_contact" class="col-sm-4 control-label">
                                            Contact No.
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="customer_contact" id="customer_contact" autocomplete="off" required ng-touched/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <!-- Customer Address Form Group -->
                                    <div class="form-group">
                                        <label for="customer_address" class="col-sm-4 control-label">
                                            Address
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="customer_address" id="customer_address" autocomplete="off" required ng-touched/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <!-- Sales Table -->
                            <div class="row">
                                <div class="col-md-12">
                                    <table class ="table table-hover table-bordered">
                                        <thead>
                                            <td>Item</td>
                                            <td>Unit</td>
                                            <td>Qty</td>
                                            <td>Price</td>
                                            <td>Additional Charge</td>
                                        </thead>

                                        <tr ng-repeat = "st in saletemp">
                                            <td><% st.otc_item_name %></td>
                                            <td>
                                                <div class="input-group">
                                                    <input name="unit_of_measurement[]" type="number" class="form-control" value="1" id="unit_of_measurement[]">  
                                                    <div class ="input-group-addon"><% st.otc_unit_of_measurement %></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input name="quantity[]" type="number" class="form-control" value="1" id="quantity[]">
                                                </div>
                                            </td>
                                            <td><b>₱<% st.otc_item_price %></b></td>
                                            <td>
                                                <div class="input-group">
                                                    <div class ="input-group-addon">₱</div>
                                                    <input name="additional_charge[]" type="number" step=".01" class="form-control" value="0" id="additional_charge[]" ng-blur="additionalCharge()">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input_fields_wrap2">
                                                    <!--
                                                    <button class="add_field_button2 btn btn-sm btn-default">+ add more stylist</button>
                                                    <br>
                                                    -->
                                                    <div> 
                                                        
                                                    </div>
                                                </div>
                                            </td>
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
                                                <input type="number" step=".01" class="form-control" value="0" id="amount_tendered" ng-model="amount_tendered" autocomplete="off" required ng-touched>
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
                                            <a href="#" class="btn btn-xs btn-primary" ng-click="proceedToCheckout(false)">Compute</a>
                                    </div>

                                    <div class="form-group">
                                        <label for="change" class="col-sm-4 control-label">Change</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">₱ <%change%></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class = "form-group">
                                        <label for="stylist_id" class="col-sm-4 control-label">Stylist</label>
                                        <div class = "col-sm-8">
                                            <div class = "input-group">
                                                {{ Form::select('stylist_id', $stylists, null, ['id' => 'stylist_id', 'class' => 'form-control']) }}
                                            </div>
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
                                <!--
                                <br><br>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stylist" class="col-sm-4 control-label">Stylist/s</label>
                                        
                                    </div>
                                </div>
                                -->
                            </div><!-- /sales payment -->

                            <hr>
                            <!-- Big checkout button -->
                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-success btn-block btn-sm" href="#" ng-click="proceedToCheckout(true)" ng-disabled="frmSales.$invalid">Proceed to checkout</a>
                                </div>
                            </div><!-- /checkout -->
            			</div><!--/col-md-9-->
                </form>
            		</div>
            	</div>
            </div>
        </div>
    </div>
    @section('after_scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            var max_fields2 = 10; //maximum input boxes allowed
            var wrapper2 = $(".input_fields_wrap2"); //fields wrapper
            var add_button2 = $(".add_field_button2"); //Add button ID

            var x2 = 1; //initial text box count
            $(add_button2).click(function(e) { //on add input button click
                e.preventDefault();
                if (x2 < max_fields2) { //max input box allowed
                    x2++; //text box increment
                    $(wrapper2).append('<div>{{ Form::select("stylist_id[]", $stylists, null, ["id" => "stylists", "class" => "col-sm-8"]) }}<a href="#" class="remove_field2">Remove</a></div>'); //add input box
                }
            });

            $(wrapper2).on("click",".remove_field2", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x2--;
            })
        });
    </script>    
    @endsection
@endsection