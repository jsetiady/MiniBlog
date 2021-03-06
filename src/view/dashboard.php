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
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-2"></div>
                    <div class="col-2">
                        <a href="newpost"><button type="button" class="btn btn-success active mt-3">Add New Post</button><br/></a>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <i class="fa fa-align-justify"></i> List Post (<a href="blog/">View Blog</a>)
                        </div>
                        <div class="card-body">
                          <table class="table" id="example">
                            <thead>
                              <tr>
                                <th>Title</th>
                                <th>Posting Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($data as $d):
                                ?>
                              <tr>
                                <td><?php echo $d->postTitle; ?></td>
                                <td><?php echo $d->postDate; ?></td>
                                <td>
                                    <a href="blog/<?php echo $d->postAuthor."/".$d->postId; ?>"><span class="badge badge-success">View Post</span></a>&nbsp;
                                    <a href="editpost?postId=<?php echo $d->postId?>"><span class="badge badge-warning">Edit</span></a>&nbsp;<a href="#" onclick='confirmdelete(<?php echo $d->postId;?>, "<?php echo $d->postAuthor?>")'><span  class="badge badge-danger" >Delete</span></a>
                                    <form method="post" action="deletePost" id="delete<?php echo $d->postId;?>">
                                        <input type="hidden" name="postAuthor" value="<?php echo $d->postAuthor; ?>"/>
                                        <input type="hidden" name="postId" value="<?php echo $d->postId;?>"/>
                                    </form>
                                </td>
                              </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                          </table>
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
    function confirmdelete(id, author) {
       var result = confirm("Apakah Anda yakin menghapus post ini?");
        if (result) {
            $("form#delete"+id).submit();
        }

   }
</script>
