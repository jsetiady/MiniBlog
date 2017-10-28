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
                          <strong>Add New Post</strong>
                        </div>
                        <div class="card-body">
                          <form action="addPost" id="addPost" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label">Blog Author</label>
                              <div class="col-md-9">
                                <p class="form-control-static"><?php echo $_SESSION['username']; ?></p>
                              </div>
                                
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Post Title</label>
                              <div class="col-md-9">
                                <input type="text" id="postTitle" name="postTitle" class="form-control" placeholder="Post Title">
                              <div id="feedbackPostTitle" class="invalid-feedback hidden">
                                  Invalid input
                                </div>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Post Date</label>
                              <div class="col-md-9">
                                  <div class="row">
                                    <div class="form-group col-sm-3">
                                        <input type="date" style="length:50%" name="postDate" id="postDate" min="<?php echo date('Y-m-d')?>"  class="form-control" value="<?php echo date('Y-m-d');?>" placeholder="Date">
                                        <div id="feedbackPostDate" class="invalid-feedback hidden">
                                          Invalid input
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <input type="time" id="postTime" name="postTime" class="form-control" min = "<?php date_default_timezone_set("Asia/Bangkok"); echo date('H:i:s');?>" placeholder="Time" value="<?php  echo date('H:i');?>">
                                        <div id="feedbackPostTime" class="invalid-feedback hidden">
                                          Invalid input
                                        </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="textarea-input">Content</label>
                              <div class="col-md-9">
                                <textarea id="postContent" name="postContent" rows="9" class="form-control" placeholder="Content.."></textarea>
                                <div id="feedbackPostContent" class="invalid-feedback hidden">
                                  Invalid input
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="card-footer">
                          <button type="submit" id="addPost" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
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


<script>
    
    function goBack() {
        window.history.back();
    }
    
    function validateDate() {
        var mydate = document.getElementById('postDate');
        var mytime = document.getElementById('postTime');
        var timeValue = mytime.value.substring(0, 5);
        var timeValueMin = mytime.min.substring(0, 5);
        var value = new Date(mydate.value + " " + timeValue);
        var min = new Date(mydate.min + " " + timeValueMin);
        if (value < min) {
            return false;
        } else {
            return true;
        }
    }
    
    $("button#addPost").click(function(){
        
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
        
        if($("input#postDate").val()=="") {
            $("input#postDate").addClass("is-invalid");
            $("div#feedbackPostDate").removeClass("hidden");
            valid = false;
        } else {
            $("input#postDate").removeClass("is-invalid");
            $("div#feedbackPostDate").addClass("hidden");
        }
        
        if($("input#postTime").val()=="") {
            $("input#postTime").addClass("is-invalid");
            $("div#feedbackPostTime").removeClass("hidden");
            valid = false;
        } else {
            $("input#postTime").removeClass("is-invalid");
            $("div#feedbackPostTime").addClass("hidden");
        }
        
        if($("textarea#postContent").val()=="") {
            $("textarea#postContent").addClass("is-invalid");
            $("div#feedbackPostContent").removeClass("hidden");
            valid = false;
        } else {
            $("textarea#postContent").removeClass("is-invalid");
            $("div#feedbackPostContent").addClass("hidden");
        }
        
        
        //date validation
        if(!validateDate()) {
            $("input#postDate").addClass("is-invalid");
            $("div#feedbackPostDate").removeClass("hidden");
            $("input#postTime").addClass("is-invalid");
            $("div#feedbackPostTime").removeClass("hidden");
            valid = false;
        }
        
        if(valid) { 
            $("form#addPost").submit();
            /*$.ajax({
                type : 'POST',
                url : "<?php echo API_URL;?>api/v1/posts/add",           
                data: {
                    postTitle : $('input#postTitle').val(),
                    postAuthor : "<?php echo $_SESSION['username']; ?>",
                    postDate  : $('input#postDate').val() + " " + $("input#postTime").val(),
                    postContent  : $('textarea#postContent').val()
                },
                success:function (data) {
                    window.location.href = "<?php echo API_URL; ?>index.php";

                },
                fail:function(data) {
                    console.log("error");
                }
            });   
            */

        }
        
        
        
    });
</script>
    