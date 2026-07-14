<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceContract;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ContractController extends Controller
{
    public function index(): Response
    {
        $customer = Auth::guard('customer')->user();

        $contracts = $customer->maintenanceContracts()
            ->orderBy('start_date', 'desc')
            ->get()
            ->map(fn (MaintenanceContract $contract) => [
                'id' => $contract->id,
                'title' => $contract->title,
                'description' => $contract->description,
                'monthly_price' => $contract->monthly_price,
                'annual_price' => $contract->annual_price,
                'start_date' => $contract->start_date->format('d/m/Y'),
                'end_date' => $contract->end_date?->format('d/m/Y'),
                'status' => $contract->status,
                'status_label' => MaintenanceContract::statusLabel($contract->status),
                'pdf_url' => $contract->hasMedia('pdf')
                    ? route('customer-portal.documents.download', ['type' => 'contract', 'id' => $contract->id])
                    : null,
            ]);

        return Inertia::render('CustomerPortal/Contract/Index', [
            'contracts' => $contracts,
        ]);
    }
}
