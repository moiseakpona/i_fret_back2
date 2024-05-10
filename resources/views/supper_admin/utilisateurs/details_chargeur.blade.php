
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
                        </div>
                        <button type="button" class="btn btn-label-danger delete-customer">Supprimer le compte</button>
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
                                        <div class="avatar-initial rounded bg-label-primary"><i class='bx bx-dollar bx-sm'></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <h4 class="card-title mb-3">Total payer</h4>
                                        <div class="d-flex align-items-end mb-1 gap-1">
                                        <h4 class="text-primary mb-0">200 345F CFA</h4>
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
                                        <h4 class="text-primary mb-0">34</h4>
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

                    <!-- Fixed Header -->
                    <div class="content mt-3">
                        <div class="animated fadeIn">
                            <div class="row">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Liste des fret ajoutés</strong>
                                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span class="tf-icon bx bx-plus bx-xs me-1">
                                                Ajouter une demande 
                                              </button>
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
                                                        <th>Action</th>
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
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                                <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                                                                </div>
                                                            </div>
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
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                                <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                                                                </div>
                                                            </div>
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

                    <hr class="my-5">
                    
                    <!-- Fixed Header -->
                    <div class="content mt-3">
                        <div class="animated fadeIn">
                            <div class="row">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Liste des tansactions</strong>
                                        </div>
                                        <div class="card-body table-responsive mb-3">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Id de transaction</th>
                                                        <th>Moyen de paiement</th>
                                                        <th>Nom & Prénom</th>
                                                        <th>Montant</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>#001</td>
                                                        <td>258904758598</td>
                                                        <td>
                                                            <span class="accordion-button-image">
                                                                <img src="../../assets/img/icons/payments/visa-light.png" class="img-fluid w-px-50 h-px-30" alt="visa-card" />
                                                            </span>
                                                        </td>
                                                        <th>Yank Luddy</th>
                                                        <td>500 000F CFA</td>
                                                        <td>03/03/2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td>#002</td>
                                                        <td>2004348588</td>
                                                        <td>
                                                            <span class="accordion-button-image">
                                                                <img src="../../assets/img/icons/payments/master-light.png" class="img-fluid w-px-50 h-px-30" alt="master-card"/>
                                                              </span>
                                                        </td>
                                                        <th>Djonou NOUAGOVI</th>
                                                        <td>1 000 000F CFA</td>
                                                        <td>03/02/2024</td>
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
                      
                      <!-- Modal  Ajouter demande de fret-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Formulaire d'ajout de fret</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="form-repeater">
                                    <div data-repeater-list="group-a">
                                    <div data-repeater-item>

                                        <div class="row mb-3">
                                        <div class="col">
                                            <label for="inputCity1" class="form-label"> Lieu de depart </label>
                                            <select class="form-select" id="inputCity1">
                                            <option selected disabled>Select City</option>
                                            <option value="Cotonou">Cotonou</option>
                                            <option value="Porto-Novo">Porto-Novo</option>
                                            <option value="Parakou">Parakou</option>
                                            <option value="Abomey-Calavi">Abomey-Calavi</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="inputCity2" class="form-label">Lieu d'arrivée</label>
                                            <select class="form-select" id="inputCity2">
                                            <option selected disabled>Select City</option>
                                            <option value="Cotonou">Cotonou</option>
                                            <option value="Porto-Novo">Porto-Novo</option>
                                            <option value="Parakou">Parakou</option>
                                            <option value="Abomey-Calavi">Abomey-Calavi</option>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="row mb-3">
                                        <div class="col">
                                            <label for="inputPrice" class="form-label">Price</label>
                                            <input type="number" class="form-control" id="inputPrice" placeholder="0.00">
                                        </div>
                                        <div class="col">
                                            <label for="inputDate" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="inputDate">
                                        </div>
                                        </div>  

                                        <div class="row mb-3 mt-3">
                                            <div class="col">
                                            <label for="inputDescription" class="form-label">Fret</label>
                                            <textarea class="form-control" id="inputDescription" rows="3"></textarea>
                                            </div>
                                        </div>  

                                    </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="button" class="btn btn-primary">Enregistrer</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <!--/ Modal Ajouter demande de fret -->
 
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->