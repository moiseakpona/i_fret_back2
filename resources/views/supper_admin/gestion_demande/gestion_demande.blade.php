
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
                        <span class="text-muted fw-light">Tableau de bord /</span> Gestion des demandes 
                     </h4>

                     <div class="row">
                      <div class="col-md-12">
                        <ul class="nav nav-pills flex-column flex-md-row mb-3">
                          <li class="nav-item"><a class="nav-link active" href="{{ route('gestion_demande') }}"><i class="bx bx-food-menu me-1"></i> Gestion demandes </a></li>
                          <li class="nav-item"><a class="nav-link" href="{{ route('gestion_fret') }}"><i class="bx bxs-truck me-1"></i> Gestion frets</a></li>
                          <li class="nav-item"><a class="nav-link" href="{{ route('fret_diponible') }}"><i class="bx bxs-truck me-1"></i> frets diponibles</a></li>
                        </ul>
                  
                        <!-- Fixed Header -->
                        <div class="content mt-3">
                          <div class="animated fadeIn">
                              <div class="row">
              
                                  <div class="col-md-12">
                                      <div class="card">
                                          <div class="card-header">
                                              <strong class="card-title">Liste des demandes</strong>                                  
                                          </div>
                                          <div class="card-body">
                                              <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                  <thead>
                                                      <tr>
                                                          <th></th>
                                                          <th>Numéro Matricule</th>
                                                          <th>Montant</th>
                                                          <th>Lieu de depart</th>
                                                          <th>Lieu d'arrivée</th>
                                                          <th>Statut</th>
                                                          <th>Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
                                                        <td>
                                                          <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#plusModal">
                                                            <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                          </button>
                                                        </td>
                                                        <td>DC 3467</td>
                                                        <td> 100000F CFA</td>
                                                        <td>Abomey-Calavi</td>
                                                        <td>Bohicon</td>
                                                        <td>
                                                          <span class="badge bg-label-warning me-1">En cours</span>
                                                        </td>
                                                        <td>
                                                          <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                            <div class="dropdown-menu">
                                                              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Supprimé</a>
                                                            </div>
                                                          </div>
                                                        </td>
                                                      </tr>

                                                      <tr>
                                                          <td>
                                                            <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#plusModal">
                                                              <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                            </button>
                                                          </td>
                                                          <td>AC 1934</td>
                                                          <td>500000F CFA</td>
                                                          <td>Djougou</td>
                                                          <td>Cotonou</td>
                                                          <td>
                                                            <span class="badge bg-label-success me-1">Finalisé</span>
                                                          </td>
                                                          <td>
                                                            <div class="dropdown">
                                                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                              <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Supprimé</a>
                                                              </div>
                                                            </div>
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
                          <table class="table ">
                            <thead>
                              <h4>Véhicule :</h4>
                            </thead>
                            <tbody>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Modèle</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">Fourgonnette 0 - 10 Tonnes</span></td>
                                  <td></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600; ">Numéro Matricule</label></td> 
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">DC 3467</span></td>
                                  <td></td>
                                </div>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>


                        <!-- Section propriétaire -->
                        <div class="table-responsive">
                          <table class="table ">
                            <thead>
                              <h4>Propriétaire :</h4>
                            </thead>
                            <tbody>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600; ">Profil :</label></td> 
                                  <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="#" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Transporteur</small></div></div></td> 
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Contact</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">+229 90345878</span></td>
                                </div>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div> 


                        <!-- Section Chauffeur -->
                        <div class="table-responsive">
                          <table class="table ">
                            <thead>
                              <h4>Chauffeur :</h4>
                            </thead>
                            <tbody>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600; ">Profil :</label></td> 
                                      <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/17.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="#" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Chauffeur</small></div></div></td> 
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Contact</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">+229 90345878</span></td>
                                </div>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>  


                        <!-- Section chargeur -->
                        <div class="table-responsive">
                          <table class="table ">
                            <thead>
                              <h4>Chargeur :</h4>
                            </thead>
                            <tbody>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600; ">Profil :</label></td> 
                                  <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="#" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Transporteur</small></div></div></td> 
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
                                  <td><label for="truckBrand" style="font-weight: 600">Description Fret(s)</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">1O Tonnes de maïs</span></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Lieu de depart</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">Cotonou</span></td>
                                </div>
                              </tr>
                              <tr>
                                <div class="mb-3">
                                  <td><label for="truckBrand" style="font-weight: 600">Lieu d'arrivée</label></td>
                                  <td><span id="truckBrand" style="font-weight: 600; color:green;">Djougou</span></td>
                                </div>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div> 

                        <!-- Section Statut -->
                        <div class="table-responsive">
                          <table class="table ">
                            <thead>
                              <h4>Modifier le statut de la demande : </h4>
                            </thead>
                            <tbody>
                              <tr>
                                <div class="mb-3">
                                  <td><label class="form-label" for="statut" style="font-weight: 600">Statut : </label></td> 
                                  <td>
                                    <select class="form-select" id="statut" name="statut">    
                                      <option value="en_cours">En cours</option>
                                      <option value="finalise">Finalisé</option>
                                    </select>
                                  </td>
                                  <td><button type="button" class="btn btn-primary">Valider</button></td>
                                </div>
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
              <!--/ Le modal Plus -->


                  </div>
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->