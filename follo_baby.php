 <?php
 session_start();
 error_reporting(0);
 include('includes/dbconnection.php');
 if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
} else{

  if (isset($_GET['baby_id'])){
    $baby_id=mysqli_real_escape_string($con,$_GET['baby_id']);
  }

  ?>
  <?php include_once('header.php');

  $ret1=mysqli_query($con,"select * from baby_tb where name='$baby_id'");
  $cnt=1;
  $res=mysqli_fetch_assoc($ret1);
  $name=$res['name'];
  $sex= $res['sex'];
  $dob=$res['date_of_birth'];
  $mother=$res['mother'];
  $farther=$res['farther'];
  $image=$res['image'];
  ?>
  <?php 
  if (isset($_POST['imm_schdl'])) {

    $date1 = $dob;
    $date2 = $get_today_date;

    $diff = intval(strtotime($date2) - strtotime($date1));

    $years = intval($diff / (365*60*60*24));
    $months = intval(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = intval(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    if ($years < 1 && $months > 0 && $months < 12) {
      $age= $months." Month(s) and ".$days." day(s)";
    }else if ($months < 1 && $days > 0 && $days < 31) {
      $age= $days." day(s)";
    }
    else if ($years > 0) {
      $age= $years." year(s) ".$months." Month(s) and ".$days." day(s)";
    }
    else {
      $age = 0;
    }


    $b_name = $_POST['b_name'];
    $imm_day = $_POST['date'];
    $vaccine_0 = $_POST['vaccine_0'];
    $vaccine_6 = $_POST['vaccine_6'];
    $vaccine_10 = $_POST['vaccine_10'];
    $vaccine_14 = $_POST['vaccine_14'];
    $vaccine_9 = $_POST['vaccine_9'];
    
    if ($vaccine_6=='' && $vaccine_10=='' && $vaccine_14=='' && $vaccine_9=='') {
      $vaccine= $vaccine_0;
    }
    else if ($vaccine_0=='' && $vaccine_10=='' && $vaccine_14=='' && $vaccine_9=='') {
      $vaccine= $vaccine_6;
    }
    else if ($vaccine_0=='' && $vaccine_6=='' && $vaccine_14=='' && $vaccine_9=='') {
      $vaccine= $vaccine_10;
    }
    else if ($vaccine_0=='' && $vaccine_6=='' && $vaccine_10=='' && $vaccine_9=='') {
      $vaccine= $vaccine_14;
    }
    else if ($vaccine_0=='' && $vaccine_6=='' && $vaccine_10=='' && $vaccine_14=='') {
      $vaccine= $vaccine_9;
    }

    $query = mysqli_query($con,"SELECT * from diseases_tbl where vaccine='$vaccine'");
    if (mysqli_num_rows($query) > 0) {
      $vac = mysqli_fetch_assoc($query);
      $imm_disease = $vac['d_name'];
      $given_at = $vac['given_at'];
    }

    $notes = $_POST['comment'];

    $checkSql = mysqli_query($con,"SELECT id from immunisation_schdl where today='$imm_day' AND vaccine='$vaccine' AND b_name='$baby_id'");
    if (mysqli_num_rows($checkSql) > 0) {
      $msg1 = "$name immunisation information for today have already been recorded";
    }

    else{

      $sql = mysqli_query($con,"INSERT INTO immunisation_schdl(b_name,age,vaccine,imm_disease,today,notes,given_at)
       VALUES('$b_name','$age','$vaccine','$imm_disease','$imm_day','$notes','$given_at')");
      if ($sql) {
        $msg = "$name Immunisation information on $imm_day recorded successfully";
      }

      else{
        $msg2 = "Sorry something went wrong try again";
      }

    }



  }

  if (isset($_POST['save_more'])) {


    $bb_name = $baby_id;
    $date_of_visit = $_POST['date_of_visit'];
    $notes = $_POST['notes'];
    $date_second_visit = $_POST['date_second_visit'];

    $check=mysqli_query($con,"SELECT * from baby_visits_tbl where b_name='$bb_name' AND date_visit='$date_of_visit'");
    if (mysqli_num_rows($check) > 0) {
      $msg1 = "Sorry $bb_name visit information has already been recorded try again";
    }
    else{
      $query = mysqli_query($con,"INSERT into baby_visits_tbl(b_name,date_visit,notes,next_visit)
        VALUES('$bb_name','$date_of_visit','$notes','$date_second_visit') ");
      if ($query) {
       $msg = "Added visit schedule for $bb_name successfully";
     }
     else{
      $msg1 = "Sorry something went wrong try again";
    }
  }


}

?>
<!-- <a href="https://imgbb.com/"><img src="https://i.ibb.co/yntWZrv/baby-img.jpg" alt="baby-img" border="0"></a>
<a href="https://imgbb.com/"><img src="https://i.ibb.co/8PNRCMk/calender-img.jpg" alt="calender-img" border="0"></a>
<a href="https://ibb.co/kSFGrWd"><img src="https://i.ibb.co/pLp1s9m/images.png" alt="images" border="0"></a><br /><a target='_blank' href='https://clueyblog.com/5-homemade-banana-face-masks'>honey with banana for skin</a><br />
-->

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 col-lg-4">
        <div class="card">

          <div class="header" style="padding-bottom: 50px;">
            <div class="dropdown">
              <label style="font-size: 12px;">Name: <?php echo $name; ?></label>

              <button class="btn btn-info btn-sm dropdown-toggle pull-right" type="button" id="dropdownMenu2" data-toggle="dropdown" style="margin-left: 2px;" aria-haspopup="true" aria-expanded="true"><i class="fas fa-fw fa-plus-circle"></i>
                Immunisation
              </button>
              
              <br>
              Today: <?php echo $get_today_date; ?>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="background-color: #CAE7F6;">
                <h3 style="font-size: 16px;text-align: center;padding-top: 5px;">Add immunisation info for <?php echo $name; ?></h3> 
                <form method="POST" style="padding-left: 10px !important; padding-right: 10px !important;" action="" >

                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="hidden" class="form-control" name="b_name" id="b_name" value="<?php echo $name; ?>" required readonly>

                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="hidden" name="date" class="form-control" readonly="" required="" value="<?php echo $get_today_date; ?>" >
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-label-group">
                      <p style="color: black;font-size: 16px;">Today</p>
                      <input type="text" name="n_visit" class="form-control" value="<?php echo $get_today_date; ?>"  readonly="true" required="">
                    </div>
                  </div>

                  <div class="col-md-12 col-lg-12">
                    <div class="form-label-group">
                      <p style="color: black;font-size: 16px;">Immunisation Vaccine</p>

                      <div class="option">

                        <input type="checkbox" name="chkBox1" value="ongoing" id="chkBox1" class="showHideCheck" />At birth
                        <br/><div class="hiddenInput">
                         <select class="form-control" name="vaccine_0">
                          <option value="" selected="true">---select---</option>
                          <?php
                          $ref=mysqli_query($con,"SELECT * from diseases_tbl where given_at='At birth' ");

                          while ($row=mysqli_fetch_array($ref)) {

                            ?>
                            <option value="<?php echo $row['vaccine'] ?>" ><?php echo $row['vaccine'] ?></option>
                            <?php
                          }

                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="option">

                      <input type="checkbox" id="chkBox2" name="chkBox2" class="showHideCheck" />At 6 weeks
                      <br/><div class="hiddenInput">
                       <select class="form-control" name="vaccine_6">
                        <option value="" selected="true">---select---</option>
                        <?php
                        $ref=mysqli_query($con,"SELECT * from diseases_tbl where given_at='At 6 weeks' ");

                        while ($row=mysqli_fetch_array($ref)) {

                          ?>
                          <option value="<?php echo $row['vaccine'] ?>" ><?php echo $row['vaccine'] ?></option>
                          <?php
                        }

                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="option">

                    <input type="checkbox" name="chkBox3" value="ongoing"  id="chkBox3" class="showHideCheck" />At 10 weeks
                    <br/><div class="hiddenInput">
                     <select class="form-control" name="vaccine_10">
                      <option value="" selected="true">---select---</option>
                      <?php
                      $ref=mysqli_query($con,"SELECT * from diseases_tbl where given_at='At 10 weeks' ");

                      while ($row=mysqli_fetch_array($ref)) {

                        ?>
                        <option value="<?php echo $row['vaccine'] ?>" ><?php echo $row['vaccine'] ?></option>
                        <?php
                      }

                      ?>
                    </select>
                  </div>
                </div>

                <div class="option">

                  <input type="checkbox" id="chkBox4" name="chkBox4" class="showHideCheck" />At 14 weeks
                  <br/><div class="hiddenInput">
                   <select class="form-control" name="vaccine_14">
                    <option value="" selected="true">---select---</option>
                    <?php
                    $ref=mysqli_query($con,"SELECT * from diseases_tbl where given_at='At 14 weeks' ");

                    while ($row=mysqli_fetch_array($ref)) {

                      ?>
                      <option value="<?php echo $row['vaccine'] ?>" ><?php echo $row['vaccine'] ?></option>
                      <?php
                    }

                    ?>
                  </select>
                </div>
              </div>

              <div class="option">

                <input type="checkbox" id="chkBox5" name="chkBox5" class="showHideCheck" />At 9 months
                <br/><div class="hiddenInput">
                 <select class="form-control" name="vaccine_9">
                  <option value="" selected="true">---select---</option>
                  <?php
                  $ref=mysqli_query($con,"SELECT * from diseases_tbl where given_at='At 9 Months' ");

                  while ($row=mysqli_fetch_array($ref)) {

                    ?>
                    <option value="<?php echo $row['vaccine'] ?>" ><?php echo $row['vaccine'] ?></option>
                    <?php
                  }

                  ?>
                </select>
              </div>
            </div>

          </div>
        </div>
        <div class="col-md-12">
          <div class="form-label-group">
            <p style="color: black;font-size: 16px;">Notes</p>
            <textarea name="comment" class="form-control" rows="3" placeholder="Comment or Message here"></textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-label-group" style="margin:2%; ">
            <button type="submit" class="btn btn-primary btn-sm btn-block" name="imm_schdl" value="Submit"><i class="fa fa-fw fa-save"></i> Submit </button>
          </div>
        </div>


      </form>
    </div>

  </div>
</div>
<div class="card card-user">
  <div class="content">
    <div class="author">
     <a href="#">
      <img class="avatar border-gray" src="<?php echo $image; ?>" alt="..."/>
      <!-- src="assets/img/faces/face-3.jpg" -->
      <h4 class="title">Name: <?php echo $name; ?><br />
       <small>Gender: <?php echo $sex; ?></small>
     </h4>
     <h5 class="text-center">Date of Birth: <?php echo $dob; ?></h5>
   </a>
 </div>
 <p class="description text-center">Mother: <?php echo $mother; ?> 
 <p class="description text-center">Farther: <?php echo $farther; ?> 
</p>
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

<div class="col-md-8 col-lg-8">
 <div class="card">
  <div class="header">
    <h6 class="m-0 font-weight-bold">Medical History of <?php echo $name; ?> </h6>
  </div>
  <div class="content">

    <div class="content table-responsive table-full-width" style="margin: 5px;">
      <table class="table table-hover table-striped" id="example" style="padding: 0;">

       <thead>

        <tr>
          <th>S.NO</th>
          <th>Vaccine</th>
          <th>Given at</th>
          <th>notes</th>
          <th>Next Visit</th>
          <th>Action</th>
        </tr>

      </thead>
      <tbody>
        <?php
        $ret=mysqli_query($con,"SELECT * from immunisation_schdl where b_name='$baby_id' ORDER BY id DESC LIMIT 6");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {

          ?>

          <tr>
            <td style="padding-top: 25px"><?php echo $cnt;?></td>
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
          <a onclick="return confirm('You are about to confirm this appointment?')" href="?confirm_result=<?php echo $row['id'].'-immunisation_schdl' ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> </a>
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

<div class="row">

  <div class="col-md-4 col-lg-4">
    <div class="card card-user">
      <div class="row">
        <form method="POST" action="" style="padding: 20px;">
          <h5 style="text-align: center;">Other Visits of <?php echo $name; ?></h5>
          <div class="form-group col-lg-12 col-md-12">
            <label>Date of Visit</label>
            <input type="text" name="date_of_visit" class="form-control" required="" readonly="" value="<?php echo $get_today_date; ?>" >
          </div>
          <div class="form-group col-lg-12 col-md-12">
            <label>Information</label>
            <textarea class="form-control" rows="3" name="notes" required="" placeholder="Enter More details"></textarea>
          </div>
          <div class="form-group col-lg-12 col-md-12">
            <label>Date of Next Visit</label>
            <input type="date" name="date_second_visit" class="form-control" required="" value="" >
          </div>
          <div class="form-group col-lg-12 col-md-12">
            <button class="btn btn-info btn-sm pull-right" type="submit" name="save_more">Submit</button>
          </div>

        </form>
        

      </div>

    </div>
  </div>

  <div class="col-md-8 col-lg-8">
   <div class="card">
    <div class="header">
      <h5 class="m-0 font-weight-bold text-primary">Immunisation At Birth </h5>
    </div>
    <div class="content">

      <div class="content table-responsive table-full-width" style="margin: 5px;">
        <table class="table table-hover table-striped" id="example" style="padding: 0;">

         <thead>

          <tr>
            <th>Vaccine</th>
            <th>Protects</th>
            <th>Procudure</th>
            <th>Action</th>
          </tr>

        </thead>
        <tbody>
          <?php
          $ret=mysqli_query($con,"SELECT * from diseases_tbl where given_at='At birth' ORDER BY id DESC LIMIT 6");
          $cnt=1;
          while ($row=mysqli_fetch_array($ret)) {

            ?>

            <tr>
              <td style="padding-top: 25px"><?php  echo $row['vaccine'];?></td>
              <td style="padding-top: 25px"><?php  echo $row['d_name'];?></td>
              <td style="padding-top: 25px"><?php  echo $row['procedure_d'];?></td>
              <td style="padding-top: 25px">
               <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-diseases_tbl' ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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

<div class="col-md-12 col-lg-12">
 <div class="card">
  <div class="header">
    <h5 class="m-0 font-weight-bold text-primary">Immunisation At 6 Weeks </h5>
  </div>
  <div class="content">

    <div class="content table-responsive" style="margin: 5px;">
      <table class="table table-hover wrap table-striped" id="example1" style="padding: 0;">

       <thead>

        <tr>
          <th>Vaccine</th>
          <th>Protects</th>
          <th>Procudure</th>
          <th>Action</th>
        </tr>

      </thead>
      <tbody>
        <?php
        $ret=mysqli_query($con,"SELECT * from diseases_tbl where given_at='At 6 weeks' ORDER BY id DESC LIMIT 6");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {

          ?>

          <tr>
            <td style="padding-top: 25px"><?php  echo $row['vaccine'];?></td>
            <td style="padding-top: 25px"><?php  echo $row['d_name'];?></td>
            <td style="padding-top: 25px"><?php  echo $row['procedure_d'];?></td>
            <td style="padding-top: 25px">
             <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-diseases_tbl' ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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

<div class="col-md-12 col-lg-12">
 <div class="card">
  <div class="header">
    <h5 class="m-0 font-weight-bold text-primary">Immunisation At 10 Weeks </h5>
  </div>
  <div class="content">

    <div class="content table-responsive" style="margin: 5px;">
      <table class="table table-hover wrap table-striped" id="example1" style="padding: 0;">

       <thead>

        <tr>
          <th>Vaccine</th>
          <th>Protects</th>
          <th>Procudure</th>
          <th>Action</th>
        </tr>

      </thead>
      <tbody>
        <?php
        $ret=mysqli_query($con,"SELECT * from diseases_tbl where given_at='At 10 weeks' ORDER BY id DESC LIMIT 6");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {

          ?>

          <tr>
            <td style="padding-top: 25px"><?php  echo $row['vaccine'];?></td>
            <td style="padding-top: 25px"><?php  echo $row['d_name'];?></td>
            <td style="padding-top: 25px"><?php  echo $row['procedure_d'];?></td>
            <td style="padding-top: 25px">
             <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-diseases_tbl' ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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

<div class="col-md-12 col-lg-12">
 <div class="card">
  <div class="header">
    <h5 class="m-0 font-weight-bold text-primary">Immunisation At 14 Weeks </h5>
  </div>
  <div class="content">

    <div class="content table-responsive" style="margin: 5px;">
      <table class="table table-hover wrap table-striped" id="example1" style="padding: 0;">

       <thead>

        <tr>
          <th>Vaccine</th>
          <th>Protects</th>
          <th>Procudure</th>
          <th>Action</th>
        </tr>

      </thead>
      <tbody>
        <?php
        $ret=mysqli_query($con,"SELECT * from diseases_tbl where given_at='At 14 weeks' ORDER BY id DESC LIMIT 6");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {

          ?>

          <tr>
            <td style="padding-top: 25px"><?php  echo $row['vaccine'];?></td>
            <td style="padding-top: 25px"><?php  echo $row['d_name'];?></td>
            <td style="padding-top: 25px"><?php  echo $row['procedure_d'];?></td>
            <td style="padding-top: 25px">
             <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-diseases_tbl' ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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
</div>

<?php require_once 'footer.php'; ?>

<script type="text/javascript">
  $(".hiddenInput").hide();
  $(".showHideCheck").on("change", function() {
    $this = $(this);
    $input = $this.parent().find(".hiddenInput");
    if($this.is(":checked")) {
      $input.slideDown();
    } else {
      $input.slideUp();
    }
  });
</script>

<script>
  var disabled=0;
  function disableEnableField(){

    if(disabled==0){ //disable
     document.getElementById('manual_date').disabled = true;
     disabled=1; 
     document.getElementById('manual_date').value = '';
   } 
    else{  //enable again
     document.getElementById('manual_date').disabled = false;
     disabled=0; 
   } 
 }
</script>

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

<p style="font-size:16px; color:red" align="center"> <?php if($msg2){
                                // echo $msg1;

 ?>
 <script type="text/javascript">
  $(document).ready(function(){

   demo.initChartist();

   $.notify({
     icon: 'pe-7s-gift',
     message: "<?php echo $msg2 ?>"

   },{
    type: 'danger',
    timer: 5000
  });

 });
</script>
<?php
}  ?> </p>


<p style="font-size:16px; color:green" align="center"> <?php if($msg5){
                                // echo $msg;
  ?>
  <script type="text/javascript">
    $(document).ready(function(){

     demo.initChartist();

     $.notify({
       icon: 'pe-7s-gift',
       message: "<?php echo $msg5; ?>"

     },{
      type: 'success',
      timer: 4000
    });

   });
 </script>
 <?php

}  ?> </p>


<p style="font-size:16px; color:red" align="center"> <?php if($msg4){
                                // echo $msg1;

 ?>
 <script type="text/javascript">
  $(document).ready(function(){

   demo.initChartist();

   $.notify({
     icon: 'pe-7s-gift',
     message: "<?php echo $msg4; ?>"

   },{
    type: 'danger',
    timer: 4000
  });

 });
</script>
<?php
}  ?> </p>

<p style="font-size:16px; color:red" align="center"> <?php if($msg6){
                                // echo $msg1;

 ?>
 <script type="text/javascript">
  $(document).ready(function(){

   demo.initChartist();

   $.notify({
     icon: 'pe-7s-gift',
     message: "<?php echo $msg6 ?>"

   },{
    type: 'danger',
    timer: 5000
  });

 });
</script>
<?php
}  ?> </p>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">New visit for <?php echo $name; ?></h4>
        </div>
        <div class="modal-body">
          <div class="container-fluid">

            <div class="row">
              <div class="col">
                <input type="hidden" id="name" name="name" value="<?php echo $name; ?>" required>
                <input type="hidden" id="contact" name="contact" value="<?php echo $contact; ?>" required>
                <input type="hidden" id="datein" name="datein" value="<?php echo $get_today_date; ?>" required>
                <input type="hidden" id="clinician" name="clinician" value="<?php echo $name_session; ?>" required>
                <div class="card">
                  <div class="content">

                    <div class="form-group ">
                      <label>Presenting Condition</label>
                      <textarea id="condition" name="condition" class="form-control" rows="4" placeholder="Type client Presenting condition"></textarea>

                    </div>
                  </div>
                </div><br>
                <div class="card">
                  <div class="content">

                    <div class="form-group ">
                      <label>Medical History</label>
                      <textarea id="history" name="history" class="form-control" rows="4" placeholder="Type client client medical History" required=""></textarea>

                    </div>
                  </div>
                </div>
              </div>
              <div class="col">

                <div class="card">
                  <div class="content">

                    <div class="form-group ">
                      <label>Examination</label>
                      <textarea id="examination" class="form-control" name="examination" placeholder="Type your Examination" required=""></textarea>

                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="content">

                    <div class="form-group ">
                      <label>Diagnosis</label>
                      <input type="text" id="diagnosis" name="diagnosis" class="form-control"  placeholder="Type your Diagnosis" required="">
                    </div>
                    <div class="form-group ">
                      <label>Treatment</label>
                      <textarea id="treatment" name="treatment" class="form-control" placeholder="Type your Treatment Notes" required=""></textarea>
                    </div>
                    <div class="form-group">
                      <label>Follow Up date</label>
                      <input type="date" class="form-control" id="folloup" name="folloup" required="">
                    </div>

                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="new_visit" class="btn btn-sm btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).on('click', '#editfarmer', function(e) {

    e.preventDefault();

        var uid = $(this).data('id'); // get id of clicked row

        $('#dynamic-content-edit').html(''); // leave this div blank
        $('#modal-loader').show(); // load ajax loader on button click

        $.ajax({
          url: 'editfarmers.php',
          type: 'POST',
          data: 'id=' + uid,
          dataType: 'html'
        })
        .done(function(data) {
          console.log(data);
            $('#dynamic-content-edit').html(''); // blank before load.
            $('#dynamic-content-edit').html(data); // load here
            $('#modal-loader').hide(); // hide loader  
          })
        .fail(function() {
          $('#dynamic-content-edit').html('<i class="fa fa-info-circle"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
        });

      });
    </script>

    <p style="font-size:16px; color:green" align="center"> <?php if($msg8){
                                // echo $msg;
      ?>
      <script type="text/javascript">
        $(document).ready(function(){

         demo.initChartist();

         $.notify({
           icon: 'pe-7s-gift',
           message: "<?php echo $msg8; ?>"

         },{
          type: 'success',
          timer: 4000
        });

       });
     </script>
     <?php

   }  ?> </p>


   <p style="font-size:16px; color:red" align="center"> <?php if($msg7){
                                // echo $msg1;

     ?>
     <script type="text/javascript">
      $(document).ready(function(){

       demo.initChartist();

       $.notify({
         icon: 'pe-7s-gift',
         message: "<?php echo $msg7; ?>"

       },{
        type: 'danger',
        timer: 4000
      });

     });
   </script>
   <?php
 }  ?> </p>

 <p style="font-size:16px; color:red" align="center"> <?php if($msg9){
                                // echo $msg1;

   ?>
   <script type="text/javascript">
    $(document).ready(function(){

     demo.initChartist();

     $.notify({
       icon: 'pe-7s-gift',
       message: "<?php echo $msg9 ?>"

     },{
      type: 'danger',
      timer: 5000
    });

   });
 </script>
 <?php
}  ?> </p>




<?php } ?>