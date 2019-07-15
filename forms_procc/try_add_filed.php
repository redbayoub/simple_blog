<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
  $filed_name=$_POST["filed_name"];
  $position=$_POST["position"];
 ?>
<?php
  $query="UPDATE pro0inter_fildes
        SET position=position+1
        WHERE position>={$position}";
  mysqli_query($conn,$query);
  confirm_query($conn);

  $query="INSERT INTO pro0inter_fildes (
        `filed_name`, `position`
        )VALUES ('{$filed_name}',
            '{$position}' )";
  mysqli_query($conn,$query);
  confirm_query($conn);

      if (mysqli_affected_rows($conn)==1){
        // Succes
        $msg=urlencode("Filed Added !");
        redirect_to("../admin.php?opt=fildesManage&msg={$msg}");
      }else{
        // Failed
        $msg=urlencode("Failed to add Filed !");
        redirect_to("../admin.php?opt=fildesManage&msg={$msg}");
      }

 ?>
