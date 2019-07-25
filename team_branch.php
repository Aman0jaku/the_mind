<?php
  if (isset($_POST['add'])==true) {
    $hmp = $_POST['hmp'];
    header('Location:team_add.php?hmp='.$hmp);
    exit();
  }
  if (isset($_POST['list'])==true) {
    header('Location:team_list.php');
    exit();
  }
?>
