<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $customer = Auth::guard('customer')->user();

        $stats = [
            'invoices' => $customer->invoices()->count(),
            'quotes' => $customer->quotes()->count(),
            'interventions' => $customer->interventions()->count(),
            'activeContract' => $customer->maintenanceContracts()->where('status', 'actif')->exists(),
        ];

        $recentInvoices = $customer->invoices()
            ->orderBy('date', 'desc')
            ->take(3)
            ->get(['id', 'title', 'number', 'date', 'amount', 'status']);

        $recentInterventions = $customer->interventions()
            ->orderBy('date', 'desc')
            ->take(3)
            ->get(['id', 'title', 'date', 'description']);

        return Inertia::render('CustomerPortal/Dashboard', [
            'customer' => [
                'name' => $customer->first_name . ' ' . $customer->name,
                'company' => $customer->company_name,
                'email' => $customer->email,
            ],
            'stats' => $stats,
            'recentInvoices' => $recentInvoices,
            'recentInterventions' => $recentInterventions,
        ]);
    }
}
