<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Download invoice as PDF by Order ID
     *
     * @param  Order  $order  (Route Model Binding)
     * @return \Illuminate\Http\Response
     */
    public function download(Order $order)
    {
        // Security: Verify user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this invoice.');
        }

        // Load relationships
        $order->load(['items.product', 'user']);

        // Generate PDF
        $pdf = Pdf::loadView('user.invoice-template', compact('order'));
        
        $pdf->setPaper('A4', 'portrait');
        
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
        ]);

        // Use invoice_no if available, otherwise order_number
        $invoiceNumber = $order->invoice_no ?? $order->order_number;
        $filename = 'Invoice-' . $invoiceNumber . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * View invoice in browser by Order ID
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function view(Order $order)
    {
        // Security: Verify user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this invoice.');
        }

        $order->load(['items.product', 'user']);

        $pdf = Pdf::loadView('invoices.invoice', compact('order'));
        $pdf->setPaper('A4', 'portrait');

        $invoiceNumber = $order->invoice_no ?? $order->order_number;

        return $pdf->stream('Invoice-' . $invoiceNumber . '.pdf');
    }

    /**
     * Download invoice by Order Number (alternative)
     *
     * @param  string  $orderNumber
     * @return \Illuminate\Http\Response
     */
    public function downloadByOrderNumber($orderNumber)
    {
        $order = Order::with(['items.product', 'user'])
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pdf = Pdf::loadView('invoices.invoice', compact('order'));
        $pdf->setPaper('A4', 'portrait');

        $invoiceNumber = $order->invoice_no ?? $order->order_number;
        $filename = 'Invoice-' . $invoiceNumber . '.pdf';

        return $pdf->download($filename);
    }
}