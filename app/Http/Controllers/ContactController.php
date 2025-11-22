<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'project_type' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $projectTypeLabels = [
                'site-vitrine' => 'Site web vitrine',
                'saas' => 'Application SaaS',
                'ecommerce' => 'E-commerce',
                'refonte' => 'Refonte de site',
                'autre' => 'Autre',
            ];

            $projectType = $request->project_type 
                ? ($projectTypeLabels[$request->project_type] ?? $request->project_type)
                : 'Non spécifié';

            $emailContent = "Nouveau message de contact - Web Discovery\n\n";
            $emailContent .= "Nom: {$request->name}\n";
            $emailContent .= "Email: {$request->email}\n";
            
            if ($request->phone) {
                $emailContent .= "Téléphone: {$request->phone}\n";
            }
            
            $emailContent .= "Type de projet: {$projectType}\n\n";
            $emailContent .= "Message:\n{$request->message}";

            Mail::raw(
                $emailContent,
                function ($message) use ($request) {
                    $message->to(config('mail.from.address'))
                        ->subject('Nouveau message de contact - Web Discovery')
                        ->replyTo($request->email, $request->name);
                }
            );

            return back()->with('success', 'Votre message a été envoyé avec succès. Je vous répondrai dans les plus brefs délais.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer plus tard.');
        }
    }
}
