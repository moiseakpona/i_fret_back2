
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
                        <span class="text-muted fw-light">Utilisateurs /</span> details chargeur
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
                            {{ $chargeur->created_at }}
                          </p>
                        @if(auth()->user()->type_compte != 'comptable')
                          </div>
                            <button type="button" class="btn btn-label-danger delete-customer" data-bs-toggle="modal" data-bs-target="#confirmationModal">Supprimer le compte</button>
                          </div>
                        @endif

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
                              <form action="{{ route('supprimer_chargeur', $chargeur->id) }}" method="POST">
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
                                  @if ($chargeur->photo)
                                    <img class="img-fluid rounded my-3" src="{{ $chargeur->photo }}" height="110" width="110" alt="User avatar">
                                  @else
                                    <img class="img-fluid rounded my-3" src="{{ asset('images/default_profile_photo.png') }}" height="110" width="110" alt="User avatar">
                                  @endif
                                  <div class="customer-info text-center">
                                    <h4 class="mb-1">{{ $chargeur->nom }} {{ $chargeur->prenom }}</h4>
                                    <small>Chargeur</small>
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
                                          <td style="font-weight: 600">{{ $chargeur->numero_tel }}</td>
                                      </tr>
                                      <tr>
                                        <td>Date de Naissance </td>
                                        <td>:</td>
                                        <td style="font-weight: 600">{{ $chargeur->date_naissance }}</td>
                                      </tr>
                                      <tr>
                                        <td> Ville </td>
                                        <td>:</td>
                                        <td style="font-weight: 600">{{ $chargeur->ville }}</td>
                                      </tr>
                                  </tbody>
                                  </table>
                                </div>

                                @if(auth()->user()->type_compte != 'comptable')
                                  <div class="d-flex justify-content-center mt-3">
                                    <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Modifier Profil</a>
                                  </div>
                                @endif
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
                                        <div class="avatar-initial rounded bg-label-primary"><i class='bx bx-dollar bx-sm'></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <h4 class="card-title mb-3">Total payer</h4>
                                        <div class="d-flex align-items-end mb-1 gap-1">
                                        <h4 class="text-primary mb-0">{{ $totalMontantPaye }} F CFA</h4>
                                        <p class="mb-0"></p>
                                        </div>
                                        <p class="text-muted mb-0 text-truncate">Total des transactions effectuées via l'application</p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                    <div class="card-icon mb-3">
                                        <div class="avatar">
                                        <div class="avatar-initial rounded bg-label-primary"><i class='bx bx-cart-alt bx-sm'></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <h4 class="card-title mb-3">Total demande</h4>
                                        <div class="d-flex align-items-end mb-1 gap-1">
                                        <h4 class="text-primary mb-0">{{ $fretCount }}</h4>
                                        <p class="mb-0"></p>
                                        </div>
                                        <p class="text-muted mb-0 text-truncate">Nombre total de de demande effectuées</p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- / customer cards -->
                        </div>
                        <!--/ Customer Content -->
                      </div>
{{-- 
                    <!-- Fixed Header -->
                    <div class="content mt-3">
                        <div class="animated fadeIn">
                            <div class="row">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Liste des fret ajoutés</strong>
                                        </div>
                                        <div class="card-body table-responsive mb-3">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Fret</th>
                                                        <th>Lieu de depart</th>
                                                        <th>Lieu d'arriver</th>
                                                        <th>Montant</th>
                                                        <th>Transporteur</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>15 sacs de maïs	</td>
                                                        <td>Cotonou <br> 2024-05-13 13:59:53</td>
                                                        <td>Parakou <br> 2024-05-13 13:59:53</td>
                                                        <td>100 000F CFA</td>
                                                        <td></td>
                                                        <td>
                                                            <span class="badge bg-label-warning me-1">En cours</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>200 sacs de charbon</td>
                                                        <td>Cotonou <br> 2024-05-13 13:59:53</td>
                                                        <th>Djougou <br> 2024-05-13 13:59:53 </th>
                                                        <td>1 000 000F CFA</td>
                                                        <td></td>
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
                    <!--/ Fixed Header --> --}}

                    <hr class="my-5">
                      
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
                              <form id="editUserForm" class="row g-3" method="POST" action="{{ route('update_admin', $chargeur->id) }}">
                                @csrf
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="FirstName">Nom</label>
                                  <input type="text" id="FirstName" name="nom" class="form-control" value="{{ $chargeur->nom }}" />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="LastName">Prénom</label>
                                  <input type="text" id="LastName" name="prenom" class="form-control" value="{{ $chargeur->prenom }}" />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="DateNaissance">Date de maissance</label>
                                  <input type="date" id="DateNaissance" name="date_naissance" class="form-control" value="{{ $chargeur->date_naissance }}" />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="Compte">Type de compte</label>
                                  <select id="Compte" name="type_compte" class="form-select"  value="{{ $chargeur->type_compte }}" >
                                    <option value="Chargeur">Chargeur</option>
                                    <option value="Transporteur">Transporteur</option>
                                    <option value="Chauffeur">Chauffeur</option>
                                  </select>
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="Phone">Contact</label>
                                  <div class="input-group input-group-merge">
                                    <input type="text" id="Phone" name="numero_tel" class="form-control phone-number-mask" value="{{ $chargeur->numero_tel }}" />
                                  </div>
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="Country">Ville</label>
                                  <select id="Country" name="ville" class="select2 form-select" data-allow-clear="true">
                                    <option value="{{ $chargeur->ville }}">{{ $chargeur->ville }}</option>
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
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->