<?php
    if(!empty($postId) && !empty($author)) {
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
              <button id="addComment" onclick="ajaxAddComment()" type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-dot-circle-o"></i> Add comment</button>
            </div>
          </div>


    <?php
    } 
    ?>