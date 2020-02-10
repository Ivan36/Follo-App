 <?php
 session_start();
 error_reporting(0);
 include('includes/dbconnection.php');
 if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
} else{
  
  ?>
  <?php include_once('header.php');?>

  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">
          <div class="card" style="padding: 20px;">
            <strong>Mother</strong>  Details
            <a href="" style="margin-left: 30%;"><i class="fa fa-upload"></i>update</a> <a href="manage-mothers.php" style="padding-left: 20px;"><i class="fa fa-arrow-left"></i>back</a>
            <div class="content">

              <p style="font-size:16px; color:red" align="center"> <?php if($msg){
                echo $msg;
              }  ?> </p>
              <?php
              if (isset($_GET['mother_id'])){
                $mother_id=mysqli_real_escape_string($con,$_GET['mother_id']);
              }
              $ret=mysqli_query($con,"select * from  pregnant_mothers where id='$mother_id'");
              $cnt=1;
              while ($row=mysqli_fetch_array($ret)) {

                ?>
                <!-- <center><img src="<?php //echo $row['image'] ?>"style="border-radius: 50%;"  width="100" height="100"><br></center> -->

                <table border="1" class="table table-bordered mg-b-0">
                  <tr>
                    <th>Full Name</th>
                    <td><?php  echo $row['name'];?></td>
                  </tr>
                  <tr>
                    <th>Age</th>
                    <td><?php  echo $row['age'];?></td>
                  </tr>

                  <tr>
                    <th>Mobile Number</th>
                    <td><?php  echo $row['contact'];?></td>
                  </tr>
                  <tr>
                    <th>Address</th>
                    <td><?php  echo $row['address'];?></td>
                  </tr>
                  <tr>
                    <th>Occupation</th>
                    <td><?php  echo $row['occupation'];?></td>
                  </tr>
                  <tr>
                    <th>Religion</th>
                    <td><?php  echo $row['religion'];?></td>
                  </tr>
                  <tr>
                    <th>Education Level</th>
                    <td><?php  echo $row['education'];?></td>
                  </tr>
                  <tr>
                    <th>Marital Status</th>
                    <td><?php  echo $row['maritual_status'];?></td>
                  </tr>

                  <tr>
                    <th>Next of Kin</th>
                    <td><?php  echo $row['next_of_kin'];?></td>
                  </tr>
                  <tr>
                    <th>Relationship with next of kin</th>
                    <td><?php  echo $row['relationship'];?></td>
                  </tr>
                  <tr>
                    <th>Next of Kin Job</th>
                    <td><?php  echo $row['other_occupation'];?></td>
                  </tr>
                  <tr>
                    <th>Next of Kin Address</th>
                    <td><?php  echo $row['other_address'];?></td>
                  </tr>
                  <tr>
                    <th>Place of Delivery</th>
                    <td><?php  echo $row['place_of_delivery'];?></td>
                  </tr>
                  <tr>
                    <th>Blood group</th>
                    <td><?php  echo $row['blood_group'];?></td>
                  </tr>
                </table>                        
              </div>

            </div>
          </div>


        </div>
      </div>
    </div>

    <?php require_once 'footer.php'; } }?>