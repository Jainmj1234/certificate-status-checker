

<?php 
error_reporting(0);
ini_set('display_errors', 0);
if(isset($_POST['submit'])){
    include 'connect.php';
    $uname=$_POST['username'];
    $pass=$_POST['password'];
    $sql="SELECT * FROM list where username='$uname';";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
      echo "<script type='text/javascript'>alert('User does not exist')</script>";
    }else{
      $row = $result->fetch_assoc();
      if($row['password']==$pass){
       echo "<script>$(window).load(function(){
                 $('#statusModal').modal('show');
            });
        </script>";
      }else{
        echo "<script type='text/javascript'>alert('Incorrect password')</script>";
      }
    }
  }
?>

<html>
<head>

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<style>
	

body
{ background-image:url("bck.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;}

</style>

</head>

<body>

<div class="card text-center" style="width: 58rem; position: relative; margin: auto;">
	<div class="card-header">
	<h1 align="center">Welcome</h1>      
  <p align="center">Check your certificate status just by entering your username and password</p>
  </div>
<div class="card-body">

<form name="login" method="post">
  <div class="form-group">
    <label for="username"><b>Username</b></label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
  <div class="form-group">
    <label for="Password"><b>Password</b></label>
    <input type="password" class="form-control" name="password" id="InputPassword" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="check">
    <label class="form-check-label" for="Check">Check me out</label>
  </div>
 <button type="submit" class="btn btn-primary" name="submit" data-target="#statusModal" data-toggle="modal">
  Check Status
</button>
</form>
  </div>
</div>





<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Certificate Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Check Another</button>
      </div>
    </div>
  </div>
</div>

</body>


</html>