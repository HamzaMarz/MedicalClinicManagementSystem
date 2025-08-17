<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

  <!-- Meta -->
  <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="author" content="ThemePixels">

  <title>Clinic Management - Login</title>

  <!-- vendor css -->
  <link href="Backend/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="Backend/lib/Ionicons/css/ionicons.css" rel="stylesheet">
  <link href="Backend/lib/select2/css/select2.min.css" rel="stylesheet">

  <!-- Bootstrap & custom CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="Backend/css/starlight.css">

  <style>
    body {
      background-color: #f4f7fe;
    }
    .login-container {
      margin-top: 80px;
    }
    .card {
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .clinic-title {
      font-weight: bold;
      font-size: 24px;
      color: #007bff;
    }
  </style>
</head>

<body>
  <div class="container login-container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="mb-4 text-center">
          <h2 class="clinic-title">Login</h2>
        </div>
        <div class="p-4 card">
          <form method="post" action="#">
            <div class="account-logo text-center mb-3">
              <img src="assets/img/logo-dark.png" width="50" height="50" alt="Logo">
            </div>

            <div class="mb-4">
              <label for="email" class="form-label fw-bold">Email</label>
              <div class="input-group">
                <span class="input-group-text">
                  <i class="fa fa-envelope"></i>
                </span>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
              </div>
            </div>

            <div class="mb-4">
              <label for="password" class="form-label fw-bold">Password</label>
              <div class="input-group">
                <span class="input-group-text">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
              </div>
            </div>

            <div class="mb-3 d-flex justify-content-between align-items-center">
              <div class="form-check mb-0">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
              </div>
              <a href="#" class="text-decoration-none">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 loginBtn">Login</button>

            <div class="mt-3 text-center">
              <span style="color: black;">Don't have an account? </span>
              <a href="#" class="text-decoration-none" style="color: #007bff;">Register</a>
            </div>
          </form>
        </div>
        <div class="mt-3 text-center">
          <small>Clinic System</small>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
