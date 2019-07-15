<?php require_once("includes/session.php") ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_Logged_In(); ?>
<?php confirm_is_admin(); ?>
<?php // this include the header without nav
 include("includes/header.php");
?>
<br>
<div class="options_nav">
  <ul>

    <li><a class="<?php if(isset($_GET["opt"])&&($_GET["opt"]=="usersManage")) echo 'active'; ?>" href="admin.php?opt=usersManage">Users Mangement</a></li>
    <li><a class="<?php if(isset($_GET["opt"])&&($_GET["opt"]=="subjManage")) echo 'active'; ?>" href="admin.php?opt=subjManage">Subjects Management</a></li>
    <?php if (is_admin(1)) { ?>
    <li><a class="<?php if(isset($_GET["opt"])&&($_GET["opt"]=="fildesManage")) echo 'active'; ?>" href="admin.php?opt=fildesManage">Fildes Management</a></li>
    <?php } ?>
  </ul>
</div>
<div class="content">
  <h3><?php if(!isset($_GET["opt"])){
    echo "Choose any option to modify";
  }elseif ($_GET["opt"]=="usersManage") {
    echo "Users Mangement";
  }elseif ($_GET["opt"]=="fildesManage") {
    echo "Fildes Management";
  }elseif ($_GET["opt"]=="subjManage") {
    echo "Subjects Management";
  } ?></h3>
  <?php
    if (isset($_GET["opt"])){
      $option=$_GET["opt"];
      if ($option=="fildesManage"&&is_admin(1)) {
        include("includes/fildes_managment.php");
      }elseif ($option=="usersManage") {
        include("includes/users_managment.php");
      }elseif ($option=="subjManage") {
        include("includes/subjects_management.php");
      }
    }
  ?>
</div>


<?php display_message(); ?>
<?php // this include the footer
    require("includes/footer.php");
?>
