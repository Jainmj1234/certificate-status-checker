<?php 
session_start();
    $errorMSG = "";
    include 'connect.php';
    if (empty($_POST["username"])) {
    $errorMSG .= "<li>Username required</li>";
    } else {
    $uname=$_POST['username'];
    }
    if (empty($_POST["password"])) {
    $errorMSG .= "<li>Password required</li>";
    } else {
    $passa=md5($_POST['password']);
    }
    if($errorMSG != ""){
        echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
    }
    else{
    $sql="SELECT * FROM login WHERE name='$uname' AND password='$passa';";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
      $errorMSG .= "<li>Username or Password incorrect..!</li>";
      echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
    }else{
     echo json_encode(['code'=>111, 'msg'=>$errorMSG]);
     $_SESSION["user"] = $uname;    
    }
}
?>