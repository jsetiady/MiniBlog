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
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <i class="fa fa-align-justify"></i> List User
                        </div>
                        <div class="card-body">
                          <table class="table" id="example">
                            <thead>
                              <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($data as $d):
                                ?>
                              <tr>
                                <td><?php echo $d['username']; ?></td>
                                <td><?php echo $d['name']; ?></td>
                                <td><?php echo $d['email']; ?></td>
                                <td><?php echo $d['role'] ? "user": "admin"; ?></td>
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
