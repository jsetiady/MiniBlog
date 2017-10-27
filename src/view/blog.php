<?php
    include "_templates/_header.php";
?>


<body class="app header-fixed sidebar-fixed aside-menu-hidden pace-done sidebar-hidden">
    <?php  include "_templates/_nav_header.php"; ?>
    
    <!-- Main content -->
    <main class="main">
      <div class="container-fluid">
        <div id="ui-view" style="opacity: 1;">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col"><br/>
                    <center><img src="<?php echo API_URL . "public/img/cover.png"; ?>" height="220px" style="margin-top:50px"/></center>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-9">
                        
                        <?php foreach($data as $d): ?>
                        <div class="card card-accent-info" style="margin-top:40px">
                            <div class="card-header">
                                <a href="<?php echo API_URL . "blog/" . $d->postAuthor . "/" . $d->postId ;?>"><h3><?php echo $d->postTitle; ?></h3></a><span>Posted by <b><?php echo $d->postAuthor; ?></b> at <?php echo $d->postDate?></span>
                                <span class="badge badge-danger float-right">Delete</span>&nbsp;&nbsp;
                                <span class="badge badge-warning float-right">Edit</span>
                            </div>
                            <div class="card-body">
                                <p> <?php echo $d->postContent; ?></p>
                                <?php if(!isset($postId)) { ?><a href="#" class="float-right">View Comments</a> <?php } ?>
                            </div>
                         </div>
                        <?php
                                if(isset($postId)) {
                                ?>
                                          <div class="card">
                                            <div class="card-body">
                                                <h4>Add comment</h4>
                                              <form action="" method="post" class="form-horizontal">
                                                <div class="form-group row">
                                                  <label class="col-md-3 form-control-label" for="hf-name">Name</label>
                                                  <div class="col-md-9">
                                                    <input type="email" id="hf-email" name="hf-name" class="form-control" placeholder="Enter Name..">
                                                    <span class="help-block">Please enter your name</span>
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                  <label class="col-md-3 form-control-label" for="hf-email">Email</label>
                                                  <div class="col-md-9">
                                                    <input type="password" id="hf-password" name="hf-email" class="form-control" placeholder="Enter Email..">
                                                    <span class="help-block">Please enter your email</span>
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="hf-name">Comment</label>
                                                    <div class="col-md-9">
                                                      <textarea id="textarea-input" name="textarea-input" rows="9" class="form-control" placeholder="Content.."></textarea>
                                                      <span class="help-block">Enter comment</span>
                                                  </div>
                                                </div>
                                              </form>
                                            </div>
                                            <div class="card-footer">
                                              <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-dot-circle-o"></i> Add comment</button>
                                            </div>
                                          </div>
    
                                <?php
                                } 
                                ?>
                        <?php endforeach; ?>
                        
                        
                        <ul class="pagination">
                              <?php
                              for($i=0;$i<$page;$i++) {
                                  ?>
                            <li class="page-item <?php if($i==($pg-1)) { echo "active"; } ?>">
                              <a class="page-link" href="?page=<?php echo $i+1; ?>"><?php echo $i+1; ?></a>
                            </li>
                              <?php
                              }
                                ?>
                          </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-accent-info" style="margin-top:40px">
                            <div class="card-header">
                              Blog Author
                            </div>
                            <div class="card-body">
                              Name
                              Username
                            </div>
                            
                          </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </main>

     
    
    
    <footer class="app-footer">
        <span> © Kelompok-4 IF5192 Secure Programming 2017</span>
      </footer>

</body>

<?php
    include "_templates/_footer.php";
?>
