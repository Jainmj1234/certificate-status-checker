<?php
session_start();
if(!isset($_SESSION["user"])){
  header("location:../../index.php");
}
?>
<?php
  include("../connect.php");
  $sqll= "SELECT id FROM stdata ORDER by id DESC LIMIT 1;";
  $resultl = $conn->query($sqll);
  $rowl = $resultl->fetch_assoc();
  $la_id = $rowl['id'];
$output = '';
if(isset($_POST["import"]))
{
 $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("Classes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file
  $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    $name = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $regno = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $class = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
    $query = "INSERT INTO stdata(name, regno, class) VALUES ('".$name."', '".$regno."', '".$class."')";
    mysqli_query($conn, $query);
    $output .= '<td>'.$name.'</td>';
    $output .= '<td>'.$regno.'</td>';
    $output .= '<td>'.$class.'</td>';
    $output .= '</tr>';
   }
  } 
  $output .= '</table>';
  header("location:lastrows.php?id=$la_id");
 }
 else
 {
  $output = '<label class="ext-danger">Invalid File</label>'; //if non excel file then
 }
}
$conn->close();
?>

<html>
 <head>
  <title>Import Excel to Mysql using PHPExcel in PHP</title>
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
   <h3 align="center">Add Excel Sheet to Database</h3><br />
   <a href="../index.php"><button class="btn btn-info">Home</button></a><br>
   <form method="post" enctype="multipart/form-data">
    <label>Select Excel File</label>
    <input type="file" name="excel" />
    <br />
    <p align="center"><input type="submit" id="table" name="import" class="btn btn-primary" value="Import" /></p>
   </form>
   <br />
  </div>
 </body>
</html>

