<?php require_once("includes/session.php") ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_Logged_In(); ?>


<?php  // form proccessing
    if (isset($_POST["edit"])) {
  // check old password login
      $username=mysql_prep(trim($_SESSION["username"]));
      $pass=sha1(mysql_prep(trim($_POST["olduserpass"])));
      $query="SELECT ID
              FROM pro0inter_users
              WHERE username='{$username}' AND password='{$pass}'
              LIMIT 1 ";
      $res=mysqli_query($conn,$query);
      confirm_query($conn);
      if (mysqli_num_rows($res)) { // user founded
        // form validation

        //Updating the user
        $newusername=mysql_prep($_POST["username"]);
        $newpass=sha1($_POST["newuserpass"]);
        $email=mysql_prep($_POST["email"]);
        $firstname=mysql_prep($_POST["firstname"]);
        $surname=mysql_prep($_POST["surname"]);
        $gender=$_POST["gender"];

        if (!empty($_POST["image"])) {
          $image=mysql_prep($_POST["image"]);
        }else {
          $image="";
        }
        if (!empty($_POST["descr"])) {
          $descr=mysql_prep($_POST["descr"]);
        }

        $query="UPDATE `pro0inter_users` SET
                  username='{$newusername}',
                  password='{$newpass}',
                  email='{$email}',
                  image='{$image}',
                  description='{$descr}',
                  firstname='{$firstname}',
                  surname='{$surname}',
                  gender='{$gender}'
                WHERE ID={$_SESSION["id"]} ";
        $res=mysqli_query($conn,$query);
        confirm_query($conn,$res);
        if (mysqli_affected_rows($conn)==1){
          // Succes
          $msg=urlencode("Your account had been sussefully edited !");
          redirect_to("logout.php?msg={$msg}");

        }else{
          // Failed
          $msg=urlencode("Failed to edit your account !");
          redirect_to("logout.php?msg={$msg}");
        }

      }else{
        // user not found
        redirect_to("login.php");
      }

    }
 ?>

 <?php $user=get_by_id("pro0inter_users","ID",$_SESSION["id"]); ?>
<?php // this include the header without nav
 include("includes/header.php");
 ?>
<form action="account_settings.php" method="post" class="form_general">
  Username :<br> <input type="text" name="username" required maxlength="50" value="<?php echo $user["username"]; ?>"><br>
  Old Password :<br> <input type="password" name="olduserpass" required maxlength="16" minlength="8"><br>
  Password :<br> <input type="password" name="newuserpass" required maxlength="16" minlength="8"><br>
  Email :<br> <input type="email" name="email" required value="<?php echo $user["email"]; ?>"><br>
  Firstname :<br> <input type="text" name="firstname" required maxlength="50"  value="<?php echo $user["firstname"]; ?>"><br>
  Surname :<br> <input type="text" name="surname" required maxlength="50" value="<?php echo $user["surname"]; ?>"><br>
  Gender :<br> <select name="gender" required> <br>
    <option value="M">Men</option>
    <option value="W">Women</option>
  </select> <br> <br>
  Image :<br> <input type="url" name="image" value="<?php echo $user["image"]; ?>"><br>
  Description: <br><textarea name="descr" maxlength="255" rows="8" cols="80" required> <?php echo $user["description"]; ?></textarea><br>

  <input type="submit" name="edit" value="Edit User">
</form>


 <?php // this include the footer
  require("includes/footer.php");
  ?>
