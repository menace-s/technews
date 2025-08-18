<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('back.partials.styles')
</head>
<body>
    
<div class="container text-center py-5">
    <div class="card card-body shadow-sm">
        <h1 class="display-1 fw-bold text-danger">403</h1>
        <h2 class="mb-3">🚫 Accès Interdit</h2>
        <p class="text-muted mb-4">
            Désolé, vous n'avez pas les permissions nécessaires pour accéder à cette page.
        </p>
        <div class="d-flex justify-content-center">
             <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Retour à la page précédente</a>
             {{-- <a href="{{ route('home') }}" class="btn btn-primary">Aller au tableau de bord</a> --}}
        </div>
    </div>
</div>
@include('back.partials.scripts')
</body>
</html>