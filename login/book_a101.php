<?php
$mysqli = new mysqli('localhost', 'root', '', 'roombookingsystem');
if(isset($_GET['date'])){
    $date = $_GET['date'];
    $stmt = $mysqli->prepare("select * from booking_a101 where date = ?");
    $stmt->bind_param('s', $date);
    $booking_a101 = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $booking_a101[]=$row['timeslot'];    
            }

            $stmt->close();
        }
    }
}

if(isset($_POST['submit']))
    if(isset($_POST['name']))
    if(isset($_POST['emailid']))
    if(isset($_POST['department']))
    if(isset($_POST['event_name']))
    if(isset($_POST['timeslot']))

    {
    $name = $_POST['name'];
    $emailid = $_POST['emailid'];
    $department =$_POST['department'];
    $event_name =$_POST['event_name'];
    $timeslot =$_POST['timeslot'];

    $stmt = $mysqli->prepare("select * from booking_a101 where date = ? AND timeslot = ?");
    $stmt->bind_param('ss', $date, $timeslot,);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
        $msg = "<div class='alert alert-danger'>Already Booked</div>";
        }else{
    $stmt = $mysqli->prepare("INSERT INTO booking_a101 (name, emailid, department, event_name, date, timeslot) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param('ssssss', $name, $emailid, $department, $event_name, $date, $timeslot);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Booking Form Submitted Successfully</div>";
    $booking_a101[]=$timeslot;
    $stmt->close();
    $mysqli->close();
    }
    }
}
 
$duration = 30;
$cleanup = 0;
$start = "9:00";
$end = "18:00";

function timeslots($duration, $cleanup, $start, $end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();
    
    for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end){
            break;
        }
        
        $slots[] = $intStart->format("H:iA")." - ". $endPeriod->format("H:iA");
        
    }
    
    return $slots;
}
?>

<!doctype html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
  </head>

  <body>
    <div class="container">
        <h1 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1><hr>
        <div class="row">
   <div class="col-md-12">
       <?php echo(isset($msg))?$msg:""; ?>
   </div>
    <?php $timeslots = timeslots($duration, $cleanup, $start, $end); 
        foreach($timeslots as $ts){
    ?>
    <div class="col-md-2">
        <div class="form-group">
        <?php if(in_array($ts, $booking_a101)){ ?>
       <button class="btn btn-danger"><?php echo $ts; ?></button>
       <?php }else{ ?>
        <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
        <?php }  ?>
        </div>
    </div>
    <?php } ?>
</div>
</div>
<div class="modal" id="myModal">
  <div class="modal-dialog">
  <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 <h4 class="modal-title">Booking For: <span id="slot"></span></h4>
 </div>
 <div class="modal-body">
<div class="row">
 <div class="col-md-12">
<form action="" method="post">
<div class="form-group">
<label for="">Time Slot</label>
<input readonly type="text" class="form-control" id="timeslot" name="timeslot">
</div>
<div class="form-group">
<label for="">Name</label>
<input required type="text" class="form-control" name="name">
 </div>
<div class="form-group">
<label for="">Email Id</label>
<input required type="email" class="form-control" name="emailid">
</div>
<div class="form-group">
<label for="">Deparment</label>
<input required type="text" class="form-control" name="department">
</div>
<div class="form-group">
<label for="">Event Name</label>
<input required type="text" class="form-control" name="event_name">
</div>
  <div class="form-group pull-right">                                
  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>
 </div>
</div>
                
</div>

</div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
$(".book").click(function(){
    var timeslot = $(this).attr('data-timeslot');
    $("#slot").html(timeslot);
    $("#timeslot").val(timeslot);
    $("#myModal").modal("show");
});
</script>
  </body>
</html>