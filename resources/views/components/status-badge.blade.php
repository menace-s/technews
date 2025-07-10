@props(['active'])

<span class="badge bg-{{ $active ? 'success' : 'secondary' }}">
    {{ $active ? 'Actif' : 'Inactif' }}
</span>

{{-- Usage example in a Blade template --}}
{{-- <x-status-badge :active="$article->is_active" /> --}}
{{-- This will render a green badge if active, otherwise a gray badge --}}