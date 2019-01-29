<?php 

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
    $pass=$_POST['password'];
    }

    if(isset($uname) and isset($pass)) {
    $sql="SELECT * FROM list where username='$uname';";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
      $errorMSG .= "<li>Username doesnot exist</li>";
    }else{
      $row = $result->fetch_assoc();
      if($row['password']==$pass){
     $msg = "Name: ".$uname.", Status: ".$status;
     echo json_encode(['code'=>200, 'msg'=>$msg]);
     exit;
     }else{
       $errorMSG .= "<li>Password doesnot exist</li>";
      }
    }
  }
  echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
?>