
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('gestion_demande') }}"><i class="bx bx-food-menu me-1"></i> Gestion demandes </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gestion_fret') }}"><i class="bx bxs-truck me-1"></i> Gestion frets</a></li>
                    {{-- <li class="nav-item"><a class="nav-link active" href="{{ route('fret_diponible') }}"><i class="bx bxs-truck me-1"></i> frets diponibles</a></li> --}}
                </ul>
            
                <!-- Fixed Header -->
                <div class="content mt-3">
                    <div class="animated fadeIn">
                        <div class="row">
        
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Liste des frets diponibles</strong>                                   
                                    </div>
                                    <div class="card-body">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Description</th>
                                                    <th>Montant</th>
                                                    <th>Lieu de depart</th>
                                                    <th>Lieu d'arrivée</th>
                                                    <th>Date</th>
                                                    <th>Statut</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($resultats as $resultat)
                                                @php
                                                    $fret = $resultat['fret'];
                                                    $chargeur = $resultat['chargeur'];
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-xs btn-primary plus-btn" data-bs-toggle="modal" data-bs-target="#plusModal" data-nom="{{ $chargeur->nom }}" data-prenom="{{ $chargeur->prenom }}" data-type_compte="{{ $chargeur->type_compte }}" data-numero_tel="{{ $chargeur->numero_tel }}" data-date_naissance="{{ $chargeur->date_naissance }}" data-ville="{{ $chargeur->ville }}" data-photo="{{ $chargeur->photo }}" >
                                                        <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                        </button>
                                                    </td>
                                                    <td>{{ $fret->id }}. {{ $fret->description }}</td>
                                                    <td>{{ $fret->montant }} F CFA</td>
                                                    <td>{{ $fret->lieu_depart }}</td>
                                                    <td>{{ $fret->lieu_arrive }}</td>
                                                    <td>{{ $fret->created_at }}</td>
                                                    <td>
                                                        <span class="badge bg-label-warning me-1">{{ $fret->statut }}</span>
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



        <!-- Le modal Plus -->
        <div class="modal fixed-right fade" id="plusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-slideout">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                <!-- Section chargeur -->
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
                                    <div class="d-flex flex-column"><a href="#" spellcheck="false"><span class="fw-medium"><span id="nom"></span> <span id="prenom"></span></span></a><small class="text-muted"><span id="type_compte"></span></small>
                                    </div>
                                </div>
                            </td> 
                        </div>
                        </tr>
                        <tr>
                        <div class="mb-3">
                            <td style="font-weight: 600; "> Contact :</td>
                            <td id="numero_tel"></td>
                        </div>
                        </tr>
                        <tr>
                        <div class="mb-3">
                            <td style="font-weight: 600; "> Data de naissance :</td>
                            <td id="date_naissance"></td>
                        </div>
                        </tr>
                        <tr>
                        <div class="mb-3">
                            <td style="font-weight: 600; "> Ville :</td>
                            <td id="ville"></td>
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
        </script>
        


            </div>
            </div>
            <!-- / Content -->
            <!-- Footer -->
            @include('supper_admin.partials.footer')
            <!-- / Footer -->

    <!-- beautify ignore:end -->