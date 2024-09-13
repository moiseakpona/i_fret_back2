
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
                        <span class="text-muted fw-light">Camions /</span> Validés
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
                                                     <th>Matricule</th>
                                                     <th>Visite Technique</th>
                                                     <th>Assurance</th>
                                                     <th>Statut</th>
                                                     <th>Action</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                              @foreach ($valide as $valides)
                                                 <tr>
                                                   <td>{{ $valides->matricule }}</td>
                                                   <td>
                                                    @if (\Carbon\Carbon::parse($valides->visite_exp)->isPast())
                                                        <span class="badge bg-label-danger me-1">Expirée</span>
                                                    @else
                                                        <span class="badge bg-label-success me-1">À jour</span>
                                                    @endif
                                                   </td>
                                                   <td>
                                                    @if (\Carbon\Carbon::parse($valides->assurance_exp)->isPast())
                                                        <span class="badge bg-label-danger me-1">Expirée</span>
                                                    @else
                                                        <span class="badge bg-label-success me-1">À jour</span>
                                                    @endif
                                                   </td>
                                                   <td>
                                                    <span class="badge bg-label-success me-1">{{ $valides->statut }}</span>
                                                   </td>
                                                   <td><a href="{{ route('detail_valide', ['id' => $valides->id]) }}" class="btn btn-primary">Voir <span class="tf-icon bx bx-plus bx-xs me-1"></span></a></button></td>
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


                 <!-- Le modal Voir Plus -->
                 <div class="modal fixed-right fade" id="plusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog modal-dialog-slideout">
                     <div class="modal-content">
                       <div class="modal-header">
                         <h4 class="modal-title" id="exampleModalLabel">Historique de la demande</h4>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       </div>
                       <div class="modal-body">

                     <!-- NumeralJS -->
                      <div class="col-12 mb-4">
                        <div class="card">
                          <h5 class="card-header">#1</h5>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table ">
                                <thead>
                                  <tr>
                                    <th class="border-top-0">Nom</th>
                                    <th class="border-top-0">Fichier</th>
                                    <th class="border-top-0">Commentaire</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Numéro matricule</td>
                                    <td>3467479682787</td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td>Photo du véhicule</td>
                                    <td><a href="{{ asset('images/Fadil_page-0001.jpg') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td>Carte Grise</td>
                                    <td><a href="{{ asset('images/1.pdf') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td>Visite Technique</td>
                                    <td><a href="{{ asset('images/1.pdf') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                    <td>
                                       
                                      <label for="date">Date d'expiration :</label>
                                      <input class="form-control" type="date" id="date" name="date">
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Assurance</td>
                                    <td><a href="{{ asset('images/1.pdf') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                    <td>
                                       
                                      <label for="date">Date d'expiration :</label>
                                      <input class="form-control" type="date" id="date" name="date">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /NumeralJS -->

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
                           </tbody>
                        </table>
                        </div> 

                       </div>
                       <div class="modal-footer">
                         <button type="button" class="btn btn-primary">Alerter</button>
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                       </div>
                     </div>
                   </div>
                 </div>


                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->