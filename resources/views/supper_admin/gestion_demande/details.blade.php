
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
                        <span class="text-muted fw-light">Gestion des demandes /</span> Details
                        <a href="{{ route('gestion_demande')}}" class="btn btn-primary float-end">< Retour</a>
                     </h4>


                     <!-- Fixed Header -->
                    <div class="content mt-3">
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
                                                        <th>#</th>
                                                        <th>Véhicule</th>
                                                        <th>Matricule</th>
                                                        <th>Visite Technique</th>
                                                        <th>Assurance</th>
                                                        <th>Permis de conduire</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                      <td>001</td>
                                                      <td>Fourgonnette 0 - 10 Tonnes</td>
                                                      <td>DC 3467</td>
                                                      <td>
                                                        <span class="badge bg-label-success me-1">A jour</span>
                                                      </td>
                                                      <td>
                                                        <span class="badge bg-label-danger me-1">Expiré(e)</span>
                                                      </td>
                                                      <td>
                                                        <span class="badge bg-label-success me-1">A jour</span>
                                                      </td>
                                                      <td>
                                                        <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#plusModal">
                                                          Voir <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                        </button>
                                                      </td>
                                                    </tr>
  
                                                    <tr>
                                                        <td>OO2</td>
                                                        <td>Camion 20 - 30 Tonnes</td>
                                                        <td>AC 3467</td>
                                                        <td>
                                                          <span class="badge bg-label-success me-1">A jour</span>
                                                        </td>
                                                        <td>
                                                          <span class="badge bg-label-success me-1">A jour</span>
                                                        </td>
                                                        <td>
                                                          <span class="badge bg-label-success me-1">A jour</span>
                                                        </td>
                                                      <td>
                                                        <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#plusModal">
                                                            Voir <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                        </button>
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
                          <table class="table ">
                            <thead>
                              <h4>Véhicule :</h4>
                            </thead>
                            <tbody>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600; ">Photo camion</label></td> 
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">h5kjc8khkh687jd</span></td> 
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Carte grise</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">h5kjc8khkh687jd</span></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Modèle</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">Fourgonnette 0 - 10 Tonnes</span></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600; ">Numéro de plaque</label></td> 
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">DC 3467</span></td> 
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Visite Technique</label></td>
                                  <td><a href="#"><span id="truckBrand" style="font-weight: 600; color:green;">h5kjc8khkh687jd</span></a></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Assurance</label></td>
                                  <td><a href="#"><span id="truckBrand" style="font-weight: 600; color:red;">h5kjc8khkh687jd</span></a></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600; ">Localisation du véhicule</label></td> 
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">Dassa</span></td> 
                                </div>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    
                        <hr class="my-5">

                        <!-- Section propriétaire -->
                        <div class="table-responsive">
                          <table class="table ">
                            <thead>
                              <h4>Propriétaire :</h4>
                            </thead>
                            <tbody>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600; ">Nom</label></td> 
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">MOUTAKILOU</span></td> 
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Prénom</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">Walide</span></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Contact</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">+229 90345878</span></td>
                                </div>
                              </tr>
                            </tbody>
                          </table>
                        </div> 

                        <hr class="my-5">

                        <!-- Section Chauffeur -->
                        <div class="table-responsive">
                          <table class="table ">
                            <thead>
                              <h4>Chauffeur :</h4>
                            </thead>
                            <tbody>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600; ">Nom</label></td> 
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">MOUTAKILOU</span></td> 
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Prénom</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">Walide</span></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Contact</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">+229 90345878</span></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Numéro du  permis</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">64790345878</span></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Permis de conduire</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">h5kjc8khkh687jd</span></td>
                                </div>
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