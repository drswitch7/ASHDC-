<?php
include('incs/libs.php');

$drp= new Utility;

if(isset($_POST['state'])){
  $sid= $_POST['state'];
    $drp->Dropdown("lganame","lga WHERE sid='$sid'","lganame");
}

?>