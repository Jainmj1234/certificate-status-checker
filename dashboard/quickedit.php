<?php
session_start();
if(!isset($_SESSION["user"])){
  header("location:../index.php");
}
?>
<html>
 <head>
  <title>All Data's - Quick Edit</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:700px;
   border:1px solid #ccc;
   background-color:#fff;
   border-radius:5px;
   margin-top:100px;
  }
  
  </style>
 </head>
 <body>
  <div class="container box">
    <h3 align="center">Data's Uploaded</h3><br />
    <a href="../index.php"><button class="btn btn-info">Home</button></a><br>
  <table class='table table-bordered'>
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Register No.</th>
                      <th>Class</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    
           <?php
            include("../connect.php");
             $sql = "SELECT * FROM stdata ORDER by id DESC;";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                if($row["name"] !="" && $row["regno"] != "" && $row["name"] != "Name"){
                 echo "<tr>
                      <td>" . $row["name"]. "  <a href='#' data-id=" .$row["id"]. " class='del' alt='delete'>(Delete Row)</a></td>
                      <td>" . $row["regno"]. "</td>
                      <td>" . $row["class"]. "</td>";
                      if ($row['status'] != 1) {
                          echo "<td><input type='submit' id='submit' data-id=" .$row["id"]. " class='btn  btnck btn-danger btn-block' value='Not Issued'></input></td>";
                          }
                      else{
                     echo "<td><input type='submit'  data-id=" .$row["id"]. " id='submit' class='btn  btnck btn-primary btn-block' value='Issued'></input></td>"; 
                          }
                          }
          

                    ;}}

                    $conn->close();
                  ?>
  </div>
 </body>
</html>

  <script type="text/javascript">
  
  $(document).ready(function() {
     $(".btnck").click(function(e){
        e.preventDefault();
        var invoker = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "btnclick.php",
            data: { did: invoker },
            success : function(data){
            location.reload();
          }
           });
       });
     });

  $(document).ready(function() {
     $(".del").click(function(e){
        e.preventDefault();
        var invoker = $(this).data('id');
        var act = "del";
        $.ajax({
            type: "POST",
            url: "btnclick.php",
            data: { did: invoker , act : act},
            success : function(data){
            location.reload();
          }
           });
       });
     });

</script>
