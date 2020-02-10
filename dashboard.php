<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
require_once 'includes/connection.php';
error_reporting(0);
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
} else{ ?>
<?php require_once 'header.php'; ?>

<div class="content">
    <div class="container-fluid">
        <?php
        $query=mysqli_query($conn,"select id from pregnant_mothers");
        $count_mothers=mysqli_num_rows($query);
        ?>  
        <div class="row m-t-25">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card1">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="pe-7s-user"></i>
                            </div>
                            <div class="text">
                                <h2><?php echo $count_mothers;?></h2>
                                <a href="" style="color: white;"><span>Mothers</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php
            $query1=mysqli_query($conn,"select id from baby_tb");
            $count_baby=mysqli_num_rows($query1);
            ?>                       


            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card2">
                        <div class="overview-box clearfix">
                            <div class="icon">
                               <i class="zmdi zmdi-account-o"></i>
                           </div>
                           <div class="text">
                            <h2><?php echo $count_baby?></h2>
                            <a href="" style="color: white;"><span>Babies</span></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php
        $query2=mysqli_query($conn,"select id from referrals");
                        // where date(EnterDate)>=(DATE(NOW()) - INTERVAL 7 DAY);
        $count_referrals=mysqli_num_rows($query2);
        ?>                       


        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card3">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>
                        </div>
                        <div class="text">
                            <h2><?php echo $count_referrals?></h2>
                            <a href="" style="color: white;"><span>Referrals</span></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
        $query3=mysqli_query($conn,"select id from appointments_tb");
        $count_appointments=mysqli_num_rows($query3);
        ?>                       




        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card4">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>
                        </div>
                        <div class="text">
                            <h2><?php echo $count_appointments?></h2>
                            <a href="" style="color: white;"><span>Appointments</span></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">

                <div class="header">
                    <h4 class="title">Appointments Statistics</h4>
                    <p class="category">Last Campaign Performance</p>
                </div>
                <div class="content">
                    <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Mothers
                            <i class="fa fa-circle text-danger"></i> Babies
                            <i class="fa fa-circle text-warning"></i> Others
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Appointments Calender</h4>
                    <!-- <p class="category">Last Campaign Performance</p> -->
                </div>
                <div class="content">
                    <?php require_once 'calender.php'; ?>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <div class="card ">
                <div class="header">
                    <h4 class="title">2020 Clients</h4>
                    <p class="category">All Follo App Activities</p>
                </div>
                <div class="content">
                    <div id="chartActivity" class="ct-chart"></div>

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Appointments
                            <i class="fa fa-circle text-danger"></i> Diagonosis
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-check"></i> Data information certified
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Tasks</h4>
                    <p class="category">Backend development</p>
                </div>
                <div class="content">
                    <div class="table-full-width">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                     <div class="checkbox">
                                      <input id="checkbox1" type="checkbox">
                                      <label for="checkbox1"></label>
                                  </div>
                              </td>
                              <td>Activities that is done on folloapp?"</td>
                              <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                             <div class="checkbox">
                              <input id="checkbox2" type="checkbox" checked>
                              <label for="checkbox2"></label>
                          </div>
                      </td>
                      <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                      <td class="td-actions text-right">
                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                     <div class="checkbox">
                      <input id="checkbox3" type="checkbox">
                      <label for="checkbox3"></label>
                  </div>
              </td>
              <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
              </td>
              <td class="td-actions text-right">
                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                    <i class="fa fa-edit"></i>
                </button>
                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                    <i class="fa fa-times"></i>
                </button>
            </td>
        </tr>
        <tr>
            <td>
             <div class="checkbox">
              <input id="checkbox4" type="checkbox" checked>
              <label for="checkbox4"></label>
          </div>
      </td>
      <td>Create 4 Invisible User Experiences you Never Knew About</td>
      <td class="td-actions text-right">
        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
            <i class="fa fa-edit"></i>
        </button>
        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
            <i class="fa fa-times"></i>
        </button>
    </td>
</tr>
<tr>
    <td>
     <div class="checkbox">
      <input id="checkbox5" type="checkbox">
      <label for="checkbox5"></label>
  </div>
</td>
<td>Read "Following makes Medium better"</td>
<td class="td-actions text-right">
    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
        <i class="fa fa-times"></i>
    </button>
</td>
</tr>
<tr>
    <td>
     <div class="checkbox">
      <input id="checkbox6" type="checkbox" checked>
      <label for="checkbox6"></label>
  </div>
</td>
<td>Unfollow 5 enemies from twitter</td>
<td class="td-actions text-right">
    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
        <i class="fa fa-times"></i>
    </button>
</td>
</tr>
</tbody>
</table>
</div>

<div class="footer">
    <hr>
    <div class="stats">
        <i class="fa fa-history"></i> Updated 3 minutes ago
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>



<?php require_once 'footer.php';

}
 ?>
 <script type="text/javascript">
 $(document).ready(function(){

     demo.initChartist();

     $.notify({
         icon: 'pe-7s-gift',
         message: "Welcome to <b>Follo App Online Services</b> - a beautiful experince bravo!!!."

     },{
        type: 'info',
        timer: 4000
    });

 });
</script>