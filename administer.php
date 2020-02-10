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
 					<div class="card">
 						<div class="header">
 							<strong>Baby</strong>  Details
 							<a href="" style="margin-left: 30%;"><i class="fa fa-upload"></i>update</a> <a href="manage-baby.php" style="padding-left: 20px;"><i class="fa fa-arrow-left"></i>back</a>
 						</div>
 						<div class="card-body card-block">

 							<p style="font-size:16px; color:red" align="center"> <?php if($msg){

 								echo $msg;
 							}  ?> </p>
 							<center>
 								<img src="<?php echo $row['image'] ?>"style="border-radius: 50%;"  alt="baby" width="200" height="200">
 							</center>
 							<?php
 							$eid=$_GET['bid'];
 							$ret=mysqli_query($con,"select * from  baby_tb where id='$eid'");
 							$cnt=1;
 							while ($row=mysqli_fetch_array($ret)) {

 								?>

 								<table border="1" class="table table-bordered mg-b-0">
 									<tr>
 										<th>Full Name</th>
 										<td><?php  echo $row['name'];?></td>
 									</tr>
 									<tr>
 										<th>Gender</th>
 										<td><?php  echo $row['sex'];?></td>
 									</tr>

 									<tr>
 										<th>Date of birth</th>
 										<td><?php  echo $row['date_of_birth'];?></td>
 									</tr>
 									<tr>
 										<th>Birth number</th>
 										<td><?php  echo $row['birth_no'];?></td>
 									</tr>
 									<tr>
 										<th>Weight</th>
 										<td><?php  echo $row['weight'];?></td>
 									</tr>
 									<tr>
 										<th>Mother</th>
 										<td><?php  echo $row['mother'];?></td>
 									</tr>
 									<tr>
 										<th>Mother Job</th>
 										<td><?php  echo $row['m_job'];?></td>
 									</tr>

 									<tr>
 										<th>Farther</th>
 										<td><?php  echo $row['farther'];?></td>
 									</tr>
 									<tr>
 										<th>Farther Job</th>
 										<td><?php  echo $row['f_job'];?></td>
 									</tr>
 									<tr>
 										<th>Health Unit</th>
 										<td><?php  echo $row['health_unit'];?></td>
 									</tr>
 									<tr>
 										<th>District</th>
 										<td><?php  echo $row['district'];?></td>
 									</tr>
 									<tr>
 										<th>Sub county</th>
 										<td><?php  echo $row['sub_county'];?></td>
 									</tr>
 									<tr>
 										<th>Parish</th>
 										<td><?php  echo $row['parish'];?></td>
 									</tr>
 									<tr>
 										<th>Village</th>
 										<td><?php  echo $row['village'];?></td>
 									</tr>
 								</table>                        
 							</div>

 						</div>
 					</div>


 				</div>
 			</div>
 		</div>

 		<?php require_once 'footer.php'; }?>