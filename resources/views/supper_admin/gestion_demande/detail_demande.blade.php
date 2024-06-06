
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
                <span class="text-muted fw-light">Gestion / Gestion demandes/ </span> Détail
                </h4>
                

                <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row">
                        <li class="nav-item"><a class="nav-link active" href="{{ route('gestion_demande') }}"><i class="bx bx-food-menu me-1"></i> Gestion demandes / Détails</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('gestion_fret') }}"><i class="bx bxs-truck me-1"></i> Gestion frets</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('fret_diponible') }}"><i class="bx bxs-truck me-1"></i> frets diponibles</a></li>
                    </ul>
                
                    <h4 class="py-3 mb-4 pb-4">
                        <span class="text-muted fw-light"></span>
                        <a href="{{ route('gestion_demande')}}" class="btn btn-primary float-end">< Retour (Gestion demandes)</a>
                    </h4>

                    <!-- Fixed Header -->
                    <div class="content mt-3 pt-4">
                        <div class="animated fadeIn">
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-10">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title"></strong>                                   
                                        </div>
                                        <div class="card-body">
                                    
                                            <div class="table-responsive">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <h4>Détails soumission :</h4>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Section Camion -->
                                                        <tr>
                                                            <td><h1></h1></td>
                                                            <td><h1></h1></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h4>Véhicule :</h4></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <div class="mb-3">
                                                                <td><label">Numéro Matricule</label></td> 
                                                                <td><a href="#">DC 3467</a></td>
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <div class="mb-3">
                                                                <td><label">Modèle</label></td> 
                                                                <td><span>Fourgonnette 0 - 10 Tonnes</span></td>
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <div class="mb-3">
                                                                <td><label">Montant</label></td> 
                                                                <td><span>1.000.000F CFA</span></td>
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <td><h1></h1></td>
                                                            <td><h1></h1></td>
                                                        </tr>

                                                        <!-- Section propriétaire -->
                                                        <tr>
                                                            <td><h4>Propriétaire :</h4></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <div class="mb-3">
                                                                <td>Profil :</td> 
                                                                <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="#" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Transporteur</small></div></div></td> 
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <div class="mb-3">
                                                                <td>Contact</td>
                                                                <td>+229 90345878</td>
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <td><h1></h1></td>
                                                            <td><h1></h1></td>
                                                        </tr>

                                                        <!-- Section Chauffeur -->
                                                        <tr>
                                                            <td><h4>Chauffeur :</h4></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Profil :</td> 
                                                            <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/17.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="#" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Chauffeur</small></div></div></td> 
                                                        </tr>
                                                        <tr>
                                                            <td>Contact</td>
                                                            <td>+229 90345878</td>
                                                        </tr>
                                                        <tr>
                                                            <td><h1></h1></td>
                                                            <td><h1></h1></td>
                                                        </tr>

                                                        <!-- Section Chargeurs -->
                                                        <tr>
                                                            <td><h4>Chargeur(s) :</h4></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Profil :</td> 
                                                            <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/17.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="#" spellcheck="false"><span class="fw-medium">Yank Luddy</span></a><small class="text-muted">Chauffeur</small></div></div></td> 
                                                        </tr>
                                                        <tr>
                                                            <td>Contact</td>
                                                            <td>+229 90345878</td>
                                                        </tr>
                                                        <tr>
                                                            <div class="mb-3">
                                                              <td>Description Fret</td>
                                                              <td>1O Tonnes de maïs</td>
                                                            </div>
                                                          </tr>
                                                          <tr>
                                                            <div class="mb-3">
                                                              <td>Lieu de depart</td>
                                                              <td>Cotonou</td>
                                                            </div>
                                                          </tr>
                                                          <tr>
                                                            <div class="mb-3">
                                                              <td>Lieu d'arrivée</td>
                                                              <td>Djougou</td>
                                                            </div>
                                                          </tr>
                                                        <tr>
                                                            <td><h1></h1></td>
                                                            <td><h1></h1></td>
                                                        </tr>

                                                        <!-- Section Statut -->
                                                        <tr>
                                                            <td><h4>Statut de la demande :</h4></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <select class="form-select" id="statut" name="statut">    
                                                                    <option value="en_cours">En cours</option>
                                                                    <option value="finalise">Finalisé</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary">Enregistrer</button>
                                                            </td>
                                                        </div>
                                                        </tr>
                                                        <tr>
                                                            <td><h1></h1></td>
                                                            <td><h1></h1></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                    
                                        </div> 

                                        <div class="card-footer d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary">Fermer</button>
                                            {{-- <button type="button" class="btn btn-primary ms-auto">Valider camion</button> --}}
                                        </div>

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
        <!-- / Content -->
        <!-- Footer -->
        @include('supper_admin.partials.footer')
        <!-- / Footer -->

<!-- beautify ignore:end -->