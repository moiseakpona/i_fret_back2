
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
                          {{-- <li class="nav-item"><a class="nav-link" href="{{ route('fret_diponible') }}"><i class="bx bxs-truck me-1"></i> frets diponibles</a></li> --}}
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
                                                          <th>Date</th>
                                                          <th>Lieu de depart</th>
                                                          <th>Lieu d'arrivée</th>
                                                          <th>Montant</th>
                                                          <th>Statut</th>
                                                          <th>Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach ($demandes as $demande)
                                                        <tr>
                                                          <td>{{ $demande->created_at }}</td>
                                                          <td>{{ $demande->lieu_depart }}</td>
                                                          <td>{{ $demande->lieu_arrive }}</td>
                                                          <td>{{ $demande->montant }}</td>
                                                          <td>
                                                            <span class="badge bg-label-warning me-1">En cours</span>
                                                          </td>
                                                          <td>
                                                            <div class="dropdown">
                                                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                              <div class="dropdown-menu">
                                                                  <a class="dropdown-item" href="{{ route('detail_demande' , ['id' => $demande->id])}}"><i class="bx bx-food-menu me-1"></i> Détail</a>
                                                                  <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> Supprimé</a>
                                                              </div>
                                                          </div>
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
                  </div>
                </div>



                  </div>
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->