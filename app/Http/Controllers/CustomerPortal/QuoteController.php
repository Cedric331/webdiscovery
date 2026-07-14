<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class QuoteController extends Controller
{
    public function index(): Response
    {
        $customer = Auth::guard('customer')->user();

        $quotes = $customer->quotes()
            ->orderBy('date', 'desc')
            ->get()
            ->map(fn (Quote $quote) => [
                'id' => $quote->id,
                'title' => $quote->title,
                'number' => $quote->number,
                'date' => $quote->date->format('d/m/Y'),
                'amount' => $quote->amount,
                'status' => $quote->status,
                'status_label' => Quote::statusLabel($quote->status),
                'description' => $quote->description,
                'pdf_url' => $quote->hasMedia('pdf')
                    ? route('customer-portal.documents.download', ['type' => 'quote', 'id' => $quote->id])
                    : null,
            ]);

        return Inertia::render('CustomerPortal/Quotes/Index', [
            'quotes' => $quotes,
        ]);
    }
}
