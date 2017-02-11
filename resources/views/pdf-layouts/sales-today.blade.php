<?php

/*------------------------------------
		Transactional Models
------------------------------------*/
use App\Transaction;

	$timestamp = time()+date("Z");
	$today = gmdate("Y/m/d",$timestamp);
	$branch_id = Session::get('branch_id', 1);
	$transactions = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
						->where('branch_id', '=', $branch_id) 
						->with('branch')
						->with('sales')
						->with('user')
						->with('promo')
						->with('sales.service')
						->with('sales.used_stylists')
						->with('used_items')
						->with('used_items.item')
						->get();

	$total_transaction = 0;
	$total_price = 0;
?>

<!DOCTYPE html5>
<html>
	<head>
		<title>Sales Report - {{$today}} | Maria Jose Salon</title>

		<style type="text/css">
		    table
		    {
		    	font-size: 10;
		    	border-collapse: collapse;
		    	page-break-inside: auto;
		    }
		    tr
		    { 
		    	page-break-inside: avoid;
		    	page-break-after: auto; 
		    }
		    .topalign
		    {
		    	vertical-align: top;
		    }
		    p, strong, h3
		    {
		    	font-family: helvetica;
		    }
		    img 
		    {
		    	position: absolute;
		    	left: 70px;
		    	top: 5px;
			}
			.unitlogo
			{
		    	position: absolute;
		    	left: 960px;
		    	top: 16px;
			}
		    .label 
		    {
		        display: inline;
		        padding: .2em .6em .3em;
		        font-size: 60%;
		        font-family: helvetica;
		        font-weight: bold;
		        line-height: 1;
		        color: #fff;
		        white-space: nowrap;
		        vertical-align: baseline;
		        border-radius: .25em;
		    }
		    .label-default 
		    {
		        background-color: #777;
		    }
		    .footer 
		    {
		        width: 100%;
		        text-align: right;
		        font-size: 10px;
		        position: fixed;
		        bottom: 0px;
		        counter-increment:pages;
		    }
		    .pagenum:before 
		    {
		        content: "Page " counter(page);
		    }
	    </style>
	</head>

	<body>
		<p style="text-align: center;">
	        <normal style="font-size: 18px">Maria & Jose Salon</normal>
	        <br>
	        <strong>SALES REPORT<br>as of {{$today}}<br>{{Auth::user()->branch->branch_name}}</strong>
	    </p>

	    <table border="1" width="720">
	    	<thead>
	    		<tr>
		    		<td>#</td>
		    		<td>Customer</td>
		    		<td>Sales</td>
		    		<td>Total Price</td>
		    		<td>Promo</td>
		    		<td>Items Used</td>
		    		<td>Cashier</td>
		    		<td>Time</td>
	    		</tr>
	    	</thead>
	    	<tbody>
		    	@foreach($transactions as $transaction)
		    		<tr>
		    			<?php
		    				$total_transaction += 1;
		    			?>
		    			<td>{{$total_transaction}}</td>
		    			<td><strong>{{$transaction->customer}}</strong><br>{{$transaction->customer_contact}}<br>{{$transaction->customer_address}}</td>
		    			<td class="topalign">
		    				<table border="1" width="100%">
		    					<thead>
		    						<tr>
		    							<td width="40%"><strong>Service</strong></td>
		    							<td width="10%"><strong>Price</strong></td>
		    							<td width="10%"><strong>Addtl.</strong></td>
		    							<td width="40%"><strong>Stylist</strong></td>
		    						</tr>
		    					</thead>

		    					<tbody>
				    				@foreach($transaction->sales as $sale)
				    					<tr>
				    						<td>{{$sale->service->service_name}}</td>
				    						<td align="right">PHP {{$sale->price}}</td>
				    						<td align="right">PHP {{$sale->additional_charge}}</td>
				    						@foreach($sale->used_stylists as $used_stylist)
					    						@if($transaction->promo_id > 0)
							    					<td>{{$used_stylist->stylist->stylist_last_name}}, {{$used_stylist->stylist->stylist_first_name}} (PHP {{ round((($sale->price + $sale->additional_charge) * .10) - (($sale->price + $sale->additional_charge) * .10) * ($transaction->promo->promo_rate * .01), 2) }})</td>
							    				@else
						    						<td>{{$used_stylist->stylist->stylist_last_name}}, {{$used_stylist->stylist->stylist_first_name}} (PHP {{round((($sale->price + $sale->additional_charge) * .10), 2)}})</td>
							    				@endif
						    				@endforeach
				    					</tr>
				    				@endforeach
		    					</tbody>
		    				</table>
		    			</td>
		    			<td align="right">PHP {{$transaction->price}}</td>
		    			<td align="left">
		    				@if($transaction->promo_id > 0)
		    					{{ $transaction->promo->promo_name }}
		    				@else
		    					None
		    				@endif
		    			</td>
		    			<?php
		    				$total_price += $transaction->price;
		    			?>
		    			<td class="topalign">
		    				<table border="1" width="100px">
		    					<thead>
		    						<tr>
		    							<td width="60%"><strong>Item</strong></td>
		    							<td width="20%"><strong>Consumed</strong></td>
		    							<td width="20%"><strong>Qty</strong></td>
		    						</tr>
		    					</thead>

		    					<tbody>
				    				@foreach($transaction->used_items as $used_item)
				    					<tr>
				    						<td>{{$used_item->item->item_name}}</td>
				    						<td>{{ $used_item->item_consumed }} {{ $used_item->item->unit_of_measurement }}</td>
				    						<td align="right">{{$used_item->item_quantity}}</td>
				    					</tr>
				    				@endforeach
		    					</tbody>
		    				</table>
		    			</td>
		    			<td>{{$transaction->user->name}}</td>
		    			<td>
		    				<?php
		    					$created_at = strtotime($transaction->created_at);
		    					$time_created_at = date('H:i:s', $created_at);
		    				?>
		    				{{ $time_created_at }}
		    			</td>
		    		</tr>
		    	@endforeach
	    	</tbody>

	    </table>
	    <br>
	    <h3>Total Transactions: {{$total_transaction}}</h3>
	    <h3>Total Sales: PHP {{$total_price}}</h3>
	</body>
</html>