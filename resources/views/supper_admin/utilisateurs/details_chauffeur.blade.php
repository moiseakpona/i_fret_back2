
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

                     <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-4 text-center text-sm-start gap-2">
                        <div class="mb-2 mb-sm-0">
                          <h4 class="mb-1">
                            Date de création 
                          </h4>
                          <p class="mb-0">
                            13/01/2024 à 14:20:56
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
                                  <img class="img-fluid rounded my-3" src="../../assets/img/avatars/9.png" height="110" width="110" alt="User avatar" />
                                  <div class="customer-info text-center">
                                    <h4 class="mb-1">Yank Luddy</h4>
                                    <small>Chauffeur</small>
                                  </div>
                                </div>
                              </div>
                              <div class="info-container">
                                <small class="d-block pt-4 border-top fw-normal text-uppercase text-muted my-3">DETAILS</small>
                                <ul class="list-unstyled">
                                  <li class="mb-3">
                                    <span class="fw-medium me-2">Contact:</span>
                                    <span>+229 90270532</span>
                                  </li>
                                  <li class="mb-3">
                                    <span class="fw-medium me-2">Date de naissance:</span>
                                    <span>30/03/2000</span>
                                  </li>
                                  <li class="mb-3">
                                    <span class="fw-medium me-2">Vile:</span>
                                    <span>Parakou</span>
                                  </li>
                                  <li class="mb-3">
                                    <span class="fw-medium me-2">Permis:</span>
                                    <span>4567890</span>
                                  </li>
                                  <li class="mb-3">
                                    <span class="fw-medium me-2">Fichier:</span>
                                    <span><a href="{{ asset('images/Fadil_page-0001.jpg') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></span>
                                  </li>
                                </ul>
                                <div class="d-flex justify-content-center">
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
                                <p>Modifier profil de l'utilisateur.</p>
                              </div>
                              <form id="editUserForm" class="row g-3" onsubmit="return false">
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="modalEditUserFirstName">Nom</label>
                                  <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John" />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="modalEditUserLastName">Prénom</label>
                                  <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="Doe" />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="modalEditUserEmail">Date de maissance</label>
                                  <input type="date" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" placeholder="example@domain.com" />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="modalEditUserStatus">Type de compte</label>
                                  <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select" aria-label="Default select example">
                                    <option selected>Chargeur</option>
                                    <option value="1">Tranporteur</option>
                                    <option value="2">Chauffeur</option>
                                  </select>
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="modalEditUserPhone">Contact</label>
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text">+229</span>
                                    <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="202 555 0111" />
                                  </div>
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="modalEditUserCountry">Ville</label>
                                  <select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select</option>
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