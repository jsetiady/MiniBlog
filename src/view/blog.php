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
                                <a href="#" onclick='confirmdelete(<?php echo $d->postId?>, "<?php echo $d->postAuthor?>")'><span class="badge badge-danger float-right launch-confirm" data-toggle="modal"   >Delete</span></a>&nbsp;&nbsp;
                                <a href="<?php echo API_URL?>editpost/<?php echo $d->postAuthor; ?>/<?php echo $d->postId?>"><span class="badge badge-warning float-right">Edit</span></a>
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
                                                <div id="commentSection">
                                                    <div class="row">
                                                        <div class="col-md-3">0 comment</div>
                                                    </div><br/>
                                                </div>
                                            </div>
                                        </div>
                                    
                        
                                      <div class="card">
                                        <div class="card-body">
                                            <h4>Add comment</h4>
                                                <form id="commentForm" method="post" >
                                                    <div class="form-group row">
                                                      <label class="col-md-3 form-control-label" for="addCommentName">Name</label>
                                                      <div class="col-md-9">
                                                        <input type="text" id="addCommentName" name="name" class="form-control" placeholder="Enter Name..">
                                                        <div id="feedbackAddCommentName" class="invalid-feedback hidden">
                                                          Invalid name
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label class="col-md-3 form-control-label" for="addCommentEmail">Email</label>
                                                      <div class="col-md-9">
                                                        <input type="email" id="addCommentEmail" name="email" class="form-control" placeholder="Enter Email..">
                                                        <div id="feedbackAddCommentEmail" class="invalid-feedback hidden">
                                                          Invalid email
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="addCommentComment">Comment</label>
                                                        <div class="col-md-9">
                                                          <textarea id="addCommentComment" name="comment" rows="9" class="form-control" placeholder="Content.."></textarea>
                                                          <div id="feedbackAddCommentComment" class="invalid-feedback hidden">
                                                          Input invalid
                                                          </div>
                                                          <input type="hidden" id="addCommentDate" name="commentDate" />
                                                          <input type="hidden" id="addCommentPostId" name="postId" />
                                                      </div>
                                                    </div>
                                                </form>
                                        </div>
                                        <div class="card-footer">
                                          <button id="addComment" type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-dot-circle-o"></i> Add comment</button>
                                        </div>
                                      </div>
                        
                                    
                                <?php
                                } 
                                ?>
                        <?php endforeach; ?>
                        
                        <?php
                        if (empty($data))
                        {
                        ?>
                       
                        <div class="card card" style="margin-top:40px">
                            <div class="card-body">
                              No post found.
                            </div>
                        </div>
                        <?
                        }
                        ?>
                        
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
                    
                    <?php
                        if (!empty($data))
                        {
                    ?>
                        <div class="col-md-3">
                            <div class="card card-accent-info" style="margin-top:40px">
                                <div class="card-header">
                                  Blog Author
                                </div>
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                      <span class="input-group-addon">@</span>
                                      <input style="background-color:#FFF" type="text" class="form-control" disabled placeholder="Username" value="<?php echo $data[0]->postAuthor; ?>">
                                    </div>
                                </div>
                              </div>
                        </div>
                        <?
                        }
                        ?>
                    
                    
                </div>
            </div>
          </div>
      </div>
    </main>

     
    
    
    <footer class="app-footer">
        <span> © Kelompok-4 IF5192 Secure Programming 2017</span>
      </footer>

<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirmation required</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure want to delete the post?</p>
        <p><i>Apakah Anda yakin menghapus post ini?</i></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="">Confirm</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>    
    
</body>

<?php
    include "_templates/_footer.php";
?>


<script type="text/javascript">
    
    
   function confirmdelete(id, author) {
       var result = confirm("Apakah Anda yakiin menghapus post ini?");
        if (result) {
            $.ajax({
                type : 'POST',
                url : "<?php echo API_URL;?>api/v1/posts/delete",           
                data: {
                    postId : id,
                    postAuthor : author,
                },
                success:function (data) {
                    location.reload();                
                },
                fail:function(data) {
                    console.log("error");
                }
            }); 
        }

   }
    
    $(document).ready(function() {
        <?php
        if(isset($postId)) {
    ?>
        reloadComment(); 
        <?php
        }
       ?>
    });
    
    function showConfirmation(id) {
        $('#smallModal').show(); 
        $('#smallModal').addClass('show'); 
    }
    
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    
    function getCommentStructure(name, email, date, comment) {
        var commentStructure = "<div class=\"row\"><div class=\"col-md-3\"><b>"+name+" ("+email+") </b> on <i>"+date+"</i></div><div class=\"col-md-9\" style=\"background-color:#f0f3f5;min-height:60px\">"+comment+"</div></div><br/>";
        return commentStructure;
    }
    
    function reloadComment() {
        $.ajax({
            type:"GET", 
            url: "<?php echo API_URL;?>api/v1/comments/<?php echo $postId;?>", 
            success: function(data) {
                console.log(data.length);
                for(i=0;i<data.length;i++) {
                    var commentStructure = getCommentStructure(data[i].name, data[i].email, data[i].commentDate, data[i].comment);
                    if(i==0) {
                        $("#commentSection").html(commentStructure);
                    } else {
                        $("#commentSection").append(commentStructure);
                    }
                }
            }, 
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
        });
    }

    $("button#addComment").click(function(){
        
        var valid = true;
        //check whether form is empty
        if($("input#addCommentName").val()=="") {
            $("input#addCommentName").addClass("is-invalid");
            $("div#feedbackAddCommentName").removeClass("hidden");
            valid = false;
            console.log(1);
        } else {
            $("input#addCommentName").removeClass("is-invalid");
            $("div#feedbackAddCommentName").addClass("hidden");
        }
        
        if($("input#addCommentEmail").val()=="") {
            $("input#addCommentEmail").addClass("is-invalid");
            $("div#feedbackAddCommentEmail").removeClass("hidden");
            valid = false;
            console.log(2);
        } else {
            $("input#addCommentEmail").removeClass("is-invalid");
            $("div#feedbackAddCommentEmail").addClass("hidden");
        }
        
        if($("textarea#addCommentComment").val()=="") {
            $("textarea#addCommentComment").addClass("is-invalid");
            $("div#feedbackAddCommentComment").removeClass("hidden");
            valid = false;
            console.log(3);
        } else {
            
            $("textarea#addCommentComment").removeClass("is-invalid");
            $("div#feedbackAddCommentComment").addClass("hidden");
        }
        
        //email format validation
        if(!validateEmail($("input#addCommentEmail").val())) {
            $("input#addCommentEmail").addClass("is-invalid");
            $("div#feedbackAddCommentEmail").removeClass("hidden");
            valid = false;
            console.log(4);
        } else {
            $("input#addCommentEmail").removeClass("is-invalid");
            $("div#feedbackAddCommentEmail").addClass("hidden");
        }
        
        if(valid) {
            $("input#addCommentDate").val("2017-01-01 00:00:00");
            $("input#addCommentPostId").val(<?php echo $postId?>);
            
            
            var data = $('#commentForm').serialize();
            $.ajax({
                type : 'POST',
                url : "<?php echo API_URL;?>api/v1/comments",           
                data: {
                    postId : $('input#addCommentPostId').val(),
                    name   : $('input#addCommentName').val(),
                    email  : $('input#addCommentEmail').val(),
                    comment  : $('textarea#addCommentComment').val(),
                    commentDate  : $('input#addCommentDate').val()
                },
                success:function (data) {
                   $("#commentForm")[0].reset();
                   reloadComment();
                },
                fail:function(data) {
                    console.log("error");
                }
            });     

        }
        
        
        
    });

</script>