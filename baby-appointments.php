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
                  <th>Baby</th>
                  <th>disease</th>
                  <th>Vaccine</th>
                  <th>Given at</th>
                  <th>Notes</th>
                  <th>Next Visit</th>
                  <th>Action</th>
                </tr>

              </thead>
              <tbody>
                <?php
                $ret=mysqli_query($con,"SELECT * from immunisation_schdl");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {

                  ?>

                  <tr>
                    <td style="padding-top: 25px"><?php echo $row['b_name'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['imm_disease'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['vaccine'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['today'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['notes'];?></td>
                    <td style="padding-top: 25px"><?php 
                    if ($row['next_date'] != '') {
                      $date1=$row['next_date'];
                      $date2 = $get_today_date;

                      $diff = intval(strtotime($date1) - strtotime($date2));

                      $years = intval($diff / (365*60*60*24));
                      $months = intval(($diff - $years * 365*60*60*24) / (30*60*60*24));
                      $days = intval(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));



                      if ($row['status']=="pending") {

                        if ($months < 1 && $days==0) {
                          $status="Today";
                        }else if ($months < 1 && $days > 0 && $days <=1) {
                // $status="tomorrow";
                          $status="<p style='color:orange;font-size:14px;'>Tomorrow</p>";
                        }
                        else if ($months < 1 && $days > 1 && $days < 31) {
                // $status="In ".intval($days)." days";
                          $status="<p style='color:blue;font-size:14px;'>Due in $days days</p>";
                        }
                        else if ($months >= 1 && $months <= 12) {
                // $status="In ".intval($days)." days";
                          $status="<p style='color:blue;font-size:14px;'>Due in $months month(s) and $days days</p>";
                        }
                        else if ($days < 0) {
                // $status="Missed";
                         $da= -1*$months;
                         $dd= -1*$days;
                         $na= $da." months(s) and " . $dd." day(s)";
                         $status="<p style='color:red;font-size:14px;'>Missed $na ago</p>";
                       }
                       echo $status;
                     }
                     else{
                      $on = $row['update_on'];
                      $status="<p style='color:green;font-size:14px;'>Done on $on</p>";
                      echo $status;
                    }
                  }
                  else{
                    ?>
                    <a onclick="return confirm('Sure to set following immunisation schedule?')" href="?set_result=<?php echo $row['id'].'-immunisation_schdl' ?>" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i> set</a>
                    <?php 
                  }
                  ?>    
                </td>
                <td style="padding-top: 25px">
                  <a class="btn btn-xs btn-info" href="baby-detail.php?bid=<?php echo $row['id'];?>" title="View Full Details"><i class="fa fa-edit fa-1x"></i></a>
                  <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-immunisation_schdl' ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
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