@extends('back.app')

@section('title', 'Paramètres du Site')

@section('dashboard-content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2 page-title">Paramètres de Base</h1>
    </div>

    {{-- Le formulaire doit pointer vers une route de mise à jour (ex: settings.update) --}}
    {{-- La méthode est PUT pour une mise à jour --}}
    {{-- enctype="multipart/form-data" est CRUCIAL pour l'upload de fichiers --}}
    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    {{-- Nom du site --}}
                    <div class="col-md-6 mb-3">
                        <label for="site_name" class="form-label">Nom du site <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('site_name') is-invalid @enderror" 
                               id="site_name" 
                               name="site_name" 
                               value="{{ old('site_name', $settings->site_name ?? '') }}" 
                               required>
                        @error('site_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Uploader une image (logo) --}}
                    <div class="col-md-6 mb-3">
                        <label for="site_logo" class="form-label">Uploader un logo</label>
                        <input class="form-control @error('site_logo') is-invalid @enderror" 
                               type="file" 
                               id="site_logo" 
                               name="site_logo">
                        @error('site_logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        {{-- Affichage du logo actuel s'il existe --}}
                        @if (isset($settings['site_logo']))
                            <div class="mt-2">
                                <small>Logo actuel :</small><br>
                                <img src="{{ Storage::url($settings['site_logo']) }}" alt="Logo actuel" style="max-height: 50px; border-radius: 5px;">
                            </div>
                        @endif
                    </div>

                    {{-- Adresse --}}
                    <div class="col-md-12 mb-3">
                        <label for="contact_address" class="form-label">Address</label>
                        <input type="text" 
                               class="form-control @error('contact_address') is-invalid @enderror" 
                               id="contact_address" 
                               name="contact_address"
                               value="{{ old('contact_address', $settings->contact_address ?? '') }}">
                        @error('contact_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Numéro de téléphone --}}
                    <div class="col-md-6 mb-3">
                        <label for="contact_phone" class="form-label">Numero de telephone</label>
                        <input type="tel" 
                               class="form-control @error('contact_phone') is-invalid @enderror" 
                               id="contact_phone" 
                               name="contact_phone"
                               value="{{ old('contact_phone', $settings->contact_phone ?? '') }}">
                        @error('contact_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6 mb-3">
                        <label for="contact_email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" 
                               class="form-control @error('contact_email') is-invalid @enderror" 
                               id="contact_email" 
                               name="contact_email"
                               value="{{ old('contact_email', $settings->contact_email ?? '') }}"
                               required>
                        @error('contact_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-md-12 mb-3">
                        <label for="about" class="form-label">Description / A Propos</label>
                        <textarea class="form-control @error('about') is-invalid @enderror" 
                                  id="about" 
                                  name="about" 
                                  rows="4">{{ old('about', $settings->about ?? '') }}</textarea>
                        @error('about')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection