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