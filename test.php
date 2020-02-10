<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css" >
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
  <script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
  <link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>

</head>


<?php $date = '08/17/2013';
$date = explode("/",$date);
$new_date = array($date[1], $date[0], $date[2]);
$date = implode("-",$new_date);
echo "New Date is".$date; ?>
</form>
</div>
</div>



               <!--  <div class="col-md-12">
                  <p style="color: black;font-size: 16px;">Next immunisation date</p>
                  <div class="option">

                    <input type="checkbox" name="chkBox1" value="ongoing" onclick="disableEnableField()" id="chkBox1" class="showHideCheck" />Automatic
                    <br/><div class="hiddenInput">
                      <input type="text" class="form-control" value="<?php echo date("d-m-Y", strtotime("+6 weeks")); ?>"  name="automatic_date" readonly/>
                    </div>
                  </div>

                  <div class="option">
                    <input type="checkbox" id="chkBox2" name="chkBox2" class="showHideCheck" />Manual
                    <br/><div class="hiddenInput">
                      <input type="date" class="datepicker form-control" value=""  id="manual_date" name="manual_date" >
                    </div>
                  </div>
                </div> -->

                <!-- <div class="col-md-12">
                  <div class="form-label-group">
                    <p style="color: black;font-size: 16px;">Notes</p>
                    <textarea name="comment" class="form-control" rows="3" placeholder="Comment or Message here"></textarea>
                  </div>
                </div> -->


<div class="container">
  <br />
  <div class="row">
    <div class='col-sm-3'>
      <div class="form-group">
        <div class="input-group date" data-provide="datepicker">
          <input type="text" class="form-control">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <input type="text" id="time" class="form-control" placeholder="Time">
      </div>
    </div>
  </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.en-GB.min.js" charset="UTF-8"></script>


<!-- Script -->
<script type="text/javascript">
  $(document).ready(function(){
   $('#datepicker').datepicker({
    "format": "mm-dd-yy",
    "startDate": "-5d",
    "endDate": "09-15-2027",
    "keyboardNavigation": false
  }); 
 });


  var timepicker = new TimePicker('time', {
    lang: 'en',
    theme: 'dark'
  });
  timepicker.on('change', function(evt) {

    var value = (evt.hour || '00') + ':' + (evt.minute || '00');
    evt.element.value = value;

  });
</script>

</body>
</html>