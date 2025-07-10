<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('back.partials.styles')
</head>
<body>
    @include('back.partials.header')
    @include('back.partials.sidebar')
    <main class="main-content sidebar-active"> <div class="container-fluid">
        @yield('dashboard-content')
    </div></main>
    @include('back.partials.scripts')

    @if (session()->get('error'))
  <script>
    iziToast.error({
        title: "Erreur",
        position: "topRight",
        message:'{{session()->get('error')}}'
    })
  </script>
    @endif
    @if (session()->get('success'))
    <script>
      iziToast.success({
          title: "Succes",
          position: "topRight",
          message:'{{session()->get('success')}}'
      })
    </script>
      @endif
</body>
</html>