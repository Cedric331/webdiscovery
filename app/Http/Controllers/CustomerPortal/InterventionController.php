<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class InterventionController extends Controller
{
    public function index(): Response
    {
        $customer = Auth::guard('customer')->user();

        $interventions = $customer->interventions()
            ->orderBy('date', 'desc')
            ->get()
            ->map(fn (Intervention $intervention) => [
                'id' => $intervention->id,
                'title' => $intervention->title,
                'date' => $intervention->date->format('d/m/Y'),
                'description' => $intervention->description,
                'technician' => $intervention->technician,
                'pdf_url' => $intervention->hasMedia('pdf')
                    ? route('customer-portal.documents.download', ['type' => 'intervention', 'id' => $intervention->id])
                    : null,
            ]);

        return Inertia::render('CustomerPortal/Interventions/Index', [
            'interventions' => $interventions,
        ]);
    }
}
