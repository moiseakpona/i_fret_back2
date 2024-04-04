<!DOCTYPE html>
<!-- beautify ignore:start -->
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <title>i-fret</title>
      <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
      <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
      <!-- Canonical SEO -->
      <link rel="canonical" href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/">
      <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
         new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
         j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
         '../../../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
         })(window,document,'script','dataLayer','GTM-5DDHKGP');
      </script>
      <!-- End Google Tag Manager -->
      <!-- Favicon -->
      <link rel="icon" href="{{ asset('../../assets/img/logo/1.jpg') }}" type="image/x-icon">
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com/">
      <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
      <!-- Icons -->
      <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />
      <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
      <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />
      <!-- Core CSS -->
      <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
      <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="../../assets/css/demo.css" />
      <!-- Vendors CSS -->
      <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
      <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
      <!-- Vendor -->
      <link rel="stylesheet" href="../../assets/vendor/libs/%40form-validation/umd/styles/index.min.css" />
      <!-- Page CSS -->
      <!-- Page -->
      <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css">
      <!-- Helpers -->
      <script src="../../assets/vendor/js/helpers.js"></script>
      <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
      <script src="../../assets/vendor/js/template-customizer.js"></script>
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="../../assets/js/config.js"></script>
   </head>
   <body>
      <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
      <!-- End Google Tag Manager (noscript) -->
      <!-- Content -->
      <div class="container-xxl">
         <div class="authentication-wrapper authentication-basic container-p-y">
            <div>
               <!-- Register -->
               <div class="card">
                  <div class="card-body">

                     <!-- Logo -->
                     <div class="app-brand justify-content-center">
                        <span class="app-brand-logo demo">
                            <img src="../../assets/img/logo/2.jpg" class="h-auto" style="width: 100px">
                        </span>
                     </div>
                     <!-- /Logo -->

                     <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('connexion') }}" >
                        @csrf

                        <div class="mb-3">
                           <label for="email" class="form-label">Email</label>
                           <input type="text"  id="email" name="email" placeholder="Enter votre email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>

                           @error('email')
                              <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>

                        <div class="mb-3 form-password-toggle">
                           <div class="d-flex justify-content-between">
                              <label class="form-label" for="password">Mot de passe </label>
                              <a href="{{ route('password') }}">
                              <small>Mot de passe oublié ?</small>
                              </a>
                           </div>
                           <div class="input-group input-group-merge">
                              <input type="password" id="password" name="password" placeholder="Enter votre mot de passe" aria-describedby="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                              @error('password')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="remember" name="remember">
                              <label class="form-check-label" for="remember">
                              Rester connecté
                              </label>
                           </div>
                        </div>
                        <div class="mb-3">
                           <button class="btn btn-primary d-grid w-100" type="submit">Se connecter</button>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- /Register -->
            </div>
         </div>

      </div>
      <!-- / Content -->

      <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
      <script src="../../assets/vendor/libs/popper/popper.js"></script>
      <script src="../../assets/vendor/js/bootstrap.js"></script>
      <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
      <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
      <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
      <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
      <script src="../../assets/vendor/js/menu.js"></script>
      <!-- endbuild -->
      <!-- Vendors JS -->
      <script src="../../assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js"></script>
      <script src="../../assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js"></script>
      <script src="../../assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js"></script>
      <!-- Main JS -->
      <script src="../../assets/js/main.js"></script>
      <!-- Page JS -->
      <script src="../../assets/js/pages-auth.js"></script>
   </body>
</html>
<!-- beautify ignore:end -->