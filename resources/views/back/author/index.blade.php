@extends('back.app') @section('title', 'Auteurs - Admin Dashboard')
@section('dashboard-content')

<div class="container-fluid pt-4 px-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom"
    >
        <h1 class="h2 page-title">Auteurs</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addAuthorModal"
            >
                <i class="bi bi-plus-circle-fill me-2"></i>Ajouter un nouvel
                auteur
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-primary">Liste des auteurs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table
                    class="table table-hover"
                    id="dataTableAuthors"
                    width="100%"
                    cellspacing="0"
                >
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($authors as $author)
                        <tr>
                            <td>AUT-00{{ $author->id }}</td>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->email }}</td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button
                                        class="btn btn-sm btn-outline-secondary rounded-circle"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        <i
                                            class="bi bi-three-dots-vertical"
                                        ></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editAuthorModal{{ $author->id }}"
                                                ><i
                                                    class="bi bi-pencil-square me-2"
                                                ></i
                                                >Modifier</a
                                            >
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item text-danger"
                                                href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteAuthorModal{{ $author->id }}"
                                                ><i
                                                    class="bi bi-trash-fill me-2"
                                                ></i
                                                >Supprimer</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Modale de modification -->
                        <div
                            class="modal fade"
                            id="editAuthorModal{{ $author->id }}"
                            tabindex="-1"
                            aria-labelledby="editAuthorModalLabel1"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5
                                            class="modal-title"
                                            id="editAuthorModalLabel{{ $author->id }}"
                                        >
                                            Modifier l'auteur {{ $author->name
                                            }}
                                        </h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>
                                    <form
                                        action="{{ route('author.update', $author->id) }}"
                                        method="POST"
                                    >
                                        @csrf @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label
                                                    for="editAuthorName{{ $author->id }}"
                                                    class="form-label"
                                                    >Nom complet</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="editAuthorName{{ $author->id }}"
                                                    name="name"
                                                    value="{{ $author->name }}"
                                                    required
                                                />
                                            </div>
                                            <div class="mb-3">
                                                <label
                                                    for="editAuthorEmail{{ $author->id }}"
                                                    class="form-label"
                                                    >Adresse Email</label
                                                >
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    id="editAuthorEmail{{ $author->id }}"
                                                    name="email"
                                                    value="{{ $author->email }}"
                                                    required
                                                />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                Annuler
                                            </button>
                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                            >
                                                Sauvegarder les modifications
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modale de suppression -->
                        <div
                            class="modal fade"
                            id="deleteAuthorModal{{ $author->id }}"
                            tabindex="-1"
                            aria-labelledby="deleteAuthorModalLabel{{ $author->id }}"
                            aria-hidden="true"
                        >
                            <div
                                class="modal-dialog modal-sm modal-dialog-centered"
                            >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5
                                            class="modal-title"
                                            id="deleteAuthorModalLabel{{ $author->id }}"
                                        >
                                            Confirmer la suppression
                                        </h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer
                                        l'auteur "{{ $author->name }}" ?
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal"
                                        >
                                            Annuler
                                        </button>
                                        <form
                                            action="{{ route('author.destroy', $author->id) }}"
                                            method="POST"
                                            style="display: inline"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                            >
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Aucun auteur trouvé.
                            </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Ici, vous pourriez ajouter la pagination si nécessaire --}}
            {{--
            <div class="mt-3">$authors->links()</div>
            --}}
        </div>
    </div>
</div>

<div
    class="modal fade"
    id="addAuthorModal"
    tabindex="-1"
    aria-labelledby="addAuthorModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAuthorModalLabel">
                    Ajouter un nouvel auteur
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            {{-- Assurez-vous que la route existe et pointe vers la méthode
            `store` de votre AuthorController --}}
            <form action="{{ route('author.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="authorName" class="form-label"
                            >Nom complet</label
                        >
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="authorName"
                            name="name"
                            required
                            placeholder="Ex: John Doe"
                        />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="authorEmail" class="form-label"
                            >Adresse Email</label
                        >
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="authorEmail"
                            name="email"
                            required
                            placeholder="Ex: john.doe@example.com"
                        />
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
