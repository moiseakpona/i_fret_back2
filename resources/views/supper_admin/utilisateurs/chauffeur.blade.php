
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
                        <span class="text-muted fw-light">Utilisateurs /</span> Chauffeur
                    </h4>

                    <!-- Fixed Header -->
                    <div class="content mt-3">
                        <div class="animated fadeIn">
                            <div class="row">
            
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Liste des Chauffeurs</strong>
                                        </div>
                                        <div class="card-body">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Nom & Prénoms</th>
                                                        <th>Contact</th>
                                                        <th>Data de naissance</th>
                                                        <th>Ville</th>
                                                        <th>Permis</th>
                                                        <th>fichier</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#plusModal">
                                                              <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                            </button>
                                                          </td>
                                                        <td class="sorting_1">
                                                          <div class="d-flex justify-content-start align-items-center customer-name">
                                                              <div class="avatar-wrapper">
                                                                  <div class="avatar me-2"><img src="../../assets/img/avatars/17.png" alt="Avatar" class="rounded-circle">
                                                                  </div>
                                                              </div>
                                                              <div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_chauffeur') }}" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Chauffeur</small>
                                                              </div>
                                                          </div>
                                                        </td>
                                                        <td>+229 90270532</td>
                                                        <th>30/03/2000</th>
                                                        <td>Parakou</td>
                                                        <td>0486599</td>
                                                        <td><a href="{{ asset('images/Fadil_page-0001.jpg') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#plusModal">
                                                              <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                            </button>
                                                          </td>
                                                          <td class="sorting_1">
                                                              <div class="d-flex justify-content-start align-items-center customer-name">
                                                                  <div class="avatar-wrapper">
                                                                      <div class="avatar me-2"><img src="../../assets/img/avatars/10.png" alt="Avatar" class="rounded-circle">
                                                                      </div>
                                                                  </div>
                                                                  <div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_chauffeur') }}" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Chauffeur</small>
                                                                  </div>
                                                              </div>
                                                            </td>
                                                        <td>+229 95358070</td>
                                                        <th>05/12/1998</th>
                                                        <td>Cotonou</td>
                                                        <td>4634670</td>
                                                        <td><a href="{{ asset('images/Fadil_page-0001.jpg') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
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
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
  
                          <!-- Section Chauffeur -->
                          <div class="table-responsive">
                              <table class="table ">
                              <thead>
                                  <h4>Details :</h4>
                              </thead>
                              <tbody>
                                  <tr>
                                  <div class="mb-3">
                                      <td><label for="truckBrand" style="font-weight: 600; ">Profil :</label></td> 
                                      <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/17.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_chauffeur') }}" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Chauffeur</small></div></div></td> 
                                  </div>
                                  </tr>
                                  <tr>
                                  <div class="mb-3">
                                      <td><label for="truckBrand" style="font-weight: 600">Contact :</label></td>
                                      <td><span id="truckBrand" style="font-weight: 600; color:green;">+229 90345878</span></td>
                                  </div>
                                  </tr>
                                  <tr>
                                  <div class="mb-3">
                                      <td><label for="truckBrand" style="font-weight: 600">Data de naissance :</label></td>
                                      <td><span id="truckBrand" style="font-weight: 600; color:green;">18/03/19987</span></td>
                                  </div>
                                  </tr>
                                  <tr>
                                  <div class="mb-3">
                                      <td><label for="truckBrand" style="font-weight: 600">Ville :</label></td>
                                      <td><span id="truckBrand" style="font-weight: 600; color:green;">Parakou</span></td>
                                  </div>
                                  </tr>
                                  <tr>
                                    <div class="mb-3">
                                        <td><label for="truckBrand" style="font-weight: 600">Permis :</label></td>
                                        <td><span id="truckBrand" style="font-weight: 600; color:green;">4634679</span></td>
                                    </div>
                                  </tr>
                                  <tr>
                                    <div class="mb-3">
                                        <td><label for="truckBrand" style="font-weight: 600">Fichier :</label></td>
                                        <td><a href="{{ asset('images/Fadil_page-0001.jpg') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                    </div>
                                  </tr>
                              </tbody>
                              </table>
                          </div>  
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