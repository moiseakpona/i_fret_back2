
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
                        <span class="text-muted fw-light">Utilisateurs /</span> details chauffeur
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
                            Date de création 
                          </h4>
                          <p class="mb-0">
                            {{ $chauffeur->created_at }}
                          </p>
                        </div>
                        <button type="button" class="btn btn-label-danger delete-customer" data-bs-toggle="modal" data-bs-target="#confirmationModal">Supprimer le compte</button>
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
                              Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                              <form action="{{ route('supprimer_chauffeur', $chauffeur->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                      <div class="row">
                        <!-- Customer-detail Sidebar -->
                        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                          <!-- Customer-detail Card -->
                          <div class="card mb-4">
                            <div class="card-body">
                              <div class="customer-avatar-section">
                                <div class="d-flex align-items-center flex-column">

                                  @if ($chauffeur->photo)
                                    <img class="img-fluid rounded my-3" src="{{ $chauffeur->photo }}" height="110" width="110" alt="User avatar">
                                  @else
                                    <img class="img-fluid rounded my-3" src="{{ asset('images/default_profile_photo.png') }}" height="110" width="110" alt="User avatar">
                                  @endif

                                  <div class="customer-info text-center">
                                    <h4 class="mb-1">{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</h4>
                                    <small>{{ $chauffeur->type_compte }}</small>
                                  </div>
                                </div>
                              </div>
                              <div class="info-container">
                                <small class="d-block pt-2 border-top fw-normal text-uppercase text-muted my-2"></small>

                                <div>
                                  <table class="table table-borderless">
                                  <tbody>
                                      <tr>
                                          <td> Contact </td>
                                          <td>:</td>
                                          <td style="font-weight: 600">{{ $chauffeur->numero_tel }}</td>
                                      </tr>
                                      <tr>
                                        <td> Date de naissance </td>
                                        <td>:</td>
                                        <td style="font-weight: 600">{{ $chauffeur->date_naissance }}</td>
                                      </tr>
                                      <tr>
                                        <td> Ville </td>
                                        <td>:</td>
                                        <td style="font-weight: 600">{{ $chauffeur->ville }}</td>
                                      </tr>
                                      <tr>
                                        <td>N° Permis </td>
                                        <td>:</td>
                                        @if ($details)
                                          <td style="font-weight: 600">{{ $details->num_permis }}</td>
                                        @else
                                          <td style="font-weight: 600">N/A</td>
                                        @endif
                                        <td style="font-weight: 600">{{ $details->num_permis }}</td>
                                      </tr>
                                      <tr>
                                        <td> Permis de conduire </td>
                                        <td>:</td>
                                        @if ($details)
                                          <td style="font-weight: 600"><a href="{{ $details->permis }}" target="_blank">Fichier </a></td>
                                        @else
                                          <td style="font-weight: 600">N/A</td>
                                        @endif
                                      </tr>
                                  </tbody>
                                  </table>
                                </div>
                                
                                <div class="d-flex justify-content-center mt-3">
                                  <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Modifier Profil</a>
                      
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /Customer-detail Card -->
                        </div>
                        <!--/ Customer Sidebar -->
                      
                      
                        <!-- Customer Content -->
                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

                            <!-- / Customer cards -->
                            <div class="row text-nowrap">
                                <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                    <div class="card-icon mb-3">
                                        <div class="avatar">
                                        <div class="avatar-initial rounded bg-label-primary"><i class='bx bx-dollar bxs-truck'></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <h4 class="card-title mb-3">Total voyages</h4>
                                        <div class="d-flex align-items-end mb-1 gap-1">
                                        <h4 class="text-primary mb-0">27</h4>
                                        <p class="mb-0"></p>
                                        </div>
                                        <p class="text-muted mb-0 text-truncate">Nombre total de voyages effectués</p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                    <div class="card-icon mb-3">
                                        <div class="avatar">
                                        <div class="avatar-initial rounded bg-label-primary"><i class='bx bx-cart-alt bxs-truck'></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <h4 class="card-title mb-3">Total véhicule</h4>
                                        <div class="d-flex align-items-end mb-1 gap-1">
                                        <h4 class="text-primary mb-0">34</h4>
                                        <p class="mb-0"></p>
                                        </div>
                                        <p class="text-muted mb-0 text-truncate">Nombre total de véhicule conduit</p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- / customer cards -->
                        </div>
                        <!--/ Customer Content -->
                      </div>

                    <!-- Fixed Header -->
                    <div class="content mt-3">
                        <div class="animated fadeIn">
                            <div class="row">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Liste des voyages éffectués</strong>
                                        </div>
                                        <div class="card-body table-responsive mb-3">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Fret</th>
                                                        <th>Lieu de depart</th>
                                                        <th>Lieu d'arriver</th>
                                                        <th>Prix</th>
                                                        <th>Date Emission</th>
                                                        <th>Date Finalisation</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>#001</td>
                                                        <td>15 sacs de maïs	</td>
                                                        <td>Cotonou</td>
                                                        <th>Parakou</th>
                                                        <td>100 000F CFA</td>
                                                        <td>03/03/2024</td>
                                                        <td></td>
                                                        <td>
                                                            <span class="badge bg-label-warning me-1">En cours</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>#001</td>
                                                        <td>200 sacs de charbon</td>
                                                        <td>Cotonou</td>
                                                        <th>Djougou</th>
                                                        <td>1 000 000F CFA</td>
                                                        <td>03/02/2024</td>
                                                        <td>10/02/2024</td>
                                                        <td>
                                                            <span class="badge bg-label-success me-1">Finalisé</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div><!-- .animated -->
                    </div><!-- .content -->
                    <!--/ Fixed Header -->
                    
                      
                      <!-- Modal -->
                      <!-- Edit User Modal -->
                      <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                          <div class="modal-content p-3 p-md-5">
                            <div class="modal-body">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              <div class="text-center mb-4">
                                <h3>Formulaire de modification</h3>
                                <p>Modifier le profil de l'utilisateur</p>
                              </div>
                              <form id="editUserForm" class="row g-3" method="POST" action="{{ route('update_admin', $chauffeur->id) }}">
                                @csrf
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="FirstName">Nom</label>
                                  <input type="text" id="FirstName" name="nom" class="form-control" value="{{ $chauffeur->nom }}" />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="LastName">Prénom</label>
                                  <input type="text" id="LastName" name="prenom" class="form-control" value="{{ $chauffeur->prenom }}" />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="DateNaissance">Date de maissance</label>
                                  <input type="date" id="DateNaissance" name="date_naissance" class="form-control" value="{{ $chauffeur->date_naissance }}" />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="Compte">Type de compte</label>
                                  <select id="Compte" name="type_compte" class="form-select" >
                                    <option value="Chauffeur">Chauffeur</option>
                                    <option value="Chargeur">Chargeur</option>
                                    <option value="Transporteur">Transporteur</option>
                                  </select>
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="Phone">Contact</label>
                                  <div class="input-group input-group-merge">
                                    <input type="text" id="Phone" name="numero_tel" class="form-control phone-number-mask" value="{{ $chauffeur->numero_tel }}" />
                                  </div>
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="Country">Ville</label>
                                  <select id="Country" name="ville" class="select2 form-select" data-allow-clear="true">
                                    <option value="{{ $chauffeur->ville }}">{{ $chauffeur->ville }}</option>
                                    <option value="Parakou">Parakou</option>
                                    <option value="Cotonou">Cotonou</option>
                                    <option value="Djougou">Djougou</option>
                                    <option value="Bohicon">Bohicon</option>
                                  </select>
                                </div>
                                <div class="col-12">
                                </div>
                                <div class="col-12 text-center">
                                  <button type="submit" class="btn btn-primary me-sm-3 me-1">Enregistrer</button>
                                  <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--/ Edit User Modal -->
                      
 
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->