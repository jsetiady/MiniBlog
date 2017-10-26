<?php
    include "_templates/_header.php";
?>

<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mx-4">
          <div class="card-body p-4">
            <h1>Register</h1>
            <p class="text-muted">Create your
                <i>SimpleBlog - Kelompok-4</i> account</p>
            <div class="input-group mb-3">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control" placeholder="Username">
            </div>
              
            <div class="input-group mb-3">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control" placeholder="Name">
            </div>

            <div class="input-group mb-3">
              <span class="input-group-addon">@</span>
              <input type="text" class="form-control" placeholder="Email">
            </div>

            <div class="input-group mb-3">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              <input type="password" class="form-control" placeholder="Password">
            </div>

            <div class="input-group mb-4">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              <input type="password" class="form-control" placeholder="Repeat password">
            </div>
              
            <div class="input-group mb-3">
                <button type="button" class="btn btn-block btn-success">Create Account</button>
            </div>
            
            <a href="index.php"><button type="button" class="btn btn-block btn-primary">Wait a minute, I have an account!</button></a>
          </div>
          
        </div>
      </div>
    </div>
  </div>

</body>
<?php
    include "_template/_footer.php";
?>