
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
                        <span class="text-muted fw-light">Gestion / Gestion frets /</span> Soumissionnaires
                     </h4>


                     <div class="row">
                      <div class="col-md-12">
                        <ul class="nav nav-pills flex-column flex-md-row">
                          <li class="nav-item"><a class="nav-link" href="{{ route('gestion_demande') }}"><i class="bx bx-food-menu me-1"></i> Gestion demandes </a></li>
                          <li class="nav-item"><a class="nav-link active" href="{{ route('gestion_fret') }}"><i class="bx bxs-truck me-1"></i> Gestion frets / Soumissionnaires</a></li>
                          <li class="nav-item"><a class="nav-link" href="{{ route('fret_diponible') }}"><i class="bx bxs-truck me-1"></i> frets diponibles</a></li>
                        </ul>

                        <h4 class="py-3 mb-4 pb-4">
                          <span class="text-muted fw-light"></span>
                          <a href="{{ route('gestion_fret')}}" class="btn btn-primary float-end">< Retour (Gestion frets)</a>
                        </h4>

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
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Liste des Véhicules soumissionnés</strong>
                                        </div>
                                        <div class="card-body">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Matricule</th>
                                                        <th>Localisation</th>
                                                        <th>Visite Technique</th>
                                                        <th>Assurance</th>
                                                        <th>Permis de conduire</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($resultats as $resultat)
                                                        @php
                                                            $soumissionnaire = $resultat['soumissionnaire'];
                                                            $transportUser = $resultat['transportUser'];
                                                            $chauffeurUser = $resultat['chauffeurUser'];
                                                            $vehicule = $resultat['vehicule'];
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-xs btn-primary plus-btn" data-bs-toggle="modal" data-bs-target="#plusModal"
                                                                    data-vehicule_matricule="{{ $vehicule->matricule }}"
                                                                    data-vehicule_localisation="{{ $soumissionnaire->localisation }}"
                                                                    data-transport_user_nom="{{ $transportUser->nom }}"
                                                                    data-transport_user_prenom="{{ $transportUser->prenom }}"
                                                                    data-transport_user_tel="{{ $transportUser->numero_tel }}"
                                                                    data-transport_user_type_compte="{{ $transportUser->type_compte }}"
                                                                    data-transport_user_photo="{{ $transportUser->photo }}"
                                                                    data-chauffeur_user_nom="{{ $chauffeurUser->nom }}"
                                                                    data-chauffeur_user_prenom="{{ $chauffeurUser->prenom }}"
                                                                    data-chauffeur_user_tel="{{ $chauffeurUser->numero_tel }}"
                                                                    data-chauffeur_user_type_compte="{{ $chauffeurUser->type_compte }}"
                                                                    data-chauffeur_user_photo="{{ $chauffeurUser->photo }}"
                                                                    data-soumissionnaire_id="{{ $soumissionnaire->id }}">
                                                                    <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                                </button>
                                                            </td>
                                                            <td>{{ $vehicule->matricule }}</td>
                                                            <td>{{ $soumissionnaire->localisation }}</td>
                                                            <td><span class="badge bg-label-success me-1">A jour</span></td>
                                                            <td><span class="badge bg-label-success me-1">A jour</span></td>
                                                            <td><span class="badge bg-label-success me-1">A jour</span></td>
                                                            <td>
                                                              @if ($soumissionnaire->statut == 'Retenu')
                                                                  <span class="badge bg-label-success me-1">{{ $soumissionnaire->statut }}</span>
                                                              @elseif ($soumissionnaire->statut == 'Rejetée')
                                                                  <span class="badge bg-label-danger me-1">{{ $soumissionnaire->statut }}</span>
                                                              @elseif ($soumissionnaire->statut == 'En cours')
                                                                <span class="badge bg-label-warning me-1">{{ $soumissionnaire->statut }}</span>
                                                              @endif
                                                          </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .animated -->
                      </div><!-- .content -->
                      <!--/ Fixed Header -->

                      <!-- Le modal Plus -->
                      <div class="modal fixed-right fade" id="plusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-slideout">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Historique de la demande</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Section Véhicule -->
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Véhicule :</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Numéro Matricule</td>
                                                    <td><a href="#"><span id="vehicule_matricule"></span></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Localisation du véhicule</td>
                                                    <td id="vehicule_localisation"></td>
                                                </tr>

                                                <!-- Section Transporteur -->
                                                <tr>
                                                    <td><strong>Transporteur :</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Profil :</td>
                                                    <td class="sorting_1">
                                                        <div class="d-flex justify-content-start align-items-center customer-name">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2">
                                                                    <img id="transport_user_photo" src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <a href="#" spellcheck="false">
                                                                    <span class="fw-medium" id="transport_user_nom"></span>
                                                                    <span class="fw-medium" id="transport_user_prenom"></span>
                                                                </a>
                                                                <small class="text-muted" id="transport_user_type_compte"></small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Contact</td>
                                                    <td id="transport_user_tel"></td>
                                                </tr>

                                                <!-- Section Chauffeur -->
                                                <tr>
                                                    <td><strong>Chauffeur :</strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Profil :</td>
                                                    <td class="sorting_1">
                                                        <div class="d-flex justify-content-start align-items-center customer-name">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2">
                                                                    <img id="chauffeur_user_photo" src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <a href="#" spellcheck="false">
                                                                    <span class="fw-medium" id="chauffeur_user_nom"></span>
                                                                    <span class="fw-medium" id="chauffeur_user_prenom"></span>
                                                                </a>
                                                                <small class="text-muted" id="chauffeur_user_type_compte"></small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Contact</td>
                                                    <td id="chauffeur_user_tel"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <!--/ Le modal Plus -->

                      <script>
                      document.querySelectorAll('.plus-btn').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const vehiculeMatricule = btn.getAttribute('data-vehicule_matricule');
                            const vehiculeLocalisation = btn.getAttribute('data-vehicule_localisation');
                            const transportUserNom = btn.getAttribute('data-transport_user_nom');
                            const transportUserPrenom = btn.getAttribute('data-transport_user_prenom');
                            const transportUserTel = btn.getAttribute('data-transport_user_tel');
                            const transportUserTypeCompte = btn.getAttribute('data-transport_user_type_compte');
                            const transportUserPhoto = btn.getAttribute('data-transport_user_photo');
                            const chauffeurUserNom = btn.getAttribute('data-chauffeur_user_nom');
                            const chauffeurUserPrenom = btn.getAttribute('data-chauffeur_user_prenom');
                            const chauffeurUserTel = btn.getAttribute('data-chauffeur_user_tel');
                            const chauffeurUserTypeCompte = btn.getAttribute('data-chauffeur_user_type_compte');
                            const chauffeurUserPhoto = btn.getAttribute('data-chauffeur_user_photo');
                            const soumissionnaireId = btn.getAttribute('data-soumissionnaire_id');

                            document.getElementById('vehicule_matricule').innerText = vehiculeMatricule;
                            document.getElementById('vehicule_localisation').innerText = vehiculeLocalisation;
                            document.getElementById('transport_user_nom').innerText = transportUserNom;
                            document.getElementById('transport_user_prenom').innerText = transportUserPrenom;
                            document.getElementById('transport_user_tel').innerText = transportUserTel;
                            document.getElementById('transport_user_type_compte').innerText = transportUserTypeCompte;
                            document.getElementById('transport_user_photo').src = transportUserPhoto ? transportUserPhoto : "{{ asset('images/default_profile_photo.png') }}";
                            document.getElementById('chauffeur_user_nom').innerText = chauffeurUserNom;
                            document.getElementById('chauffeur_user_prenom').innerText = chauffeurUserPrenom;
                            document.getElementById('chauffeur_user_tel').innerText = chauffeurUserTel;
                            document.getElementById('chauffeur_user_type_compte').innerText = chauffeurUserTypeCompte;
                            document.getElementById('chauffeur_user_photo').src = chauffeurUserPhoto ? chauffeurUserPhoto : "{{ asset('images/default_profile_photo.png') }}";

                            // Update the valider button with the soumissionnaire ID
                            document.querySelector('.valider-btn').setAttribute('data-soumissionnaire-id', soumissionnaireId);
                        });
                      });
                      </script>



                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->