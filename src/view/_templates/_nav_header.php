<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" style="background-size:120px auto"></a>
        
    <?php if($_SESSION['username']) { ?>
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="d-md-down-none"><?php echo $_SESSION['username']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-header text-center">
                <strong>Account</strong>
              </div>
                <?php if($_SESSION['role']=="1") { ?> 
              <a class="dropdown-item" href="<?php echo API_URL;?>blog"><i class="fa fa-tasks"></i> View My Blog</a>
                <?php } ?>
              <a class="dropdown-item" href="<?php echo API_URL;?>changepassword"><i class="fa fa-wrench"></i> Change Password</a>
              <a class="dropdown-item" href="<?php echo API_URL;?>logout"><i class="fa fa-lock"></i> Logout</a>
            </div>
          </li>
        </ul>
        <span class="input-group-addon" style="border:0;background-color:#FFFFFF"><i class="fa fa-user"></i></span>
        <span class="input-group-addon" style="border:0;background-color:#FFFFFF"></span>
    <?php } else { ?>
    <a href="<?php echo API_URL;?>" style="margin:100px"><button type="button" class="btn btn-primary px-4" >Login</button></a>
    <?php }  ?>
    

  </header>