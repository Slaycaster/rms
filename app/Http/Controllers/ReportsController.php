<?php

namespace App\Http\Controllers;

use Request, Session, DB, Validator, Input, Redirect;

use App\Http\Requests;
use Barryvdh\DomPDF\Facade as PDF;

use App\Branch;

class ReportsController extends Controller
{
    public function index()
    {
        $branches = Branch::pluck('branch_name', 'id');
    	return view('reports')
            ->with('branches', $branches);
    }

    public function today()
    {
    	//$sales = Transaction::whereBetween('created_at', [$date . ' 00:00:00', $date . ' 23:59:59'])->with('sales')->get();
        Session::put('branch_id', Request::input('branch_id'));
    	$pdf = PDF::loadView('pdf-layouts.sales-today')->setPaper('Letter', 'landscape');
    	$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf->get_canvas();
		$canvas->page_text(808, 580, "Maria & Jose Salon - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
    }

    public function branch()
    {
        Session::put('branch_id', Request::input('branch_id'));
        Session::put('date', Request::input('date'));
        $pdf = PDF::loadView('pdf-layouts.sales-branch')->setPaper('Letter', 'landscape');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(808, 580, "Maria & Jose Salon - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream();
    }

    public function customer()
    {
        Session::put('customer_name', Request::input('customer_name'));
        $pdf = PDF::loadView('pdf-layouts.sales-customer')->setPaper('Letter', 'landscape');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(808, 580, "Maria & Jose Salon - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream();   
    }
}
