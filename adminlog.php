<?php 
session_start();
    $errorMSG = "";
    include 'connect.php';
    if (empty($_POST["username"])) {
    $errorMSG .= "<li>Username is required</li>";
    } else {
    $uname=$_POST['username'];
    }
    if (empty($_POST["password"])) {
    $errorMSG .= "<li>Password is required</li>";
    } else {
    $passa=md5($_POST['password']);
    }
    $sql="SELECT * FROM login WHERE name='$uname' AND password='$passa';";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
      $errorMSG .= "<li>Username or Password incorrect..!</li>";
      echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
    }else{
     echo json_encode(['code'=>111, 'msg'=>$errorMSG]);
     $_SESSION["user"] = $uname;    
    }
?>