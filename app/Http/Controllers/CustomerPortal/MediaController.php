<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use App\Models\Invoice;
use App\Models\MaintenanceContract;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MediaController extends Controller
{
    public function download(string $type, int $id): StreamedResponse
    {
        $customer = Auth::guard('customer')->user();

        $model = match ($type) {
            'invoice' => Invoice::where('customer_id', $customer->id)->findOrFail($id),
            'quote' => Quote::where('customer_id', $customer->id)->findOrFail($id),
            'intervention' => Intervention::where('customer_id', $customer->id)->findOrFail($id),
            'contract' => MaintenanceContract::where('customer_id', $customer->id)->findOrFail($id),
            default => abort(404),
        };

        $media = $model->getFirstMedia('pdf');

        abort_if(! $media, 404, 'Aucun document disponible.');

        return response()->streamDownload(function () use ($media) {
            echo file_get_contents($media->getPath());
        }, $media->file_name, [
            'Content-Type' => $media->mime_type,
        ]);
    }
}
