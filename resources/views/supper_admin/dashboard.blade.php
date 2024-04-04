

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
                    <h3 class="mb-1">224</h3>
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
                    <h3 class="mb-1">165</h3>
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
                    <h3 class="mb-1">24</h3>
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
                    <h3 class="mb-1">87</h3>
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
      <h4 class="ms-1 mb-0">42</h4>
    </div>
    <p class="mb-1">Total</p>
    <p class="mb-0">
      <span class="fw-medium me-1"> </span>
      <small class="text-muted">Camions</small>
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
      <h4 class="ms-1 mb-0">8</h4>
    </div>
    <p class="mb-1">En attent de validation</p>
    <p class="mb-0">
      <span class="fw-medium me-1"> </span>
      <small class="text-muted">Camions</small>
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
      <h4 class="ms-1 mb-0">27</h4>
    </div>
    <p class="mb-1">Rejeté(s)</p>
    <p class="mb-0">
      <span class="fw-medium me-1"> </span>
      <small class="text-muted">Camions</small>
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
      <h4 class="ms-1 mb-0">13</h4>
    </div>
    <p class="mb-1">Validé(s)</p>
    <p class="mb-0">
      <span class="fw-medium me-1"> </span>
      <small class="text-muted">Camions</small>
    </p>
  </div>
</div>
</div>
</div>
<!--/ Card Border Shadow -->
<div class="row">
<!-- Vehicles overview -->
<div class="col-xxl-6 mb-4 order-5 order-xxl-0">
<div class="card h-100">
  <div class="card-header">
    <div class="card-title mb-0">
      <h5 class="m-0">Vehicles overview</h5>
    </div>
  </div>
  <div class="card-body">
    <div class="d-none d-lg-flex vehicles-progress-labels mb-3">
      <div class="vehicles-progress-label on-the-way-text" style="width: 39.7%;">On the way</div>
      <div class="vehicles-progress-label unloading-text" style="width: 28.3%;">Unloading</div>
      <div class="vehicles-progress-label loading-text" style="width: 17.4%;">Loading</div>
      <div class="vehicles-progress-label waiting-text" style="width: 14.6%;">Waiting</div>
    </div>
    <div class="vehicles-overview-progress progress rounded-2 mb-3" style="height: 46px;">
      <div class="progress-bar fs-big fw-medium text-start bg-lighter text-body px-1 px-lg-3 rounded-start shadow-none" role="progressbar" style="width: 39.7%" aria-valuenow="39.7" aria-valuemin="0" aria-valuemax="100">39.7%</div>
      <div class="progress-bar fs-big fw-medium text-start bg-primary px-1 px-lg-3 shadow-none" role="progressbar" style="width: 28.3%" aria-valuenow="28.3" aria-valuemin="0" aria-valuemax="100">28.3%</div>
      <div class="progress-bar fs-big fw-medium text-start text-bg-info px-1 px-lg-3 shadow-none" role="progressbar" style="width: 17.4%" aria-valuenow="17.4" aria-valuemin="0" aria-valuemax="100">17.4%</div>
      <div class="progress-bar fs-big fw-medium text-start bg-gray-900 px-1 px-lg-3 rounded-end shadow-none" role="progressbar" style="width: 14.6%" aria-valuenow="14.6" aria-valuemin="0" aria-valuemax="100">14.6%</div>
    </div>
    <div class="table-responsive">
      <table class="table card-table">
        <tbody class="table-border-bottom-0">
          <tr>
            <td class="w-50 ps-0">
              <div class="d-flex justify-content-start align-items-center">
                <div class="me-2">
                  <i class="bx bxs-truck"></i>
                </div>
                <h6 class="mb-0 fw-normal">On the way</h6>
              </div>
            </td>
            <td class="text-end pe-0 text-nowrap">
              <h6 class="mb-0">2hr 10min</h6>
            </td>
            <td class="text-end pe-0">
              <span class="fw-medium">39.7%</span>
            </td>
          </tr>
          <tr>
            <td class="w-50 ps-0">
              <div class="d-flex justify-content-start align-items-center">
                <div class="me-2">
                  <i class='bx bx-down-arrow-circle'></i>
                </div>
                <h6 class="mb-0 fw-normal">Unloading</h6>
              </div>
            </td>
            <td class="text-end pe-0 text-nowrap">
              <h6 class="mb-0">3hr 15min</h6>
            </td>
            <td class="text-end pe-0">
              <span class="fw-medium">28.3%</span>
            </td>
          </tr>
          <tr>
            <td class="w-50 ps-0">
              <div class="d-flex justify-content-start align-items-center">
                <div class="me-2">
                  <i class='bx bx-up-arrow-circle'></i>
                </div>
                <h6 class="mb-0 fw-normal">Loading</h6>
              </div>
            </td>
            <td class="text-end pe-0 text-nowrap">
              <h6 class="mb-0">1hr 24min</h6>
            </td>
            <td class="text-end pe-0">
              <span class="fw-medium">17.4%</span>
            </td>
          </tr>
          <tr>
            <td class="w-50 ps-0">
              <div class="d-flex justify-content-start align-items-center">
                <div class="me-2">
                  <i class="bx bx-time-five"></i>
                </div>
                <h6 class="mb-0 fw-normal">Waiting</h6>
              </div>
            </td>
            <td class="text-end pe-0 text-nowrap">
              <h6 class="mb-0">5hr 19min</h6>
            </td>
            <td class="text-end pe-0">
              <span class="fw-medium">14.6%</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!--/ Vehicles overview -->
<!-- Statistiques d'expédition-->
<div class="col-lg-6 col-xxl-6 mb-4 order-3 order-xxl-1">
<div class="card h-100">
  <div class="card-header d-flex align-items-center justify-content-between">
    <div class="card-title mb-0">
      <h5 class="m-0 me-2">Statistiques d'expédition</h5>
      <small class="text-muted">Nombre total de livraisons 23.8k</small>
    </div>
    <div class="dropdown">
      <button type="button" class="btn btn-label-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">January</button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="javascript:void(0);">January</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">February</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">March</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">April</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">May</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">June</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">July</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">August</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">September</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">October</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">November</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);">December</a></li>
      </ul>
    </div>
  </div>
  <div class="card-body">
    <div id="shipmentStatisticsChart"></div>
  </div>
</div>
</div>
<!--/ Statistiques d'expédition -->


<!-- On route vehicles Table -->
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
<!--/ On route vehicles Table -->

      </div>
      <!-- / Content -->

<!-- Footer -->

    @include('supper_admin.partials.footer')

<!-- / Footer -->

          
      