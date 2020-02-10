 <?php
 session_start();
 error_reporting(0);
 include('includes/dbconnection.php');
 if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
} else{

  if (isset($_POST['set_appoint'])) {

   $M_name = $_POST['m_name'];
   $Date = $_POST['date'];
   $Time = $_POST['time'];
   $Comment = $_POST['comment'];
   $Contact = $_POST['m_contact'];
   $CheckSQL = "SELECT * FROM appointments_tb WHERE mother='$M_name' AND date='$Date'";

   $check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));

   if(isset($check)){

         // echo 'Appointment Already Set';
    $msg3="Appointment for $M_name on $Date at $Time has not been set since the appointment is Already Set for this date";

  }
  else{ 
    $Sql_Query = "INSERT INTO appointments_tb (mother,contact,date,time,comment) values ('$M_name','$Contact','$Date','$Time','$Comment')";

    if(mysqli_query($con,$Sql_Query))
    {
       // echo 'Appointment has been set Successfully';
     $msg="Appointment for $M_name on $Date at $Time has been set Successfully";
   }
   else
   {
       // echo 'Something went wrong';
     $msg1="Appointment not set Something went wrong";
   }
 }
}

if (isset($_POST['reffer'])) {

  $M_name = $_POST['m_name'];
  $Date = $_POST['date'];
  $Referral = $_POST['referral'];
  $Comment = $_POST['comment'];
  $Contact = $_POST['m_contact'];
  $CheckSQL = "SELECT * FROM referal_tb WHERE mother='$M_name' AND date='$Date'";

  $check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));

  if(isset($check)){

         // echo 'Appointment Already Set';
    $msg4="You have already reffered $M_name to $Referral";

  }
  else{ 
    $Sql_Query = "INSERT INTO referal_tb (mother,contact,date,comment,referral) values ('$M_name','$Contact','$Date','$Comment','$Referral')";

    if(mysqli_query($con,$Sql_Query))
    {
       // echo 'Appointment has been set Successfully';
     $msg5="Reffer for $M_name on $Date to $Referral has been sent Successfully";
   }
   else
   {
       // echo 'Something went wrong';
     $msg6="Referral not sent Something went wrong";
   }
 }

}

if (isset($_GET['mother_id'])){
  $mother_id=mysqli_real_escape_string($con,$_GET['mother_id']);
}

?>
<?php include_once('header.php');

$ret1=mysqli_query($con,"select * from pregnant_mothers where name='$mother_id'");
$cnt=1;
$res=mysqli_fetch_assoc($ret1);
$name=$res['name'];
$contact= $res['contact'];
$age=$res['age'];
$address=$res['address'];
$image=$res['image'];

?>
<?php if (isset($_POST['new_visit'])) {
  $name = $_POST['name'];
  $datein = $_POST['datein'];
  $contact = $_POST['contact'];
  $condition = $_POST['condition'];
  $history = $_POST['history'];
  $examination = $_POST['examination'];
  $diagnosis = $_POST['diagnosis'];
  $treatment = $_POST['treatment'];
  $folloup = $_POST['folloup'];
  $clinician = $_POST['clinician'];

  $CheckSQL = "SELECT * FROM medical_history WHERE mother='$name' AND datein='$datein'";

  $check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));

  if(isset($check)){

         // echo 'Appointment Already Set';
    $msg7="You have already Noted New visit for $name today";

  }
  else{ 
    $Sql_Query = "INSERT INTO medical_history (mother,contact,datein,complaint,history,exam,diagnosis,treatment,folloup,clinician) 
    values ('$name','$contact','$datein','$condition','$history','$examination','$diagnosis','$treatment','$folloup','$clinician')";

    if(mysqli_query($con,$Sql_Query))
    {
       // echo 'Appointment has been set Successfully';
     $msg8="New Visit for $name on $datein has been Recorded Successfully";
   }
   else
   {
       // echo 'Something went wrong';
     $msg9="New Visit failed Something went wrong";
   }
 }

} ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <div class="card">

          <div class="header" style="padding-bottom: 50px;">
            <div class="dropdown">
              <label style="font-size: 12px;">Name: <?php echo $name; ?></label>

              <button class="btn btn-success btn-sm dropdown-toggle pull-right" type="button" id="dropdownMenu2" data-toggle="dropdown" style="margin-left: 2px;" aria-haspopup="true" aria-expanded="true"><i class="fas fa-fw fa-plus-circle"></i>
                REFFER
              </button>
              <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal">
               <i class="fas fa-fw fa-plus-circle"></i> New Visit
             </button>
             <br>
             Today: <?php echo $get_today_date; ?>
             <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="background-color: #CAE7F6;">
              <h3 style="font-size: 16px;text-align: center;padding-top: 5px;">Reffer <?php echo $name; ?></h3> 
              <form method="POST" style="padding-left: 10px !important; padding-right: 10px !important;" action="" >

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-label-group">
                        <input type="hidden" class="form-control" name="m_name" id="m_name" value="<?php echo $name; ?>" required readonly>

                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-label-group">
                        <input type="hidden" class="form-control" name="m_contact" id="m_contact" value="<?php echo $contact; ?>"  required readonly="">
                        <input type="hidden" name="date" class="form-control" readonly="" required="" value="<?php echo $get_today_date; ?>" >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-lg-12">
                  <div class="form-label-group">
                    <label style="color: black;font-size: 16px;">Referral</label>
                    <select class="form-control" name="referral" required="true">
                      <option value="" selected="true">---select---</option>
                      <?php
                      $ref=mysqli_query($con,"SELECT * from referral_units");

                      while ($row=mysqli_fetch_array($ref)) {

                        ?>
                        <option value="<?php echo $row['name'] ?>" ><?php echo $row['name'] ?></option>
                        <?php
                      }

                      ?>
                    </select>

                  </div>
                </div>


                <div class="col-md-12">
                  <div class="form-label-group">
                    <label style="color: black;font-size: 16px;">Comments or Notes</label>
                    <textarea name="comment" class="form-control" rows="3" placeholder="Comment or Message here"></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-label-group" style="margin:2%; ">
                    <button type="submit" class="btn btn-success btn-block" name="reffer" value="Submit"><i class="fa fa-fw fa-save"></i> Submit </button>
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
               <small>Phone No: <?php echo $contact; ?></small>
             </h4>
             <h5 class="text-center">Age: <?php echo $age; ?></h5>
           </a>
         </div>
         <p class="description text-center">Home-area: <?php echo $address; ?> 
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

<div class="col-md-8">
  <div class="card">
    <div class="header">

      <div class="dropdown">
        <label>Appointments</label>
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-fw fa-plus-circle"></i>
          CREAT
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="background-color: #F3F2F0;">
          <h2 style="font-size: 16px;text-align: center;">Set Appointments</h2>
          <hr>
          <form method="POST" style="padding-left: 10px !important; padding-right: 10px !important;" action="" >

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="hidden" class="form-control" name="m_name" id="m_name" value="<?php echo $name; ?>" required readonly>

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="hidden" class="form-control" name="m_contact" id="m_contact" value="<?php echo $contact; ?>"  required readonly="">

                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <label style="color: black;font-size: 16px;">Date</label>
                    <input type="date" name="date" class="form-control" required="">

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <label style="color: black;font-size: 16px;">Time</label>
                    <input type="time" name="time" class="form-control"required="">

                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-label-group">
                <label style="color: black;font-size: 16px;">Comment</label>
                <textarea name="comment" class="form-control" rows="3" placeholder="Comment or Message here"></textarea>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-label-group" style="margin:2%; ">
                <button type="submit" class="btn btn-primary btn-block" name="set_appoint" value="Submit"><i class="fa fa-fw fa-save"></i> Submit </button>
              </div>
            </div>


          </form>
        </div>

      </div>
    </div>


    <div class="content table-responsive table-full-width" style="margin: 5px;">
      <table class="table table-hover table-striped" id="example" style="padding: 0;">

       <thead>

        <tr>
          <th>S.NO</th>
          <th>Date</th>
          <th>Details</th>
          <th>Cotact</th>
          <th>Status</th>
          <th>Action</th>
        </tr>

      </thead>
      <tbody>
        <?php
        $ret=mysqli_query($con,"SELECT * from appointments_tb where mother='$mother_id' ORDER BY id asc LIMIT 6");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {

          ?>

          <tr>
            <td><?php echo $cnt;?></td>

            <td style="padding-top: 25px"><?php  echo $row['date']." ".$row['time'];?></td>
            <td style="padding-top: 25px"><?php  echo $row['comment'];?></td>
            <td style="padding-top: 25px"><?php  echo $row['contact'];?></td>
            <td style="padding-top: 25px"><?php 
            $date1=$row['date'];
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
          ?>    
        </td>
        <td style="padding-top: 25px">
          <a onclick="return confirm('You are about to confirm this appointment?')" href="?confirm_result=<?php echo $row['id'].'-appointments_tb' ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> </a>
          <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-appointments_tb' ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
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



<div class="row">
  <div class="col-md-4 col-lg-4">
   <div class="card">
    <div class="header">
      <h6 class="m-0 font-weight-bold">Medical History of <?php echo $name; ?> </h6>
    </div>
    <div class="content">
      <?php
      $statement=mysqli_query($con,"SELECT * from medical_history where mother='$mother_id' ORDER BY datein DESC");
      $number= mysqli_num_rows($statement);
      while ($row=mysqli_fetch_array($statement)) 

      {

        ?>
        <div class="card">
          <!-- Card Header - Accordion -->
          <a href="#collapse<?php echo $row['id']; ?>" class="header" style="text-align: center !important;" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse<?php echo $id ?>">
            <h6 class="m-0 font-weight-bold text-primary">Visit <?php echo $number ?>:  <?php echo $row['datein']; ?></h6>
          </a>
          <!-- Card Content - Collapse -->
          <div class="collapse show" id="collapse<?php echo $row['id']; ?>">
            <div class="content">
              <strong>Presenting Complaint</strong>
              <p><?php echo $row['complaint']; ?></p>
              <strong>Medical  Examination</strong>
              <p><?php echo $row['exam']; ?></p>
              <strong>Diagnosis and Ttreatment</strong>
              <p><?php echo $row['diagnosis'];?>. <?php echo $row['treatment']; ?></p>
            </div>
          </div>
        </div>
        <?php

        $number=$number-1;
      }
      ?>
    </div>
  </div>
</div>

<div class="col-md-8 col-lg-8">
  <div class="card ">
    <div class="header">
      <h4 class="title">REFERRALS</h4>
    </div>

    <div class="content table-responsive table-full-width" style="margin: 5px;">
      <table class="table table-hover table-striped" id="example1" style="padding: 0;">

       <thead>

        <tr>
          <th>No</th>
          <th>Date</th>
          <th>To</th>
          <th>Notes</th>
          <th>Feedback</th>
          <th>Action</th>
        </tr>

      </thead>
      <tbody>
        <?php
        $ret=mysqli_query($con,"SELECT * from referal_tb where mother='$mother_id' ORDER BY id DESC LIMIT 6");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {

          ?>

          <tr>
            <td style="padding-top: 25px"><?php echo $cnt;?></td>
            <td style="padding-top: 25px"><?php  echo $row['date'];?></td>
            <td style="padding-top: 25px"><?php  echo $row['referral'];?></td>
            <td style="padding-top: 25px"><?php  echo $row['comment'];?></td>
            <td style="padding-top: 25px"><?php 

            if ($row['feedback']=="") {

              echo "N/A";

            }
            else{
              echo $row['feedback'];
            }
            ?>    
          </td>
          <td style="padding-top: 25px">
            <button data-toggle="modal" data-target="#view-modal-edit" data-id="<?php echo $row['id']; ?>" id="viewreferral" class="btn btn-xs btn-info"><i class="fas fa-fw fa-eye"></i> view</button>
            <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-referal_tb' ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
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


<?php require_once 'footer.php'; ?>

<div id="view-modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">×</button>

      </div>

      <div id="printThis" class="modal-body">
        <div id="modal-loader" style="display: none; text-align: center;">
          <!-- ajax loader -->
          <img src="ajax-loader.gif">
        </div>

        <!-- mysql data will be load here -->
        <div id="dynamic-content-edit"></div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '#viewreferral', function(e) {

      e.preventDefault();

        var uid = $(this).data('id'); // get id of clicked row

        $('#dynamic-content-edit').html(''); // leave this div blank
        $('#modal-loader').show(); // load ajax loader on button click

        $.ajax({
          url: 'referral-detail.php',
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

    $(document).on('click', '#edituser', function(e) {

      e.preventDefault();

        var uid = $(this).data('id'); // get id of clicked row

        $('#dynamic-content-edit').html(''); // leave this div blank
        $('#modal-loader').show(); // load ajax loader on button click

        $.ajax({
          url: 'edit_user.php',
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
  });
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

<p style="font-size:16px; color:red" align="center"> <?php if($msg3){
                                // echo $msg1;

 ?>
 <script type="text/javascript">
  $(document).ready(function(){

   demo.initChartist();

   $.notify({
     icon: 'pe-7s-gift',
     message: "<?php echo $msg3 ?>"

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
  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
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