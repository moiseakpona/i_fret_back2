
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
                                                        <th>Nom & Prénoms</th>
                                                        <th>Contact</th>
                                                        <th>Data de naissance</th>
                                                        <th>Ville</th>
                                                        <th>Permis</th>
                                                        <th>fichier</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($chauffeursAvecDetails as $chauffeurAvecDetails)
                                                    <tr>
                                                        <td class="sorting_1">
                                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                                <div class="avatar-wrapper">
                                                                    <div class="avatar me-2">
                                                                        @if ($chauffeurAvecDetails['chauffeur']->photo)
                                                                            <img src="{{ $chauffeurAvecDetails['chauffeur']->photo }}" alt="Photo de profil" class="rounded-circle">
                                                                        @else
                                                                            <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_chauffeur', ['numero_tel' => $chauffeurAvecDetails['chauffeur']->numero_tel]) }}" spellcheck="false"><span class="fw-medium">{{ $chauffeurAvecDetails['chauffeur']->nom }} {{ $chauffeurAvecDetails['chauffeur']->prenom }}</span></a><small class="text-muted">{{ $chauffeurAvecDetails['chauffeur']->type_compte }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $chauffeurAvecDetails['chauffeur']->numero_tel }}</td>
                                                        <th>{{ $chauffeurAvecDetails['chauffeur']->date_naissance }}</th>
                                                        <td>{{ $chauffeurAvecDetails['chauffeur']->ville }}</td>
                                                        <td>{{ $chauffeurAvecDetails['details']->num_permis }}</td>
                                                        <td><a href="{{ $chauffeurAvecDetails['details']->permis }}" target="_blank">Permis de conduire</a></td>
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
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->