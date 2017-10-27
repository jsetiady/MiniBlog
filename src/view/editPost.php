<?php
    include "_templates/_header.php";
?>


<body class="app header-fixed sidebar-fixed aside-menu-hidden pace-done sidebar-hidden">
    <?php  include "_templates/_nav_header.php"; ?>
    
    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="http://coreui.io/demo/Ajax_Demo/#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>

      <div class="container-fluid">
        <div id="ui-view" style="opacity: 1;">
            <div class="animated fadeIn">
                <div class="row"><div class="col-md-2"><a href="home"><button type="button" class="btn btn-primary active mt-3"> << Back to  Post List </button><br/></a></div></div>
                <div class="row"><div class="col-md-2"><br/></div></div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <strong>Edit Post</strong>
                        </div>
                        <div class="card-body">
                          <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label">Blog Author</label>
                              <div class="col-md-9">
                                <p class="form-control-static">Name (Username)</p>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Post Title</label>
                              <div class="col-md-9">
                                <input type="text" id="text-input" name="text-input" class="form-control" placeholder="Text">
                                <span class="help-block">This is a help text</span>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Post Date</label>
                              <div class="col-md-9">
                                <input type="text" id="text-input" name="text-input" class="form-control" placeholder="Text">
                                <span class="help-block">This is a help text</span>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="textarea-input">Textarea</label>
                              <div class="col-md-9">
                                <textarea id="textarea-input" name="textarea-input" rows="9" class="form-control" placeholder="Content.."></textarea>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="card-footer">
                          <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Update</button>
                          <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
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
