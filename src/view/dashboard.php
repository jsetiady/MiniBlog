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
                          <i class="fa fa-align-justify"></i> List Post. Author: Tara Basro (<a href="blog/">View Blog</a>)
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
                                    <a href="editpost?postId=<?php echo $d->postId?>"><span class="badge badge-warning">Edit</span></a>&nbsp;
                                    <a href="#"><span class="badge badge-danger" data-toggle="modal" data-target="#smallModal">Delete</span></a>
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
        <p>You are going to remove post. Removed project CANNOT be restored! Are you ABSOLUTELY sure?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger">Confirm</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>    
    
    
    <footer class="app-footer">
        <span> © Kelompok-4 IF5192 Secure Programming 2017</span>
      </footer>
 
    
    

</body>



<?php
    include "_templates/_footer.php";
?>

<!--
<script type="text/javascript">
    var $ = jQuery;

$(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "http://localhost:8888/MiniBlog/api/v1/posts/jeje"
    } );
} );
</script>
-->
