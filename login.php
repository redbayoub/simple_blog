
<?php require_once("includes/session.php") ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php if(loggedIn()){
  if (is_admin()) {
    redirect_to("admin.php");
  }else {
    redirect_to("index.php");
  }
} ?>
 <?php //form Proccesing
    if (isset($_POST["submit"])) {

        $username=mysql_prep(trim($_POST["username"]));
        $pass=sha1(mysql_prep(trim($_POST["pass"])));
        //$pass=mysql_prep(trim($_POST["pass"]));
        $query="SELECT ID,username,account_type,approved,description,image,firstname,surname
                FROM pro0inter_users
                WHERE username='{$username}'  AND password='{$pass}'
                LIMIT 1";
        $result=mysqli_query($conn,$query);
        confirm_query($conn);
        if (mysqli_num_rows($result)==1) {
          $user=mysqli_fetch_assoc($result);
          $_SESSION["id"]=$user["ID"];
          $_SESSION["username"]=$user["username"];
          $_SESSION["acc_type"]=$user["account_type"];
          $_SESSION["approved"]=$user["approved"];
          $_SESSION["description"]=$user["description"];
          $_SESSION["image"]=$user["image"];
          $_SESSION["fullname"]=$user["firstname"]." ".$user["surname"];
          redirect_to("admin.php");

        }else{
          $msg=urlencode("The Username/password Combination is wrong !");
          redirect_to("login.php?msg={$msg}");
        }
    }
?>
<?php // this include the header without nav
 include("includes/header.php");
 ?>
<br>
<div class="login">
  <form class="form_general" action="login.php" method="post">
    Username : <input type="text" name="username" value="" required><br><br>
    Password : <input type="password" name="pass" value="" required><br><br>
    <input type="submit" name="submit" value="Submit"> <a href="forget_pass.php">forgot password</a>
  </form>
</div>

<br>
<?php display_message(); ?>
<?php // this include the footer
 require("includes/footer.php");
 ?>
