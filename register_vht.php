<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
} else{
  if(isset($_POST['reg_vht']))
  {
    require_once 'includes/connection.php';
    $cvmsaid=$_SESSION['cvmsaid'];
    $F_name = $_POST['f_name'];
    $contact = $_POST['m_contact'];
    $L_name = $_POST['l_name'];
    $email = $_POST['e_address'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $CheckSQL = "SELECT * FROM vhts WHERE contact='$contact'";

    $check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));

    if(isset($check)){

           // echo 'Email Already Exist';
     $msg1 = "Sorry Phone Number Exists try again";

   }
   else{ 
    $Sql_Query = "INSERT INTO vhts (first_name,last_name,contact,user_email,address,user_password) values ('$F_name','$L_name','$contact','$email','$address','$password')";

    if(mysqli_query($con,$Sql_Query))
    {
           // echo 'Registration Successfully';
     $msg = "Vht Account created succefully";
   }
   else
   {
           // echo 'Something went wrong';
    $msg2 = "Sorry Something went wrong try again";
  }
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
            <strong>Add</strong> New Vht
          </div>
          <div class="card-body card-block">
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal myform">


              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">First Name</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="text" id="f_name" name="f_name" placeholder="Enter First Name" class="form-control" required="">

                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="email-input" class="form-control-label">Last Name</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="text" id="l_name" name="l_name" placeholder="Enter Last Name" class="form-control" required="">

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
                <label for="password-input" class=" form-control-label">Home Area or Address</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" id="address" name="address" placeholder="Home area or address" class="form-control" required="">

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
              <p style="text-align: center;"><button type="submit" name="reg_vht" id="reg_vht" class="btn btn-primary btn-sm">Submit
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