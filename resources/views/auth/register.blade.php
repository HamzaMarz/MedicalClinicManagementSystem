<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Clinic Management - Register</title>

    <!-- vendor css -->
    <link href="Backend/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="Backend/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="Backend/lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="Backend/css/starlight.css">

    <style>
      body{ background:#f5f6fa; }
      .auth-card{
        max-width:560px; margin:40px auto;
        border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,.08);
        overflow:hidden; background:#fff;
      }
      .auth-card .card-header{
        background:#5b93d3; color:#fff; font-weight:600; letter-spacing:.3px;
      }
      .form-group label{ font-weight:600; }
      .btn-primary{
        border-radius:8px; padding:.6rem 1.2rem; font-weight:600;
      }
      .muted-link{
        color:#6c757d; text-decoration:underline;
      }
      .muted-link:hover{ color:#343a40; text-decoration:none; }
    </style>
  </head>

  <body>

    <div class="container">
      <div class="auth-card card">
        <div class="card-header">
          <h5 class="mb-0">Register</h5>
        </div>
        <div class="card-body">
          <form id="registerForm" action="#" method="post" novalidate>
            <!-- Name -->
            <div class="form-group">
              <label for="name">Name</label>
              <input id="name" class="form-control" type="text" name="name" required autocomplete="name" />
              <small class="text-danger d-none" id="err-name">Please enter your name.</small>
            </div>

            <!-- Email Address -->
            <div class="form-group mt-3">
              <label for="email">Email</label>
              <input id="email" class="form-control" type="email" name="email" required autocomplete="username" />
              <small class="text-danger d-none" id="err-email">Please enter a valid email.</small>
            </div>

            <!-- Password -->
            <div class="form-group mt-3">
              <label for="password">Password</label>
              <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
              <small class="text-danger d-none" id="err-password">Please enter a password (min 6 chars).</small>
            </div>

            <!-- Confirm Password -->
            <div class="form-group mt-3">
              <label for="password_confirmation">Confirm Password</label>
              <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
              <small class="text-danger d-none" id="err-password-confirm">Passwords do not match.</small>
            </div>

            <div class="d-flex align-items-center justify-content-between mt-4">
              <a class="muted-link" href="login.html">Already registered?</a>
              <button type="submit" class="btn btn-primary ms-4">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="Backend/lib/popper.js/popper.js"></script>
    <script src="Backend/lib/bootstrap/bootstrap.js"></script>
    <script src="Backend/lib/select2/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   
  </body>
</html>
