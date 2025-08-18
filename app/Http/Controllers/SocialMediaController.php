<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use App\Http\Requests\SocialMedia\StoreSocialMediaRequest;
use App\Http\Requests\SocialMedia\UpdateSocialMediaRequest;
use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $social_media_list = SocialMedia::all();
        return view('back.social.index',compact('social_media_list'));
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
    public function store(StoreSocialMediaRequest $request)
    {
        $data= $request->validated();
        SocialMedia::create($data);
        return redirect()->route('social-media.index')->with('success', 'Réseau social ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialMedia $social_medium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $social_medium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSocialMediaRequest $request, SocialMedia $social_medium)
    {
        $data = $request->validated();
        // dd($data);
        $social_medium->update($data);
        return redirect()->route('social-media.index')->with('success', 'Réseau social mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $social_medium)
    {
        // dd($social_medium); 
        $social_medium->delete();
        return back()->with('success', 'Réseau social supprimé avec succès.');
    }
}
