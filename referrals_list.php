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
              <h4 class="title">All Referrals Table</h4>
            </div>

            <div class="content table-responsive table-full-width" style="margin: 5px;">
              <table class="table table-hover table-striped" id="example" style="padding: 0;">

               <thead>

                <tr>
                  <th>No</th>
                  <th>Mother</th>
                  <th>Contact</th>
                  <th>Date</th>
                  <th>Details</th>
                  <th>To</th>
                  <th>Feedback</th>
                  <th>Action</th>
                </tr>

              </thead>
              <tbody>
                <?php
                $ret=mysqli_query($con,"select * from referal_tb");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {

                  ?>

                  <tr>
                    <td><?php echo $cnt;?></td>

                    <td style="padding-top: 25px"><?php  echo $row['mother'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['contact'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['date'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['comment'];?></td>
                    <td style="padding-top: 25px"><?php  echo $row['referral'];?></td>
                    <td style="padding-top: 25px"><?php 
                    if ($row['feedback']=="") {
                      echo "N/A";
                    }
                    else{
                      echo $row['feedback'];
                    }
                    ?></td>
                    <td style="padding-top: 25px">
                      <button data-toggle="modal" data-target="#view-modal-edit" data-id="<?php echo $row['id']; ?>" id="viewreferral" class="btn btn-sm btn-info"><i class="fas fa-fw fa-eye"></i> view</button>
                      <a onclick="return confirm('Are you sure to delete this field?')" href="?del_result=<?php echo $row['id'].'-referal_tb' ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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