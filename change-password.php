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
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query=mysqli_query($con,"select ID from tbladmin where ID='$adminid' and Password='$cpassword'");
$row=mysqli_fetch_array($query);
if($row>0){
$ret=mysqli_query($con,"update tbladmin set Password='$newpassword' where ID='$adminid'");
$msg= "Your password successully changed"; 
} else {

$msg1="Your current password is wrong";
}



}

?>
<?php require_once 'header.php'; ?>

<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

</script>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-lg-8">
       <div class="card">
        <div class="header">
          <strong>Change</strong> Admin Password
        </div>
        <div class="content">
          <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="changepassword" onsubmit="return checkpass();">

            <?php
            $adminid=$_SESSION['cvmsaid'];
            $ret=mysqli_query($con,"select * from tbladmin where ID='$adminid'");
            $cnt=1;
            while ($row=mysqli_fetch_array($ret)) {

              ?>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Current Password</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="password" id="currentpassword" name="currentpassword" value="" class="form-control" required="">

                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="email-input" class=" form-control-label">New Password</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="password" id="newpassword" name="newpassword" value="" class="form-control" required="">

                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="password-input" class=" form-control-label">Confirm Password</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" maxlength="10" value="" required="">

                </div>
              </div>


            <?php } ?>
            <div class="card-footer">
              <p style="text-align: center;"><button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Change
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