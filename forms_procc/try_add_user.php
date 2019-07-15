<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_Logged_In(); ?>
<?php
  $username=mysql_prep($_POST["username"]);
  $pass=sha1($_POST["userpass"]);
  $email=mysql_prep($_POST["email"]);
  $firstname=mysql_prep($_POST["firstname"]);
  $surname=mysql_prep($_POST["surname"]);
  $gender=$_POST["gender"];
  $acc_type=$_POST["acc_type"];

  if (!empty($_POST["image"])) {
    $image=mysql_prep($_POST["image"]);
  }else {
    $image="";
  }
  if (!empty($_POST["descr"])) {
    $descr=mysql_prep($_POST["descr"]);
  }
  if (isset($_POST["approved"])) {
    $apr=1;
  }else {
    $apr=0;
  }

 ?>
<?php
  $query="INSERT INTO `pro0inter_users`( `username`,
            `password`, `email`, `account_type`, `approved`,
            `image`, `description`, `firstname`, `surname`, `gender`)
          VALUES ( '{$username}',
            '{$pass}',
            '{$email}',
            '{$acc_type}',
            '{$apr}',
            '{$image}',
            '{$descr}',
            '{$firstname}',
            '{$surname}',
            '{$gender}' ) ";
  $res=mysqli_query($conn,$query);
  confirm_query($conn,$res);

      if (mysqli_affected_rows($conn)==1){
        // Succes
        $msg=urlencode("User Added !");
        redirect_to("../admin.php?opt=usersManage&msg={$msg}");
      }else{
        // Failed
        $msg=urlencode("Failed to add user !");
        redirect_to("../admin.php?opt=usersManage&msg={$msg}");
      }


 ?>
