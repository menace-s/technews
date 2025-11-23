<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Requests\SettingsRequest;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Settings::first(); // Assuming you have only one settings record
        return view('back.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingsRequest $request)
    {
        $settings = Settings::first();
        
        // Si aucun settings n'existe, le créer
        if (!$settings) {
            $settings = new Settings();
        }
        $data= $request->validated();
        // Gestion de l'upload du logo
        if ($request->hasFile('site_logo')) {
            // Supprimer l'ancien logo s'il existe
            if ($settings->site_logo && Storage::disk('public')->exists($settings->site_logo)) {
                Storage::disk('public')->delete($settings->site_logo);
            }
            
            // Stocker le nouveau logo
            $path = $request->file('site_logo')->store('settings', 'public');
            $data['site_logo'] = $path;
        }
         // Mettre à jour ou créer
        $settings->fill($data);
        $settings->save();
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
