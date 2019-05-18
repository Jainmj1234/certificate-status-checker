<?php
session_start();
if(!isset($_SESSION["user"])){
  header("location:../index.php");
}
?>
<html>
 <head>
  <title>History</title>
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
    <h3 align="center">Search History</h3><br />
    <a href="../index.php"><button class="btn btn-info">Home</button></a><br>
  <table class='table table-bordered'>
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Register No.</th>
                      <th>Class</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    
           <?php
            include("../connect.php");
             $sql = "SELECT * FROM entries ORDER by id DESC;";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 echo "<tr>
                      <td>" . $row["id"]. "  </td>
                      <td>" . $row["name"]. " </td>
                      <td>" . $row["regno"]. "</td>
                      <td>" . $row["class"]. "</td>
                      <td>" . $row["status"]. "</td>";
                   }
                    };

                    $conn->close();
                  ?>
  </div>
 </body>
</html>

