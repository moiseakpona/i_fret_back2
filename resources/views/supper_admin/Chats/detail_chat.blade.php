
            <!-- Menu -->
            @include('supper_admin.partials.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
               <!-- Navbar -->
               @include("supper_admin.partials.header")
               <!-- Content wrapper -->
               <div class="content-wrapper">
                  <!-- Content -->
                  <div class="container-xxl flex-grow-1 container-p-y">


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


                  
                  <div class="container-xxl flex-grow-1 container-p-y">
                     <div class="app-chat overflow-hidden card">
                        <div class="row g-0">

                           <!-- Sidebar Left -->
                           <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
                              <div class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap p-4 mt-2">
                                 <div class="avatar avatar-xl avatar-online">
                                    @if (Auth::check() && Auth::user()->photo)
                                       <img src="{{ asset('images/' . Auth::user()->photo) }}" alt="Avatar" class="user-avatar rounded-circle cursor-pointer" >
                                    @else
                                       <img src="{{ asset('images/default_profile_photo.png') }}" alt="Avatar" class="user-avatar rounded-circle cursor-pointer" >
                                    @endif
                                 </div>
                                 <h5 class="mt-3 mb-1">{{ $admin->nom }} {{ $admin->prenom }}</h5>
                                 <small class="text-muted">{{ $admin->type_compte }}</small>
                                 <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 " data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-left"></i>
                              </div>
                           </div>
                           <!-- /Sidebar Left-->

                           <!-- Chat & Contacts -->
                           <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
                              <div class="sidebar-header pt-3 px-3 mx-1">
                                 <div class="d-flex align-items-center me-3 me-lg-0">
                                    <div class="flex-shrink-0 avatar avatar-online me-2" data-bs-toggle="sidebar" data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                                       @if (Auth::check() && Auth::user()->photo)
                                          <img src="{{ asset('images/' . Auth::user()->photo) }}" alt="Avatar" class="user-avatar rounded-circle cursor-pointer" >
                                       @else
                                          <img src="{{ asset('images/default_profile_photo.png') }}" alt="Avatar" class="user-avatar rounded-circle cursor-pointer" >
                                       @endif
                                    </div>
                                    <div class="flex-grow-1 input-group input-group-merge rounded-pill ms-1">
                                       <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search fs-4"></i></span>
                                       <input type="text" class="form-control chat-search-input" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                                    </div>
                                 </div>
                                 <i class="bx bx-x cursor-pointer position-absolute top-0 end-0 mt-2 me-1 fs-4 d-lg-none d-block" data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                              </div>
                              <hr class="container-m-nx mt-3 mb-0">
                              <div class="sidebar-body"> 

                                 <!-- Chats -->
                                 <ul class="list-unstyled chat-contact-list pt-1" id="chat-list">
                                    <li class="chat-contact-list-item chat-contact-list-item-title">
                                       <h5 class="text-primary mb-0">Chats</h5>
                                    </li>
                                    <li class="chat-contact-list-item chat-list-item-0 d-none">
                                        <h6 class="text-muted mb-0">No Chats Found</h6>
                                     </li>
                                    <li class="chat-contact-list-item active">
                                       <a href="#" class="d-flex align-items-center">
                                          <div class="flex-shrink-0 avatar avatar-offline">
                                             <img src="{{ asset('assets/img/avatars/2.png')}}" alt="Avatar" class="rounded-circle">
                                          </div>
                                          <div class="chat-contact-info flex-grow-1 ms-3">
                                             <h6 class="chat-contact-name text-truncate m-0">Felecia Rower</h6>
                                             <p class="chat-contact-status text-truncate mb-0 text-muted">I will purchase it for sure. 👍</p>
                                          </div>
                                          <small class="text-muted mb-auto">30 Minutes</small>
                                       </a>
                                    </li>
                                 </ul>

                                 <!-- Contacts -->
                                 <ul class="list-unstyled chat-contact-list mb-0" id="contact-list">
                                    <li class="chat-contact-list-item chat-contact-list-item-title">
                                       <h5 class="text-primary mb-0">Utilisateurs</h5>
                                    </li>
                                    <li class="chat-contact-list-item contact-list-item-0 d-none">
                                        <h6 class="text-muted mb-0">No Contacts Found</h6>
                                     </li>
                                    @foreach ($chargeurs as $chargeur)
                                       <li class="chat-contact-list-item">
                                          <a href="{{ route('detail_chat', ['numero_tel' => $chargeur->numero_tel]) }}" class="d-flex align-items-center">
                                             <div class="flex-shrink-0 avatar">
                                                @if ($chargeur->photo)
                                                   <img src="{{ $chargeur->photo }}" alt="Photo de profil" class="rounded-circle">
                                                @else
                                                   <img src="{{ asset('images/default_profile_photo.png') }}" alt="Avatar" class="rounded-circle">
                                                @endif
                                             </div>
                                             <div class="chat-contact-info flex-grow-1 ms-3">
                                                <h6 class="chat-contact-name text-truncate m-0">{{ $chargeur->nom }} {{ $chargeur->prenom }}</h6>
                                                <p class="chat-contact-status text-truncate mb-0 text-muted">{{ $chargeur->type_compte }}</p>
                                             </div>
                                          </a>
                                       </li>
                                    @endforeach
                                 </ul>
                              </div>
                           </div>
                           <!-- /Chat contacts -->


                           <!-- Chat History -->
                           <div class="col app-chat-history">
                            <div class="chat-history-wrapper">
                               <div class="chat-history-header border-bottom">
                                  <div class="d-flex justify-content-between align-items-center">
                                     <div class="d-flex overflow-hidden align-items-center">
                                        <i class="bx bx-menu bx-sm cursor-pointer d-lg-none d-block me-2" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
                                        <div class="flex-shrink-0 avatar">
                                            @if ($chargeur_online->photo)
                                                <img src="{{ $chargeur_online->photo }}" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                                            @else
                                                <img src="{{ asset('images/default_profile_photo.png') }}" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                                            @endif
                                        </div>
                                        <div class="chat-contact-info flex-grow-1 ms-3">
                                           <h6 class="m-0">{{ $chargeur_online->nom }} {{ $chargeur_online->prenom }}</h6>
                                           <small class="user-status text-muted">{{ $chargeur_online->type_compte }}</small>
                                        </div>
                                     </div>
                                     <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                           <button class="btn p-0" type="button" id="chat-header-actions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           <i class="bx bx-dots-vertical-rounded fs-4"></i>
                                           </button>
                                           <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chat-header-actions">
                                              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter fret</a>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>

                               <div class="chat-history-body">
                                  <ul class="list-unstyled chat-history mb-0">
                                     <li class="chat-message">
                                        <div class="d-flex overflow-hidden">
                                           <div class="user-avatar flex-shrink-0 me-3">
                                              <div class="avatar avatar-sm">
                                                @if ($chargeur_online->photo)
                                                   <img src="{{ $chargeur_online->photo }}" alt="Avatar" class="rounded-circle">
                                                @else
                                                   <img src="{{ asset('images/default_profile_photo.png') }}" alt="Avatar" class="rounded-circle">
                                                @endif
                                              </div>
                                           </div>
                                           <div class="chat-message-wrapper flex-grow-1">
                                              <div class="chat-message-text">
                                                 <p class="mb-0">Hey John, Could you please help me to find it out? 🤔</p>
                                              </div>
                                              <div class="text-muted mt-1">
                                                 <small>10:02 AM</small>
                                              </div>
                                           </div>
                                        </div>
                                     </li>
                                     <li class="chat-message chat-message-right">
                                        <div class="d-flex overflow-hidden">
                                          <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text">
                                              <p class="mb-0">Sneat has all the components you'll ever need in a app.</p>
                                            </div>
                                            <div class="text-end text-muted mt-1">
                                              <i class='bx bx-check-double text-success'></i>
                                              <small>10:03 AM</small>
                                            </div>
                                          </div>
                                          <div class="user-avatar flex-shrink-0 ms-3">
                                            <div class="avatar avatar-sm">
                                                @if (Auth::check() && Auth::user()->photo)
                                                    <img src="{{ asset('images/' . Auth::user()->photo) }}" alt="Avatar" class="rounded-circle" >
                                                @else
                                                    <img src="{{ asset('images/default_profile_photo.png') }}" alt="Avatar" class="rounded-circle" >
                                                @endif
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                  </ul>
                               </div>
                               <!-- Chat message form -->
                               
                               <div class="chat-history-footer">
                                  <form class="form-send-message d-flex justify-content-between align-items-center ">
                                     <input class="form-control message-input border-0 me-3 shadow-none" placeholder="Message...">
                                     <div class="message-actions d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary d-flex send-msg-btn">
                                        <i class="bx bx-paper-plane me-md-1 me-0"></i>
                                        <span class="align-middle d-md-inline-block d-none">Envoyer</span>
                                        </button>
                                     </div>
                                  </form>
                               </div>
                            </div>
                         </div>
                         <!-- /Chat History -->

                         <!-- Sidebar Right -->
                         <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
                            <div class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap p-4 mt-2">
                               <div class="avatar avatar-xl avatar-online">
                                    @if ($chargeur_online->photo)
                                        <img src="{{ $chargeur_online->photo }}" alt="Avatar" class="rounded-circle">
                                    @else
                                        <img src="{{ asset('images/default_profile_photo.png') }}" alt="Avatar" class="rounded-circle">
                                    @endif
                               </div>
                               <h6 class="mt-3 mb-1">{{ $chargeur_online->nom }} {{ $chargeur_online->prenom }}</h6>
                               <small class="text-muted">{{ $chargeur_online->type_compte }}</small>
                               <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 d-block" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right"></i>
                            </div>
                            <div class="sidebar-body px-4 pb-4">
                               <div class="my-4">
                                  <span class="text-muted text-uppercase">Informations Personnelles</span>
                                  <ul class="list-unstyled d-grid gap-2 mt-2">
                                     <li class="d-flex align-items-center">
                                        <i class='bx bx-phone-call'></i>
                                        <span class="align-middle ms-2">{{ $chargeur_online->numero_tel }}</span>
                                     </li>
                                     <li class="d-flex align-items-center">
                                        <i class='bx bx-time-five'></i>
                                        <span class="align-middle ms-2">{{ $chargeur_online->created_at }}</span>
                                     </li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                         <!-- /Sidebar Right -->


                           <div class="app-overlay"></div>
                        </div>
                     </div>
                  </div>



                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Formulaire d'ajout de fret</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>

                         <form class="form-repeater" method="POST" action="{{ route('fret.enregister', ['numero_tel' => $chargeur_online->numero_tel ]) }}">
                           @csrf

                         <div class="modal-body">
                               <div data-repeater-list="group-a">
                                 <div data-repeater-item>

                                    <div class="row mb-3 mt-3">
                                       <div class="col">
                                         <label for="description" class="form-label">Description du fret</label>
                                         <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                       </div>
                                     </div>
 
                                   <div class="row mb-3">
                                     <div class="col">
                                       <label for="lieu_depart" class="form-label"> Lieu de depart </label>
                                       <select class="form-select" id="lieu_depart" name="lieu_depart">
                                         <option selected disabled>Select City</option>
                                         <option value="Cotonou">Cotonou</option>
                                         <option value="Porto-Novo">Porto-Novo</option>
                                         <option value="Parakou">Parakou</option>
                                         <option value="Abomey-Calavi">Abomey-Calavi</option>
                                       </select>
                                     </div>

                                     <div class="col">
                                       <label for="lieu_arrive" class="form-label">Lieu d'arrivée</label>
                                       <select class="form-select" id="lieu_arrive" name="lieu_arrive">
                                         <option selected disabled>Select City</option>
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
                                       <input type="number" class="form-control" id="montant" name="montant" placeholder="1 000 000">
                                     </div>
                                     <div class="col">
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
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->