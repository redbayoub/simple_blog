<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
  function redirect($msg)
  {
    if (isset($_GET["src_page"])) {
      redirect_to("{$_GET["src_page"]}&msg=".urlencode($msg));
    } else {
      redirect_to("index.php");
    }
  }
 ?>
<?php
  $subj_id=$_GET["subj_id"];
  $additional="";
  if (isset($_GET["showSubj"])){
    $additional="&showSubj={$_GET["showSubj"]}";
  }
 ?>

<?php

    $query="DELETE FROM `pro0inter_subjects`
    WHERE subject_id={$subj_id}";

    $res=mysqli_query($conn,$query);
    confirm_query($conn,$res);


      if (mysqli_affected_rows($conn)==1){
        // Succes
        redirect("Subject Removed");
      }else{
        // Failed
        redirect("Failed to remove Subject");
      }

 ?>
