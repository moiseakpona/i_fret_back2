
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
                        <span class="text-muted fw-light">Utilisateurs /</span> Transporteur
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
                                            <strong class="card-title">Liste des transporteur</strong>
                                        </div>
                                        <div class="card-body table-responsive mb-3">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        {{-- <th></th> --}}
                                                        <th>Nom & Prénoms</th>
                                                        <th>Contact</th>
                                                        <th>Data de naissance</th>
                                                        <th>Ville</th>
                                                        <th>Véhicule validé</th>
                                                        <th>Véhicule rejété</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($transporteursDetails as $details)
                                                    <tr>
                                                        {{-- <td>
                                                            <button type="button" class="btn btn-xs btn-primary plus-btn" data-bs-toggle="modal" data-bs-target="#plusModal" data-nom="{{ $transporteur->nom }}" data-prenom="{{ $transporteur->prenom }}" data-type_compte="{{ $transporteur->type_compte }}" data-numero_tel="{{ $transporteur->numero_tel }}" data-date_naissance="{{ $transporteur->date_naissance }}" data-ville="{{ $transporteur->ville }}" data-photo="{{ $transporteur->photo }}" >
                                                            <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                            </button>
                                                        </td> --}}
                                                        <td class="sorting_1">
                                                        <div class="d-flex justify-content-start align-items-center customer-name">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2">
                                                                    @if ( $details['transporteur']->photo )
                                                                        <img src="{{$details['transporteur']->photo }}" alt="Photo de profil" class="rounded-circle">
                                                                    @else
                                                                        <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_transporteur', ['numero_tel' => $details['transporteur']->numero_tel]) }}" spellcheck="false"><span class="fw-medium">{{ $details['transporteur']->nom }} {{ $details['transporteur']->prenom }}</span></a><small class="text-muted">{{ $details['transporteur']->type_compte }}</small>
                                                            </div>
                                                        </div>
                                                        </td>
                                                        <td>{{ $details['transporteur']->numero_tel }}</td>
                                                        <th>{{ $details['transporteur']->date_naissance }}</th>
                                                        <td>{{ $details['transporteur']->ville }}</td>
                                                        <td>{{ $details['vehiculesValides'] }}</td>
                                                        <td>{{ $details['vehiculesRejetes'] }}</td>
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



                    {{-- <!-- Le modal Plus -->
                  <div class="modal fixed-right fade" id="plusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-slideout">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <!-- Section Chauffeur -->
                        <div class="table-responsive">
                            <table class="table ">
                            <thead>
                                <h4>Details :</h4>
                            </thead>
                            <tbody>
                                <tr>
                                <div class="mb-3">
                                    <td style="font-weight: 600; ">Profil :</td> 
                                    <td class="sorting_1">
                                        <div class="d-flex justify-content-start align-items-center customer-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2">
                                                    @if (isset($chargeur) && $chargeur->photo)
                                                        <img src="{{ $chargeur->photo }}" alt="Photo de profil" class="rounded-circle">
                                                    @else
                                                        <img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil" class="rounded-circle">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_transporteur') }}" spellcheck="false"><span class="fw-medium"><span id="nom"></span> <span id="prenom"></span></span></a><small class="text-muted"><span id="type_compte"></span></small>
                                            </div>
                                        </div>
                                    </td> 
                                </div>
                                </tr>
                                <tr>
                                <div class="mb-3">
                                    <td style="font-weight: 600; "> Contact :</td>
                                    <td id="numero_tel" style="font-weight: 600; color:green;"></td>
                                </div>
                                </tr>
                                <tr>
                                <div class="mb-3">
                                    <td style="font-weight: 600; "> Data de naissance :</td>
                                    <td id="date_naissance" style="font-weight: 600; color:green;"></td>
                                </div>
                                </tr>
                                <tr>
                                <div class="mb-3">
                                    <td style="font-weight: 600; "> Ville :</td>
                                    <td id="ville" style="font-weight: 600; color:green;"></td>
                                </div>
                                </tr>
                                <tr>
                                    <div class="mb-3">
                                        <td><label for="truckBrand" style="font-weight: 600">Véhicule validé:</label></td>
                                        <td><span id="truckBrand" style="font-weight: 600; color:green;">4</span></td>
                                    </div>
                                  </tr>
                                  <tr>
                                    <div class="mb-3">
                                        <td><label for="truckBrand" style="font-weight: 600">Véhicule rejété:</label></td>
                                        <td><span id="truckBrand" style="font-weight: 600; color:green;">0</span></td>
                                    </div>
                                  </tr>
                                  <tr>
                                    <div class="mb-3">
                                        <td><label for="truckBrand" style="font-weight: 600">Fichier :</label></td>
                                        <td><a href="{{ asset('images/Fadil_page-0001.jpg') }}" target="_blank">Avec php récupérer le nom du fichier dans la base de données</a></td>
                                    </div>
                                  </tr>
                            </tbody>
                            </table>
                        </div>  
                        </div>
                    </div>
                    </div>
                </div>
                <!--/ Le modal Plus -->



                <script>
                    document.querySelectorAll('.plus-btn').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const nom = btn.getAttribute('data-nom');
                            const prenom = btn.getAttribute('data-prenom');
                            const type_compte = btn.getAttribute('data-type_compte');
                            const numero_tel = btn.getAttribute('data-numero_tel');
                            const date_naissance = btn.getAttribute('data-date_naissance');
                            const ville = btn.getAttribute('data-ville');
                            const photo = btn.getAttribute('data-photo');
                            
            
                            document.getElementById('nom').innerText = nom;
                            document.getElementById('prenom').innerText = prenom;
                            document.getElementById('type_compte').innerText = type_compte;
                            document.getElementById('numero_tel').innerText = numero_tel;
                            document.getElementById('date_naissance').innerText = date_naissance;
                            document.getElementById('ville').innerText = ville;
                            document.getElementById('photo').innerText = photo;
                            document.getElementById('plusModal').style.display = 'block';
                        });
                    });
            
                    function closeModal() {
                        document.getElementById('plusModal').style.display = 'none';
                    }
                </script> --}}
                   
                   

                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->