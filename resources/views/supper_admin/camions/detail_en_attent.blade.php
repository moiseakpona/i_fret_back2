
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
                        <span class="text-muted fw-light">Véhicules /</span> Details véhicule en attent
                        <a href="{{ route('camions.en_attent')}}" class="btn btn-primary float-end">< Retour</a>
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



                     <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-4 text-center text-sm-start gap-2">
                        <div class="mb-2 mb-sm-0">
                          <h4 class="mb-1">
                            Date d'ajout 
                          </h4>
                          <p class="mb-0">
                            {{ $vehicule->created_at }}
                          </p>
                        </div>
                        <button type="button" class="btn btn-label-danger delete-customer" data-bs-toggle="modal" data-bs-target="#confirmationModal">Supprimer le véhicule</button>
                    </div>

                    <!-- Modal confirmation de Suppression de compte-->
                    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation de suppression</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer ce véhicule ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <form action="{{ route('supprimer_vehicule_en_attent', $vehicule->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>


                    <!-- NumeralJS -->
                    <div class="col-12 mb-4">
                        <div class="card">
                          <div class="card-header">
                            <strong style="font-size: 20px">Véhicule</strong>
                            <span class="badge bg-label-warning me-1 float-end" style="font-size: 15px">{{ $vehicule->statut }}</span>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-borderless">
                                <thead>
                                  <tr>
                                    <th style="font-size: 15px;">Nom</th>
                                    <th style="font-size: 15px;">Fichier</th>
                                    <th style="font-size: 15px;">Commentaire</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <form id="editUserForm" class="row g-3" method="POST" action="{{ route('forme_rejete_vehicule', $vehicule->id) }}">
                                        @csrf
                                        <tr>
                                            <td>Numéro matricule</td>
                                            <td>{{ $vehicule->matricule }}</td>
                                            <td><textarea class="form-control" name="matricule_commentaire"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Photo du véhicule</td>
                                            <td><a href="{{ $vehicule->photo_camion }}" target="_blank">{{ $vehicule->photo_camion }}</a></td>
                                            <td><textarea class="form-control" name="photo_camion_commentaire"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Carte Grise</td>
                                            <td><a href="{{ $vehicule->carte_grise }}" target="_blank">{{ $vehicule->carte_grise }}</a></td>
                                            <td><textarea class="form-control" name="carte_grise_commentaire"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Visite Technique</td>
                                            <td><a href="{{ $vehicule->visite_technique }}" target="_blank">{{ $vehicule->visite_technique }}</a></td>
                                            <td><textarea class="form-control" name="visite_technique_commentaire"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Assurance</td>
                                            <td><a href="{{ $vehicule->assurance }}" target="_blank">{{ $vehicule->assurance }}</a></td>
                                            <td><textarea class="form-control" name="assurance_commentaire"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><button type="submit" class="btn btn-danger">Rejeter</button></td>
                                        </tr>
                                    </form>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <div class="card-header">
                            <strong style="font-size: 20px">Propriétaire</strong>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td><label for="truckBrand" style="font-weight: 600; ">Profil :</label></td> 
                                        <td class="sorting_1">
                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                <div class="avatar-wrapper">
                                                    <div class="avatar me-2">
                                                        @if ($transporteur->photo)
                                                            <img src="{{ $transporteur->photo }}" alt="Photo de profil" class="rounded-circle">
                                                        @else
                                                            <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_transporteur', ['numero_tel' => $transporteur->numero_tel]) }}" spellcheck="false"><span class="fw-medium">{{ $transporteur->nom }} {{ $transporteur->prenom }}</span></a><small class="text-muted">{{ $transporteur->type_compte }}</small></div>
                                            </div>
                                        </td>
                                        <td><span>{{ $transporteur->numero_tel }}</span></td>
                                    </tr>
                                 </tbody>
                              </table>
                            </div>
                          </div>


                          <div class="card-header">
                            <strong style="font-size: 20px">Formulaire de validation</strong>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-borderless">
                                <thead>
                                    <tr>
                                      <th style="font-size: 15px;">Date d'expiration : Visite Technique </th>
                                      <th style="font-size: 15px;">Date d'expiration : Assurance</th>
                                      <th style="font-size: 15px;"></th>
                                    </tr>
                                  </thead>
                                <tbody>
                                    <form id="editUserForm" class="row g-3" method="POST" action="{{ route('forme_valide_vehicule', $vehicule->id) }}">
                                        @csrf
                                        <tr>
                                            <td>
                                                <input class="form-control" type="date" name="visite_exp">
                                            </td>
                                            <td>
                                                <input class="form-control" type="date" name="assurance_exp">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">Valider</button>
                                            </td>
                                        </tr>
                                    </form>
                                 </tbody>
                              </table>
                            </div>
                          </div>


                          <div class="modal-footer">
                          </div>

                        </div>
                      </div>

 
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->