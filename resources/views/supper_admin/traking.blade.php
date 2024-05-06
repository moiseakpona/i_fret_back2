
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
                        <span class="text-muted fw-light">Tableau de bord /</span> Traking
                     </h4>





                     <form class="form-repeater">
                        <div data-repeater-list="searches">
                            <div data-repeater-item>
                    
                                <!-- Ajout du champ de recherche par numéro de téléphone -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="inputPhoneNumber" class="form-label">Numéro de téléphone</label>
                                        <input type="text" class="form-control" id="inputPhoneNumber" placeholder="Numéro de téléphone" name="phoneNumber">
                                    </div>
                                    <!-- Bouton pour supprimer le champ de saisie du numéro de téléphone -->
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-danger" data-repeater-delete>X</button>
                                    </div>
                                </div>
                    
                                <!-- Ajout de la liste déroulante pour sélectionner l'utilisateur -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="selectUser" class="form-label">Utilisateur</label>
                                        <select class="form-select" id="selectUser" name="selectedUser">
                                            <!-- Les options seront ajoutées dynamiquement en fonction des résultats de la recherche -->
                                            <option value="">Sélectionner un utilisateur</option>
                                        </select>
                                    </div>
                                </div>
                    
                                <!-- Bouton pour ajouter un nouvel utilisateur -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <button type="button" class="btn btn-primary" data-repeater-create>Ajouter un autre numéro</button>
                                    </div>
                                </div>

                                <!-- Multiple -->
          <div class="col-md-6 mb-4">
            <label for="select2Multiple" class="form-label">Multiple</label>
            <select id="select2Multiple" class="select2 form-select" multiple>
                <option value="CA">California</option>
                <option value="NV">Nevada</option>
                <option value="OR">Oregon</option>
                <option value="WA">Washington</option>
                <option value="AZ">Arizona</option>
          </div>
                    
                            </div>
                        </div>
                    </form>
                    



 
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->