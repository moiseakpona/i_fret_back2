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
