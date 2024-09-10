document.getElementById('nom').innerText = nom;
document.getElementById('prenom').innerText = prenom;
document.getElementById('type_compte').innerText = type_compte;
document.getElementById('numero_tel').innerText = numero_tel;
document.getElementById('ville').innerText = ville;
document.getElementById('date_naissance').innerText = date_naissance;


const nom = btn.getAttribute('data-nom');
const prenom = btn.getAttribute('data-prenom');
const type_compte = btn.getAttribute('data-type_compte');
const numero_tel = btn.getAttribute('data-numero_tel');
const ville = btn.getAttribute('data-ville');
const date_naissance = btn.getAttribute('data-date_naissance');

<div class="row mb-3 mt-3">
    <div class="col">
      <label for="inputDescription" class="form-label">Fret</label>
      <textarea class="form-control" id="inputDescription" rows="3"></textarea>
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
            <table class="table ">
              <thead>
                <h4>Chargeur :</h4>
              </thead>
              <tbody>
                <tr>
                  <div class="mb-3">
                    <td><label for="truckBrand" style="font-weight: 600; ">Profil :</label></td> 
                    <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_transporteur') }}" spellcheck="false"><span class="fw-medium">Nom Prenom</span></a><small class="text-muted">Transporteur</small></div></div></td> 
                  </div>
                </tr>
                <tr>
                  <div class="mb-3">
                    <td><label for="truckBrand" style="font-weight: 600">Contact</label></td>
                    <td><span id="truckBrand" style="font-weight: 600; color:green;">+229 90345878</span></td>
                  </div>
                </tr>
                <tr>
                  <div class="mb-3">
                    <td><label for="truckBrand" style="font-weight: 600">Description Fret(s)</label></td>
                    <td><span id="truckBrand" style="font-weight: 600; color:green;">1O Tonnes de maïs</span></td>
                  </div>
                </tr>
                <tr>
                  <div class="mb-3">
                    <td><label for="truckBrand" style="font-weight: 600">Lieu de depart</label></td>
                    <td><span id="truckBrand" style="font-weight: 600; color:green;">Cotonou</span></td>
                  </div>
                </tr>
                <tr>
                  <div class="mb-3">
                    <td><label for="truckBrand" style="font-weight: 600">Lieu d'arrivée</label></td>
                    <td><span id="truckBrand" style="font-weight: 600; color:green;">Djougou</span></td>
                  </div>
                </tr>
              </tbody>
            </table>
          </div> 

          <hr class="my-5">

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
<!--/ Le modal Plus -->














<!-- Boucle pour afficher les frets associés et les utilisateurs correspondants -->
@foreach ($frets as $fret)

  <!-- Section chargeur -->
  <div class="table-responsive">
    <table class="table ">
      <thead>
        <h4>Chargeur :</h4>
      </thead>
      <tbody>
        @foreach ($utilisateursFrets as $utilisateur)
          <tr>
            <div class="mb-3">
              <td><label for="truckBrand" style="font-weight: 600; ">Profil :</label></td> 
              <td class="sorting_1"><div class="d-flex justify-content-start align-items-center customer-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="{{ route('utilisateurs.details_chargeur') }}" spellcheck="false"><span class="fw-medium">{{ $utilisateur->nom }} {{ $utilisateur->prenom }}</span></a><small class="text-muted">Transporteur</small></div></div></td> 
            </div>
          </tr>
          <tr>
            <div class="mb-3">
              <td><label for="truckBrand" style="font-weight: 600">Contact</label></td>
              <td><span id="truckBrand" style="font-weight: 600; color:green;">{{ $utilisateur->numero_tel }}</span></td>
            </div>
          </tr>
        @endforeach
        <tr>
          <div class="mb-3">
            <td><label for="truckBrand" style="font-weight: 600">Description Fret(s)</label></td>
            <td><span id="truckBrand" style="font-weight: 600; color:green;">{{ $fret->description }}</span></td>
          </div>
        </tr>
        <tr>
          <div class="mb-3">
            <td><label for="truckBrand" style="font-weight: 600">Lieu de depart</label></td>
            <td><span id="truckBrand" style="font-weight: 600; color:green;">{{ $fret->lieu_depart }}</span></td>
          </div>
        </tr>
        <tr>
          <div class="mb-3">
            <td><label for="truckBrand" style="font-weight: 600">Lieu d'arrivée</label></td>
            <td><span id="truckBrand" style="font-weight: 600; color:green;">{{ $fret->lieu_arrive }}</span></td>
          </div>
        </tr>
      </tbody>
    </table>
  </div>

  <hr class="my-5">

  @endforeach









