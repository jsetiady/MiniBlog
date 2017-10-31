 <?php
    if (!empty($_SESSION['author']))
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
    <?php
    }
    ?>