

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
        
<!-- Cards with few info -->
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
          <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
              <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                  <div>
                    <h3 class="mb-1">{{ $statistics['user'] }}</h3>
                    <p class="mb-0">Utilisateurs</p>
                  </div>
                  <span class="badge bg-label-secondary rounded p-2 me-sm-4">
                    <i class="bx bx-user bx-sm"></i>
                  </span>
                </div>
                <hr class="d-none d-sm-block d-lg-none me-4">
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                  <div>
                    <h3 class="mb-1">{{ $statistics['chargeur'] }}</h3>
                    <p class="mb-0">Chargeurs</p>
                  </div>
                  <span class="badge bg-label-secondary rounded p-2 me-lg-4">
                    <i class="bx bx-user bx-sm"></i>
                  </span>
                </div>
                <hr class="d-none d-sm-block d-lg-none">
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                  <div>
                    <h3 class="mb-1">{{ $statistics['transporteur'] }}</h3>
                    <p class="mb-0">Transporteurs</p>
                  </div>
                  <span class="badge bg-label-secondary rounded p-2 me-sm-4">
                    <i class="bx bx-user bx-sm"></i>
                  </span>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-between align-items-start">
                  <div>
                    <h3 class="mb-1">{{ $statistics['chauffeur'] }}</h3>
                    <p class="mb-0">Chauffeurs</p>
                  </div>
                  <span class="badge bg-label-secondary rounded p-2">
                    <i class="bx bx-user bx-sm"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Cards with few info -->


<!-- Card Border Shadow -->
<div class="row">
<div class="col-sm-6 col-lg-3 mb-4">
<div class="card card-border-shadow-primary h-100">
  <div class="card-body">
    <div class="d-flex align-items-center mb-2 pb-1">
      <div class="avatar me-2">
        <span class="avatar-initial rounded bg-label-primary"><i class="bx bxs-truck"></i></span>
      </div>
      <h4 class="ms-1 mb-0">{{ $statistics['vehicule'] }}</h4>
    </div>
    <p class="mb-1">Total</p>
    <p class="mb-0">
      <span class="fw-medium me-1"> </span>
      <small class="text-muted">Véhicule</small>
    </p>
  </div>
</div>
</div>
<div class="col-sm-6 col-lg-3 mb-4">
<div class="card card-border-shadow-warning h-100">
  <div class="card-body">
    <div class="d-flex align-items-center mb-2 pb-1">
      <div class="avatar me-2">
        <span class="avatar-initial rounded bg-label-warning"><i class='bx bxs-truck'></i></span>
      </div>
      <h4 class="ms-1 mb-0">{{ $statistics['en_attente'] }}</h4>
    </div>
    <p class="mb-1">En attent de validation</p>
    <p class="mb-0">
      <span class="fw-medium me-1"> </span>
      <small class="text-muted">Véhicule</small>
    </p>
  </div>
</div>
</div>
<div class="col-sm-6 col-lg-3 mb-4">
<div class="card card-border-shadow-danger h-100">
  <div class="card-body">
    <div class="d-flex align-items-center mb-2 pb-1">
      <div class="avatar me-2">
        <span class="avatar-initial rounded bg-label-danger"><i class='bx bxs-truck'></i></span>
      </div>
      <h4 class="ms-1 mb-0">{{ $statistics['rejete'] }}</h4>
    </div>
    <p class="mb-1">Rejeté(s)</p>
    <p class="mb-0">
      <span class="fw-medium me-1"> </span>
      <small class="text-muted">Véhicule</small>
    </p>
  </div>
</div>
</div>
<div class="col-sm-6 col-lg-3 mb-4">
<div class="card card-border-shadow-info h-100">
  <div class="card-body">
    <div class="d-flex align-items-center mb-2 pb-1">
      <div class="avatar me-2">
        <span class="avatar-initial rounded bg-label-info"><i class='bx bxs-truck'></i></span>
      </div>
      <h4 class="ms-1 mb-0">{{ $statistics['valide'] }}</h4>
    </div>
    <p class="mb-1">Validé(s)</p>
    <p class="mb-0">
      <span class="fw-medium me-1"> </span>
      <small class="text-muted">Véhicule</small>
    </p>
  </div>
</div>
</div>
</div>
<!--/ Card Border Shadow -->


{{-- <!-- On route vehicles Table -->
<div class="col-12 order-5">
<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <div class="card-title mb-0">
      <h5 class="m-0 me-2">On route vehicles</h5>
    </div>
    <div class="dropdown">
      <button class="btn p-0" type="button" id="routeVehicles" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bx bx-dots-vertical-rounded"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="routeVehicles">
        <a class="dropdown-item" href="javascript:void(0);">Select All</a>
        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
        <a class="dropdown-item" href="javascript:void(0);">Share</a>
      </div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class="dt-route-vehicles table">
      <thead class="border-top">
        <tr>
          <th></th>
          <th></th>
          <th>location</th>
          <th>starting route</th>
          <th>ending route</th>
          <th>warnings</th>
          <th class="w-20">progress</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
</div>
</div>
<!--/ On route vehicles Table --> --}}

      </div>
      <!-- / Content -->

<!-- Footer -->

    @include('supper_admin.partials.footer')

<!-- / Footer -->

          
      