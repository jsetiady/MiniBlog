<?php
    include "_templates/_header.php";
?>

    <body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0">
          <div class="card p-4">
            <div class="card-body">
              <h1>Login</h1>
              <p class="text-muted">Sign In to your account</p>
              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <input type="text" class="form-control" placeholder="Username">
              </div>
              <div class="input-group mb-4">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" placeholder="Password">
              </div>
              <div class="row">
                <div class="col-6">
                  <a href="validatelogin"><button type="button" class="btn btn-primary px-4">Login</button></a>
                </div>
                <div class="col-6 text-right">
                    <a href="forgotpassword"><button type="button" class="btn btn-link px-0">Forgot password?</button></a>
                </div>
              </div>
            </div>
          </div>
          <div class="card text-white bg-primary py-5 " style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Sign up</h2>
                  <p>Create an exclusive <i>Simple Blog - Kelompok-4</i> account!</p>
                <a href="register"><button type="button" class="btn btn-primary active mt-3">Register Now!</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
    
<?php
    include "_templates/_footer.php";
?>