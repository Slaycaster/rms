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
						->with('stylist')
						->with('sales.service')
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
		        text-align: center;
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
	        <strong>SALES REPORT<br>{{$today}}</strong>
	        <br>
	        <normal style="font-size: 16px"></normal>
	    </p>

	    <table border="1" width="520">
	    	<thead>
	    		<tr>
		    		<td>#</td>
		    		<td>Customer</td>
		    		<td>Sales</td>
		    		<td>Total Price</td>
		    		<td>Stylist</td>
		    		<td>Cashier</td>
	    		</tr>
	    	</thead>
	    	<tbody>
		    	@foreach($transactions as $transaction)
		    		<tr>
		    			<td>{{$transaction->id}}</td>
		    			<?php
		    				$total_transaction += 1;
		    			?>
		    			<td>{{$transaction->customer}}</td>
		    			<td>
		    				<table border="1" width="100%">
		    					<thead>
		    						<tr>
		    							<td width="60%"><strong>Service</strong></td>
		    							<td width="40%"><strong>Price</strong></td>
		    						</tr>
		    					</thead>

		    					<tbody>
				    				@foreach($transaction->sales as $sale)
				    					<tr>
				    						<td>{{$sale->service->service_name}}</td>
				    						<td align="right">PHP {{$sale->price}}</td>
				    					</tr>
				    				@endforeach
		    					</tbody>
		    				</table>
		    			</td>
		    			<td align="right">PHP {{$transaction->price}}</td>
		    			<?php
		    				$total_price += $transaction->price;
		    			?>
		    			<td>{{ $transaction->stylist->stylist_last_name }}, {{ $transaction->stylist->stylist_first_name }}</td>
		    			<td>{{$transaction->user->name}}</td>
		    		</tr>
		    	@endforeach
	    	</tbody>

	    </table>
	    <br>
	    <h3>Total Transactions: {{$total_transaction}}</h3>
	    <h3>Total Sales: PHP {{$total_price}}</h3>
	</body>
</html>