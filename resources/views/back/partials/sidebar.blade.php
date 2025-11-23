<nav id="sidebar" class="sidebar active">  <div class="sidebar-content-wrapper"> <div class="user-profile">
                <img src="{{ Auth::user()->avatarUrl() }}" alt="User Avatar">
                <h5>{{Auth::user()->name}}</h5>
                <p>Administrateur</p>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#articlesSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="articlesSubmenu">
                        <i class="bi bi-file-earmark-text-fill"></i> Articles
                    </a>
                    <ul class="collapse list-unstyled" id="articlesSubmenu">
                        <li><a class="nav-link ms-4" href="{{ route('admin.article.index') }}">Tous les articles</a></li>
                        <li><a class="nav-link ms-4" href="{{ route('admin.article.create') }}">Ajouter un article</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="all-comments.html">
                        <i class="bi bi-chat-dots-fill"></i> Commentaires
                    </a>
                </li>
                @can('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="#categoriesSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="categoriesSubmenu">
                            <i class="bi bi-tags-fill"></i> Catégories
                        </a>
                        <ul class="collapse list-unstyled" id="categoriesSubmenu">
                            <li><a class="nav-link ms-4" href="{{ route('admin.category.index')}}">Toutes les catégories</a></li>
                        </ul>
                    </li>
                
                 <li class="nav-item">
                    <a class="nav-link" href="#authorsSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="authorsSubmenu">
                        <i class="bi bi-people-fill"></i> Auteurs
                    </a>
                    <ul class="collapse list-unstyled" id="authorsSubmenu">
                        <li><a class="nav-link ms-4" href="{{ route('admin.author.index') }}">Tous les auteurs</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#socialSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="socialSubmenu">
                         <i class="bi bi-share-fill"></i> Médias Sociaux
                    </a>
                     <ul class="collapse list-unstyled" id="socialSubmenu">
                        <li><a class="nav-link ms-4" href="{{ route('admin.social-media.index') }}">Tous les médias</a></li>
                        <li><a class="nav-link ms-4" href="add-social-media.html">Ajouter un média</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="all-contacts.html">
                        <i class="bi bi-envelope-fill"></i> Contacts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.settings.index') }}">
                        <i class="bi bi-gear-fill"></i> Paramètres
                    </a>
                </li>
            @endcan
            </ul>
            </div>
        </div>
    </nav>