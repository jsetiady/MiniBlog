<div class="card card-accent-info" style="margin-top:40px">
    <div class="card-header">
        <a href="<?php echo API_URL . "blog/" . $d->postAuthor . "/" . $d->postId ;?>">
            <h3><?php echo $d->postTitle; ?></h3>
        </a>
        <span>Posted by <b><?php echo $d->postAuthor; ?></b> at <?php echo $d->postDate?></span>
        <?php if ($_SESSION['username'] == $d->postAuthor) { ?>
            <a href="#" onclick='confirmdelete(<?php echo $d->postId?>, "<?php echo $d->postAuthor?>")'>
                <span class="badge badge-danger float-right launch-confirm" data-toggle="modal"   >Delete</span>
        </a>&nbsp;&nbsp;
            <a href="<?php echo API_URL?>editpost?postId=<?php echo $d->postId?>&blog=1">
                <span class="badge badge-warning float-right">Edit</span>
        </a>
            <form method="post" action="<?php echo API_URL?>deletePost" id="delete<?php echo $d->postId;?>">
                <input type="hidden" name="postAuthor" value="<?php echo $d->postAuthor; ?>"/>
                <input type="hidden" name="postId" value="<?php echo $d->postId;?>"/>
                <input type="hidden" name="back" value="blog"/>
            </form>
        <?php } ?>
    </div>
    <div class="card-body">
        <p> <?php echo $d->postContent; ?></p>
        <?php if(!isset($postId)) { ?><a href="<?php echo API_URL . "blog/" . $d->postAuthor . "/" . $d->postId ;?>" class="float-right">View Comment(s)</a> <?php } ?>
    </div>
 </div>