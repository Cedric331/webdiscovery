<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $portfolios = Portfolio::query()
            ->where('is_published', true)
            ->with('media')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return Inertia::render('Portfolio/Index', [
            'portfolios' => $portfolios,
        ]);
    }
}

