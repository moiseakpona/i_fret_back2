
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


                     <div class="row">
                      <div class="col-md-12">
                        <ul class="nav nav-pills flex-column flex-md-row mb-3">
                          <li class="nav-item"><a class="nav-link" href="{{ route('gestion_demande') }}"><i class="bx bx-food-menu me-1"></i> Gestion demandes </a></li>
                          <li class="nav-item"><a class="nav-link active" href="{{ route('gestion_fret') }}"><i class="bx bxs-truck me-1"></i> Gestion frets</a></li>
                          <li class="nav-item"><a class="nav-link" href="{{ route('fret_diponible') }}"><i class="bx bxs-truck me-1"></i> frets diponibles</a></li>
                        </ul>
                  
                        <div class="col-md-12">
                          <div class="card">
                              <div class="card-header">
                                  <strong class="card-title">Liste des demandes</strong>
                                  <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                      <span class="tf-icon bx bx-plus bx-xs me-1">Faire une demande</span>
                                  </button>
                              </div>
                              <div class="card-body">
                                  <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                      <thead>
                                          <tr>
                                              <th></th>
                                              <th>Véhicule</th>
                                              <th>Montant</th>
                                              <th>Lieu de départ</th>
                                              <th>Lieu d'arrivée</th>
                                              <th>Statut</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($demandeFretsUser as $key => $demandeFretsUsers)
                                          @php
                                          $demande = $demandeFretsUsers['demande'];
                                          $frets = $demandeFretsUsers['frets'];
                                          $utilisateursFrets = $demandeFretsUsers['utilisateurs'];
                                          @endphp
                                          <tr>
                                              <td>
                                                  <button type="button" class="btn btn-xs btn-primary plus-btn" data-bs-toggle="modal" data-bs-target="#plusModal"
                                                      data-frets='@json($frets)' data-utilisateurs='@json($utilisateursFrets)'>
                                                      <span class="tf-icon bx bx-plus bx-xs me-1"></span>
                                                  </button>
                                              </td>
                                              <td>{{ $demande->type_vehicule }}</td>
                                              <td>{{ $demande->montant }}</td>
                                              <td>{{ $demande->lieu_depart }}</td>
                                              <td>{{ $demande->lieu_arrive }}</td>
                                              <td>
                                                  <span class="badge {{ $demande->statut === 'En cours' ? 'bg-label-warning' : 'bg-label-success' }} me-1">{{ $demande->statut }}</span>
                                              </td>
                                              <td>
                                                  <div class="dropdown">
                                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                      <div class="dropdown-menu">
                                                          <a class="dropdown-item" href="{{ route('details')}}"><i class="bx bx-food-menu me-1"></i> Détail</a>
                                                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Modifier</a>
                                                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Supprimé</a>
                                                      </div>
                                                  </div>
                                              </td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                      
                      <!-- Le modal Plus -->
                      <div class="modal fixed-right fade" id="plusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-slideout">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Historique des frets</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <!-- Section chargeur -->
                                      <div class="table-responsive">
                                          <table class="table">
                                              <thead>
                                                  <h4>Chargeur :</h4>
                                              </thead>
                                              <tbody id="plusModalBody">
                                                  <!-- Dynamically generated content will be inserted here -->
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!--/ Le modal Plus -->
                      
                      <script>
                          document.querySelectorAll('.plus-btn').forEach(btn => {
                              btn.addEventListener('click', () => {
                                  const frets = JSON.parse(btn.getAttribute('data-frets'));
                                  const utilisateurs = JSON.parse(btn.getAttribute('data-utilisateurs'));
                      
                                  const modalBody = document.getElementById('plusModalBody');
                                  modalBody.innerHTML = ''; // Efface le contenu précédent
                      
                                  frets.forEach((fret, index) => {
                                      const utilisateur = utilisateurs[index];
                      
                                      const nom = document.createElement('tr');
                                      nom.innerHTML = `
                                          <td><label style="font-weight: 600; ">Profil :</label></td> 
                                          <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2">${chargeurPhoto ? `<img src="${chargeurPhoto}" alt="Photo de profil" class="rounded-circle">` : `<img src="{{ asset('images/default_profile_photo.png') }}" alt="Photo de profil par défaut" class="rounded-circle">`}</div></div><div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_chargeur') }}" spellcheck="false"><span class="fw-medium">${utilisateur.nom} ${utilisateur.prenom}</span></a><small class="text-muted">${utilisateur.type_compte}</small></div></div></td> `;
                                      modalBody.appendChild(nom);
                      
                                      const numeroTel = document.createElement('tr');
                                      numeroTel.innerHTML = `
                                          <td><label style="font-weight: 600">Contact</label></td>
                                          <td><span style="font-weight: 600; color:green;">${utilisateur.numero_tel}</span></td>`;
                                      modalBody.appendChild(numeroTel);

                                      const description = document.createElement('tr');
                                      description.innerHTML = `
                                          <td><label style="font-weight: 600;">Description du fret :</label></td>
                                          <td><span style="font-weight: 600; color:green;">${fret.description}</span></td>`;
                                      modalBody.appendChild(description);
                      
                                      const lieuDepart = document.createElement('tr');
                                      lieuDepart.innerHTML = `
                                          <td><label style="font-weight: 600;">Lieu de départ :</label></td>
                                          <td><span style="font-weight: 600; color:green;">${fret.lieu_depart}</span></td>`;
                                      modalBody.appendChild(lieuDepart);
                      
                                      const lieuArrivee = document.createElement('tr');
                                      lieuArrivee.innerHTML = `
                                          <td><label style="font-weight: 600;">Lieu d'arrivée :</label></td>
                                          <td><span style="font-weight: 600; color:green;">${fret.lieu_arrive}</span></td>`;
                                      modalBody.appendChild(lieuArrivee);
                      
                                      // Ajoute un séparateur entre chaque fret et utilisateur
                                      if (index < frets.length - 1) {
                                          const separator = document.createElement('hr');
                                          modalBody.appendChild(separator);
                                      }
                                  });
                      
                                  document.getElementById('plusModal').style.display = 'block';
                              });
                          });
                      
                          function closeModal() {
                              document.getElementById('plusModal').style.display = 'none';
                          }
                      </script>


                      <script>
                        // Initialisez les variables JavaScript avec les valeurs provenant du côté serveur
                        const chargeurPhoto = "{{ isset($chargeur) && $chargeur->photo ? $chargeur->photo : '' }}";
                        const chargeurNom = "{{ isset($chargeur) ? $chargeur->nom : '' }}";
                        const chargeurPrenom = "{{ isset($chargeur) ? $chargeur->prenom : '' }}";
                        const typeCompte = "{{ isset($chargeur) ? $chargeur->type_compte : '' }}";
                        const detailsChargeurRoute = "{{ route('utilisateurs.details_chargeur') }}";
                      </script>
                      
                      
                  </div>
                </div>
              


                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Formulaire de demande de camion</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="form-repeater" method="POST" action="{{ route('demande') }}">
                          @csrf
                           <div class="modal-body">
                              <div data-repeater-list="group-a">
                                <div data-repeater-item>

                                  <div class="row">
                                    <div class="mb-3 col-12">
                                      <label for="id_fret" class="form-label">Chargeur(s)</label>
                                      <select id="id_fret" name="id_fret[]" class="select2 form-select" multiple>
                                        @foreach ($fretsEnAttente as $fret)
                                          <option value="{{ $fret->id }}">{{ $fret->id }}. {{ $fret->description }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="mb-3 col-12">
                                      <label class="form-label" for="type_vehicule">Véhicule</label>
                                      <select id="type_vehicule" name="type_vehicule" class="select2 form-select" data-placeholder="Fourgonnette 0 - 10 Tonnes">
                                        <option value=""></option>
                                        <option value="Fourgonnette 0 - 10 Tonnes">Fourgonnette 0 - 10 Tonnes</option>
                                        <option value="Camion 20 - 30 Tonnes">Camion 20 - 30 Tonnes</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <div class="col">
                                      <label for="lieu_depart" class="form-label"> Lieu de depart </label>
                                      <select class="form-select" id="lieu_depart" name="lieu_depart">
                                        <option selected disabled>Cotonou</option>
                                        <option value="Cotonou">Cotonou</option>
                                        <option value="Porto-Novo">Porto-Novo</option>
                                        <option value="Parakou">Parakou</option>
                                        <option value="Abomey-Calavi">Abomey-Calavi</option>
                                      </select>
                                    </div>
                                    <div class="col">
                                      <label for="lieu_arrive" class="form-label">Lieu d'arrivée</label>
                                      <select class="form-select" id="lieu_arrive" name="lieu_arrive">
                                        <option selected disabled>Parakou</option>
                                        <option value="Cotonou">Cotonou</option>
                                        <option value="Porto-Novo">Porto-Novo</option>
                                        <option value="Parakou">Parakou</option>
                                        <option value="Abomey-Calavi">Abomey-Calavi</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <div class="col">
                                      <label for="montant" class="form-label">Montant (F CFA)</label>
                                      <input type="number" class="form-control" id="montant" name="montant" placeholder="1 000 000F CFA">
                                    </div>
                                    <div class="col">
                                      {{-- <label for="inputDate" class="form-label">Date</label>
                                      <input type="date" class="form-control" id="inputDate"> --}}
                                    </div>
                                  </div>  
                                    
                                </div>
                              </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                          <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                  <!--/ Modal -->



                  
               


                  </div>
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->