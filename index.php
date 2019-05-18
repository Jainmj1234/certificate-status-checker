<?php
session_start();
if(isset($_SESSION["user"])){
  header("location:dashboard/tables.php");
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Certificate-Status</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet" />
   <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>




  <style>
  .d-bck
  {

  padding: 0px 40px 20px 40px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}
.d-bdy{
  background-color: #F7F3F3;
  background-clip: border-box;
  padding: 0px 40px 20px 40px;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;}

  ul
  {
    list-style: none;
  }
  .box
  {
   width:inherit;
   border:1px solid #ccc;
   background-color:#fff;
   border-radius:5px;
   margin-top:10px;
  }
  .tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}


.tooltip:hover .tooltiptext {
  visibility: visible;
}

body
{ background-image:url("img/bck.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;opacity: .8;}
</style>

</head>

<body>

<div class="container">
  <div class="row shadow-lg bg-white rounded">
  <div class="col-md-12">
    <span class="d-block d-bck text-center">
    <div class="alert alert-danger display-error" style="display: none">
    </div>
      <h4 class="form-header text-center">Welcome</h4>      
        <p align="center"><b>Check your certificate status just by entering your NAME and Register Number</b></p>
        <p align="center">This page is created for checking certificates status of ELECTONICS AND COMMUNICATION passout students, NSS COLLEGE OF ENGINEERING</p>
        <p align="center" >This page returns most matched data's with respect to the input given</p>
        <p align="right">
        <a href="" class="btn btn-info mb-4" data-toggle="modal" data-target="#modalLoginForm">Admin Login</a></p>
      </span>
    </div>
  </div>
  <div class="row">
  <div class="col-md-12 m-auto">
      <span class="d-block d-bdy text-center">
      <div class="form-group text-left">
        <h5 class="text-dark">Search for the Certificate-Status</h5>
        <hr />
        <div class="row">
          <div class="col-md-7 m-auto">
      <div id="div1">
        <form name="login" method="post" id="login">
        <div class="form-group">
          <i class="fa fa-user iconalign"></i> 
          <label for="username"><b>Name</b></label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter Name">
         </div>
        <div class="form-group">
          <i class="fa fa-credit-card iconalign"></i> 
          <label for="register"><b>Register Number</b></label>&nbsp&nbsp&nbsp&nbsp<i id="text">info</i>
          <div id="pig" style="display:none"><div class="container"><p>If your register number is in the format NSACEECXXX ,try both NSACEECXXX and NSACEEC XXX</p></div></div>
          <input type="text" class="form-control" name="regno" id="regno" placeholder="Register Number">
          </div>
          <div class="form-group">
            <label for="class"><b>Select the Semester</b></label>
            <select class="form-control" id="class" style="padding-left:8px !important">
              <option value="S3">S3</option>
              <option value="S4">S4</option>
              <option value="S5">S5</option>
              <option value="S6">S6</option>
              <option value="S7">S7</option>
              <option value="FY">Final Year</option>
              <option value="MTECH">M-TECH</option>
            </select>
          </div>
          <hr />
      <div class="row">
        <div class="form-group col-md-6">
          <button type="reset" value="reset" name="reset" class="btn btn-default">Clear Fields</button>
        </div>
        <div class="form-group col-md-6">
          <button type="submit" data-target="#statusModal" data-toggle="modal" class="btn btn-lg btn-primary" name="submit">Check Status</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
</div>
</span>
</div>
</div>
</div>


<script type="text/javascript">


  $('#text').mouseenter(function(){
    $('#pig').fadeIn();
   }).mouseleave(function(){
    $('#pig').fadeOut();
  });
  
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
                    setTimeout(function() { location.reload(1);},2500);
                    }
                 else {
                    var details = '';
                    details += '<div style="overflow: auto" class="container-box">';
                    details += "<center><b><u>Matched Data's Found</u></b></center>";
                    details += '<table class="table table-bordered" style="width:auto;text-align:center" padding=3px><tr width="100%"><th scope="col" width="25%">Name</th><th scope="col" width="25%">Register Number</th><th scope="col" width="25%">Semester</th><th width="25%" scope="col">Status</th></tr>';
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
                    setTimeout(function() { location.reload(1);},2000);
   
                }
            }
        });
      });
  });
</script>


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
      <span class="text-center">
      <form name="adminlogin text-center" method="post" id="adminlog">
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fa fa-user"></i>
          <label data-error="wrong" data-success="right" for="defaultForm-email">Username</label>
          <input type="text" name="usera" id="usera" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <i class="fa fa-lock"></i>
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
          <input type="password" name="passa" id="passa" class="form-control validate">
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="reset" class="btn btn-default">Reset</button>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      </form>
    </span>
       <div class="alert alert-danger display-error_l" style="display: none">
    </div>
    </div>
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
        <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Check Another</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
