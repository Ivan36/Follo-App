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
              <h4 class="title">New born Babies Table</h4>
            </div>

            <div class="content table-responsive table-full-width" style="margin: 5px;">
              <table class="table table-hover table-striped" id="example" style="padding: 0;">

               <thead>

                <tr>
                  <th>S.NO</th>
                  <th>Full Name</th>
                  <th>Sex</th>
                  <th>Birth date</th>
                  <th>Mother</th>
                  <th>Action</th>
                </tr>

              </thead>
              <tbody>
                <?php
                $ret=mysqli_query($con,"select * from baby_tb");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {

                  ?>

                  <tr>
                    <td><?php echo $cnt;?></td>

                    <td style="padding-top: 25px"><?php  echo $row['name'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['sex'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['date_of_birth'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['mother'];?></td>
                    <td style="padding-top: 25px"><a class="btn btn-sm btn-primary" href="baby-detail.php?baby_id=<?php echo $row['name'];?>" title="View Full Details"><i class="fa fa-eye fa-1x"></i></a>
                      <a class="btn btn-sm btn-info" href="follo_baby.php?baby_id=<?php echo $row['name'];?>" title="View Full Details"><i class="fa fa-edit fa-1x"></i></a>
                      <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-baby_tb' ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                           
                    </td>
                  </tr>
                  <?php 
                  $cnt=$cnt+1;
                }?>
              </tbody>
            </table>

          </div>
        </div>
      </div>


    </div>
  </div>
</div>

<?php require_once 'footer.php'; }?>