<header class="fixed-top bg-dark">
  <div class="container d-flex align-items-center justify-content-between py-2">
    <a href="{{ route('home') }}#home" class="navbar-brand text-white fs-3 fw-bold">
     <div class="logo">
    <img src="{{asset('storage/images/LOGO.png') }}" alt="Diallo" class="logo-img">
    <span class="logo-text">Diallo</span>
</div>

    </a>

    <!-- Menu desktop -->
    <nav class="d-none d-lg-block">
      <ul class="nav align-items-center">
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#home">Accueil</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#about">À propos</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#skills">Compétences</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#projects">Projets</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#contact">Contact</a></li>
      </ul>
    </nav>

    <div class="d-flex align-items-center gap-2 flex-grow-1">
      <!-- Barre de recherche -->
      <div class="header-search flex-grow-1 me-2 position-relative">
    <input type="text" id="searchInput" placeholder="Rechercher..." class="form-control form-control-sm" autocomplete="off">
    <i class="bi bi-search position-absolute"></i>

    <ul id="searchSuggestions" class="list-group position-absolute w-100" style="top: 100%; left: 0; z-index:1001; display:none;"></ul>
</div>



      <!-- Connexion desktop -->
      <a href="{{ route('login') }}" class="btn btn-login btn-sm d-none d-lg-block">
        <i class="bi bi-box-arrow-in-right"></i> Connexion
      </a>

      <!-- Hamburger menu mobile -->
      <button class="btn btn-outline-light btn-sm d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav">
        <i class="bi bi-list fs-3"></i>
      </button>
    </div>
  </div>

  <!-- Menu mobile -->
  <div class="collapse bg-dark" id="mobileNav">
    <ul class="nav flex-column text-center py-3">
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#home">Accueil</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#about">À propos</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#skills">Compétences</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#projects">Projets</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#contact">Contact</a></li>

      <!-- Connexion mobile -->
      <li class="nav-item mt-2 d-lg-none">
        <a href="{{ route('login') }}" class="btn btn-login w-100 btn-sm">
          <i class="bi bi-box-arrow-in-right"></i> Connexion
        </a>
      </li>
    </ul>
  </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchInput');
    const suggestions = document.getElementById('searchSuggestions');
    let debounceTimer;
    let cachedResults = [];

    function scrollToSection(hash) {
        const el = document.querySelector(hash);
        if(el) el.scrollIntoView({behavior: 'smooth'});
    }

    input.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const query = input.value.trim();
            if(!query){
                suggestions.style.display = 'none';
                return;
            }

            fetch('/ajax-recherche?q=' + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    cachedResults = data;
                    if(!data.length){
                        suggestions.style.display = 'none';
                        return;
                    }

                    const fragment = document.createDocumentFragment();
                    data.forEach(item => {
                        const li = document.createElement('li');
                        li.className = 'list-group-item list-group-item-action';
                        li.style.cursor = 'pointer';
                        li.textContent = item.label;

                        li.addEventListener('click', () => {
                            if(item.url.includes('#')){
                                scrollToSection('#' + item.url.split('#')[1]);
                            } else {
                                window.location.href = item.url;
                            }
                            suggestions.style.display = 'none';
                        });

                        fragment.appendChild(li);
                    });

                    suggestions.innerHTML = '';
                    suggestions.appendChild(fragment);
                    suggestions.style.display = 'block';
                });
        }, 300); // Debounce pour réduire les requêtes
    });

    input.addEventListener('keypress', e => {
        if(e.key === 'Enter'){
            e.preventDefault();
            const query = input.value.trim();
            if(!query) return;

            const match = cachedResults.find(item => item.label.toLowerCase() === query.toLowerCase());
            if(match){
                if(match.url.includes('#')){
                    scrollToSection('#' + match.url.split('#')[1]);
                } else {
                    window.location.href = match.url;
                }
            } else {
                window.open('https://www.google.com/search?q=' + encodeURIComponent(query), '_blank');
            }
            suggestions.style.display = 'none';
        }
    });

    document.addEventListener('click', e => {
        if(!input.contains(e.target) && !suggestions.contains(e.target)){
            suggestions.style.display = 'none';
        }
    });

    // Fermer le menu mobile après clic sur lien
    document.querySelectorAll('#mobileNav .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            const mobileNav = document.getElementById('mobileNav');
            if(mobileNav.classList.contains('show')){
                const bsCollapse = new bootstrap.Collapse(mobileNav, { toggle: true });
            }
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const headerSearch = document.querySelector('.header-search');
    const searchInput = headerSearch.querySelector('input');
    const searchIcon = headerSearch.querySelector('i');

    // Clique sur l'icône → ouvrir la barre
    searchIcon.addEventListener('click', (e) => {
        headerSearch.classList.add('active');
        searchInput.focus();
        e.stopPropagation(); // ne pas fermer immédiatement
    });

    // Desktop : Curseur sort de la barre → refermer
    headerSearch.addEventListener('mouseleave', () => {
        headerSearch.classList.remove('active');
    });

    // Mobile : dès que le doigt quitte la barre → refermer
    headerSearch.addEventListener('touchend', () => {
        headerSearch.classList.remove('active');
    });

    // Empêche de fermer quand on clique dans la barre
    searchInput.addEventListener('click', (e) => {
        e.stopPropagation();
    });
});

</script>
