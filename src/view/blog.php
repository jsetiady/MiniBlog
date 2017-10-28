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
                        
                                    <div class="card ">
                                        <div class="card-body">
                                            <h4>Comment</h4>
                                            <div class="row">
                                                <div class="col-md-3">nama, email, tanggal</div>
                                                <div class="col-md-9" style="background-color:#f0f3f5;min-height:60px">comment</div>
                                            </div>
                                        </div>
                                    </div>
                        
                                      <div class="card">
                                        <div class="card-body">
                                            <h4>Add comment</h4>
                                            <div class="form-group row">
                                              <label class="col-md-3 form-control-label" for="addCommentName">Name</label>
                                              <div class="col-md-9">
                                                <input type="text" id="addCommentName" name="addCommentName" class="form-control" placeholder="Enter Name..">
                                                <div id="feedbackAddCommentName" class="invalid-feedback hidden">
                                                  Invalid name
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-md-3 form-control-label" for="addCommentEmail">Email</label>
                                              <div class="col-md-9">
                                                <input type="email" id="addCommentEmail" name="addCommentEmail" class="form-control" placeholder="Enter Email..">
                                                <div id="feedbackAddCommentEmail" class="invalid-feedback hidden">
                                                  Invalid email
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="addCommentComment">Comment</label>
                                                <div class="col-md-9">
                                                  <textarea id="addCommentComment" name="addCommentComment" rows="9" class="form-control" placeholder="Content.."></textarea>
                                                  <div id="feedbackAddCommentComment" class="invalid-feedback hidden">
                                                  Input invalid
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                          <button id="addComment" type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-dot-circle-o"></i> Add comment</button>
                                        </div>
                                      </div>
                        
                                    
                                <?php
                                } 
                                ?>
                        <?php endforeach; ?>
                        
                        
                        <?php if(!isset($postId)) { ?>
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
                        <?php } ?>
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


<script type="text/javascript">
    
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    $("button#addComment").click(function(){
        
        //check whether form is empty
        if($("input#addCommentName").val()=="") {
            $("input#addCommentName").addClass("is-invalid");
            $("div#feedbackAddCommentName").removeClass("hidden");
        } else {
            $("input#addCommentName").removeClass("is-invalid");
            $("div#feedbackAddCommentName").addClass("hidden");
        }
        
        if($("input#addCommentEmail").val()=="") {
            $("input#addCommentEmail").addClass("is-invalid");
            $("div#feedbackAddCommentEmail").removeClass("hidden");
        } else {
            $("input#addCommentEmail").removeClass("is-invalid");
            $("div#feedbackAddCommentEmail").addClass("hidden");
        }
        
        if($("textarea#addCommentComment").val()=="") {
            $("textarea#addCommentComment").addClass("is-invalid");
            $("div#feedbackAddCommentComment").removeClass("hidden");
        } else {
            
            $("textarea#addCommentComment").removeClass("is-invalid");
            $("div#feedbackAddCommentComment").addClass("hidden");
        }
        
        //email format validation
        if(!validateEmail($("input#addCommentEmail").val())) {
            $("input#addCommentEmail").addClass("is-invalid");
            $("div#feedbackAddCommentEmail").removeClass("hidden");
        } else {
            $("input#addCommentEmail").removeClass("is-invalid");
            $("div#feedbackAddCommentEmail").addClass("hidden");
        }
    });

</script>