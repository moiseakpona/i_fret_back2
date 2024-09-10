
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
                        <span class="text-muted fw-light">Tableau de bord /</span> Paiement
                     </h4>
        
                     <!-- Fixed Header -->
                    <div class="content mt-3">
                        <div class="animated fadeIn">
                            <div class="row">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">Liste des fret ajoutés</strong>
                                        </div>
                                        <div class="card-body table-responsive mb-3">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Chargeur</th>
                                                        <th>Transporteur</th>
                                                        <th>Fret</th>
                                                        <th>Lieu de depart</th>
                                                        <th>Lieu d'arriver</th>
                                                        <th>Montant</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="sorting_1">
                                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2">
                                                                    <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column"><a href="" spellcheck="false"><span class="fw-medium">AKPONA Moïse</span></a><small class="text-muted">+22990270530</small>
                                                            </div>
                                                            </div>
                                                        </td>
                                                        <td class="sorting_1">
                                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2">
                                                                    <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column"><a href="" spellcheck="false"><span class="fw-medium">AKPONA Moïse</span></a><small class="text-muted">+22990270530</small>
                                                            </div>
                                                            </div>
                                                        </td>
                                                        <td>15 sacs de maïs	</td>
                                                        <td>Cotonou</td>
                                                        <td>Parakou</td>
                                                        <td>100 000F CFA</td>
                                                        <td>
                                                            <span class="badge bg-label-warning me-1">En cours</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="sorting_1">
                                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2">
                                                                    <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column"><a href="" spellcheck="false"><span class="fw-medium">AKPONA Moïse</span></a><small class="text-muted">+22990270530</small>
                                                            </div>
                                                            </div>
                                                        </td>
                                                        <td class="sorting_1">
                                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2">
                                                                    <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column"><a href="" spellcheck="false"><span class="fw-medium">AKPONA Moïse</span></a><small class="text-muted">+22990270530</small>
                                                            </div>
                                                            </div>
                                                        </td>
                                                        <td>200 sacs de charbon</td>
                                                        <td>Cotonou</td>
                                                        <th>Djougou </th>
                                                        <td>1 000 000F CFA</td>
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
                     
 
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->