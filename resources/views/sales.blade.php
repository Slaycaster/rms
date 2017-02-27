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

            				<table class="table table-hover table-responsive">
            					<thead>
                                    <td>Category</td>
            						<td>Service</td>
            						<td>Price</td>
                                    <td>Add</td>
            					</thead>

                                <tr ng-repeat="service in services | filter: searchKeyword">
                                    <td><% service.service_type.service_type_name %></td>
                                    <td><% service.service_name %></td>
                                    <td>₱<% service.price %></td>
                                    <td><a href="#" class="btn btn-success btn-xs" ng-click="addServiceItem(service.id)">+ add</a></td>
                                </tr>
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
                                            <td>Service</td>
                                            <td>Price</td>
                                            <td>Additional Charge</td>
                                            <td>Stylist</td>
                                        </thead>

                                        <tr ng-repeat = "st in saletemp">
                                            <td><% st.service_name %></td>
                                            <td><b>₱<% st.price %></b></td>
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
                                                        {{ Form::select('stylist_id[]', $stylists, null, ['id' => 'stylist_id', 'class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                            </td>
                                            <!--
                                            <td><a href="#" class="btn btn-danger btn-xs" ng-click="removeServiceItem(st.id)">- remove</a></td>
                                            -->
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
                                                <input type="number" step=".01" class="form-control" value="0" id="amount_tendered" ng-model="amount_tendered" ng-change="getChange(amount_tendered)" autocomplete="off" required ng-touched>
                                            </div>
                                        </div>
                                        <div>&nbsp;</div>
                                        <div class="form-group">
                                            <label for="items" class="col-sm-8 control-label">Item/s Used (Item/Consumed/Stock)</label>
                                            <div class="input_fields_wrap">
                                                <button class="add_field_button btn btn-sm btn-default">+ add more item</button>
                                                <br>
                                                <br>
                                                <div> 
                                                    {{ Form::select('item_id[]', $items, null, ['id' => 'item_id', 'class' => 'col-sm-6']) }}
                                                    <input type="number" step=".01" name="item_consumed[]" id="item_consumed" class="col-sm-3" value="0">
                                                    <input type="number" name="item_unit[]" id="item_unit" class="col-sm-3" value="0">
                                                </div>
                                            </div>
                                            <!--
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="items" id="items" />
                                            </div>
                                            -->
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
                                    <center><i class="fa fa-spinner fa-spin" ng-show="isDisabled" style="font-size:24px"></i></center>
                                    <a class="btn btn-success btn-block btn-sm" href="#" ng-click="proceedToCheckout()" ng-disabled="isDisabled">Proceed to checkout</a>
                                </div>
                            </div><!-- /checkout -->

                            <!--Modal -->
                            <script type="text/ng-template" id="modal.html">
                                <div class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" ng-click="closeModal(true)" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Cannot proceed to transaction...</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p><% title %></p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" ng-click="closeModal(true)" class="btn btn-primary btn-block" data-dismiss="modal">Ok</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </script>
            			</div><!--/col-md-9-->
                </form>
            		</div>
            	</div>
            </div>
        </div>
    </div>
    @section('after_scripts')

    <!-- Lodash JS -->
    {{ Html::script('js/lodash/lodash.js', array('type' => 'text/javascript')) }}
    <!-- AngularJS~ -->
    {{ Html::script('js/angular/app.js', array('type' => 'text/javascript')) }}
    {{ Html::script('js/angular/sale.js', array('type' => 'text/javascript')) }}
    {{ Html::script('bower_components\angular-modal-service\dst\angular-modal-service.min.js', array('type' => 'text/javascript')) }}

    <script type="text/javascript">
        $(document).ready(function() {
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initial text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div>{{ Form::select("item_id[]", $items, null, ["id" => "items", "class" => "col-sm-6"]) }}<input type="number" step=".01" name="item_consumed[]" id="item_consumed" class="col-sm-3" value="0"><input type="number" name="item_unit[]" id="items" value="0" class="col-sm-3"><a href="#" class="remove_field">Remove</a></div>'); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>

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