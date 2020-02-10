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
              <h4 class="title">Antenatal Mothers Table</h4>
            </div>

            <div class="content table-responsive table-full-width" style="margin: 5px;">
              <table class="table table-hover table-striped" id="example" style="padding: 0;">

               <thead>
                <tr>
                  <tr>
                    <th>S.NO</th>
                    <th>Full Name</th>
                    <th>Contact</th>
                    <th>Schedule</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tr>
              </thead>
              <?php
              $ret=mysqli_query($con,"select * from appointments_tb");
              $cnt=1;
              while ($row=mysqli_fetch_array($ret)) {

                ?>

                <tr> 
                  <td><?php echo $cnt;?></td>

                  <td style="padding-top: 25px"><?php  echo $row['mother'];?></td>
                  <td style="padding-top: 25px"><?php  echo $row['contact'];?></td>
                  <td style="padding-top: 25px"><?php  echo $row['date']." ".$row['time'];?></td>
                  <td style="padding-top: 25px"><?php  echo $row['comment'];?></td>
                  <td style="padding-top: 25px"><?php 
                  $date1=$row['date'];
                  $date2 = $get_today_date;

                  $diff = intval(strtotime($date1) - strtotime($date2));

                  $years = intval($diff / (365*60*60*24));
                  $months = intval(($diff - $years * 365*60*60*24) / (30*60*60*24));
                  $days = intval(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                  if ($row['status']=="pending") {

                    if ($days==0) {
                      $status="Today";
                    }else if ($days > 0 && $days <=1) {
                // $status="tomorrow";
                      $status="<p style='color:orange;font-size:14px;'>Tomorrow</p>";
                    }
                    else if ($days > 1) {
                // $status="In ".intval($days)." days";
                      $status="<p style='color:blue;font-size:14px;'>Due in $days days</p>";
                    }
                    else if ($days < 0) {
                // $status="Missed";
                      if ($months>=1 && $months<=12) {
                       $na= $months." month(s)";
                     }
                     else{
                      $dd= -1*$days;
                      $na= $dd." day(s)";
                    }
                    $status="<p style='color:red;font-size:14px;'>Missed $na ago</p>";
                  }
                  echo $status;
                }
                else{
                  $status="<p style='color:green;font-size:14px;'>Done $na ago</p>";
                  echo $status;
                }
                ?>    
              </td>
              <td style="padding-top: 25px"><a class="btn btn-sm btn-primary" href="#mother-detail.php?mid=<?php echo $row['id'];?>" title="View Full Details"><i class="fa fa-eye fa-1x"></i></a>
                <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-appointments_tb' ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
              </td>
            </tr>
            <?php 
            $cnt=$cnt+1;
          }?>
        </table>

      </div>
    </div>
  </div>


</div>
</div>
</div>

<?php require_once 'footer.php'; }?>