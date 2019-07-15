<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
  $subj_id=$_GET["subj_id"];
 ?>

<?php

    $query="UPDATE `pro0inter_subjects`
    SET subject_aproved=1
    WHERE subject_id={$subj_id}";

    mysqli_query($conn,$query);
    confirm_query($conn);


      if (mysqli_affected_rows($conn)==1){
        // Succes
        $msg=urlencode("Subject Aproved !");
        redirect_to("../admin.php?opt=subjManage&msg={$msg}");
      }else{
        // Failed
        $msg=urlencode("Failed to aprove Subject !");
        redirect_to("../admin.php?opt=subjManage&msg={$msg}");
      }

 ?>
