<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
} else{
    if(isset($_POST['submit']))
    {
        require_once 'includes/connection.php';
        $cvmsaid=$_SESSION['cvmsaid'];
        $M_name = $_POST['m_name'];
        $M_age = $_POST['m_age'];
        $M_address = $_POST['m_address'];
        $M_occupation = $_POST['m_occupation'];
        $M_contact = $_POST['m_contact'];
        $M_religion = $_POST['m_religion'];
        $M_education = $_POST['m_education'];
        $M_maritual_status = $_POST['m_status'];
        $Next_of_kin = $_POST['next_of_kin'];
        $N_relationship = $_POST['n_relationship'];
        $N_occupation = $_POST['n_occupation'];
        $N_address = $_POST['n_address'];
        $Place_of_delivery = $_POST['place_of_delivery'];
        $M_blood = $_POST['n_blood'];


        $CheckSQL = "SELECT * FROM pregnant_mothers WHERE name='$M_name' AND age='$M_age'";

        $check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));

        if(isset($check)){

            // echo 'Mother information Already Exist';
            $msg1 = "Mother information Already Exist";

        }
        else{ 
            $Sql_Query = "INSERT INTO pregnant_mothers (name,age,address,occupation,contact,education,religion,maritual_status,next_of_kin,relationship,other_occupation,other_address,place_of_delivery,blood_group) 
            values ('$M_name','$M_age','$M_address','$M_occupation','$M_contact','$M_education','$M_religion','$M_maritual_status','$Next_of_kin','$N_relationship','$N_occupation','$N_address','$Place_of_delivery','$M_blood')";

            if(mysqli_query($conn,$Sql_Query))
            {
               // echo 'Registration Successfully';
             $msg = "Registration Successfully";
             // return $msg;
         }
         else
         {
               // echo 'Something went wrong';
             $msg3 = "Something went wrong";
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
                        <strong>Add</strong> New Mothers
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal myform">


                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Full Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="m_name" name="m_name" placeholder="Full Name" class="form-control" required="">

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="email-input" class=" form-control-label">Age</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="m_age" name="m_age" placeholder="Enter Age" class="form-control" required="">

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class=" form-control-label">Address</label>
                                </div>
                                <div class="col-12 col-md-9">
                                 <input type="text" id="m_address" name="m_address" placeholder="Enter Address" class="form-control" required="">
                             </div>
                         </div>
                         <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Phone Number</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="m_contact" name="m_contact" placeholder="Mobile Number" class="form-control" maxlength="10" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Occupation</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="m_occupation" name="m_occupation" placeholder="Enter Occupation" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Education Level</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="m_education" name="m_education" placeholder="Enter Education Level" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Religion</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="m_religion" name="m_religion" placeholder="Enter Religion" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Maritual Status</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control" id="m_status" name="m_status" required="">
                                    <option value="" selected="">---select---</option>
                                    <option value="Single" >Single</option>
                                    <option value="Married" >Married</option>
                                    <option value="Widowed" >Widowed</option>
                                    <option value="Divorced" >Divorced</option>
                                    <option value="Cohabiting" >Cohabiting</option>
                                    <option value="Other" >Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Next Of Kin</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="next_of_kin" name="next_of_kin" placeholder="Enter Next Of Kin" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">N.O.K Relationship</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="n_relationship" name="n_relationship" placeholder="Enter Relationship with Next Of Kin" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">N.O.K Occupation</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="n_occupation" name="n_occupation" placeholder="Enter Next Of Kin's Occupation" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">N.O.K Address</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="n_address" name="n_address" placeholder="Enter Next Of Kin's Address" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Place of Delivery</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="place_of_delivery" name="place_of_delivery" placeholder="Enter Place of Delivery" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Blood Group</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="n_blood" name="n_blood" placeholder="Enter Blood Group" class="form-control" required="">

                            </div>
                        </div>


                        <div class="card-footer">
                            <p style="text-align: center;"><button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Submit
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

<?php require_once 'footer.php'; }?>

<p style="font-size:16px; color:green" align="center"> <?php if($msg){
                                // echo $msg;
    ?>
    <script type="text/javascript">
        $(document).ready(function(){

           demo.initChartist();

           $.notify({
               icon: 'pe-7s-gift',
               message: "Antenantal Mother Registration successful"

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
           message: "Sorry Mothers information Already Exist try again"

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
           message: "Sorry Something went wrong try again"

       },{
        type: 'danger',
        timer: 4000
    });

   });
</script>
<?php
}  ?> </p>