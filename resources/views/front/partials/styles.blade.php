
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- Alternative si tu n'utilises pas Vite (méthode plus "ancienne") --}}
{{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}

{{-- Police Google Fonts, par exemple --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">