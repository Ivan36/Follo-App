<div class="table-responsive">
  <p class="text-center">
<i class="fa fa-user"></i> Create Account</p>
  <form action="accounts.php" method="post" enctype="multipart/form-data" class="form-horizontal myform">
    <div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input"  class=" form-control-label">Full Name</label>
      </div>
      <div class="col-12 col-md-9">

        <input type="text" id="f_name" name="f_name" placeholder="Enter full Name" class="form-control" required="">

      </div>
    </div>
    <div class="row form-group">
      <div class="col col-md-3">
        <label for="email-input" class="form-control-label">User Name</label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" id="u_name" name="u_name" placeholder="Enter preffered User Name" class="form-control" required="">

      </div>
    </div>
    <div class="row form-group">
      <div class="col col-md-3">
        <label for="textarea-input" class=" form-control-label">Email Address</label>
      </div>
      <div class="col-12 col-md-9">
       <input type="text" id="e_address" name="e_address" placeholder="Enter Email Address" class="form-control" required="">
     </div>
   </div>
   <div class="row form-group">
    <div class="col col-md-3">
      <label for="password-input" class=" form-control-label">Phone Number</label>
    </div>
    <div class="col-12 col-md-9">
      <input type="number" id="m_contact" name="m_contact" placeholder="Mobile Number" class="form-control" maxlength="10" required="">

    </div>
  </div>
  <div class="row form-group">
    <div class="col col-md-3">
      <label for="password-input" class=" form-control-label">Role</label>
    </div>
    <div class="col-12 col-md-9">
      <select class="form-control" name="role" required="true" >
        <option value="">---select---</option>
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
      <input type="Password" id="password" name="password" placeholder="*********" class="form-control" required="">

    </div>
  </div>
  <div class="card-footer">
    <p style="text-align: center;"><button type="submit" name="adduser" id="adduser" class="btn btn-primary btn-sm">create account
    </button></p>

  </div>
</form>

</div>