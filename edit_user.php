<?php

require_once 'includes/dbconnection.php';

if (isset($_REQUEST['id'])) {
  $id = intval($_REQUEST['id']);
  $query =mysqli_query($con,"SELECT * FROM tbladmin WHERE ID='$id'");
  while ($row=mysqli_fetch_array($query)) {


    ?>


    <div class="table-responsive">
      <p class="text-center">
        <i class="fa fa-user"></i> Update Account Info</p>
        <form action="accounts.php" method="post" enctype="multipart/form-data" class="form-horizontal myform">
          <input type="hidden" id="id" name="id" value="<?php echo $row['ID'] ?>"  class="form-control" required="">
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="text-input"  class="form-control-label">Full Name</label>
            </div>
            <div class="col-12 col-md-9">

              <input type="text" id="f_name" name="f_name" value="<?php echo $row['AdminName'] ?>" class="form-control" required="">

            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="email-input" class="form-control-label">User Name</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="u_name" name="u_name" value="<?php echo $row['UserName'] ?>" class="form-control" required="">

            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="textarea-input" class=" form-control-label">Email Address</label>
            </div>
            <div class="col-12 col-md-9">
             <input type="text" id="e_address" name="e_address" value="<?php echo $row['Email'] ?>" class="form-control" required="">
           </div>
         </div>
         <div class="row form-group">
          <div class="col col-md-3">
            <label for="password-input" class=" form-control-label">Phone Number</label>
          </div>
          <div class="col-12 col-md-9">
            <input type="number" id="m_contact" name="m_contact" value="<?php echo $row['MobileNumber'] ?>" class="form-control" maxlength="10" required="">

          </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3">
            <label for="password-input" class=" form-control-label">Role</label>
          </div>
          <div class="col-12 col-md-9">
            <select class="form-control" name="role" required="true" >
              <option value="<?php echo $row['role'] ?>" selected><?php echo $row['role'] ?></option>
              <option value="admin">admin</option>
              <option value="doctor">doctor</option>
              <option value="clinician">clinician</option>
              <option value="receptionist">receptionist</option>

            </select>

          </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3">
            <label for="password-input" class=" form-control-label">Password</label>
          </div>
          <div class="col-12 col-md-9">
            <input type="Password" id="password" name="password" value="<?php echo $row['Password'] ?>" placeholder="*********" class="form-control" required="">

          </div>
        </div>
        <div class="card-footer">
          <p style="text-align: center;"><button type="submit" name="updateuser" id="updateuser" class="btn btn-primary btn-sm">update account
          </button></p>

        </div>
      </form>

    </div>

    <?php
  }
}
?>