
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


{{-- 
                     <div class="table-responsive">
                        <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td> Contact :</td>
                                <td style="font-weight: 600; color:green;">BAMI</td>
                            </tr>
                            <tr>
                        </tbody>
                        </table>
                    </div>  --}}





                    <div class="container-xxl flex-grow-1 container-p-y">
                     <div class="app-chat overflow-hidden card">
                        <div class="row g-0">

                           <!-- Sidebar Left -->
                           <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
                              <div class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap p-4 mt-2">
                                 <div class="avatar avatar-xl avatar-online">
                                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                                 </div>
                                 <h5 class="mt-3 mb-1">John Doe</h5>
                                 <small class="text-muted">UI/UX Designer</small>
                                 <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 " data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-left"></i>
                              </div>
                           </div>
                           <!-- /Sidebar Left-->

                           <!-- Chat & Contacts -->
                           <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
                              <div class="sidebar-header pt-3 px-3 mx-1">
                                 <div class="d-flex align-items-center me-3 me-lg-0">
                                    <div class="flex-shrink-0 avatar avatar-online me-2" data-bs-toggle="sidebar" data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                                       <img class="user-avatar rounded-circle cursor-pointer" src="../../assets/img/avatars/1.png" alt="Avatar">
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
                                    <li class="chat-contact-list-item active">
                                       <a href="{{ route('gestion_demande') }}" class="d-flex align-items-center">
                                          <div class="flex-shrink-0 avatar avatar-offline">
                                             <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
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
                                       <h5 class="text-primary mb-0">Contacts</h5>
                                    </li>
                                    <li class="chat-contact-list-item">
                                       <a class="d-flex align-items-center">
                                          <div class="avatar d-block flex-shrink-0">
                                             <span class="avatar-initial rounded-circle bg-label-primary">LM</span>
                                          </div>
                                          <div class="chat-contact-info flex-grow-1 ms-3">
                                             <h6 class="chat-contact-name text-truncate m-0">Louie Mason</h6>
                                             <p class="chat-contact-status text-truncate mb-0 text-muted">Resource Manager</p>
                                          </div>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <!-- /Chat contacts -->

                           


                           <div class="app-overlay"></div>
                        </div>
                     </div>
                  </div>


                    
                  












                  <div class="container-xxl flex-grow-1 container-p-y">
                     <div class="app-chat overflow-hidden card">
                        <div class="row g-0">

                           <!-- Sidebar Left -->
                           <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
                              <div class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap p-4 mt-2">
                                 <div class="avatar avatar-xl avatar-online">
                                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                                 </div>
                                 <h5 class="mt-3 mb-1">John Doe</h5>
                                 <small class="text-muted">UI/UX Designer</small>
                                 <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 " data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-left"></i>
                              </div>
                           </div>
                           <!-- /Sidebar Left-->

                           <!-- Chat & Contacts -->
                           <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
                              <div class="sidebar-header pt-3 px-3 mx-1">
                                 <div class="d-flex align-items-center me-3 me-lg-0">
                                    <div class="flex-shrink-0 avatar avatar-online me-2" data-bs-toggle="sidebar" data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                                       <img class="user-avatar rounded-circle cursor-pointer" src="../../assets/img/avatars/1.png" alt="Avatar">
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
                                       <a class="d-flex align-items-center">
                                          <div class="flex-shrink-0 avatar avatar-offline">
                                             <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
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
                                       <h5 class="text-primary mb-0">Contacts</h5>
                                    </li>
                                    <li class="chat-contact-list-item contact-list-item-0 d-none">
                                       <h6 class="text-muted mb-0">No Contacts Found</h6>
                                    </li>
                                    <li class="chat-contact-list-item">
                                       <a class="d-flex align-items-center">
                                          <div class="avatar d-block flex-shrink-0">
                                             <span class="avatar-initial rounded-circle bg-label-primary">LM</span>
                                          </div>
                                          <div class="chat-contact-info flex-grow-1 ms-3">
                                             <h6 class="chat-contact-name text-truncate m-0">Louie Mason</h6>
                                             <p class="chat-contact-status text-truncate mb-0 text-muted">Resource Manager</p>
                                          </div>
                                       </a>
                                    </li>
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
                                             <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                                          </div>
                                          <div class="chat-contact-info flex-grow-1 ms-3">
                                             <h6 class="m-0">Felecia Rower</h6>
                                             <small class="user-status text-muted">NextJS developer</small>
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
                                                   <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
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
                                                <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
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
                                    <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                                 </div>
                                 <h6 class="mt-3 mb-1">Felecia Rower</h6>
                                 <small class="text-muted">NextJS Developer</small>
                                 <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 d-block" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right"></i>
                              </div>
                              <div class="sidebar-body px-4 pb-4">
                                 <div class="my-4">
                                    <span class="text-muted text-uppercase">Informations Personnelles</span>
                                    <ul class="list-unstyled d-grid gap-2 mt-2">
                                       <li class="d-flex align-items-center">
                                          <i class='bx bx-phone-call'></i>
                                          <span class="align-middle ms-2">+22942347890</span>
                                       </li>
                                       <li class="d-flex align-items-center">
                                          <i class='bx bx-time-five'></i>
                                          <span class="align-middle ms-2">Mon - Fri 10AM - 8PM</span>
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











                  





 
                  </div>
                  <!-- / Content -->
                  <!-- Footer -->
                  @include('supper_admin.partials.footer')
                  <!-- / Footer -->

<!-- beautify ignore:end -->