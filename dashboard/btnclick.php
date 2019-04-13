<?php 
  $act ="";
  $id=$_POST['did'];
  $act = $_POST['act'];
  include 'connect.php';
  if($act != "del"){
  $sql="SELECT * FROM stdata WHERE `id`='". $id ."';";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  if ($row[status] == 0){
  $sql="UPDATE stdata SET `status`=1 WHERE `id`='". $id ."';";
  $result = $conn->query($sql);
}
else {
  $sql="UPDATE stdata SET `status`=0 WHERE `id`='". $id ."';";
  $result = $conn->query($sql);
}        
}
else{
$sql="DELETE FROM stdata WHERE `id`='". $id ."';";
$result = $conn->query($sql);
}

 ?>
