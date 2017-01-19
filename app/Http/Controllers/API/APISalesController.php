<?php

namespace App\Http\Controllers\API;

use Request, Session, DB, Validator, Input, Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service;
use App\Servicetype;
use App\Promo;
use App\UsedItem;

/*------------------------------------
		Transactional Models
------------------------------------*/
use App\Transaction;
use App\Sale;

class APISalesController extends Controller
{
    public function transactionCheckout()
    {
        $item_id = Request::input('item_id');
        $item_unit = Request::input('item_unit');

        /*--------------------------------------------------
            Save the current transaction to the database
        ---------------------------------------------------*/
        $transaction = new Transaction();
        $transaction->customer = Request::input('customer');
        $transaction->branch_id = Request::input('branch_id');
        $transaction->user_id = Request::input('user_id');
        $transaction->stylist_id = Request::input('stylist_id');
        $transaction->promo_id = Request::input('promo_id');
        //$transaction->items = Request::input('items');

        if (Request::input('promo_id') != 0)
        {
            $promo = Promo::find(Request::input('promo_id'));
            $discounted_price = 0;
            $discount_rate = $promo->promo_rate * .01;
            $discounted_price = Request::input('price') - (Request::input('price') * $discount_rate);
            //Save to DB
            $transaction->price = $discounted_price; 
        }
        else
        {
        	$transaction->price = Request::input('price');
        }
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

        for ($i=0; $i < $item_id.length() ; $i++)
        { 
            $item_used = new UsedItem();
            $item_used->item_id = $item_id[$i];
            $item_used->item_dosage = $item_unit[$i];
            $item_used->transaction_id = $transaction_max;
            $item_used->save();
        }

    	return json_encode(["message" => "Transaction successfully saved!"], JSON_PRETTY_PRINT);
    }

    public function getTransactionNumber($id)
    {
    	$transaction_max = Transaction::where('branch_id', '=', $id)->max('id');
    	if ($transaction_max == null)
    	{
    		$transaction_max = 0;
    	}
    	return json_encode(["max_transaction_id" => $transaction_max], JSON_PRETTY_PRINT);
    }
}
