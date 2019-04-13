<?php
session_start();
if(isset($_SESSION["user"])){
  header("location:dashboard/tables.php");
}
?>
<html>
<head>

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="script.js"></script>
<script src="js/bootstrap.min.js"></script></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<style>
  .box
  {
   width:inherit;
   border:1px solid #ccc;
   background-color:#fff;
   border-radius:5px;
   margin-top:10px;
  }
body
{ background-image:url("bck.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;}
</style>

</head>

<body>

<div class="card text-center" style="width: 58rem; position: relative; margin: auto;">
  <div class="card-header">
    <div class="alert alert-danger display-error" style="display: none">
    </div>
  <h1 align="center">Welcome</h1>      
  <p align="center">Check your certificate status just by entering your username and password</p>
  <p align="right">
  <a href="" class="btn btn-info mb-4" data-toggle="modal" data-target="#modalLoginForm">Admin Login</a>
  </div>
<div class="card-body">

<form name="login" method="post" id="login">
  <div class="form-group">
    <label for="username"><b>Username</b></label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
  <div class="form-group">
    <label for="register"><b>Register Number</b></label>
    <input type="text" class="form-control" name="regno" id="regno" placeholder="Register Number">
  </div>
  <div class="form-group">
  <label for="class"><b>Select the Semester</b></label>
  <select class="form-control" id="class">
        <option value="S3">S3</option>
        <option value="S4">S4</option>
        <option value="S5">S5</option>
        <option value="S6">S6</option>
        <option value="S7">S7</option>
        <option value="FY">Final Year</option>
        <option value="MTECH">M-TECH</option>
  </select>
</div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="check">
    <label class="form-check-label" for="Check">Check me out</label>
  </div>
 <button type="submit" data-target="#statusModal" data-toggle="modal" class="btn btn-primary" name="submit">
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
      <div class="modal-body" id="statusContent">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='index.html'">Check Another</button>
      </div>
    </div>
  </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form name="adminlogin" method="post" id="adminlog">
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fa fa-user"></i>
          <input type="text" name="usera" id="usera" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Username</label>
        </div>

        <div class="md-form mb-4">
          <i class="fa fa-lock"></i>
          <input type="password" name="passa" id="passa" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" class="btn btn-default">Login</button>
      </div>
      </form>
       <div class="alert alert-danger display-error_l" style="display: none">
    </div>
    </div>
  </div>
</div>
</body>


<script type="text/javascript">
  
  $(document).ready(function() {
      $('#login').submit(function(e){
        e.preventDefault();
        var username = $("#username").val();
        var regno = $("#regno").val();
        var semester = $("#class").val();
        $.ajax({
            type: "POST",
            url: "submit.php",
            dataType: "json",
            data: {username:username, regno:regno, class:semester},
            success : function(data){
                if (data.code == "404"){
                  $(".display-error").html("<ul>"+data.msg+"</ul>");
                    $(".display-error").css("display","block");
                    result="Check the data's that you entered";
                    document.getElementById("statusContent").innerHTML=result;
                    }
                 else {
                    var details = '';
                    details += '<div class="container box">';
                    details += "<center><b><u>Matched Data's Found</u></b></center>";
                    details += '<table class="table table-bordered" style="width:auto;text-align:center" padding=3px><tr width="100%"><th width="25%">Name</th><th width="25%">Register Number</th><th width="25%">Semester</th><th width="25%">Status</th></tr>';
                   $.each(data,function(key,value){
                      details += '<tr width="100%">';
                      details += '<td width="25%" width="25%" width="25%" width="25%">'+value.name+'</td>';
                      details += '<td width="25%" width="25%" width="25%">'+value.regno+'</td>';
                       details += '<td width="25%" width="25%">'+value.class+'</td>';
                       if(value.status == null || value.status == 0){
                        details += '<td width="25%"><b><i>Not Issued</i></b></td></tr>';
                      }
                      else{
                        details += '<td width="25%"><b>Issued</b></td></tr>';
                      }
                        });
                       details += '</tr></table></div>';
                    document.getElementById("statusContent").innerHTML=details;
                }
            }
        });
      });
  }); 
  
  $(document).ready(function() {
      $('#adminlog').submit(function(e){
        e.preventDefault();
        var username = $("#usera").val();
        var password = $("#passa").val();
        $.ajax({
            type: "POST",
            url: "adminlog.php",
            dataType: "json",
            data: {username:username, password:password},
            success : function(data){
                if (data.code == "111"){
                 window.location.href = "dashboard/tables.php";
                    }
                 else {
                   $(".display-error_l").html("<ul>"+data.msg+"</ul>");
                    $(".display-error_l").css("display","block");        
                }
            }
        });
      });
  });
</script>
</html>
