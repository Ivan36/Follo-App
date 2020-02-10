<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
} else{
 if(isset($_POST['submit']))
 {
  $adminid=$_SESSION['cvmsaid'];
  $AName=$_POST['adminname'];
  $mobno=$_POST['mobilenumber'];
  $email=$_POST['email'];
  
  $query=mysqli_query($con, "update tbladmin set AdminName='$AName', MobileNumber ='$mobno', Email= '$email' where ID='$adminid'");
  if ($query) {
    $msg="Admin profile has been updated.";
  }
  else
  {
    $msg1="Something Went Wrong. Please try again.";
  }
}

?>
<?php require_once 'header.php'; ?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-lg-8">
       <div class="card">
        <div class="header">
          <strong>Update</strong> Admin Profile
        </div>
        <div class="content">
          <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

            <?php
            $adminid=$_SESSION['cvmsaid'];
            $ret=mysqli_query($con,"select * from tbladmin where ID='$adminid'");
            $cnt=1;
            while ($row=mysqli_fetch_array($ret)) {

              ?>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Admin Name</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="text" id="adminname" name="adminname" value="<?php  echo $row['AdminName'];?>" class="form-control" required="">

                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="email-input" class=" form-control-label">Email Input</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="email" id="email" name="email" value="<?php  echo $row['Email'];?>" class="form-control" required="">

                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="password-input" class=" form-control-label">Phone Number</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="text" id="mobilenumber" name="mobilenumber" class="form-control" maxlength="10" value="<?php  echo $row['MobileNumber'];?>" required="">

                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="textarea-input" class=" form-control-label">User Name</label>
                </div>
                <div class="col-12 col-md-9">
                  <input name="username" id="username" rows="9" class="form-control" required="" readonly="" value="<?php  echo $row['UserName'];?>">

                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="password-input" class=" form-control-label">Admin Update date</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="text" id="adminregdate" name="adminregdate"  value="<?php  echo date('d-m-Y');?>" class="form-control" required="" readonly="">

                </div>
              </div>

            <?php } ?>
            <div class="card-footer">
              <p style="text-align: center;"><button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Update
              </button></p>

            </div>
          </form>
        </div>

      </div>
    </div>
    <div class="col-md-4 col-lg-4 hidden-sm hidden-xs">
      <div class="card card-user">
        <div class="image">
          <img src="images/calender-img.jpg" alt="..."/>
        </div>
        <div class="content">
         <?php require_once 'calender.php'; ?>
       </div>
       <hr>
       <div class="text-center">
        <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
        <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
        <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

      </div>
    </div>
  </div>

</div>
</div>
</div>

<?php require_once 'footer.php'; ?>

<p style="font-size:16px; color:green" align="center"> <?php if($msg){
                                // echo $msg;
  ?>
  <script type="text/javascript">
    $(document).ready(function(){

     demo.initChartist();

     $.notify({
       icon: 'pe-7s-gift',
       message: "<?php echo $msg; ?>"

     },{
      type: 'success',
      timer: 4000
    });

   });
 </script>
 <?php

}  ?> </p>


<p style="font-size:16px; color:red" align="center"> <?php if($msg1){
                                // echo $msg1;

 ?>
 <script type="text/javascript">
  $(document).ready(function(){

   demo.initChartist();

   $.notify({
     icon: 'pe-7s-gift',
     message: "<?php echo $msg1; ?>"

   },{
    type: 'danger',
    timer: 4000
  });

 });
</script>
<?php
}  ?> </p>

<p style="font-size:16px; color:red" align="center"> <?php if($msg3){
                                // echo $msg1;

 ?>
 <script type="text/javascript">
  $(document).ready(function(){

   demo.initChartist();

   $.notify({
     icon: 'pe-7s-gift',
     message: "<?php echo $msg2; ?>"

   },{
    type: 'danger',
    timer: 4000
  });

 });
</script>
<?php
}  ?> </p>



<?php } ?>