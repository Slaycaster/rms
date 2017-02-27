<?php

namespace App\Http\Controllers\API;

use Request, Session, DB, Validator, Input, Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OTCItem;
use App\OTCTransaction;
use App\OTCSale;
use App\Promo;

class APIOTCSalesController extends Controller
{
	public function otc_items($id)
	{
		$data = OTCItem::where('branch_id', '=', $id)->get();
    	return json_encode($data, JSON_PRETTY_PRINT);
	}

	public function transactionCheckout()
    {
        $item_id = Request::input('item_id');
        
        $additional_charges = Request::input('additional_charge');
        $quantity = Request::input('quantity');
        $unit = Request::input('unit_of_measurement');

        /*--------------------------------------------------
            Save the current transaction to the database
        ---------------------------------------------------*/
        $transaction = new OTCTransaction();
        $transaction->invoice_id = Request::input('invoice_id');
        $transaction->customer = Request::input('customer');
        $transaction->customer_contact = Request::input('customer_contact');
        $transaction->customer_address = Request::input('customer_address');
        $transaction->branch_id = Request::input('branch_id');
        $transaction->user_id = Request::input('user_id');
        $transaction->promo_id = Request::input('promo_id');
        $transaction->stylist_id = Request::input('stylist_id');

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

        //Query the id of the recently saved Transaction
        $transaction_max = OTCTransaction::max('id');

        
        $saleitems = Request::input('sales');
        $saleitem_index = 0;
        foreach ($saleitems as $saleitem)
        {
            $sale = new OTCSale();
            $sale->otc_item_id = $saleitem['id'];
            $sale->otc_transaction_id = $transaction_max;
            $sale->quantity = $quantity[$saleitem_index];
            $sale->price = $saleitem['otc_item_price'];
            $sale->unit = $unit[$saleitem_index];
            $sale->additional_charge = $additional_charges[$saleitem_index];

            //Decrement the stock count in the database...
            DB::table('otc_items')->where('id', '=', $saleitem['id'])->decrement('otc_item_stock', $quantity[$saleitem_index]);

            $sale->save();

            $saleitem_index = $saleitem_index + 1;
        }
    	return json_encode(["message" => "Transaction successfully saved!"], JSON_PRETTY_PRINT);
    }

	public function getTransactionNumber($id)
    {
    	$transaction_max = OTCTransaction::where('branch_id', '=', $id)->max('invoice_id');
    	if ($transaction_max == null)
    	{
    		$transaction_max = 0;
    	}
    	return json_encode(["max_transaction_id" => $transaction_max], JSON_PRETTY_PRINT);
    }

    public function getMaxTransactionNumber()
    {
        $transaction_max = OTCTransaction::max('id');
        if ($transaction_max == null)
        {
            $transaction_max = 0;
        }
        return json_encode(["max_transaction_id" => $transaction_max], JSON_PRETTY_PRINT);
    }
}
