<?php

/*------------------------------------
		Transactional Models
------------------------------------*/
use App\OTCTransaction;

	$timestamp = time()+date("Z");
	$today = gmdate("Y/m/d",$timestamp);
	$customer_name = Session::get('customer_name', ' ');
	$transactions = OTCTransaction::where('customer', 'like', '%' . $customer_name . '%') 
						->with('branch')
						->with('otc_sales')
						->with('stylist')
						->with('user')
						->get();

	$total_transaction = 0;
	$total_price = 0;
?>

<!DOCTYPE html5>
<html>
	<head>
		<title>Over-the-counter Customer's Sales Report - {{$today}} | Maria Jose Salon</title>

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
	        <strong>Over-the-counter<br>CUSTOMER REPORT<br>as of {{$today}}</strong>
	    </p>

	    <table border="1" width="720">
	    	<thead>
	    		<tr>
		    		<td>#</td>
		    		<td>Customer</td>
		    		<td>Item/s</td>
		    		<td>Total Price</td>
		    		<td>Promo</td>
		    		<td>Stylist</td>
		    		<td>Cashier</td>
		    		<td>Time</td>
		    		<td>Branch</td>
	    		</tr>
	    	</thead>
	    	<tbody>
		    	@foreach($transactions as $transaction)
		    		<tr>
		    			<?php
		    				$total_transaction += 1;
		    			?>
		    			<td>{{ str_pad($transaction->invoice_id, 5, 0, STR_PAD_LEFT) }}</td>
		    			<td><strong>{{$transaction->customer}}</strong><br>{{$transaction->customer_contact}}<br>{{$transaction->customer_address}}</td>
		    			<td class="topalign">
		    				<table border="1" width="250px">
		    					<thead>
		    						<tr>
		    							<td width="50%"><strong>Item Name</strong></td>
		    							<td width="10%"><strong>Unit</strong></td>
		    							<td width="10%"><strong>Price</strong></td>
		    							<td width="10%"><strong>Qty.</strong></td>
		    							<td width="10%"><strong>Addtl.</strong></td>
		    							<td width="10%"><strong>Subtotal</strong></td>
		    						</tr>
		    					</thead>

		    					<tbody>
				    				@foreach($transaction->otc_sales as $sale)
				    					<tr>
				    						<td>{{$sale->otc_item->otc_item_name}}</td>
				    						<td>{{ $sale->unit }} {{ $sale->otc_item->otc_unit_of_measurement }}</td>
				    						<td align="right">PHP {{$sale->otc_item->otc_item_price}}</td>
				    						<td align="right">{{$sale->quantity}}</td>
				    						<td align="right">PHP {{$sale->additional_charge}}</td>
				    						<td align="right">PHP {{$sale->otc_item->otc_item_price * $sale->quantity + $sale->additional_charge}}</td>
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
		    			<td align="left">
		    				{{$transaction->stylist->stylist_last_name}}, {{$transaction->stylist->stylist_first_name}} (PHP {{round(($transaction->price * .05), 2)}})
		    			</td>
		    			<td>{{$transaction->user->name}}</td>
		    			<td>
		    				{{ $transaction->created_at }}
		    			</td>
		    			<td>{{ $transaction->branch->branch_name }}</td>
		    		</tr>
		    	@endforeach
	    	</tbody>

	    </table>
	    <br>
	    <h3>Total Transactions: {{$total_transaction}}</h3>
	    <h3>Total Sales: PHP {{$total_price}}</h3>
	</body>
</html>