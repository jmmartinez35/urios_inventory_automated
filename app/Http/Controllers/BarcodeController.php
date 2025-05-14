<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function printBarcodes()
    {
        $items = Item::orderBy('created_at', 'DESC')->get();

        $pdf = Pdf::loadView('admin.print.index', compact('items'));

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="barcodes.pdf"',
        ]);
    }
}
