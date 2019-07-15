<?php require_once("includes/session.php"); ?>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($_GET["title"])) echo $_GET["title"];
                  else {
                    echo "Proffsionals Of Internet";
                  }
    ?></title>
    <link rel="stylesheet" href="./stylesheet/general.css">
  </head>
  <body>

    <div class="header">
      <?php
        if (loggedIn()) {
      ?>
      <div class="top_header">
            <?php  echo "Welcome ".$_SESSION["fullname"];?>
            <a href="logout.php" style="float:right;color:white;">&nbsp;Logout</a>
            <a href="account_settings.php" style="float:right;color:white;">&nbsp;&nbsp;Account Settings</a>
            <?php if (is_admin()) { ?>
              <a href="admin.php" style="float:right;color:white;">Admin</a>
            <?php } ?>
      </div>
      <?php } ?>



      <div class="mid_header">
        <!-- Social networks links
        <ul class="social_networks">
          <li> <a href="#">Facebook</a> </li>
          <li> <a href="#">Youtube</a> </li>
        </ul>
        -->
        <a href="index.php" ><img src="./images/logo.png" alt="Pro0inter Logo" class="logo"></a>


      </div>
    </div>
