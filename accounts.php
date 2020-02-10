 <?php
 session_start();
 error_reporting(0);
 include('includes/dbconnection.php');
 if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
} else{

  if (isset($_POST['adduser'])) {

    $names = $_POST['f_name'];
    $username = $_POST['u_name'];
    $contact = $_POST['m_contact'];
    $email = $_POST['e_address'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    $addSql = mysqli_query($con,"INSERT INTO tbladmin(AdminName,UserName,Email,MobileNumber,Password,role)
     VALUES('$names','$username','$email','$contact','$password','$role')");
    if ($addSql) {
      $msg = "New User added successfully";
    }
    else{
      $msg1 = "Account failed to be created please try again";
    }

  }

  if (isset($_POST['updateuser'])) {

   $id = $_POST['id'];
   $names = $_POST['f_name'];
   $username = $_POST['u_name'];
   $contact = $_POST['m_contact'];
   $email = $_POST['e_address'];
   $role = $_POST['role'];
   $password = $_POST['password'];

   $update_query = mysqli_query($con,
    "UPDATE tbladmin set AdminName='$names', UserName='$username', Email='$email', 
    MobileNumber='$contact', Password='$password', role='$role' where ID='$id'");
   if ($update_query) {
    $msg = "$names information successfully updated";
  }
  else{
    $msg1 = "$names information failed to update";
  }
}

?>
<?php include_once('header.php');?>

<div class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="header">
            User Accounts 
            <button data-toggle="modal" data-target="#view-modal-edit" data-id="1" id="addaccount" class="btn btn-sm btn-info"><i class="fas fa-fw fa-plus-circle"></i> Add users</button>
          </div>

          <div class="content table-responsive table-full-width" style="margin: 5px;">
            <table class="table table-hover table-striped" id="example" style="padding: 0;">

             <thead>

              <tr>
                <th>S.NO</th>
                <th>Full Name</th>
                <th>UserName</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>Role</th>
                <th>Action</th>
              </tr>

            </thead>
            <tbody>
              <?php
              $ret=mysqli_query($con,"select * from tbladmin");
              $cnt=1;
              while ($row=mysqli_fetch_array($ret)) {

                ?>

                <tr>
                  <td><?php echo $cnt;?></td>

                  <td style="padding-top: 25px"><?php  echo $row['AdminName'];?></td>
                  <td style="padding-top: 25px"><?php  echo $row['UserName'];?></td>
                  <td style="padding-top: 25px"><?php  echo $row['Email'];?></td>
                  <td style="padding-top: 25px"><?php  echo $row['MobileNumber'];?></td>
                  <td style="padding-top: 25px"><?php  echo $row['role'];?></td>
                  <td style="padding-top: 25px">
                    <button data-toggle="modal" data-target="#view-modal-edit" data-id="<?php echo $row['ID']; ?>" id="edituser" class="btn btn-sm btn-info"><i class="fas fa-fw fa-edit"></i> Edit</button>
                    <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this field?')" title="View Full Details"><i class="fa fa-trash fa-1x"></i></a>
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
    $(document).on('click', '#addaccount', function(e) {

      e.preventDefault();

        var uid = $(this).data('id'); // get id of clicked row

        $('#dynamic-content-edit').html(''); // leave this div blank
        $('#modal-loader').show(); // load ajax loader on button click

        $.ajax({
          url: 'create_accounts.php',
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