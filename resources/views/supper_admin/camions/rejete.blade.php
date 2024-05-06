
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
                        <span class="text-muted fw-light">Camions /</span> Rejetés
                     </h4>

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
                                                     <th>#</th>
                                                     <th>Numéro matricule</th>
                                                     <th>Statut</th>
                                                     <th>Action</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <tr>
                                                   <td>1</td>
                                                   <td>immatriculation</td>
                                                   <td>
                                                     <span class="badge bg-label-danger me-1">Rejeté</span>
                                                   </td>
                                                   <td>
                                                      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#plusModal">Voir <span class="tf-icon bx bx-plus bx-xs me-1"></span></a>
                                                    </td>
                                                 </tr>

                                                 <tr>
                                                   <td>2</td>
                                                   <td>immatriculation</td>
                                                   <td>
                                                     <span class="badge bg-label-danger me-1">Rejeté</span>
                                                   </td>
                                                   <td>
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#plusModal">Voir <span class="tf-icon bx bx-plus bx-xs me-1"></span></a>
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


                 <!-- Le modal Voir Plus -->
              <div class="modal fixed-right fade" id="plusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-slideout">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h4 class="modal-title" id="exampleModalLabel">Historique de la demande</h4>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">

                      
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
                                  <td><textarea class="form-control"></textarea></td>
                                </tr>
                                <tr>
                                  <td>Photo du véhicule</td>
                                  <td><a href="{{ asset('images/Fadil_page-0001.jpg') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                  <td><textarea class="form-control"></textarea></td>
                                </tr>
                                <tr>
                                  <td>Carte Grise</td>
                                  <td><a href="{{ asset('images/1.pdf') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                  <td><textarea class="form-control"></textarea></td>
                                </tr>
                                <tr>
                                  <td>Visite Technique</td>
                                  <td><a href="{{ asset('images/1.pdf') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                  <td>
                                    <textarea class="form-control"></textarea> 
                                    <label for="date">Date d'expiration :</label>
                                    <input class="form-control" type="date" id="date" name="date">
                                  </td>
                                </tr>
                                <tr>
                                  <td>Assurance</td>
                                  <td><a href="{{ asset('images/1.pdf') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                  <td>
                                    <textarea class="form-control"></textarea> 
                                    <label for="date">Date d'expiration :</label>
                                    <input class="form-control" type="date" id="date" name="date">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    <!-- /NumeralJS -->

                     </div>
                     <div class="modal-footer">
                       <button type="submit" name="action" value="valider" class="btn btn-primary">Valider</button>
                       <button type="submit" name="action" value="rejeter" class="btn btn-danger">Rejeter</button>
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