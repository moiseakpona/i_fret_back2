
    <!-- Menu -->
    @include('supper_admin.partials.sidebar');
    <!-- / Menu -->
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        @include("supper_admin.partials.header")
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
            
                <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Gestion / Gestion demandes/ </span> Détail
                </h4>

                <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row">
                        <li class="nav-item"><a class="nav-link active" href="{{ route('gestion_demande') }}"><i class="bx bx-food-menu me-1"></i> Gestion demandes / Détails</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('gestion_fret') }}"><i class="bx bxs-truck me-1"></i> Gestion frets</a></li>
                    </ul>

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                              ×
                            </button>
                            {{session()->get('message')}}
                        </div> 
                      @endif

                      @if (session()->has('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                              ×
                            </button>
                            {{session()->get('error')}}
                        </div> 
                      @endif

                    <!-- Fixed Header -->
                    <div class="content mt-3 pt-4">
                        <div class="animated fadeIn">
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-10">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title"></strong>                                   
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <h4>Détails soumission :</h4>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($resultatSoumi as $resultatSoumis)
                                                            @php
                                                                $soumissionnaire = $resultatSoumis['soumissionnaire'];
                                                                $transportUser = $resultatSoumis['transportUser'];
                                                                $chauffeurUser = $resultatSoumis['chauffeurUser'];
                                                                $vehicule = $resultatSoumis['vehicule'];
                                                            @endphp
                                                            <!-- Section Véhicule -->
                                                            <tr>
                                                                <td><h4>Véhicule :</h4></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <div class="mb-3">
                                                                    <td>Numéro Matricule</td> 
                                                                    <td><a href="#">{{ $vehicule->matricule }}</a></td>
                                                                </div>
                                                            </tr>
                                                            <tr>
                                                                <div class="mb-3">
                                                                    <td>Modèle</td> 
                                                                    <td><span>{{ $vehicule->modele }}</span></td>
                                                                </div>
                                                            </tr>
                                                            <!-- Section Transporteur -->
                                                            <tr>
                                                                <td><h4>Transporteur :</h4></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <div class="mb-3">
                                                                    <td>Profil :</td> 
                                                                    <td class="sorting_1">
                                                                        <div class="d-flex justify-content-start align-items-center customer-name">
                                                                            <div class="avatar-wrapper">
                                                                                <div class="avatar me-2">
                                                                                    @if (isset($transportUser->photo))
                                                                                        <img src="{{ $transportUser->photo }}" alt="Photo de profil" class="rounded-circle">
                                                                                    @else
                                                                                        <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex flex-column">
                                                                                <a href="{{ route('utilisateurs.details_transporteur', ['numero_tel' => $transportUser->numero_tel]) }}">
                                                                                    <span class="fw-medium">{{ $transportUser->nom }} {{ $transportUser->prenom }}</span>
                                                                                </a>
                                                                                <small class="text-muted">{{ $transportUser->type_compte }}</small>
                                                                            </div>
                                                                        </div>
                                                                    </td> 
                                                                </div>
                                                            </tr>
                                                            <tr>
                                                                <div class="mb-3">
                                                                    <td>Contact</td>
                                                                    <td>{{ $transportUser->numero_tel }}</td>
                                                                </div>
                                                            </tr>
                                                            <!-- Section Chauffeur -->
                                                            <tr>
                                                                <td><h4>Chauffeur :</h4></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Profil :</td> 
                                                                <td class="sorting_1">
                                                                    <div class="d-flex justify-content-start align-items-center customer-name">
                                                                        <div class="avatar-wrapper">
                                                                            <div class="avatar me-2">
                                                                                @if (isset($chauffeurUser->photo))
                                                                                    <img src="{{ $chauffeurUser->photo }}" alt="Photo de profil" class="rounded-circle">
                                                                                @else
                                                                                    <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-column">
                                                                            <a href="{{ route('utilisateurs.details_chauffeur', ['numero_tel' => $chauffeurUser->numero_tel]) }}">
                                                                                <span class="fw-medium">{{ $chauffeurUser->nom }} {{ $chauffeurUser->prenom }}</span>
                                                                            </a>
                                                                            <small class="text-muted">{{ $chauffeurUser->type_compte }}</small>
                                                                        </div>
                                                                    </div>
                                                                </td> 
                                                            </tr>
                                                            <tr>
                                                                <td>Contact</td>
                                                                <td>{{ $chauffeurUser->numero_tel }}</td>
                                                            </tr>
                                                        @endforeach

                                                        <!-- Section Chargeurs -->
                                                        <tr>
                                                            <td><h4>Chargeur(s) :</h4></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Profil :</td> 
                                                            <td class="sorting_1">
                                                                <div class="d-flex justify-content-start align-items-center customer-name">
                                                                    <div class="avatar-wrapper">
                                                                        <div class="avatar me-2">
                                                                            @if ($chargeur->photo)
                                                                                <img src="{{ $chargeur->photo }}" alt="Photo de profil" class="rounded-circle">
                                                                            @else
                                                                                <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex flex-column">
                                                                        <a href="{{ route('utilisateurs.details_chargeur', ['numero_tel' => $chargeur->numero_tel]) }}">
                                                                            <span class="fw-medium">{{ $chargeur->nom }} {{ $chargeur->prenom }}</span>
                                                                        </a>
                                                                        <small class="text-muted">{{ $chargeur->type_compte }}</small>
                                                                    </div>
                                                                </div>
                                                            </td> 
                                                        </tr>
                                                        <tr>
                                                            <td>Contact</td>
                                                            <td>{{ $chargeur->numero_tel }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Description Fret</td>
                                                            <td>{{ $fret->description }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Lieu de départ</td>
                                                            <td>{{ $fret->lieu_depart }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Lieu d'arrivée</td>
                                                            <td>{{ $fret->lieu_arrive }}</td>
                                                        </tr>

                                                        @if ($fret->statut === 'Finalisé')
                                                            
                                                        @else
                                                            <!-- Section Statut -->
                                                        <tr>
                                                            <td><h4>Statut de la demande :</h4></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Finaliser</button>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> 

                                        <div class="card-footer d-flex justify-content-between">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr class="my-5">

                    
                    <!-- Modal confirmation de la finalisation du fret -->
                    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="confirmationModalLabel">Confirmer la finalisation de la demande</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Êtes-vous sûr de vouloir marquer la fin de la demande ?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                              <form action="{{ route('finaliser', $fret->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Confirmer</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>


        </div>
        <!-- / Content -->
        <!-- Footer -->
        @include('supper_admin.partials.footer')
        <!-- / Footer -->

<!-- beautify ignore:end -->