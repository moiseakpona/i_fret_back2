
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
                                    @foreach($usersEtEndMessage as $userEtEndMessage)
                                       <li class="chat-contact-list-item">
                                          <a href="{{ route('detail_chat', ['numero_tel' => $userEtEndMessage['utilisateur']->numero_tel]) }}" class="d-flex align-items-center">
                                             @if ( $userEtEndMessage['dernierMessage']->statut)
                                                <div class="flex-shrink-0 avatar">
                                             @else
                                                <div class="flex-shrink-0 avatar avatar-online">
                                             @endif
                                                @if ($userEtEndMessage['utilisateur']->photo)
                                                   <img src="{{ $userEtEndMessage['utilisateur']->photo }}" alt="Photo de profil" class="rounded-circle">
                                                @else
                                                   <img src="{{ asset('images/default_profile_photo.png') }}" alt="Avatar" class="rounded-circle">
                                                @endif
                                             </div>
                                             <div class="chat-contact-info flex-grow-1 ms-3">
                                                <h6 class="chat-contact-name text-truncate m-0">{{ $userEtEndMessage['utilisateur']->nom }} {{ $userEtEndMessage['utilisateur']->prenom }}</h6>
                                                <p class="chat-contact-status text-truncate mb-0 text-muted">{{ $userEtEndMessage['dernierMessage']->message }}</p>
                                             </div>
                                             <small class="text-muted mb-auto">{{ $userEtEndMessage['dernierMessage']->created_at }}</small>
                                          </a>
                                       </li>
                                    @endforeach
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

                           


                           <div class="app-overlay"></div>
                        </div>
                     </div>
                  </div>



                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->