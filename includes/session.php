<?php require_once("functions.php"); ?>
<?php
if(!isset($_SESSION["id"])){
  session_start();
}

 ?>
 <?php
 function loggedIn()
 {
   return isset($_SESSION["id"]);
 }
 function confirm_Logged_In()
 {
   if (!loggedIn()) {
     redirect_to("login.php");
   }
}

function is_admin($apr=0)
 {
   return ((($_SESSION["approved"]==$apr)||($_SESSION["approved"]==1))&&($_SESSION["acc_type"]=="A"));
 }

 function confirm_is_admin($apr=0)
 {
   if (!is_admin($apr)) {
     redirect_to("index.php");
   }
 }

 function is_writer($apr=0)
  {
    if (isset($_SESSION["approved"])) {
      return (($_SESSION["approved"]==$apr)||($_SESSION["approved"]==1));
    }
    return false;
  }


  ?>
