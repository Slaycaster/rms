<?php

namespace App\Http\Controllers\API;

use Request, Session, DB, Validator, Input, Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service;
use App\Servicetype;
use App\Promo;
use App\UsedItem;
use App\UsedStylist;

/*------------------------------------
		Transactional Models
------------------------------------*/
use App\Transaction;
use App\Sale;

class APISalesController extends Controller
{
    public function transactionCheckout()
    {
        dd(Request::input('customer_contact') . ' ' . Request::input('customer_address'));
        $item_id = Request::input('item_id');
        $item_unit = Request::input('item_unit');
        $item_consumed = Request::input('item_consumed');

        $stylists = Request::input('stylist_id');
        $additional_charges = Request::input('additional_charge');

        /*--------------------------------------------------
            Save the current transaction to the database
        ---------------------------------------------------*/
        $transaction = new Transaction();
        $transaction->customer = Request::input('customer');
        $transaction->customer_contact = Request::input('customer_contact');
        $transaction->customer_address = Request::input('customer_address');
        $transaction->branch_id = Request::input('branch_id');
        $transaction->user_id = Request::input('user_id');
        $transaction->promo_id = Request::input('promo_id');

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
        $transaction_max = Transaction::max('id');

        
        $saleitems = Request::input('sales');
        $saleitem_index = 0;
        foreach ($saleitems as $saleitem)
        {
            $sale = new Sale();
            $sale->service_id = $saleitem['id'];
            $sale->transaction_id = $transaction_max;
            $sale->price = $saleitem['price'];
            $sale->additional_charge = $additional_charges[$saleitem_index];

            $sale->save();

            //Query the id of the recently saved Sale
            $sale_max = Sale::max('id');

            $stylist_used = new UsedStylist();
            $stylist_used->stylist_id = $stylists[$saleitem_index];
            $stylist_used->sale_id = $sale_max;

            $stylist_used->save();

            $saleitem_index = $saleitem_index + 1;
        }

        for ($i=0; $i < sizeof($item_id) ; $i++)
        { 
            $item_used = new UsedItem();
            $item_used->item_id = $item_id[$i];
            $item_used->item_consumed = $item_consumed[$i];
            $item_used->item_quantity = $item_unit[$i];
            $item_used->transaction_id = $transaction_max;

            //Decrement the stock count in the database...
            DB::table('items')->where('id', '=', $item_id[$i])->decrement('item_stock', $item_unit[$i]);

            $item_used->save();
        }
        /*
        for ($j=0; $j < sizeof($stylists); $j++)
        {
            $stylist_used = new UsedStylist();
            $stylist_used->stylist_id = $stylists[$j];
            $stylist_used->transaction_id = $transaction_max;

            $stylist_used->save();
        }
        */
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

    public function getMaxTransactionNumber()
    {
        $transaction_max = Transaction::max('id');
        if ($transaction_max == null)
        {
            $transaction_max = 0;
        }
        return json_encode(["max_transaction_id" => $transaction_max], JSON_PRETTY_PRINT);
    }
}
