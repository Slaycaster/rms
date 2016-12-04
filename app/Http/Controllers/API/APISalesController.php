<?php

namespace App\Http\Controllers\API;

use Request, Session, DB, Validator, Input, Redirect;

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
    	/*--------------------------------------------------
    		Save the current transaction to the database
    	---------------------------------------------------*/
    	$transaction = new Transaction();
    	$transaction->customer = Request::input('customer');
    	$transaction->branch_id = Request::input('branch_id');
    	$transaction->price = Request::input('price');
        $transaction->user_id = Request::input('user_id');
    	$transaction->save();

        //Query the if of the recently saved Transaction
        $transaction_max = Transaction::max('id');

        
        $saleitems = Request::input('sales');
        foreach ($saleitems as $saleitem)
        {
            $sale = new Sale();
            $sale->service_id = $saleitem['id'];
            $sale->transaction_id = $transaction_max;
            $sale->price = $saleitem['price'];
            $sale->save();
        }

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
}
