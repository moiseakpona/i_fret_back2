
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
                        <span class="text-muted fw-light">Paramètres /</span> Securité
                      </h4>
                      
                      <div class="row">
                        <div class="col-md-12">
                          <ul class="nav nav-pills flex-column flex-md-row mb-3">
                            <li class="nav-item"><a class="nav-link" href="{{ route('profil') }}"><i class="bx bx-user me-1"></i> Profil</a></li>
                            <li class="nav-item"><a class="nav-link active" href="{{ route('securite') }}"><i class="bx bx-lock-alt me-1"></i> Securité</a></li>
                          </ul>
                          <!-- Change Password -->
                          <div class="card mb-4">
                            <h5 class="card-header">Changer le mot de passe</h5>
                            <div class="card-body">
                            @if (session('error'))
                              <div class="alert alert-danger">
                                  {{ session('error') }}
                              </div>
                            @endif
  
                            @if (session('success'))
                              <div class="alert alert-success">
                                  {{ session('success') }}
                              </div>
                            @endif

                              <form id="formAccountSettings" method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <div class="row">
                                  <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="current_password">MOT DE PASSE ACTUEL</label>
                                    <div class="input-group input-group-merge">
                                      <input class="form-control" type="password" name="current_password" id="current_password" required autofocus placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"  />
                                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                  </div>
                                </div>
                                
                                <div class="row">
                                  <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="new_password">NOUVEAU MOT DE PASSE</label>
                                    <div class="input-group input-group-merge">
                                      <input class="form-control" type="password" id="new_password" name="new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                  </div>
                      
                                  <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="new_password_confirmation">CONFIRMER LE NOUVEAU MOT DE PASSE</label>
                                    <div class="input-group input-group-merge">
                                      <input class="form-control" type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                  </div>
                                  <div class="col-12 mb-4">
                                    <p class="fw-medium mt-2">Exigences de mot de passe :</p>
                                    <ul class="ps-3 mb-0">
                                      <li class="mb-1">
                                        Minimum 8 caractères : plus il y en a, mieux c'est
                                      </li>
                                      <li class="mb-1">Au moins un caractère minuscule</li>
                                      <li>Au moins un chiffre, un symbole ou un espace</li>
                                    </ul>
                                  </div>
                                  <div class="col-12 mt-1">
                                    <button type="submit" class="btn btn-primary me-2">Sauvegarder les modifications</button>
                                    <button type="reset" class="btn btn-label-secondary">Annuler</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <!--/ Change Password -->
                      
                        </div>
                      </div>


                      <script>
                        document.addEventListener('DOMContentLoaded', function () {
                          var newPassword = document.getElementById('new_password');
                          var confirmPassword = document.getElementById('new_password_confirmation');

                          function validatePassword() {
                              if (newPassword.value !== confirmPassword.value) {
                                  confirmPassword.setCustomValidity("Les mots de passe ne correspondent pas.");
                                } else {
                                  confirmPassword.setCustomValidity('');
                                }
                              }

                              newPassword.addEventListener('change', validatePassword);
                              confirmPassword.addEventListener('change', validatePassword);
                              });
                      </script>


                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->