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
    
    
</body>

<?php
    include "_templates/_footer.php";
?>


<script type="text/javascript">
    
    
   function confirmdelete(id, author) {
       var result = confirm("Apakah Anda yakin menghapus post ini?");
        if (result) {
            $("form#delete"+id).submit();
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