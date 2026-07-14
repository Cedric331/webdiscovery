<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class InvoiceController extends Controller
{
    public function index(): Response
    {
        $customer = Auth::guard('customer')->user();

        $invoices = $customer->invoices()
            ->orderBy('date', 'desc')
            ->get()
            ->map(fn (Invoice $invoice) => [
                'id' => $invoice->id,
                'title' => $invoice->title,
                'number' => $invoice->number,
                'date' => $invoice->date->format('d/m/Y'),
                'amount' => $invoice->amount,
                'status' => $invoice->status,
                'status_label' => Invoice::statusLabel($invoice->status),
                'description' => $invoice->description,
                'pdf_url' => $invoice->hasMedia('pdf')
                    ? route('customer-portal.documents.download', ['type' => 'invoice', 'id' => $invoice->id])
                    : null,
            ]);

        return Inertia::render('CustomerPortal/Invoices/Index', [
            'invoices' => $invoices,
        ]);
    }
}
