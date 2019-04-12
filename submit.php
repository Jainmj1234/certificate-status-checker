<?php 
    $errorMSG = "";
    include 'connect.php';
    $class = $_POST['class'];
    if (empty($_POST["username"])) {
    $errorMSG .= "<li>Username is required</li>";
    } else {
    $uname=$_POST['username'];
    }
    if (empty($_POST["regno"])) {
    $errorMSG .= "<li>Password is required</li>";
    } else {
    $regno=$_POST['regno'];
    }
    if(isset($uname) and isset($regno)) {
    $sql="SELECT * FROM stdata WHERE name REGEXP '$uname' AND regno REGEXP '$regno' AND class = '$class';";
    $result = $conn->query($sql);
    $json = array();
    if ($result->num_rows == 0) {
      $errorMSG .= "<li>No matched data found ...</li>";
    }else{
    while($row=mysqli_fetch_assoc($result)){
    $json[]=$row;
    }
    echo json_encode($json);
    exit;
    }
  }
  echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
?>