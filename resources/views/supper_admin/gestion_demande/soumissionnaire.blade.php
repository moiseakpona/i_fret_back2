
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
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-xs btn-primary plus-btn" data-bs-toggle="modal" data-bs-target="#plusModal">
                                                              <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                          </button>
                                                        </td>
                                                        <td>AC 3467</td>
                                                        <td>Cotonou</td>
                                                        <td>
                                                          <span class="badge bg-label-success me-1">A jour</span>
                                                        </td>
                                                        <td>
                                                          <span class="badge bg-label-success me-1">A jour</span>
                                                        </td>
                                                        <td>
                                                          <span class="badge bg-label-success me-1">A jour</span>
                                                        </td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
              
                              </div>
                          </div><!-- .animated -->
                      </div><!-- .content -->
                      <!--/ Fixed Header -->
                    </div>

  
                    <!-- Le modal Plus -->
                <div class="modal fixed-right fade" id="plusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-slideout">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Historique de la demande</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        <!-- Section Camion -->
                        <div class="table-responsive">
                          <table class="table table-borderless">
                            <tbody>
                              <tr>
                                <td><strong>Véhicule :</strong></td>
                                <td></td>
                              </tr>
                              <tr>
                                  <td>Numéro Matricule</td> 
                                  <td><a href="#">DC 3467</a></td>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td>Localisation du véhicule</td> 
                                  <td>Dassa</td>
                                </div>
                              </tr>
                              <tr>
                                <td><h4></h4></td>
                                <td><h4></h4></td>
                              </tr>
                              
                              <!-- Section transporteur -->
                              <tr>
                                <td><strong>Transporteur :</strong></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>Profil :</label></td> 
                                <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="#" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Transporteur</small></div></div></td> 
                              </tr>
                              <tr>
                                  <td>Contact</label></td>
                                  <td>+229 90345878</td>
                              </tr>
                              <tr>
                                <td><h4></h4></td>
                                <td><h4></h4></td>
                              </tr>

                              <!-- Section Chauffeur -->
                              <tr>
                                <td><strong>Chauffeur :</strong></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>Profil :</td> 
                                <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="#" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Transporteur</small></div></div>
                                </td> 
                              </tr>
                              <tr>
                                  <td>Contact</td>
                                  <td>+229 90345878</td>
                              </tr>
                              <tr>
                                <td><h4></h4></td>
                                <td><h4></h4></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>  
                       
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary">Valider camion</button>
                      </div>
                    </div>
                  </div>
                </div>
              <!--/ Le modal Plus -->


                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->