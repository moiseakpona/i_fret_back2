
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
                        <span class="text-muted fw-light">Paramètres /</span> Profil
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
                            <li class="nav-item"><a class="nav-link active" href="{{ route('profil') }}"><i class="bx bx-user me-1"></i> Profil</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('securite') }}"><i class="bx bx-lock-alt me-1"></i> securité</a></li>
                          </ul>
                          <div class="card mb-4">
                            <h5 class="card-header">Détails du profil</h5>
                            <!-- Account -->
                            <div class="card-body">

                              @if ($errors->any())
                                <div>
                                    <strong>Erreur!</strong> Veuillez corriger les erreurs ci-dessous:<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                              @endif

                              <div class="d-flex align-items-start align-items-sm-center gap-4">

                                @if (Auth::check() && Auth::user()->photo)
                                  <img src="{{ asset('images/' . Auth::user()->photo) }}" alt="Photo de profil" class="d-block rounded" height="100" width="100" id="image">
                                @endif
                    
                                <div >
                                  <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data" id="uploadForm">
                                    @csrf 
                                    <h5>Télécharger une nouvelle photo</h5>
                                    <label for="image" class="btn btn-primary me-2 mb-4"> 
                                      
                                      <i class="bx bx-upload d-block d-sm-none"></i>
                                      <input type="file" name="image" id="image" onchange="confirmUpload()" accept="image/png, image/jpeg">
                                    </label>
                                </form>
                      
                                  <p class="text-muted mt-0">JPG, GIF ou PNG autorisés. Taille maximale de 2Mo</p>
                                </div>
                              
                              <script>
                                function confirmUpload() {
                                    if (confirm("Êtes-vous sûr de vouloir télécharger cette image?")) {
                                        document.getElementById("uploadForm").submit();
                                    } else {
                                        // Réinitialiser l'élément input de type "file" si l'utilisateur annule
                                        document.getElementById("image").value = "";
                                    }
                                }
                            </script>




                              </div>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">

                              <form id="editUserForm" class="row g-3" method="POST" action="{{ route('update_admin', $admin->id ) }}">
                                @csrf
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="FirstName">Nom</label>
                                  <input type="text" id="FirstName" name="nom" class="form-control" value="{{ $admin->nom }}" />
                                </div>
                                <div class="col-12 col-md-6">
                                  <label class="form-label" for="LastName">Prénom</label>
                                  <input type="text" id="LastName" name="prenom" class="form-control" value="{{ $admin->prenom }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label for="email" class="form-label">E-mail</label>
                                  <input class="form-control" type="text" id="email" name="email" value="{{ $admin->email }}" required/>
                                </div>

                                <div class="mb-3 col-md-6">
                                  <label for="address" class="form-label">Addresse</label>
                                  <input type="text" class="form-control" id="address" name="ville" value="{{ $admin->ville }}" required/>
                                </div>

                                <div class="mb-3 col-md-6">
                                  <label for="date" class="form-label">Date de Naissance</label>
                                  <input class="form-control" type="date" id="date" name="date_naissance" value="{{ $admin->date_naissance }}" required/>
                                </div>

                                <div class="mb-3 col-md-6">
                                  <label class="form-label" for="phoneNumber">NUMÉRO DE TÉLÉPHONE</label>
                                  <div class="input-group input-group-merge">
                                    <input type="text" id="phoneNumber" name="numero_tel" class="form-control" value="{{ $admin->numero_tel }}" required/>
                                  </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                  <label for="type" class="form-label">Type de compte</label>
                                  <input class="form-control" type="text" id="type" name="type_compte" value="{{ $admin->type_compte }}" readonly />
                                </div>
                                <div class="col-12 text-center">
                                  <button type="submit" class="btn btn-primary me-sm-3 me-1">Enregistrer</button>
                                  <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                                </div>
                              </form>

                            </div>
                            <!-- /Account -->
                          </div>
                          <div class="card">
                            <h5 class="card-header">Supprimer le compte</h5>
                            <div class="card-body">
                              <div class="mb-3 col-12 mb-0">
                                <div class="alert alert-warning">
                                  <h6 class="alert-heading fw-medium mb-1">Êtes-vous sûr de vouloir supprimer votre compte ?</h6>
                                  <p class="mb-0">Une fois votre compte supprimé, vous ne pourrez plus revenir en arrière. Soyez-en sûr, s'il vous plaît.</p>
                                </div>
                              </div>
                              <form id="formAccountDeactivation" onsubmit="return false">
                                <div class="form-check mb-3">
                                  <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                                  <label class="form-check-label" for="accountActivation">Je confirme la désactivation de mon compte</label>
                                </div>
                                <button type="submit" class="btn btn-danger deactivate-account">Désactiver le compte</button>
                              </form>
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