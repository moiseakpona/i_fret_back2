
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
                        <span class="text-muted fw-light">Utilisateurs /</span> Chargeur
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
                                                      <th>Date d'inscription</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                @foreach ($liste_chargeur as $chargeur)
                                                  <tr>
                                                    <td class="sorting_1">
                                                    <div class="d-flex justify-content-start align-items-center customer-name">
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar me-2">
                                                                @if ($chargeur->photo)
                                                                    <img src="{{ $chargeur->photo }}" alt="Photo de profil" class="rounded-circle">
                                                                @else
                                                                    <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_chargeur', ['numero_tel' => $chargeur->numero_tel]) }}" spellcheck="false"><span class="fw-medium">{{ $chargeur->nom }} {{ $chargeur->prenom }}</span></a><small class="text-muted">{{ $chargeur->type_compte }}</small>
                                                        </div>
                                                        </div>
                                                      </td>
                                                      <td>{{ $chargeur->numero_tel }}</td>
                                                      <th>{{ $chargeur->date_naissance }}</th>
                                                      <td>{{ $chargeur->ville }}</td>
                                                      <td>{{ $chargeur->created_at }}</td>
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