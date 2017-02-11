<?php

use App\OTCItem;
use App\Branch;

	$timestamp = time()+date("Z");
	$today = gmdate("Y/m/d H:i:s",$timestamp);
	$date = Session::get('date', $today);
	$branch_id = Session::get('branch_id', 1);

	$items = OTCItem::where('branch_id', '=', $branch_id)->orderBy('otc_item_stock', 'DESC')->get();
	$branch = Branch::where('id', '=', $branch_id)->first();
	$total_items = 0;
	$total_stock_count = 0;
?>

<!DOCTYPE html5>
<html>
	<head>
		<title>Over-the-counter Inventory Report - {{$date}} | Maria Jose Salon</title>

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
	        <strong>OVER THE COUNTER<br>INVENTORY REPORT<br>as of {{$today}}<br>{{$branch->branch_name}}</strong>
	    </p>

	    <table border="1" width="720">
	    	<thead>
	    		<tr>
		    		<td>#</td>
		    		<td width="400">Item Name</td>
		    		<td>Unit of Measurement</td>
		    		<td>Item Price</td>
		    		<td align="right">Stock</td>
	    		</tr>
	    	</thead>
	    	<tbody>
		    	@foreach($items as $item)
		    		<tr>
		    			<?php
		    				$total_items += 1;
		    			?>
		    			<td>{{$total_items}}</td>
		    			<td>{{$item->otc_item_name}}</td>
		    			<td>{{$item->otc_unit_of_measurement}}</td>
		    			<td>{{$item->otc_item_price}}</td>
		    			<td align="right">{{$item->otc_item_stock}}</td>
		    			<?php
		    				$total_stock_count += $item->otc_item_stock;
		    			?>
		    		</tr>
		    	@endforeach
	    	</tbody>

	    </table>
	    <br>
	    <h3>Total Items: {{$total_items}}</h3>
	    <h3>Total Stock Count: {{$total_stock_count}}</h3>
	</body>
</html>