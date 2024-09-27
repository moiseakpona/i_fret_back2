
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
                                                        <th>Chauffeur</th>
                                                        <th>Fret</th>
                                                        <th>Trajectoire</th>
                                                        <th>Montant Retenu</th>
                                                        <th>Montant Versé</th>
                                                        <th>Revenu</th>
                                                        <th>Statut</th>

                                                        @if(auth()->user()->type_compte == 'comptable')
                                                        <th>Action</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($resultats as $resultats)
                                                    <tr>
                                                        <td class="sorting_1">
                                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                                <div class="avatar-wrapper">
                                                                    <div class="avatar me-2">
                                                                        @if ( $resultats['chargeur']->photo )
                                                                            <img src="{{ $resultats['chargeur']->photo }}" alt="Photo de profil" class="rounded-circle">
                                                                        @else
                                                                            <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_chargeur', ['numero_tel' => $resultats['chargeur']->numero_tel]) }}" spellcheck="false"><span class="fw-medium">{{ $resultats['chargeur']->nom }} {{ $resultats['chargeur']->prenom }}</span></a><small class="text-muted">{{ $resultats['chargeur']->numero_tel }}</small>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="sorting_1">
                                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                                <div class="avatar-wrapper">
                                                                    <div class="avatar me-2">
                                                                        @if ( $resultats['transporteur']->photo )
                                                                            <img src="{{ $resultats['transporteur']->photo }}" alt="Photo de profil" class="rounded-circle">
                                                                        @else
                                                                            <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_transporteur', ['numero_tel' => $resultats['transporteur']->numero_tel]) }}" spellcheck="false"><span class="fw-medium">{{ $resultats['transporteur']->nom }} {{ $resultats['transporteur']->prenom }}</span></a><small class="text-muted">{{ $resultats['transporteur']->numero_tel }}</small>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="sorting_1">
                                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                                <div class="avatar-wrapper">
                                                                    <div class="avatar me-2">
                                                                        @if ( $resultats['chauffeur']->photo )
                                                                            <img src="{{ $resultats['chauffeur']->photo }}" alt="Photo de profil" class="rounded-circle">
                                                                        @else
                                                                            <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_chauffeur', ['numero_tel' => $resultats['chauffeur']->numero_tel]) }}" spellcheck="false"><span class="fw-medium">{{ $resultats['chauffeur']->nom }} {{ $resultats['chauffeur']->prenom }}</span></a><small class="text-muted">{{ $resultats['chauffeur']->numero_tel }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>{{ $resultats['fret']->description }} <br> ({{ $resultats['fret']->info_comp }}) </td>
                                                        <td>{{ $resultats['fret']->lieu_depart }} <br> à <br> {{ $resultats['fret']->lieu_arrive }} </td>
                                                        <td>{{ $resultats['soumissionnaire']->montant }} F CFA</td>
                                                        <td>{{ $resultats['fret']->montant }} F CFA <br> ({{ $resultats['fret']->kkiapay_transaction_id }})</td>
                                                        <td>{{ $resultats['soumissionnaire']->montant - $resultats['fret']->montant }} F CFA</td>
                                                        <td>{{ $resultats['fret']->montant }} F CFA</td>
                                                        <td>{{ $resultats['fret']->montant - $resultats['soumissionnaire']->montant }} F CFA</td>
                                                        <td>
                                                            @if ($resultats['soumissionnaire']->statut_paiement === 'payé')
                                                                <span class="badge bg-label-success me-1">{{ $resultats['soumissionnaire']->statut_paiement }}</span>
                                                            @else
                                                                <span class="badge bg-label-warning me-1">{{ $resultats['soumissionnaire']->statut_paiement }}</span>
                                                            @endif
                                                        </td>

                                                        @if(auth()->user()->type_compte == 'comptable')
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#confirmationModal"><i class="bx bx-add me-1"></i> Payer</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div><!-- .animated -->
                    </div><!-- .content -->
                    <!--/ Fixed Header -->


                    <!-- Modal confirmation de de paiement au transporteur-->
                    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="confirmationModalLabel">Confirmation de payement</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Êtes-vous sûr de vouloir payer cet transporteur ?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                              <form action="{{ route('payer', $resultats['soumissionnaire']->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Payer</button>
                              </form>
                            </div>
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