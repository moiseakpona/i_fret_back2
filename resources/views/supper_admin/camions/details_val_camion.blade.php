
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
                        <span class="text-muted fw-light">Camion /</span> Détail camion
                        <a href="{{ route('camions.en_attent')}}" class="btn btn-primary float-end">< Retour</a>
                     </h4>

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
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                      <button type="submit" name="action" value="valider" class="btn btn-primary">Valider</button>
                                      <button type="submit" name="action" value="rejeter" class="btn btn-danger">Rejeter</button>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /NumeralJS -->

                      <!-- NumeralJS -->
                      <div class="col-12">
                        <div class="card">
                          <h5 class="card-header">#2</h5>
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
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                      <button type="submit" name="action" value="valider" class="btn btn-primary">Valider</button>
                                      <button type="submit" name="action" value="rejeter" class="btn btn-danger">Rejeter</button>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /NumeralJS -->
                     
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->