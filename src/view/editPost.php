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
                <div class="row"><div class="col-md-2"><a href="#" onclick="goBack()"><button type="button" class="btn btn-primary active mt-3"> << Back </button><br/></a></div></div>
                <div class="row"><div class="col-md-2"><br/></div></div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <strong>Edit Post</strong>
                        </div>
                        <div class="card-body">
                          <form action="updatePost" id="editPost" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label">Blog Author</label>
                              <div class="col-md-9">
                                <p class="form-control-static"><?php echo $_SESSION['username']; ?></p>
                              </div>
                                
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Post Title</label>
                              <div class="col-md-9">
                                <input type="hidden" id="postId" name="postId" class="form-control" value="<?php echo $postId ?>">
                                <input type="hidden" id="postAuthor" name="postAuthor" class="form-control" value="<?php echo $_SESSION['username']; ?>">
                                <input type="text" id="postTitle" name="postTitle" class="form-control" placeholder="Post Title" value="<?php echo $data->postTitle;?>">
                              <div id="feedbackPostTitle" class="invalid-feedback hidden">
                                  Invalid input
                                </div>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Post Date</label>
                              <div class="col-md-9">
                                    <p class="form-control-static"><?php echo $data->postDate; ?></p>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="textarea-input">Content</label>
                              <div class="col-md-9">
                                <textarea id="postContent" name="postContent" rows="9" class="form-control" placeholder="Content.."><?php echo $data->postContent;?></textarea>
                                <div id="feedbackPostContent" class="invalid-feedback hidden">
                                  Invalid input
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="card-footer">
                          <button type="submit" id="editPost" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Update</button>
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


<script>
    
    function goBack() {
        window.history.back();
    }
        
    $("button#editPost").click(function(){
        
        var valid = true;
        //check whether form is empty
        if($("input#postTitle").val()=="") {
            $("input#postTitle").addClass("is-invalid");
            $("div#feedbackPostTitle").removeClass("hidden");
            valid = false;
        } else {
            $("input#postTitle").removeClass("is-invalid");
            $("div#feedbackPostTitle").addClass("hidden");
        }
                
        if($("textarea#postContent").val()=="") {
            $("textarea#postContent").addClass("is-invalid");
            $("div#feedbackPostContent").removeClass("hidden");
            valid = false;
        } else {
            $("textarea#postContent").removeClass("is-invalid");
            $("div#feedbackPostContent").addClass("hidden");
        }
        
        
        if(valid) { 
            $("form#editPost").submit();
        }
        
        
        
    });
</script>
    