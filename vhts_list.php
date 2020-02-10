 <?php
 session_start();
 error_reporting(0);
 include('includes/dbconnection.php');
 if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
} else{

  if (isset($_POST['update_vht'])) {

    $id = $_POST['id'];
    $F_name = $_POST['f_name'];
    $contact = $_POST['m_contact'];
    $L_name = $_POST['l_name'];
    $email = $_POST['e_address'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $update_query = mysqli_query($con,
      "UPDATE vhts set first_name='$F_name', contact='$contact', last_name='$L_name', 
      user_email='$email', address='$address', user_password='$password' where id='$id'");
    if ($update_query) {
      $msg = "$F_name $L_name information successfully updated";
    }
    else{
      $msg1 = "$F_name $L_name information failed to update";
    }

  }

  ?>
  <?php include_once('header.php');?>

  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="header">
              <h4 class="title">Vhts Accounts Table</h4>
            </div>

            <div class="content table-responsive table-full-width" style="margin: 5px;">
              <table class="table table-hover table-striped" id="example" style="padding: 0;">

               <thead>

                <tr>
                  <th>S.NO</th>
                  <th>Full Name</th>
                  <th>Home Area</th>
                  <th>Phone No</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>

              </thead>
              <tbody>
                <?php
                $ret=mysqli_query($con,"SELECT * from vhts ORDER BY id DESC");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {

                  ?>

                  <tr>
                    <td><?php echo $cnt;?></td>

                    <td style="padding-top: 25px"><?php  echo $row['first_name']." ".$row['last_name'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['address'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['contact'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['user_email'];?></td>
                    <td style="padding-top: 25px">
                      <button data-toggle="modal" data-target="#view-modal-edit" data-id="<?php echo $row['id']; ?>" id="editvht" class="btn btn-sm btn-info"><i class="fas fa-fw fa-edit"></i> Edit</button>
                      <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-vhts' ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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
        <h4 class="modal-title">
          <i class="fa fa-user"></i> Edit Vhts Info
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

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
    $(document).on('click', '#editvht', function(e) {

      e.preventDefault();

        var uid = $(this).data('id'); // get id of clicked row

        $('#dynamic-content-edit').html(''); // leave this div blank
        $('#modal-loader').show(); // load ajax loader on button click

        $.ajax({
          url: 'edit_vht.php',
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