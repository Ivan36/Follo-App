<?php

require_once 'includes/dbconnection.php';

if (isset($_REQUEST['id'])) {
  $id = intval($_REQUEST['id']);
  $query =mysqli_query($con,"SELECT * FROM referal_tb WHERE id='$id'");
  while ($row=mysqli_fetch_array($query)) {


    ?>


    <div class="table-responsive">
      <p class="text-center">
        <i class="fa fa-user"></i> Referral Details</p>
        <form action="accounts.php" method="post" enctype="multipart/form-data" class="form-horizontal myform">
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="text-input"  class="form-control-label">Mother Name</label>
            </div>
            <div class="col-12 col-md-9">
              <p><?php echo $row['mother']; ?></p>
              
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="text-input"  class="form-control-label">Phone Number</label>
            </div>
            <div class="col-12 col-md-9">
              <p><?php echo $row['contact']; ?></p>
              
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="text-input"  class="form-control-label">Refeered On</label>
            </div>
            <div class="col-12 col-md-9">
              <p><?php echo $row['date']; ?></p>
              
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="text-input"  class="form-control-label">Notes</label>
            </div>
            <div class="col-12 col-md-9">
              <p><?php echo $row['comment']; ?></p>
              
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="text-input"  class="form-control-label">Refeered To</label>
            </div>
            <div class="col-12 col-md-9">
              <p><?php echo $row['referral']; ?></p>
              
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="text-input"  class="form-control-label">Feedback from Referral</label>
            </div>
            <div class="col-12 col-md-9">
              <p><?php
              if ($row['feedback']=='') {
                echo "No feedback from referral yet";
              }else{
                echo $row['feedback'];
             }
             ?></p>
           </div>
         </div>
         <div class="row form-group">
          <div class="col col-md-3">
            <label for="text-input"  class="form-control-label">Feedback On</label>
          </div>
          <div class="col-12 col-md-9">
            <p><?php echo $row['feedback_date']; ?></p>

          </div>
        </div>
        <div class="card-footer">
          <!-- <p style="text-align: center;"><button type="submit" name="updateuser" id="updateuser" class="btn btn-primary btn-sm">update account
          </button></p> -->

        </div>
      </form>

    </div>

    <?php
  }
}
?>