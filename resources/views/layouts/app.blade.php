<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">

  <!-- Viewport optimisé -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>@yield('title')</title>
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>


  <!-- Bootstrap CSS (prioritaire mais non bloquant) -->
  <link
    rel="preload"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    as="style"
    onload="this.onload=null;this.rel='stylesheet'">

  <noscript>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </noscript>

  <!-- Bootstrap Icons -->
  <link
    rel="preload"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    as="style"
    onload="this.onload=null;this.rel='stylesheet'">

  <noscript>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  </noscript>

  <!-- Ton CSS (priorité LCP) -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

@include('partials.header')

<main class="pt-5 mt-5">
  @yield('content')
</main>

@include('partials.footer')

<!-- Bootstrap JS (non bloquant → INP amélioré) -->
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  defer>
</script>

<!-- Ton JS -->


</body>
</html>
