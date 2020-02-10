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
              <h4 class="title">Referral Units Table</h4>
            </div>

            <div class="content table-responsive table-full-width" style="margin: 5px;">
              <table class="table table-hover table-striped" id="example" style="padding: 0;">

               <thead>

                <tr>
                  <th>No</th>
                  <th>Referral</th>
                  <th>Address</th>
                  <th>Officer in charge</th>
                  <th>Action</th>
                </tr>

              </thead>
              <tbody>
                <?php
                $ret=mysqli_query($con,"select * from health_units");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {

                  ?>

                  <tr>
                    <td><?php echo $cnt;?></td>

                    <td style="padding-top: 25px"><?php  echo $row['referral'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['address'];?></td>
                    <td style="padding-top: 25px"><?php  
                    if ($row['officer']=='') {
                      echo "N/A";
                    }
                    else{
                      echo $row['officer'];
                    }
                    ?></td>
                    <td style="padding-top: 25px">
                      <a class="btn btn-sm btn-info" href="#edit_hunits.php?hid=<?php echo $row['id'];?>" title="View Full Details"><i class="fa fa-edit fa-1x"></i></a>
                      <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-health_units' ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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