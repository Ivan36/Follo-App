<?php

require_once 'includes/dbconnection.php';

if (isset($_REQUEST['id'])) {
  $id = intval($_REQUEST['id']);
  $query =mysqli_query($con,"SELECT * FROM vhts WHERE id='$id'");
  while ($row=mysqli_fetch_array($query)) {


    ?>


    <div class="table-responsive">

      <form action="vhts_list.php" method="post" enctype="multipart/form-data" class="form-horizontal myform">

        <input type="hidden" id="id" value="<?php echo $row['id'] ?>" name="id" class="form-control" required="">
        <div class="row form-group">
          <div class="col col-md-3">
            <label for="text-input"  class=" form-control-label">First Name</label>
          </div>
          <div class="col-12 col-md-9">

            <input type="text" id="f_name" value="<?php echo $row['first_name'] ?>" name="f_name" placeholder="Enter First Name" class="form-control" required="">

          </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3">
            <label for="email-input" class="form-control-label">Last Name</label>
          </div>
          <div class="col-12 col-md-9">
            <input type="text" id="l_name" name="l_name" value="<?php echo $row['last_name'] ?>" placeholder="Enter Last Name" class="form-control" required="">

          </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3">
            <label for="textarea-input" class=" form-control-label">Email Address</label>
          </div>
          <div class="col-12 col-md-9">
           <input type="text" id="e_address" name="e_address" value="<?php echo $row['user_email'] ?>" placeholder="Enter Email Address" class="form-control" required="">
         </div>
       </div>
       <div class="row form-group">
        <div class="col col-md-3">
          <label for="password-input" class=" form-control-label">Phone Number</label>
        </div>
        <div class="col-12 col-md-9">
          <input type="number" id="m_contact" name="m_contact" value="<?php echo $row['contact'] ?>" placeholder="Mobile Number" class="form-control" maxlength="10" required="">

        </div>
      </div>
      <div class="row form-group">
        <div class="col col-md-3">
          <label for="password-input" class=" form-control-label">Home Area or Address</label>
        </div>
        <div class="col-12 col-md-9">
          <input type="text" id="address" name="address" value="<?php echo $row['address'] ?>" placeholder="Home area or address" class="form-control" required="">

        </div>
      </div>
      <div class="row form-group">
        <div class="col col-md-3">
          <label for="password-input" class=" form-control-label">Password</label>
        </div>
        <div class="col-12 col-md-9">
          <input type="Password" id="password" name="password" value="<?php echo $row['user_password'] ?>" placeholder="*********" class="form-control" required="">

        </div>
      </div>
      <div class="card-footer">
        <p style="text-align: center;"><button type="submit" name="update_vht" id="reg_vht" class="btn btn-primary btn-sm">Update data
        </button></p>

      </div>
    </form>

  </div>

  <?php
}
}
?>