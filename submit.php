<?php 
    $errorMSG = "";
    $findError = "";
    include 'connect.php';
    $class = $_POST['class'];
    if (empty($_POST["username"])) {
    $errorMSG .= "<li>NAME required</li>";
    } else {
    $uname=$_POST['username'];
    }
    if (empty($_POST["regno"])) {
    $errorMSG .= "<li>Register Number required</li>";
    } else {
    $regno=$_POST['regno'];
    }
    if($errorMSG != ""){
     echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
    }
    else{
    $sql="SELECT * FROM stdata WHERE name REGEXP '$uname' AND regno REGEXP '$regno' AND class REGEXP '$class';";
    $result = $conn->query($sql);
    $json = array();
    if ($result->num_rows == 0) {
      $findError .= "<li>No matched data found ...</li>";
      $stat = "Not found";
      echo json_encode(['code'=>404, 'msg'=>$findError]);
    }else{
    $stat = "Found YEH!";
    while($row=mysqli_fetch_assoc($result)){
    $json[]=$row;
    }
    echo json_encode($json);
    }
    $sql1="INSERT INTO entries(name, regno, class, status) VALUES ('".$uname."', '".$regno."', '".$class."', '".$stat."')";
    $result1 = $conn->query($sql1);
    $conn->close();
    exit;
  }
?>