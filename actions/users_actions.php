<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_Logged_In(); ?>

<?php
$src_page="../admin.php?opt=usersManage&msg=";
if (isset($_GET["sel_user"])&&$_GET["op"]) {
  $sel_user=$_GET["sel_user"];
  $sel_op=$_GET["op"];
  if ($sel_op=="rm") {
    $query="DELETE FROM `pro0inter_users`
            WHERE ID={$sel_user}";
  }else {

    if ($sel_op=="apr") {
      $apr=1;
    }elseif ($sel_op=="deapr") {
      $apr=0;
    }
    $query="UPDATE pro0inter_users
            SET approved={$apr}
            WHERE ID={$sel_user}";
  }
  mysqli_query($conn,$query);
  confirm_query($conn);
    if (mysqli_affected_rows($conn)==1){
      // Succes
      $msg="selected action aplicated";
    }else{
      // Failed
      $msg="failed to applicate the selected action";
    }
}else{
  $msg="No selected user";

}
$src_page.=$msg;
redirect_to($src_page);

 ?>
