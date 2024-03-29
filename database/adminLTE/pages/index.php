<?php
session_start();
if(isset($_SESSION["logged"]) || session_status() != 2){
  header("location: ./logged.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <?php

  /*
  session_start();
  if (isset($_SESSION["error"])) {
      echo "<div class='callout callout-danger'>";
      echo "<h5>Błąd!</h5>";
  
      foreach ($_SESSION["error"] as $key => $value) {
          echo "<p>$value</p>";
      }
  
      echo "</div>";
      unset($_SESSION["error"]);
  }

*/
    
    if (isset($_GET["error"]) || isset($_SESSION["error"])){
        echo '<div class="callout callout-danger">';
                  echo '<h5>Błąd!</h5>';
                  echo  '<p>';
                        if (isset($_GET["error"]))
                          echo $_GET["error"];
                        else if (isset($_SESSION["error"])){
                          echo $_SESSION["error"];
                          unset($_SESSION["error"]);
                        }
           echo "</p>";
           echo "</div>";
    
 
     }


     if (isset($_SESSION["success"])){
      echo <<< ERROR
   <div class="callout callout-success">
              <h5>Gratulacje!</h5>
              <p>$_SESSION[success]</p>
            </div>
ERROR;

    unset($_SESSION["success"]);

}
  ?>
  
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      

      <form action="../skrypty/login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Podaj email" name="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Podaj hasło" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
