<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $invoice = Invoice::with('repair', 'repair.user', 'repair.vehicle','repair.spareParts')->find($id);

        $options = [
            'defaultFont' => 'Arial',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'isPhpEnabled' => true,
            'isJavascriptEnabled' => true,
            'paperSize' => 'A4',
        ];

        $pdf = PDF::loadView('pdfInvoice', compact('invoice'), $options);    
        return $pdf->download('garagistInvoice.pdf');
    }
  
};