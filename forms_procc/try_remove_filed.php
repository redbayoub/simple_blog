<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
  $del_filed_by_nb=$_POST["del_filed_by_nb"];

 ?>
<?php

  $filed_res=get_by_nb("pro0inter_fildes",$del_filed_by_nb,1,"position","ASC");
  $filed_id=$filed_res["filed_id"];
  $filed_pos=$filed_res["position"];

  $query="UPDATE pro0inter_fildes
            SET position=position-1
            WHERE position>{$filed_pos}";
  mysqli_query($conn,$query);
  confirm_query($conn);

  $query="DELETE FROM pro0inter_fildes
          WHERE filed_id={$filed_id} ";

  mysqli_query($conn,$query);
  confirm_query($conn);

    if (mysqli_affected_rows($conn)==1){
      // Succes
      $msg=urlencode("Filed Removed !");
      redirect_to("../admin.php?opt=fildesManage&msg={$msg}");
    }else{
      // Failed
      $msg=urlencode("Failed to remove Filed Removed !");
      redirect_to("../admin.php?opt=fildesManage&msg={$msg}");
    }
 ?>
