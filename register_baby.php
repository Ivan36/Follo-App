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
        $B_name = $_POST['b_name'];
        $B_sex = $_POST['b_sex'];
        $B_dob = $_POST['b_dob'];
        $B_number = $_POST['b_number'];
        $B_weight = $_POST['b_weight'];
        $M_names = $_POST['m_names'];
        $M_job = $_POST['m_job'];
        $F_names = $_POST['f_names'];
        $F_job = $_POST['f_job'];
        $Health_unit = $_POST['health_unit'];
        $District = $_POST['district'];
        $Sub_county = $_POST['sub_county'];
        $Parish = $_POST['parish'];
        $Village = $_POST['village'];


        $CheckSQL = "SELECT * FROM baby_tb WHERE name='$B_name' AND date_of_birth='$B_dob'";

        $check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));

        if(isset($check)){

            echo 'Babys information Already Exist';
            $msg1 = "Babys information Already Exist";

        }
        else{ 
            $Sql_Query = "INSERT INTO baby_tb (name,sex,date_of_birth,birth_no,weight,mother,m_job,farther,f_job,health_unit,district,sub_county,parish,village) 
            values ('$B_name','$B_sex','$B_dob','$B_number','$B_weight','$M_names','$M_job','$F_names','$F_job','$Health_unit','$District','$Sub_county','$Parish','$Village')";

            if(mysqli_query($conn,$Sql_Query))
            {
               echo 'Registration Successfully';
               $msg = "Registration Successfully";
           }
           else
           {
               echo 'Something went wrong';
               $msg1 = "Something went wrong";
           }
       }


   }

   ?>
   <?php require_once 'header.php'; ?>

   <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <strong>Add</strong> New Babies
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal myform">
                            <p style="font-size:16px; color:red" align="center"> <?php if($msg1){
                                echo $msg1;
                            }  ?> </p>
                            <p style="font-size:16px; color:green" align="center"> <?php if($msg){
                                echo $msg;
                            }  ?> </p>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Baby Names</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="b_name" name="b_name" placeholder="Baby Names" class="form-control" required="">

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="email-input" class=" form-control-label">Age</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select id="b_sex" name="b_sex" class="form-control" required="">
                                        <option value="" selected="">---Select---</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>    
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class=" form-control-label">Date of Birth</label>
                                </div>
                                <div class="col-12 col-md-9">
                                   <input type="date" id="b_dob" name="b_dob" placeholder="YYY-MMM-DDD" class="form-control" required="">
                               </div>
                           </div>
                           <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Birth Number</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="b_number" name="b_number" placeholder="Birth Number" class="form-control" maxlength="10" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Weight</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="b_weight" name="b_weight" placeholder="Enter Baby's Weight (kgs)" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Mother Names</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="m_names" name="m_names" placeholder="Enter Mother's Names" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Mother's Job</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="m_job" name="m_job" placeholder="Enter Mother's Job" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Father's Names</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="f_names" name="f_names" placeholder="Enter Father's Names" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Father's</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="f_job" name="f_job" placeholder="Enter Father's Job" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Health unit</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="health_unit" name="health_unit" placeholder="Enter health unit" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">District</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="district" name="district" value="Mbarara" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Sub county</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="sub_county" name="sub_county" placeholder="Enter Sub county" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Parish</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="parish" name="parish" placeholder="Enter Parish" class="form-control" required="">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password-input" class=" form-control-label">Village</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="village" name="village" placeholder="Enter Village" class="form-control" required="">

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