<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Site_touristique;
use Illuminate\Support\Facades\Storage;

class EvenementsController extends Controller
{
    /**
     * Affiche la page principale des événements.
     */
    public function index()
    {
        return view('Evenements');
    }

    /**
     * Affiche le formulaire de création d'un événement.
     */
    public function create_evenement()
    {
        // Récupère tous les sites touristiques pour les afficher dans le formulaire
        $site_touristiques = Site_touristique::all();
        return view('Admin/Evenements/create', compact('site_touristiques'));
    }

    /**
     * Traite la création d'un nouvel événement.
     */
    public function traitement_create_evenement(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'site_touristique_id' => 'required|exists:site_touristiques,id',
            'nom' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'date' => 'required|date',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sponsor' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Gestion du téléchargement de l'image
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = null;
        }

        // Création et enregistrement du nouvel événement
        Evenement::create([
            'site_touristique_id' => $request->site_touristique_id,
            'nom' => $request->nom,
            'lieu' => $request->lieu,
            'date' => $request->date,
            'photo' => $photoPath ? 'storage/' . $photoPath : null,
            'sponsor' => $request->sponsor,
            'description' => $request->description,
        ]);

        return redirect()->route('indexevenements')->with('success', 'Événement créé avec succès.');
    }

    /**
     * Affiche la liste des événements.
     */
    public function Evenement()
    {
        $datas = Evenement::all();
        return view('Admin/Evenements/index', compact('datas'));
    }

    /**
     * Affiche le formulaire de modification d'un événement.
     */
    public function modifierevenements($id)
    {
        $data = Evenement::findOrFail($id);
        return view('Admin/modification/editevenement', compact('data'));
    }

    /**
     * Traite la modification d'un événement existant.
     */
    public function modificationevenements(Request $request, $id)
    {
        $data = Evenement::findOrFail($id);

        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'date' => 'required|date',
            'sponsor' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gestion de l'image si une nouvelle est envoyée
        if ($request->hasFile('photo')) {
            // Suppression de l'ancienne image si elle existe
            if ($data->photo) {
                Storage::disk('public')->delete(str_replace('storage/', '', $data->photo));
            }

            $photoPath = $request->file('photo')->store('photos', 'public');
            $data->photo = 'storage/' . $photoPath;
        }

        // Mise à jour des autres champs
        $data->update($request->except('photo'));

        return redirect()->route('indexevenements')->with('success', 'Événement modifié avec succès.');
    }

    /**
     * Supprime un événement de la base de données.
     */
    public function supressionevenements($id)
    {
        $post = Evenement::findOrFail($id);

        // Suppression de la photo associée si elle existe
        if ($post->photo) {
            Storage::disk('public')->delete(str_replace('storage/', '', $post->photo));
        }

        $post->delete();

        return redirect()->route('indexevenements')->with('success', 'Événement supprimé avec succès.');
    }
}
