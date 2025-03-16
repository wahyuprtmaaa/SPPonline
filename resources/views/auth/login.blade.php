<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
      <meta name="author" content="AdminKit">
      <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link rel="shortcut icon" href="/dist/img/icons/icon-48x48.png" />
      <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />
      <title>Sign In | AdminKit Demo</title>
      <link href="/dist/css/app.css" rel="stylesheet">
      <link href="/dist/css/sb-admin-2.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
   </head>
   <body>
      <main class="d-flex w-100">
         <div class="container d-flex flex-column">
            <div class="row vh-100">
               <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                  <div class="d-table-cell align-middle">
                     <div class="text-center mt-4">
                        <h1 class="h2 text-dark">SMK JANDA JAYA</h1>
                     </div>
                     <div class="card">
                        <div class="card-body">
                           <div class="m-sm-4">
                            <img src="/dist/img/tutwuri.png" alt="logo" style="width: 100px; height: auto;" class="d-block mx-auto mb-3">
							  <form role="form" class="text-start" method="POST" action="{{ route('login') }}">
								@csrf
                                 <div class="mb-3">
                                    <label class="form-label">Email</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
									@error('email')
									<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
									</span>
									@enderror
                                 </div>
                                 <div class="mb-3">
                                    <label class="form-label">Password</label>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
									@error('password')
									<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
									</span>
									@enderror
                                 </div>
                                 <div class="text-center mt-3">
									<button type="submit" class="btn bg-primary text-white w-100 my-4 mb-2">Sign in</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <script src="/dist/js/app.js"></script>
   </body>
</html>
