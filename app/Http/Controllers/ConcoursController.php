<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ConcoursController extends Controller
{
    /**
     * Affiche la page de participation au concours
     */
    public function show()
    {
        return Inertia::render('ParticipationConcours');
    }

    /**
     * Traite la soumission du formulaire de participation
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'company_name' => 'nullable|string|max:255',
            'accept_reglement' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Vérifier si l'email n'a pas déjà participé au concours
        $existingProspect = Prospect::where('email', $request->email)
            ->where('source', 'concours')
            ->first();

        if ($existingProspect) {
            return back()
                ->withErrors(['email' => 'Vous avez déjà participé au concours avec cet email.'])
                ->withInput();
        }

        try {
            // Créer le prospect
            Prospect::create([
                'email' => $request->email,
                'company_name' => $request->company_name,
                'source' => 'concours',
                'status' => 'new',
                'prospect_date' => now(),
            ]);

            return back()->with('success', 'Votre participation a été enregistrée avec succès ! Bonne chance !');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['email' => 'Une erreur est survenue lors de l\'enregistrement de votre participation. Veuillez réessayer plus tard.'])
                ->withInput();
        }
    }
}

