<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service;
use App\Servicetype;

/*------------------------------------
		Transactional Models
------------------------------------*/
use App\Transaction;
use App\Sale;

class APISalesController extends Controller
{
    public function transactionCheckout()
    {
    	/*---------------------------------------
    		Get server's current time and date
    	----------------------------------------*/
    	$timestamp = time()+date("Z");
        $datetimestamp = gmdate("Y/m/d H:i:s",$timestamp);

    	/*--------------------------------------------------
    		Save the current transaction to the database
    	---------------------------------------------------*/
    	$transaction = new Transaction();
    	$transaction->customer_id = $request->input('customer_id');
    	$transaction->branch_id = $request->input('branch_id');
    	$transaction->datetime = $datetimestamp;
    	$transaction->price = $request->input('price');
    	$transaction->save();

    	return json_encode(["message" => "Transaction successfully saved!"], JSON_PRETTY_PRINT);
    }

    public function getTransactionNumber()
    {
    	$transaction_max = Transaction::max('id');
    	if ($transaction_max == null)
    	{
    		$transaction_max = 0;
    	}
    	return json_encode(["max_transaction_id" => $transaction_max], JSON_PRETTY_PRINT);
    }

    public function saleCheckout()
    {
    	/*---------------------------------------------------
    			Save the current sales to the database
    	----------------------------------------------------*/
    	$sale = new Sale();
    	$sale->service_id = $request->input('service_id');
    	$sale->transaction_id = $request->input('transaction_id');
    	$sale->price = $request->input('price');
    	$sale->save();

    	return json_encode(["message" => "Sale successfully saved!"], JSON_PRETTY_PRINT);
    }
}
